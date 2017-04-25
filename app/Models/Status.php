<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/5/2016
 * Time: 7:03 AM
 */

namespace Models;


use Framework\Base\Model;

class Status extends Model
{
    const Active = 1;
    const InActive = 2;

    const Pin_Used = 3;
    const Pin_Sold = 4;
    const Pin_Blocked = 5;

    const Notification_New = 6;
    const Notification_Read = 7;

    const Pending = 8;

    const Payment_Completed = 9;
    const Payment_Cancelled = 10;
    const Payment_Failed = 11;

    const ORDER_PENDING_ITEMs_DELIVERY = 12;
    const ORDER_ITEMs_DELIVERED = 13;

    protected $text;

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

}