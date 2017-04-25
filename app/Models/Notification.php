<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/25/2016
 * Time: 7:49 PM
 */

namespace Models;


use Framework\Base\Model;
use Globals\Utility;

class Notification extends Model
{
    public static function getNewNotifications($member_id, $offset = 0, $limit = 0){
        $status = Status::Notification_New;
        $sql = "SELECT * FROM notifications WHERE member_id = '$member_id' AND `statu` = '$status' ORDER BY `date` LIMIT $offset, $limit;";
        $result = \R::getAll($sql);
        $notifications = [];
        foreach ($result as $item) {
            $notification = new Notification();
            $notification->init($item);
            $notifications[] = $notification;
        }
        return $notifications;
    }

    public static function getRecentNotifications($member_id, $limit = 5){
        $status = Status::Notification_New;
        $sql = "SELECT * FROM notifications WHERE member_id = '$member_id' AND `status` = '$status' ORDER BY `date` LIMIT 0, $limit;";
        $result = \R::getAll($sql);
        $notifications = [];
        foreach ($result as $item) {
            $notification = new Notification();
            $notification->init($item);
            $notifications[] = $notification;
        }
        return $notifications;
    }


    public function __construct()
    {
        $this->setStatus(Status::Notification_New);
        $this->setDate(Utility::getCurrentDateTime());
    }

    protected $title;

    protected $message;

    protected $date;

    protected $member_id;

    protected $status;

    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $member_id;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

}