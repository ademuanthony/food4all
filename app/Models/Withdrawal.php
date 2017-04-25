<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/20/2016
 * Time: 11:41 PM
 */

namespace Models;


use Framework\Base\Model;

class Withdrawal extends Model
{

    const Type_Cash = 1;
    const Type_Transfer = 2;
    const Type_Pin = 3;
    const Type_Food = 4;

    protected $member_id;

    protected $date;

    protected $amount;

    protected $type;

    protected $ref;

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }

}