<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/25/2016
 * Time: 8:47 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Models\Notification;
use Models\Status;

class NotificationController extends BackendBaseController
{
    public function IndexAction(){

    }

    public function ReadAction($id){
        $notification = Notification::find($id);
        $this->flashSuccess($notification->getMessage());
        $notification->setStatus(Status::Notification_Read);
        $notification->save();
        return $this->back();
    }

}