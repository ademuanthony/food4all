<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/24/2016
 * Time: 3:49 PM
 */

namespace Models;


use Framework\Base\Model;

class MatrixLevel extends Model
{
    protected $stage_id;

    protected $label;

    protected $number;

    protected $block;

    protected $complete_line_up;

    protected $prize;

    protected $matching_bonus_percentage;

    public function setPrize($prize)
    {
        $this->prize = $prize;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setMatchingBonusPercentage($matching_bonus_percentage)
    {
        $this->matching_bonus_percentage = $matching_bonus_percentage;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

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

    public function setStageId($stage_id)
    {
        $this->stage_id = $stage_id;
        return $this;
    }


    public function getPrize()
    {
        return $this->prize;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getMatchingBonusPercentage()
    {
        return $this->matching_bonus_percentage;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function getCompleteLineUp()
    {
        return $this->complete_line_up;
    }

    public function getStageId()
    {
        return $this->stage_id;
    }

}