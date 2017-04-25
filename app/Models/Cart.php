<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/8/2016
 * Time: 6:25 AM
 */

namespace Models;


use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\Status;
use Globals\Utility;
use Exception;

class Cart
{
    /**
     * @return Cart
     */
    public static function current_cart(){
        $cart = Utility::getInstance()->session('cart');
        if(!$cart) $cart = new Cart();
        return $cart;
    }

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param $product_id
     * @param CartItem $item
     * @return Cart $this
     */
    public function setItem($product_id, CartItem $item){
        $this->items[$product_id] = $item;
        return $this;
    }

    /**
     * @param $product_id
     * @return Cart $this
     */
    public function removeItem($product_id){
        unset($this->items[$product_id]);
        return $this;
    }

    /**
     * @param $product_id
     * @return CartItem
     */
    public function getItem($product_id){
        return isset($this->items[$product_id])?$this->items[$product_id]:null;
    }

    /**
     * @return array
     */
    public function getItems(){
        return $this->items;
    }

    /**
     * @return int
     */
    public function getItemsCount(){
        return count($this->items);
    }

    public function getTotal(){
        $total = 0;
        foreach ($this->getItems() as $item) {
            /** @var $item CartItem */
            $total += $item->getTotal();
        }
        return $total;
    }

    public function createOrder(){
        try{
            Model::beginTransaction();

            $order = new Order();
            //$order->setStoreId(Utility::getInstance()->getStore()->getId());
            $order->setDate(new \DateTime('now'));
            $order->setMemberId(Utility::getInstance()->getCurrentUser()->getId());
            $order->save();

            foreach ($this->getItems() as $item) {
                /** @var CartItem $item */
                $order_item = $item->createOrderItem();
                $order_item->setOrderId($order->getId());
                $order_item->save();
            }

            Model::commit();
            return $order;
        }catch (Exception $e){
            Model::rollBack();

            if(TinyMvc::$config['env'] == 'dev')
                throw $e;
            else
                Utility::slackDebug('Food4all - Exception', $e->getMessage());
            return false;
        }

    }

    /**
     * @return Cart $this
     */
    public function save(){
        Utility::getInstance()->session('cart', $this);
        return $this;
    }

    public function delete(){
        Utility::getInstance()->session('cart', new Cart());
    }
}