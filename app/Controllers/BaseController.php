<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 7:42 AM
 */

namespace Controllers;


use Framework\Base\Controller;
use Globals\AppService;
use Globals\Utility;
use Models\Category;
use Models\Notification;
use Symfony\Component\HttpFoundation\Response;
use Models\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->store = Utility::getInstance()->getStore();
    }

    /**
     * @var \Models\Store
     */
    protected $store;

    protected $page_size = 3;

    protected function render($view, array $data = [], $renderPartial = false)
    {
        if(!isset($data['layout'])) $data['layout'] = [];
        $data['layout']['store'] = $this->store;

        $data['layout']['categories'] = Category::getParentCategories($this->store->getId());
        $data['layout']['user'] = $this->getCurrentUser();
        $data['layout']['member'] = $this->getCurrentMember();

        $data['layout']['notifications'] = Notification::getRecentNotifications($this->getCurrentMember()->getMembershipId());
        return parent::render($view, $data, $renderPartial);
    }

    /**
     * @return Auth|boolean
     */
    public function getCurrentUser(){
        return Utility::getInstance()->getCurrentUser();
    }

    public function getCurrentMember(){
        return Utility::getInstance()->getCurrentMember();
    }

    public function requestIsAuthenticated(){
        return $this->getCurrentUser() != false;
    }


    protected function accessDenied(){
        if($this->requestIsAuthenticated()) {
            $this->flashError('Access Denied, you do not have the right to access that route');
            return $this->back();
        }
        $this->flashError('Access Denied, Please login to continue');
        return $this->redirectTo(AppService::Login);
    }

    /**
     * @return \Models\Auth
     */
    protected function getUser(){
        return Utility::getInstance()->getCurrentUser();
    }

    protected function isInRole(array $roles = []){
        return in_array($this->getUser()->getRole(), $roles);
    }
}