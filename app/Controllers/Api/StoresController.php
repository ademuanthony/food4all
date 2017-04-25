<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/25/2016
 * Time: 6:47 AM
 */

namespace Controllers\Api;


use Models\CartItem;
use Models\Category;
use Models\Product;
use Models\Slider;
use Models\Store;

class StoresController extends ApiBaseController
{
    public function FillDefaultDataAction($store_id){
        dd('here');
        /** @var Store $store */
        $store = Store::find($store_id);
        if(!$store){
            return $this->json(['message' => 'Invalid Store Id', 'success = false']);
        }
        //create sliders
       $this->fillSliders($store);

        //create products and categories
        $category = new Category();
        $category->setName('Fashion');
        $fashion_id = $category->getId();
        $category->save();

        $category = new Category();
        $category->setName('Sportwears');
        $category->save();

        $category=new Category();
        $category->setName('Household');
        $category->save();

        $category = new Category();
        $category->setName('Interiors');
        $category->save();

        //create products
        $product = new Product();
        $product->setName('Product Name');
        $product->setCategoryId($fashion_id);

        return $this->json(['succes' => true]);

    }

    private function fillSliders(Store $store)
    {
        $slider = new Slider();
        $slider->setTitle($store->getName());
        $slider->setStoreId($store->getId());
        $slider->setShortInfo('Smartest Shop on The Planet');
        $slider->setBody('This is a collection of all the you need. This is '.$store->getName().'... The best store on the internet');
        $slider->setActionText('Shop Now');
        $slider->setLandingPage('#');
        $slider->setImage('girl1.jpg');
        $slider->setImage2('pricing.png');
        $slider->save();

        $slider = new Slider();
        $slider->setTitle($store->getName());
        $slider->setStoreId($store->getId());
        $slider->setShortInfo('Smartest Shop on The Planet');
        $slider->setBody('This is a collection of all the you need. This is '.$store->getName().'... The best store on the internet');
        $slider->setActionText('Shop Now');
        $slider->setLandingPage('#');
        $slider->setImage('girl2.jpg');
        $slider->setImage2('pricing.png');
        $slider->save();

        $slider = new Slider();
        $slider->setTitle($store->getName());
        $slider->setStoreId($store->getId());
        $slider->setShortInfo('Smartest Shop on The Planet');
        $slider->setBody('This is a collection of all the you need. This is '.$store->getName().'... The best store on the internet');
        $slider->setActionText('Shop Now');
        $slider->setLandingPage('#');
        $slider->setImage('girl3.jpg');
        $slider->setImage2('pricing.png');
        $slider->save();


        copy('web/themes/eleganza/images/home/girl1.jpg',  'web/stores/'.$store->getSubDomain().'/sliders/girl1.jpg');
        copy('web/themes/eleganza/images/home/girl2.jpg',  'web/stores/'.$store->getSubDomain().'/sliders/girl1.jpg');
        copy('web/themes/eleganza/images/home/girl3.jpg',  'web/stores/'.$store->getSubDomain().'/sliders/girl1.jpg');
        copy('web/themes/eleganza/images/home/pricing.png',  'web/stores/'.$store->getSubDomain().'/sliders/pricing.png');
    }
}