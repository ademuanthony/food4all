<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/29/2016
 * Time: 10:30 AM
 */

namespace Models;


class StageOneMember extends StageMember
{
    public function __construct()
    {
        $this->stage_id = 1;
    }

    public static function getNextFreeUpline($upline = '')
    {
        return parent::getNextFreeUpline($upline, 1); // TODO: Change the autogenerated stub
    }
}