<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/27/2016
 * Time: 11:44 AM
 */

namespace Models;


use Framework\Base\Model;

class LoanRequest extends Model
{
    protected $member_id;

    protected $month;

    protected $date;

    protected $amount;

    protected $status;

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

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

    public function setMonth($month)
    {
        $this->month = $month;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}