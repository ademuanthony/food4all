<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 4:36 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Framework\TinyMvc;
use Globals\Utility;
use Models\Slider;
use Symfony\Component\Config\Definition\Exception\Exception;
use Globals\AppService;

class SettingsController extends BackendBaseController
{
    public function IndexAction(){
        $sliders = Slider::findAll(['store_id' => $this->store->getId()]);
        $viewBag = [
            'themes' => Utility::getThemes(),
            'sliders' => $sliders,
            'store' => $this->store,
            'currentTheme' => $this->store->getTheme(),
            'layout' => ['title' => 'Settings', 'currentMenu' => 'settings']
        ];
        return $this->render('index', $viewBag);
    }

    public function SaveBasicInformationAction(){
        $store = $this->store;

    }

    public function ChangeThemeAction(){
        try{
            $theme = preg_replace('#[^a-z0-9]#i', '', $_POST['theme']);
            if(!isset(Utility::getThemes()[$theme])){
                $this->flashError('Invalid theme');
                return $this->redirectTo('settings');
            }

            $hColor = $this->request->get('hColor');
            $bColor = $this->request->get('bColor');
            $fColor = $this->request->get('fColor');

            // Path to the config file
            $file_name = TinyMvc::$config['root']."/web/stores/".$this->store->getSubDomain()."/themes/$theme/css/rastvorConfig.css";
            // Write data to the css file whether it exists or not
            $handle = fopen($file_name, 'w+');
            // Content to add to file
            $content = ".rastvor-config-button {
                color: #fff !important; background-color: $bColor !important;
            }
            .rastvor-config-header {background-color: $hColor !important;}
            .rastvor-config-footer {background-color: $fColor !important;}
            .rastvor-config-text {color: $bColor !important;}";
            // Write the core config style to the file
            fwrite($handle, $content);
            // Close the file
            fclose($handle);

            $store = $this->store;

            $store->setTheme($this->request->get('theme'));
            $store->setHeaderColor($hColor);
            $store->setFooterColor($fColor);
            $store->setBottomColor($bColor);

            $store->save();
            $this->flashSuccess('Theme updated');
            return $this->redirectTo(AppService::RouteBackendSettings);
        }catch (Exception $ex){
            Utility::slackDebug('Theme no updated: ', $ex->getMessage());
            $this->flashError('Unable to save changes please try again later');
            return $this->redirectTo('settings');
        }


    }

    public function AddSliderAction(){
        $slider = new Slider();
        $slider->setBody($this->request->get('body'));
        $slider->setTitle($this->request->get('title'));
        $slider->setShortInfo($this->request->get('short_info'));
        $slider->setStoreId($this->store->getId());
        $slider->setLandingPage($this->request->get('landing_page'));
        $slider->setActionText($this->request->get('action_text'));
        $slider->setSortOrder($this->request->get('sort_order'));

        //upload image
        $handle = new \upload($_FILES['image']);
        if($handle->uploaded){
            $file_name = str_replace(' ', '_', $slider->getTitle());
            $ext = $handle->file_src_name_ext;
            $folder_path = "web/stores/".$this->store->getSubDomain()."/sliders";
            //delete the old image
            if(file_exists(TinyMvc::$config['appFolder']."$folder_path/$file_name.$ext")){
                unlink(TinyMvc::$config['appFolder']."$folder_path/$file_name.$ext");
            }
            $handle->file_new_name_body  = $file_name;

            $handle->process($this->store->getAssetRootFolder()."/sliders");
            if($handle->processed){
                $slider->setImage("stores/".$this->store->getSubDomain()."/sliders/$file_name.$ext");
            }else{
                $this->flashError('Slider not saved. Unable to upload image');
                return $this->redirectTo(AppService::RouteBackendSettings);
            }

            $handle->clean();
        }

        //upload image2
        $handle = new \upload($_FILES['image2']);
        if($handle->uploaded){
            $file_name = str_replace(' ', '_', $slider->getTitle()).'2';
            $ext = $handle->file_src_name_ext;
            $folder_path = "web/stores/".$this->store->getSubDomain()."/sliders";
            //delete the old image
            if(file_exists(TinyMvc::$config['appFolder']."$folder_path/$file_name.$ext")){
                unlink(TinyMvc::$config['appFolder']."$folder_path/$file_name.$ext");
            }
            $handle->file_new_name_body  = $file_name;

            $handle->process($this->store->getAssetRootFolder()."/sliders");
            if($handle->processed){
                $slider->setImage2("stores/".$this->store->getSubDomain()."/sliders/$file_name.$ext");
            }else{
                $this->flashError('Slider not saved. Unable to upload image');
                return $this->redirectTo('settings');
            }

            $handle->clean();
        }else{
            $slider->setImage2('');
        }

        $slider->save();
        $this->flashSuccess('Slider saved');

        return $this->redirectTo(AppService::RouteBackendSettings);

    }

    public function DeleteSliderAction($id){
        /** @var Slider $slider */
        $slider = Slider::find($id);
        if(!$slider){
            $this->flashError('Slider not found');
        }else{
            if(file_exists(TinyMvc::$config['root'].'/web/'.$slider->getImage())){
                unlink(TinyMvc::$config['root'].'/web/'.$slider->getImage());
            }
            if(file_exists(TinyMvc::$config['root'].'/web/'.$slider->getImage2())){
                unlink(TinyMvc::$config['root'].'/web/'.$slider->getImage2());
            }
            $slider->delete();
            $this->flashSuccess('Slider deleted');
        }
        return $this->redirectTo(AppService::RouteBackendSettings);
    }

}