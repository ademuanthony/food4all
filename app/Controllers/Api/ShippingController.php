<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/30/2016
 * Time: 5:15 PM
 */

namespace Controllers\Api;


class ShippingController extends ApiBaseController
{
    public function CalculateCostAction(){
        $fstate = $this->request->get('fstate');
        $tstate = $this->request->get('tstate');
        $fcity = $this->request->get('fcity');
        $tcity = $this->request->get('tcity');

        return $this->json(['amount' => 750, 'success' => true]);
    }

}