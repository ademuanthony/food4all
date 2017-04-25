<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/17/2016
 * Time: 6:03 AM
 */

namespace Models;


use Framework\Base\Model;

class Genealogy extends Model
{
 /*   public static function getLevelsInStage($stage){
        switch($stage){
            case 1:
                return 2;
            case 2:
                return 4;
            case 3:
                return 6;
        }
    }*/

    protected $membership_id;

    protected $level_id;

    protected $stage_id;

    public function setLevelId($level_id)
    {
        $this->level_id = $level_id;
        return $this;
    }

    public function setMembershipId($membership_id)
    {
        $this->membership_id = $membership_id;
        return $this;
    }

    public function setStageId($stage_id)
    {
        $this->stage_id = $stage_id;
        return $this;
    }

    public function getLevelId()
    {
        return $this->level_id;
    }

    public function getMembershipId()
    {
        return $this->membership_id;
    }

    public function getStageId()
    {
        return $this->stage_id;
    }

    private $stage = null;

    /**
     * @return MatrixStage|null
     */
    public function getStage(){
        if($this->stage == null){
            $this->stage = MatrixStage::find($this->stage_id);
        }
        return $this->stage;
    }

    private $level = null;

    /**
     * @return MatrixLevel|null
     */
    public function getLevel(){
        if($this->level == null){
            $this->level = MatrixLevel::find($this->level_id);
        }
        return $this->level;
    }

}