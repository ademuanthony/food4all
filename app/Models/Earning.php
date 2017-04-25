<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/20/2016
 * Time: 11:33 PM
 */

namespace Models;


use Framework\Base\Model;

class Earning extends Model
{
    public function __construct()
    {
        $this->setStageOfAvailability(0);
    }

    public function save()
    {
        $saved = parent::save();
        if($saved){
            $notification = new Notification();
            $notification->setTitle('Account Credited');
            $notification->setMemberId($this->getMemberId());
            $notification->setMessage('You have been credited with '. $this->getAmount() . ' from '. $this->getEvent());
            $notification->save();
        }

        return $saved; // TODO: Change the autogenerated stub
    }

    protected $member_id;

    protected $amount;

    protected $food_percentage;

    protected $cash_percentage;

    protected $date;

    protected $event;

    protected $ref;

    protected $status;

    protected $narration;

    protected $stage_of_availability;

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setFoodPercentage($food_percentage)
    {
        $this->food_percentage = $food_percentage;
        return $this;
    }

    public function getFoodPercentage()
    {
        return $this->food_percentage;
    }

    public function setCashPercentage($cash_percentage)
    {
        $this->cash_percentage = $cash_percentage;
        return $this;
    }

    public function getCashPercentage()
    {
        return $this->cash_percentage;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }

    public function getRef()
    {
        return $this->ref;
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

    public function setNarration($narration)
    {
        $this->narration = $narration;
        return $this;
    }

    public function getNarration()
    {
        return $this->narration;
    }

    public function setStageOfAvailability($stage_of_availability)
    {
        $this->stage_of_availability = $stage_of_availability;
        return $this;
    }

    public function getStageOfAvailability()
    {
        return $this->stage_of_availability;
    }

}