<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/24/2016
 * Time: 3:49 PM
 */

namespace Models;


use Framework\Base\Model;

class MatrixStage extends Model
{
    public static function getStageName($stage){
        switch($stage){
            case 1:
                return 'Food Chanel';
            break;
            default:
                return 'Food Keeper';
            break;
        }
    }

    public static function getStageImage($stage, $gender){
        $gender = strtolower($gender);
        return "/web/app/images/stage_avatars/stage-$stage-$gender.png";
    }

    protected $number;

    protected $label;

    protected $block;

    protected $complete_line_up;

    protected $prize;

    protected $matching_bonus_percentage;

    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }

    public function setCompleteLineUp($complete_line_up)
    {
        $this->complete_line_up = $complete_line_up;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setMatchingBonusPercentage($matching_bonus_percentage)
    {
        $this->matching_bonus_percentage = $matching_bonus_percentage;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setPrize($prize)
    {
        $this->prize = $prize;
        return $this;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function getCompleteLineUp()
    {
        return $this->complete_line_up;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getMatchingBonusPercentage()
    {
        return $this->matching_bonus_percentage;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPrize()
    {
        return $this->prize;
    }

    private $firstLevel = null;
    /**
     * @return MatrixLevel|null
     */
    public function getFirstLevel(){
        if($this->firstLevel == null){
            $this->firstLevel = MatrixLevel::findOneBy(['stage_id' => $this->getId(), 'number' => 1]);
        }
        return $this->firstLevel;
    }
}