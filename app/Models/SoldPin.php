<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/23/2016
 * Time: 11:25 AM
 */

namespace Models;


use Framework\Base\Model;

class SoldPin extends Model
{
    public static function sell($order_id, $number, $member_id){
        $ids = [];
        for($i = 1; $i<=$number; $i++){
            $card = RegistrationPin::createOne();
            if(!$card){
                return false;
            }

            $ids[] = $card->getId();

            $soldPin = new SoldPin();
            $soldPin->setPinId($card->getId());
            $soldPin->setMemberId($member_id);
            $soldPin->setDateOfPurchase(date('Y-m-d H:i:s'));
            $soldPin->setOrderId($order_id);
            $soldPin->save();
        }

        return $ids;
    }
    /**
     * @param $membership_id
     * @return array
     */
    public static function getPurchasedPin($membership_id){
        $sql = "SELECT pin.pin, pin.serial_number, pin.status, sold_pin.date_of_purchase from soldpins sold_pin
                JOIN registrationpins pin ON sold_pin.pin_id = pin.id where member_id = '$membership_id'";
        return \R::getAll($sql);
    }

    protected $pin_id;

    protected $member_id;

    protected $date_of_purchase;

    protected $order_id;

    public function setDateOfPurchase($date_of_purchase)
    {
        $this->date_of_purchase = $date_of_purchase;
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

    public function getDateOfPurchase()
    {
        return $this->date_of_purchase;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function getPinId()
    {
        return $this->pin_id;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }
}