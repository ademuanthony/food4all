<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/11/2016
 * Time: 8:26 AM
 */

namespace Controllers\Backend;


use Framework\Pagination\PageInfo;
use Globals\Utility;
use Models\Member;
use Models\Transfer;
use Globals\AppService;

class TransactionsController extends BackendBaseController
{
    public function TransfersAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $viewData = ['layout' => ['title' => 'Fund Transfers', 'currentMenu' => AppService::Transactions]];
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $where = "sender_id = :sender_id OR receiver_id = :receiver_id";
        $bind = [':sender_id' => $this->getCurrentMember()->getMembershipId(), ':receiver_id' => $this->getCurrentMember()->getMembershipId()];
        $filter = [$where, 'bind' => $bind];
        $transfers = Transfer::fetchAll($off_set, $this->page_size, $filter);

        $total = Transfer::getCount($filter);

        $page_info = new PageInfo($transfers, $this->page_size, $off_set, $total);

        $viewData['page_info']  = $page_info;
        $viewData['off_set'] = $off_set;


        return $this->render('transfers', $viewData);
    }

    public function SendMoneyAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $receiver_id = $this->request->get('receiver_id');
        $amount = $this->request->get('amount');

        if(in_array(null, [$receiver_id, $amount])){
            $this->flashError('Please enter receiver ID and a valid amount');
            return $this->back();
        }
        if(!Member::getByMembershipId($receiver_id)){
            $this->flashError('Invalid Receiver ID');
            return $this->back();
        }
        if($receiver_id == $this->getCurrentMember()->getMembershipId()){
            $this->flashError('You cannot transfer money to yourself');
            return $this->back();
        }
        if($this->getCurrentMember()->getCashBalance() < $amount){
            $this->flashError('Insufficient balance');
            return $this->back();
        }
        $transfer = new Transfer();
        $transfer->init(['amount' => $amount, 'receiver_id' => $receiver_id, 'sender_id' => $this->getCurrentMember()->getMembershipId(), 'date' => date(Utility::DATETIME_FORMAT)]);
        if($transfer->save()){
            $this->flashSuccess('Fund transferred');
        }else $this->flashError('Error in transferring fund');
        return $this->back();
    }

}