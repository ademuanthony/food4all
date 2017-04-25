<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/21/2016
 * Time: 12:02 AM
 */

namespace Models;


use Framework\Base\Model;

class UsedPin extends Model
{

    protected $pin_id;

    protected $member_id;

    protected $date;

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function setPinId($pin_id)
    {
        $this->pin_id = $pin_id;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function getPinId()
    {
        return $this->pin_id;
    }
}