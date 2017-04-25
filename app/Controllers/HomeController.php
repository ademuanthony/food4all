<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 7:40 AM
 */

namespace Controllers;

use Globals\Utility;
use Models\Category;
use Models\Product;
use Models\Slider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Tests\Controller;

class HomeController extends FrontendBaseController
{
    public function IndexAction(){
        $viewBag = [];
        $viewBag['sliders'] = Slider::findAll(['store_id' => $this->store->getId()]);

        return $this->render('home', $viewBag);
    }

    public function ReadAction($name){
        return new Response("This is home page ".$name);
    }

    public function AboutAction() {
        return $this->render('about');
    }

    public function CompensationAction() {
        return $this->render('compensation');
    }

    public function FaqAction() {
        return $this->render('faq');
    }

    public function GalleryAction() {
        return $this->render('gallery');
    }

    public function HowItWorksAction() {
        return $this->render('howitworks');
    }

    public function SupportAction() {
        return $this->render('support');
    }

    public function ContactAction() {
        return $this->render('contact');
    }

}