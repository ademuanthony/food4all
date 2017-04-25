<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 1/9/2017
 * Time: 8:12 PM
 */

namespace Controllers\Api;


use Models\Member;

class RefController extends ApiBaseController
{
    public function GetMemberAction(){
        $key = $this->get('key');
        $value = $this->get('value');

        $member = Member::findOneBy(['conditions' => "$key = ?", 'bind' => [$value]]);
        if(!$member) return $this->sendError('Invalid identity');
        return $this->sendSuccess($member);
    }

}