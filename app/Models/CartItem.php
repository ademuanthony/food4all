<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/8/2016
 * Time: 6:25 AM
 */

namespace Models;


class CartItem extends OrderItem
{
    public function createOrderItem(){
        $item = new OrderItem();
        $item->setQuantity($this->getQuantity());
        $item->setUnitPrice($this->getUnitPrice());
        $item->setProductId($this->getProductId());
        return $item;
    }
}