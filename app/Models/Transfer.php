<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/11/2016
 * Time: 7:44 AM
 */

namespace Models;


use Framework\Base\Model;

class Transfer extends Model
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $sender_id;

    /**
     * @var string
     */
    protected $receiver_id;

    /**
     * @var double
     */
    protected $amount;

    /**
     * @var string
     */
    protected $date;

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getSenderid()
    {
        return $this->sender_id;
    }

    public function getReceiverid()
    {
        return $this->receiver_id;
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

    public function setSenderid($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function setReceiverid($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        return $this;
    }

    public function save()
    {
        $saved = parent::save(); // TODO: Change the autogenerated stub
        if($saved){
            $notification = new Notification();
            $notification->setTitle('Account Credited');
            $notification->setMemberId($this->getReceiverid());
            $notification->setMessage('You have been credited with '. $this->getAmount() . ' from fund transfer');
            $notification->save();
        }
        return $saved;
    }

    public static function fetchAll($off_set, $count, $filter = [])
    {
        $where = $filter[0];
        $sql = "
        SELECT
            t.id,
            t.sender_id,
            t.receiver_id,
            t.amount,
            t.date,
            s.firstname as s_firstname,
            s.lastname as s_lastname,
            r.firstname as r_firstname,
            r.lastname as r_lastname
        FROM transfers t
            INNER JOIN members s ON t.sender_id = s.membership_id
            INNER JOIN members r ON t.receiver_id = r.membership_id
        WHERE $where LIMIT $off_set, $count;
        ";


        return \R::getAll($sql, array_key_exists('bind', $filter)?$filter['bind']:[]);
    }

}