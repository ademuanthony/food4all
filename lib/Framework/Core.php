<?php

namespace Framework;

use Doctrine\ORM\EntityManager;
use Framework\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use
    Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Core implements HttpKernelInterface
{
    /** @var RouteCollection */
    protected $routes;

    protected $routeContext;

    /** @var EventDispatcher */
    protected $dispatcher;

    /** @var array  */
    protected $config;

    /** @var  EntityManager */
    public $db;

    /** @var  string */
    public $currentRoute;

    public function __construct($config)
    {
        $this->routes = new RouteCollection();
        $this->dispatcher = new EventDispatcher();
        $this->config = $config;
        TinyMvc::$config = $config;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $event = new RequestEvent();
        $event->setRequest($request);

        $this->dispatcher->dispatch('request', $event);

        // create a context using the current request
        $context = new RequestContext();
        $context->fromRequest($request);
        $this->routeContext = $context;

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());

            $this->currentRoute = $attributes['_route'];

            $this->setRoute($this->currentRoute);


            $controller = $attributes['controller'];
            unset($attributes['controller']);

            $cSplit = explode('::', $controller);
            if(count($cSplit) > 1){
                /* @var Base\Controller $controllerObj */
                $controllerObj = new $cSplit[0]();

                $response = call_user_func_array(array($controllerObj, $cSplit[1]), $attributes);
            }else{
                $response = call_user_func_array($controller, $attributes);
            }
        } catch (ResourceNotFoundException $e) {
            if(TinyMvc::$config['env'] == 'dev')
                throw $e;
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        }
        return $response;
    }

    public function map($slug, $path, $controller) {
        $this->routes->add($slug, new Route(
            $path,
            array('controller' => $controller)
        ));
    }

    public function generateUrl($slug, array $param = array()){
        $generator = new UrlGenerator($this->routes, $this->routeContext);
        $url = $generator->generate($slug, $param);
        return $url;
    }

    public function on($event, $callback)
    {
        $this->dispatcher->addListener($event, $callback);
    }

    public function fire($event)
    {
        return $this->dispatcher->dispatch($event);
    }


    private function setRoute($route)
    {
        if($this->getCurrentRoute() == $route) return;
        self::session('previous_route', self::session('current_route'));
        self::session('current_route', $route);
    }

    public function getCurrentRoute(){
        return self::session('current_route');
    }

    public function getPreviousRoute(){
        return self::session('previous_route');
    }

    /**
     * get or set a session by key
     * @param $key
     * @param null $value
     * @return null
     */
    private static function session($key, $value = null){
        if(!isset($_SESSION)){
            session_start();
        }
        if($value != null){
            $_SESSION[$key] = $value;
        }
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
}