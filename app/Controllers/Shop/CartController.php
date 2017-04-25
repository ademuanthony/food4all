<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/5/2016
 * Time: 9:32 AM
 */

namespace Controllers\Shop;


use Controllers\Backend\BackendBaseController;
use Controllers\FrontendBaseController;
use Globals\AppService;
use Models\Cart;
use Models\CartItem;
use Models\Order;
use Models\OrderItem;
use Models\Product;

class CartController extends BackendBaseController
{
    public function IndexAction(){
        $cart = Cart::current_cart();

        if(count($cart->getItems()) == 0){
            $this->flashError('Your shopping cart is empty');
        }

        $viewBag['cart'] = $cart;
        $viewBag['store'] = $this->store;
        $layout = ['title' => 'Shopping cart'];
        $layout['currentMenu'] = AppService::Shop;
        $viewBag['layout'] = $layout;

        return $this->render('index', $viewBag);
    }

    public function AddAction($product_id, $qnt){
        $cart = Cart::current_cart();
        $item = $cart->getItem($product_id);
        if(!$item) $item = new CartItem();
        $product = Product::find($product_id);
        $item->setQuantity($qnt);
        $item->setUnitPrice($product->getNewPrice());
        $item->setProductId($product_id);
        $item->setProduct($product);

        $cart->setItem($product_id, $item);
        $cart->save();

        $this->flashSuccess("$qnt item(s) added to your shopping cart");
        return $this->redirectTo(AppService::RouteCart);
    }

    public function RemoveAction($product_id){
        $cart = Cart::current_cart();
        $cart->removeItem($product_id);
        $this->flashSuccess('1 product have been removed from your cart');
        return $this->redirectTo(AppService::RouteCart);
    }

    public function IncreaseAction($product_id, $qnt){
        $cart = Cart::current_cart();
        $item = $cart->getItem($product_id);
        $item->setQuantity($item->getQuantity()+$qnt);
        $cart->setItem($product_id, $item);
        $cart->save();

        return $this->redirectTo(AppService::RouteCart);
    }

    public function ReduceAction($product_id, $qnt){
        $cart = Cart::current_cart();
        $item = $cart->getItem($product_id);
        $item->setQuantity($item->getQuantity() - $qnt);
        if($item->getQuantity() <= 0){
            $cart->removeItem($product_id);
        }else{
            $cart->setItem($product_id, $item);
        }
        $cart->save();

        return $this->redirectTo(AppService::RouteCart);
    }

    public function CheckoutAction(){
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $cart = Cart::current_cart();
        $member = $this->getCurrentMember();
        //if his balance is low, throw him back
        if($member->getBalance() < $cart->getTotal()){
            $this->flashError('Insufficient balance');
            return $this->back();
        }

        $order = $cart->createOrder();
        //make payment
        if($member->getFoodBalance() >= $cart->getTotal()){
            $member->withdraw($cart, 'food', $order->getId());
        }elseif ($member->getFoodBalance() == 0){
            $member->withdraw($cart->getTotal(), 'cash', $order->getId());
        }else{
            $rem = $cart->getTotal() - $member->getFoodBalance();
            $member->withdraw($member->getFoodBalance(), 'food', $order->getId());
            $member->withdraw($rem, 'cash', $order->getId());
        }


        $order->setType(Order::TYPE_FOOD);
        $order->setPaymentMethod('ab');
        $order->setDescription('Food Purchase');
        $order->save();

        $this->flashSuccess('Your order has been placed');
        $cart->delete();

        return $this->redirectTo(AppService::RouteBackendDashboard);

    }

}