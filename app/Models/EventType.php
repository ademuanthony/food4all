<?php
/**
 * Created by PhpStorm.
 * User: ademu
 * Date: 5/7/17
 * Time: 12:44 PM
 */

namespace Models;


use Framework\Base\Model;

class EventType extends Model
{
    const STAGE_ONE_COMPLETED = 'stage_one_completed';
    const STAGE_TWO_COMPLETED = 'stage_two_completed';
    const STAGE_THREE_COMPLETED = 'stage_three_completed';
    const STAGE_FOUR_COMPLETED = 'stage_four_completed';
    const STAGE_FIVE_COMPLETED = 'stage_five_completed';


    protected $name;

    protected $key;

    protected $reward;

    protected $sponsors_reward;

    protected $description;

    protected $stage_id;

    protected $descendants_count;

    protected $right_descendant_count;

    protected $left_descendant_count;

    protected $requires_balanced_descendant; // tells if the number of descendants on the left mus equal the number of the right

    protected $is_multiple; // tells wheather or not this event type occurs multiple time

    protected $food_percentage;

    protected $cash_percentage;


    /**
     * @param mixed $stage_id
     * @return $this
     */
    public function setStageId($stage_id)
    {
        $this->stage_id = $stage_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStageId()
    {
        return $this->stage_id;
    }

    /**
     * @param mixed $sponsors_reward
     * @return $this
     */
    public function setSponsorsReward($sponsors_reward)
    {
        $this->sponsors_reward = $sponsors_reward;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSponsorsReward()
    {
        return $this->sponsors_reward;
    }

    /**
     * @return mixed
     */
    public function getFoodPercentage()
    {
        return $this->food_percentage;
    }


    /**
     * @return mixed
     */
    public function getCashPercentage()
    {
        return $this->cash_percentage;
    }

    /**
     * @param $membership_id string
     * @param $stageId int
     * @return EventType[]
     */
    public static function getPendingEventsForMember($membership_id, $stageId)
    {
        $sql = "SELECT eventtypes.* FROM eventtypes INNER JOIN events ON eventtypes.id = events.type_id 
                  INNER JOIN members ON members.membership_id = events.membership_id 
                WHERE events.id IS NULL AND members.membership_id = $membership_id AND eventtypes.stage_id = $stageId";
        $result = \R::getAll($sql);
        $eventTypes = [];
        foreach ($result as $item) {
            $eventType = new EventType();
            $eventType->init($item);
            $eventTypes[] = $eventType;
        }
        return $eventTypes;
    }

    /**
     * @param mixed $food_percentage
     * @return $this
     */
    public function setFoodPercentage($food_percentage)
    {
        $this->food_percentage = $food_percentage;
        return $this;
    }

    /**
     * @param mixed $cash_percentage
     * @return $this
     */
    public function setCashPercentage($cash_percentage)
    {
        $this->cash_percentage = $cash_percentage;
        return $this;
    }

    /**
     * @param mixed $right_descendant_count
     * @return $this
     */
    public function setRightDescendantCount($right_descendant_count)
    {
        $this->right_descendant_count = $right_descendant_count;
        return $this;
    }

    /**
     * @param mixed $left_descendant_count
     * @return $this
     */
    public function setLeftDescendantCount($left_descendant_count)
    {
        $this->left_descendant_count = $left_descendant_count;
        return $this;
    }

    /**
     * @param mixed $descendants_count
     * @return $this
     */
    public function setDescendantsCount($descendants_count)
    {
        $this->descendants_count = $descendants_count;
        return $this;
    }

    /**
     * @param mixed $requires_balanced_descendant
     * @return $this
     */
    public function setRequiresBalancedDescendant($requires_balanced_descendant)
    {
        $this->requires_balanced_descendant = $requires_balanced_descendant;
        return $this;
    }

    /**
     * @param mixed $is_multiple
     * @return $this
     */
    public function setIsMultiple($is_multiple)
    {
        $this->is_multiple = $is_multiple;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getIsMultiple()
    {
        return $this->is_multiple;
    }

    /**
     * @return mixed
     */
    public function getRequiresBalancedDescendant()
    {
        return $this->requires_balanced_descendant;
    }

    /**
     * @return mixed
     */
    public function getDescendantsCount()
    {
        return $this->descendants_count;
    }

    /**
     * @return mixed
     */
    public function getLeftDescendantCount()
    {
        return $this->left_descendant_count;
    }

    /**
     * @return mixed
     */
    public function getRightDescendantCount()
    {
        return $this->right_descendant_count;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $reward
     * @return $this
     */
    public function setReward($reward)
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}