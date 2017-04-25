<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 8:17 AM
 */

namespace Framework\Base;

/** @var $config array */


use Doctrine\ORM\EntityManager;
use Framework\Core;
use Framework\TinyMvc;
use Globals\AppService;
use Globals\Utility;
use Plasticbrain\FlashMessages\FlashMessages;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\Helper\AssetsHelper;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

class Controller
{
    /** @var Request */
    protected $request;

    protected $layoutPath;

    protected $layout;

    /** @var  EntityManager */
    protected $db;

    private $flashMessage;

    public $title;

    public function __construct()
    {
        if (!session_id()) @session_start();
        $this->flashMessage = new FlashMessages();
        $this->request = Request::createFromGlobals();
        $this->db = TinyMvc::$config['db'];

        $this->viewPath = 'app/Views';
        $this->layout = 'main.php';
        $this->layoutPath = 'app/Views/layout';
    }

    public function flashSuccess($message){
        $this->flashMessage->success($message);
    }

    public function flashError($message){
        $this->flashMessage->error($message);
    }

    protected $scripts = [];
    protected function addScript($scriptUri){
        $this->scripts[] = $scriptUri;
        return $this;
    }

    protected $styles = [];
    protected function addStyle($styleUri){
        $this->styles[] = $styleUri;
        return $this;
    }

    protected function get($key, $default = null, $deep = false){
        return $this->request->get($key, $default, $deep);
    }
    /**
     * @param $data
     * @return Response
     */
    protected function raw($data){
        return new Response($data, 200, ['Content-Type' => 'text/plian']);
    }

    /**
     * @param array $data
     * @return Response
     */
    protected function json(array $data){
        return new Response(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }
    /**
     * @param string $message
     * @return Response
     */
    protected function sendError($message = 'Internal Error'){
        return $this->json(['message' => $message, 'success' => false]);
    }

    /**
     * @param array|Model $data
     * @return Response
     */
    protected function sendSuccess($data){
        if(is_subclass_of($data, 'Framework\Base\Model')) {
            $data = $data->getData();
        }
        return $this->json(['data' => $data, 'success' => true]);
    }
    /**
     * @param $view
     * @param array $data
     * @param bool|false $renderPartial
     * @return Response
     */
    protected function render($view, array $data = [], $renderPartial = false){
        $view.='.php';
        $loader = new FilesystemLoader($this->getViewFullPath().'/%name%');
        $templateEngine = new PhpEngine(new TemplateNameParser(), $loader);
        $templateEngine->set(new AssetsHelper('/web'));
        //if partial rendering add script and style
        if($renderPartial){
            $data['j_scripts'] = $this->scripts;
            $data['c_styles'] = $this->styles;
        }
        $content = $templateEngine->render($view, $data);

        if(!$renderPartial){
            $loader = new FilesystemLoader($this->getLayoutPath().'/%name%');
            $templateEngine = new PhpEngine(new TemplateNameParser(), $loader);
            $templateEngine->set(new AssetsHelper('/web'));
            if(!isset($data['layout'])){
                $data['layout'] = [];
            }

            $data['layout']['j_scripts'] = $this->scripts;
            $data['layout']['c_styles'] = $this->styles;
            $data['layout'] = array_merge($data['layout'], ['content' => $content]);
            $content = $templateEngine->render($this->getLayoutFile(), $data['layout']);
        }


        return new Response($content);
    }

    protected function renderPartial($view, array $data = []){
        return $this->render($view, $data, true);
    }

    protected function getViewInnerFolder(){
        $class_name = get_called_class();
        //take off the Controller extension
        $class_name = substr($class_name, 0, strlen($class_name) - 10);
        $cSplitted = explode('\\', $class_name);
        unset($cSplitted[0]);
        $path = implode('/', $cSplitted);
        return strtolower($path);
    }

    protected function getViewFullPath(){
        $path = TinyMvc::$config['root'].'/'.$this->viewPath.'/'.$this->getViewInnerFolder();
        return $path;
    }

    protected function getLayoutPath(){
        return TinyMvc::$config['root'].'/'.$this->layoutPath;
    }

    protected function getLayoutFile(){
        return $this->layout;
    }


    public function redirectTo($route, array $route_param = []){
        return new RedirectResponse(TinyMvc::toRoute($route, $route_param));
    }

    protected function getDefaultPage(){
        return 'home';
    }

    /**
     * @return RedirectResponse
     */
    public function back(){
        $previous_route = TinyMvc::$app->getPreviousRoute()? TinyMvc::$app->getPreviousRoute():$this->getDefaultPage();
        return $this->redirectTo($previous_route);
    }

    public function copyFolder($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->copyFolder($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}