<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 11/24/2016
 * Time: 6:44 AM
 */

namespace Controllers\Shop;


use Controllers\Backend\BackendBaseController;
use Controllers\BaseController;
use Models\Order;
use Models\SoldPin;
use Models\Status;

class PaymentController extends BackendBaseController
{
    public function PayAction($order_ref){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $order = Order::getOrderFromReference($order_ref);
        return $this->render('pay', ['order' => $order, 'member' => $this->getCurrentMember()]);
    }

    public function SuccessAction(){
        $transaction_reference = $this->request->get('TransactionReference');
        $order_ref = $this->request->get('OrderId');

        //verify

        $view_data = [];

        $order = Order::getOrderFromReference($order_ref);
        if($order->getPaymentStatus() != Status::Pending){
            $this->flashError('Payment has been recorded for this order');
            return $this->back();
        }
        $order->setPaymentStatus(Status::Payment_Completed);
        if($order->getType() == Order::TYPE_PINP){
            $ids = SoldPin::sell($order->getId(), $order->getExtras(), $order->getMemberId());
            if(!$ids){
                $this->flashError('Internal error in generating pins. Please try again later');
                $order->setStatus(Status::ORDER_PENDING_ITEMs_DELIVERY);
                $order->save();
                return $this->back();
            }
            $order->setStatus(Status::ORDER_ITEMs_DELIVERED);
            $order->save();
            $this->flashSuccess('Your order has been completed successfully and your account has been credited with ' . $order->getExtras(). 'PINs');
            return $this->render('success', $view_data);
        }else{
            //food purchase
        }
    }

    public function FailedAction(){

    }

    public function PendingAction(){

    }

    public function CancelledAction(){

    }
}