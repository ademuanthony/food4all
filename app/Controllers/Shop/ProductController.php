<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/5/2016
 * Time: 4:08 AM
 */

namespace Controllers\Shop;


use Controllers\Backend\BackendBaseController;
use Framework\Pagination\PageInfo;
use Globals\AppService;
use Models\Category;
use Models\Product;

class ProductController extends BackendBaseController
{

    public function IndexAction()
    {
        if(!$this->requestIsAuthenticated()) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = Product::getAllProducts($this->store->getId(), $off_set, $this->page_size);

        //dd($page_info);

        return $this->render('index', ['page_info' => $page_info, 'layout' => ['title' => 'Products', 'currentMenu' => AppService::Shop]]);
    }

    public function ViewAction($permalink){
        return $this->redirectTo(AppService::RouteFrontendProducts);
        /** @var Product $product */
        $product = Product::findOneBy(['permalink' => $permalink]);

        $viewBag['categories'] = Category::getParentCategories($this->store->getId());
        $viewBag['layout'] = ['title' => $product->getName(), 'currentMenu' => AppService::RouteFrontendProducts];
        $viewBag['product'] = $product;

        return $this->render('view', $viewBag);
    }



}