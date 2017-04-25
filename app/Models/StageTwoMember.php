<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/29/2016
 * Time: 10:08 AM
 */

namespace Models;


class StageTwoMember extends StageMember
{
    public function __construct()
    {
        $this->stage_id = 2;
    }
}