<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/29/2016
 * Time: 10:10 AM
 */

namespace Models;


class StageThreeMember extends StageMember
{
    public function __construct()
    {
        $this->stage_id = 3;
    }
}