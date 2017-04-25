<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/20/2016
 * Time: 10:49 PM
 */

namespace Models;


use Framework\Base\Model;

class BankDetail extends Model
{
    protected $member_id;

    protected $bank_name;

    protected $account_name;

    protected $account_number;

    protected $branch_name;

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
        return $this;
    }

    public function getBankName()
    {
        return $this->bank_name;
    }

    public function setAccountName($account_name)
    {
        $this->account_name = $account_name;
        return $this;
    }

    public function getAccountName()
    {
        return $this->account_name;
    }

    public function setAccountNumber($account_number)
    {
        $this->account_number = $account_number;
        return $this;
    }

    public function getAccountNumber()
    {
        return $this->account_number;
    }

    public function setBranchName($branch_name)
    {
        $this->branch_name = $branch_name;
        return $this;
    }

    public function getBranchName()
    {
        return $this->branch_name;
    }
}
