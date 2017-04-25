<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 11/24/2016
 * Time: 3:12 PM
 */

namespace Models;


use Framework\Base\Model;

class TempMember extends Model
{
    protected $sponsor_id;
    protected $parent_id;
    protected $username;
    protected $email;
    protected $password;
    protected $number_of_accounts;
    protected $payment_method;

    public function getEmail()
    {
        return $this->email;
    }

    public function getNumberOfAccounts()
    {
        return $this->number_of_accounts;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSponsorId()
    {
        return $this->sponsor_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setNumberOfAccounts($number_of_accounts)
    {
        $this->number_of_accounts = $number_of_accounts;
        return $this;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setSponsorId($sponsor_id)
    {
        $this->sponsor_id = $sponsor_id;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    public function getRef(){
        return 'TEMP'.str_pad($this->getId(), 7, '0', STR_PAD_LEFT);
    }

    public static function getIdFromReference($ref){
        $id_text = substr($ref, 4, strlen($ref)-4);
        return intval($id_text);
    }

    /**
     * @param $ref
     * @return TempMember|null
     */
    public static function getFromRef($ref){
        $id = self::getIdFromReference($ref);
        return self::find($id);
    }
}