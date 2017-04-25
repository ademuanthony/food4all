<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/30/2016
 * Time: 4:17 PM
 */

namespace Controllers\Api;


class OrdersController extends ApiBaseController
{
    public function callbackAction(){
        $order_id = $this->request->get('order_id');
        $key = $this->request->get('key');
        $payment_method = $this->request->get('payment_method');
    }
}