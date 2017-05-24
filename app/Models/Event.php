<?php
/**
 * Created by PhpStorm.
 * User: ademu
 * Date: 5/23/17
 * Time: 2:29 PM
 */

namespace Models;


use Framework\Base\Model;

class Event extends Model
{
    protected $type_id;

    protected $membership_id;

    protected $date;

    /**
     * @param mixed $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
        return $this;
    }

    /**
     * @param mixed $membership_id
     * @return $this
     */
    public function setMembershipId($membership_id)
    {
        $this->membership_id = $membership_id;
        return $this;
    }

    /**
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * @return mixed
     */
    public function getMembershipId()
    {
        return $this->membership_id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}