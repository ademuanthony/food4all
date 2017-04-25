<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 5:14 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Globals\Utility;
use Models\Member;
use Models\Notification;
use Models\Order;

class DashboardController extends BackendBaseController
{
    public function IndexAction()
    {
        $order = Order::find(6);
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $member = $this->getCurrentMember();
        return $this->render('index', ['member' => $member]);
    }
}