<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/27/2016
 * Time: 11:48 AM
 */

namespace Models;


use Framework\Base\Model;

class LoanPayback extends Model
{
    protected $loan_id;

    protected $amount;

    protected $date;

    protected $payment_method;

    public function getDate()
    {
        return $this->date;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function getLoanId()
    {
        return $this->loan_id;
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

    public function setLoanId($loan_id)
    {
        $this->loan_id = $loan_id;
        return $this;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        return $this;
    }
}