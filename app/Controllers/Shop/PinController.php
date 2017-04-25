<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/23/2016
 * Time: 11:20 AM
 */

namespace Controllers\Shop;


use Controllers\Backend\BackendBaseController;
use Controllers\BaseController;
use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\AppService;
use Globals\Utility;
use Models\Order;
use Models\RegistrationPin;
use Models\SoldPin;
use Models\Status;

class PinController extends BackendBaseController
{
    public function IndexAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $member = $this->getCurrentMember();

        $pins = SoldPin::getPurchasedPin($member->getId());

        $viewBag = ['cards' => $pins, 'layout' => ['currentMenu' => AppService::Shop]];

        return $this->render('index', $viewBag);
    }

    public function BuyAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();

        $data = $this->request->get('data');

        $number_pin = $data['number'];
        $payment_method = $data['payment_method'];


        if(in_array(null, $data)){
            $this->flashError('Required fields not sent');
            return $this->back();
        }

        $member = $this->getCurrentMember();

        if(!$member->validateTransactionPin($data['pin'])){
            $this->flashError('Invalid transaction pin');
            return $this->back();
        }

        $order = new Order();
        $order->setType(Order::TYPE_PINP);
        $order->setDescription('PIN Purchase');
        $order->setMemberId($this->getCurrentMember()->getId());
        $order->setExtras($number_pin);

        if($payment_method == 'ab'){
            Model::beginTransaction();
            try{
                $price_per_pin = TinyMvc::$config['registration_fee'];
                $amount_need = $price_per_pin * $number_pin;
                if($member->getCashBalance() < $amount_need){
                    $this->flashError('You do not have enough money to perform this transaction');
                    return $this->back();
                }


                $order->setPaymentMethod('ac');
                $order->setPaymentStatus(Status::Payment_Completed);
                $order->setType(Order::TYPE_PINP);
                $order->save();

                $ids = SoldPin::sell($order->getId(), $number_pin, $this->getCurrentMember()->getId());
                if(!$ids){
                    $this->flashError('Internal error in generating PINS. Please try again later');
                    Model::rollBack();
                    return $this->back();
                }

                $member->withdraw($amount_need, 'cash', implode(',', $ids));

                Model::commit();
                $this->flashSuccess('You have successfully bought '.$number_pin.' pin(s)');
                return $this->redirectTo(AppService::Pin);
            }catch (\Exception $ex){
                Utility::slackDebug('Error in buying pin', $ex->getMessage());
                Model::rollBack();
                $this->flashError('Internal error in creating pin. Please try again later');
                return $this->back();
            }

        }elseif($payment_method == 'cc'){
            $order->setPaymentMethod('cc');
            $order->setPaymentStatus(Status::Pending);
            $order->save();
            return $this->redirectTo(AppService::Payment_Pay, ['order_ref' => $order->getRef()]);
        }

    }
}