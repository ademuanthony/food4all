<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/29/2016
 * Time: 10:05 AM
 */

namespace Models;


use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\AppConstants;
use Globals\Utility;

class StageMember extends Model
{
    protected function getTableName()
    {
        return 'stagemembers'; // TODO: Change the autogenerated stub
    }

    public function save()
    {
        //if there are event types for this stage
        if(EventType::count(['stage_id' => $this->getStageId()]) > 0){
            //get the current_member that is being added to a new stage
            $current_member = Member::getByMembershipId($this->getMembershipId());
            if(!$current_member) return false;
            $members = $current_member->getAncestors();
            $members[] = $current_member;

            /** @var Member $member */
            foreach ($members as $member) {
                $downlineCount = self::getDownlineCount($member, $this->getStageId());
                $pendingEvents = EventType::getPendingEventsForMember($member->getId(), $this->getStageId());
                /** @var EventType $eventType */
                $eventType = from($pendingEvents)->firstOrDefault(function (EventType $type) use($downlineCount){
                    return $type->getDescendantsCount() >= $downlineCount;
                });
                if($eventType){
                    //create event and earning
                    $earning = new Earning();
                    $earning->setEvent($eventType->getName());
                    $earning->setAmount($eventType->getReward());
                    $earning->setStatus(Status::Active);

                    $earning->setMemberId($member->getMembershipId());
                    $earning->setAmount($eventType->getReward());
                    $earning->setFoodPercentage($eventType->getFoodPercentage());
                    $earning->setCashPercentage($eventType->getCashPercentage());
                    $earning->setNarration($eventType->getDescription());
                    $earning->setRef($member->getMembershipId());
                    $earning->setStageOfAvailability($eventType->getStageId());

                    $earning->setDate(date('Y-m-d H:i:s'));
                    if($earning->save()){//create event and earning
                        if($eventType->getSponsorsReward() > 0){
                            //if earning is set for sponsor, add it
                            $earning = new Earning();
                            $earning->setEvent($member->getMembershipId().' '.$eventType->getName());
                            $earning->setAmount($eventType->getSponsorsReward());
                            $earning->setStatus(Status::Active);

                            $earning->setMemberId($member->getSponsorId());
                            $earning->setAmount($eventType->getSponsorsReward());
                            $earning->setFoodPercentage($eventType->getFoodPercentage());
                            $earning->setCashPercentage($eventType->getCashPercentage());
                            $earning->setNarration($member->getMembershipId().' '. $eventType->getDescription());
                            $earning->setRef($member->getMembershipId());

                            $earning->setDate(date('Y-m-d H:i:s'));
                            $earning->save();

                        }

                        // log the event
                        $event = new Event();
                        $event->setTypeId($eventType->getId());
                        $event->setMembershipId($member->getMembershipId());
                        $event->setDate(Utility::getCurrentDateTime());
                        if(!$event->save()) {
                            Utility::slackDebug('Canont save event', "Error in create ".$eventType->getName()." event
                             for ".$member->getMembershipId());
                            return false;
                        }
                    }else{
                        Utility::slackDebug('Cannot save earning', "Error in saving for ".$eventType->getName() ." event
                             for ".$member->getMembershipId());
                        return false;
                    }


                }
            }
        }

        return parent::save(); // TODO: Change the autogenerated stub
    }


    public static function haveCompletedStage(Member $member, MatrixStage $stage){
        $left_index = $member->getLeftIndex();
        $right_index = $member->getRightIndex();

        $block = $member->getLevel() + $stage->getBlock();

        //todo: left and right should come from the member's table
        $sql = "SELECT COUNT(id) AS no FROM stagemembers INNER JOIN members ON members.membership_id = stagemember.membership_id
                WHERE (members.left_index BETWEEN $left_index AND $right_index)";
        if($stage->getId() == AppConstants::STAGE_ONE){
            $sql.= " AND (`block` = $block)";
        }
        $result = \R::getAll($sql);

        $result = $result[0]['no'] == $stage->getCompleteLineUp();
        return $result;
    }

    public static function getDownlines(Member $member, MatrixStage $stage){
        $left = $member->getLeftIndex(); $right = $member->getRightIndex();
        $stage_id = $stage->getId();

        //todo: left, right parent andd block should come from the member's table
        $sql = "SELECT membership_id, parent_id, left_index, right_index, username, `block` FROM stagemembers
                INNER JOIN members ON members.membership_id = stagemember.membership_id
                WHERE (members.left_index BETWEEN $left AND $right) AND stagemembers.stage_id = $stage_id ORDER BY members.left_index ASC;";

        $result = \R::getAll($sql);

        return $result;
    }

    public static function getDownlineCount(Member $member, $stage_id){
        $sql = "SELECT COUNT(membership_id) AS number FROM stagemembers
                INNER JOIN members ON members.membership_id = stagemember.membership_id
                WHERE (members.left_index BETWEEN $member->getLeftIndex() AND $member->getRightIndex())
                 AND stagemembers.stage_id = $stage_id ORDER BY members.left_index ASC;";

        $result = \R::getAll($sql);

        return $result[0]['number'];
    }


    protected $membership_id;

    protected $fistname;

    protected $lastname;

    protected $username;

    protected $left_index;

    protected $right_index;

    protected $parent_id;

    protected $stage_id;

    protected $block;

    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }

    public function setLeftIndex($left_index)
    {
        $this->left_index = $left_index;
        return $this;
    }

    public function setMembershipId($membership_id)
    {
        $this->membership_id = $membership_id;
        return $this;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    public function setRightIndex($right_index)
    {
        $this->right_index = $right_index;
        return $this;
    }

    public function setStageId($stage_id)
    {
        $this->stage_id = $stage_id;
        return $this;
    }

    public function setFistname($fistname)
    {
        $this->fistname = $fistname;
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function getLeftIndex()
    {
        return $this->left_index;
    }

    public function getMembershipId()
    {
        return $this->membership_id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function getRightIndex()
    {
        return $this->right_index;
    }

    public function getStageId()
    {
        return $this->stage_id;
    }

}