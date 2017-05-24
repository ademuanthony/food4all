<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/22/2016
 * Time: 6:55 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Models\Earning;

class EarningsController extends BackendBaseController
{
    public function IndexAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = Earning::findAll(['member_id' => $this->getCurrentMember()->getMembershipId()], $off_set, $this->page_size);

        return $this->render('index', ['page_info' => $page_info, 'layout' => ['title' => 'Earnings']]);
    }
}