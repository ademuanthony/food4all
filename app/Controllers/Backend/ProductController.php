<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 1:40 AM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Framework\Pagination\PageInfo;
use Framework\TinyMvc;
use Globals\Utility;
use Models\Category;
use Models\Product;
use Globals\AppService;
use Models\Role;

class ProductController extends BackendBaseController
{
    public function IndexAction()
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = Product::getAllProducts($this->store->getId(), $off_set, $this->page_size);

        return $this->render('list', ['page_info' => $page_info, 'layout' => ['title' => 'Products', 'currentMenu' => 'products']]);
    }

    public function AddAction()
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $product = new Product();
        if ($this->request->isMethod('post')) {
            try {
                $product->setName($this->request->get('name'));
                $product->setQuantity($this->request->get('quantity'));
                $product->setWeight($this->request->get('weight'));
                $product->setDescription($this->request->get('description'));
                $product->setKeywords($this->request->get('keywords'));
                $product->setMetaDescription($this->request->get('meta_description'));
                $product->setCategoryId($this->request->get('category_id'));
                $product->setNewPrice($this->request->get('new_price', 0));
                $product->setOldPrice($this->request->get('old_price', 0));
                $product->setPermalink($this->request->get('permalink'));
                $product->setIsFeatured($this->request->get('is_featured', false));
                $product->setImages('');
                $product->setStoreId($this->store->getId());

                if(Product::findOneBy(['name' => $product->getName()])){
                    $this->flashError('A product with the same name have already been added');
                }else{
                    if(empty($product->getPermalink())){
                        $product->setPermalink(str_replace(' ', '-', $product->getName()));
                    }
                    if(Product::findOneBy(['permalink' => $product->getPermalink()])){
                        $product->setPermalink($product->getPermalink().time());
                    }

                    //upload image
                    $handle = new \upload($_FILES['image']);
                    if($handle->uploaded){
                        $file_name = str_replace(' ', '_', $product->getName());
                        //delete the old image
                        $old_file = TinyMvc::$config['root'].'/web/'.$file_name.'.'.$handle->file_src_name_ext;
                        if(file_exists($old_file)){
                            unlink($old_file);
                        }
                        $handle->file_new_name_body  = $file_name;

                        $handle->process($this->store->getAssetRootFolder()."/products/original");
                        if($handle->processed){
                            $product->setMainImage($file_name.'.'.$handle->file_src_name_ext);

                            //save thumbnail getFileFullName
                            $handle->image_max_height = 100;
                            $handle->image_max_width = 100;
                            $handle->process($this->store->getAssetRootFolder()."/products/thumbnail");
                        }


                        $handle->clean();
                    }


                    $product->save();
                    $this->flashSuccess('Product added');
                    return $this->redirectTo(AppService::RouteBackendProducts);
                }

            } catch (\Exception $ex) {
                Utility::slackDebug('Product not added', $ex->getMessage());
                $this->flashError('Product not added. Please review your input and try again');
            }

        }
        $categories = Category::findAll(array('store_id' => $this->store->getId()));

        return $this->render('add', ['product' => $product, 'categories' => $categories, 'layout' =>
            ['title' => 'Add Product', 'currentMenu' => 'products']]);
    }

    public function ManageAction($id)
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        /** @var Product $product */
        $product = Product::find($id);
        if(!$product){
            $this->flashError('Product not found');
            return $this->redirectTo('products');
        }
        if ($this->request->isMethod('post')) {
            try {
                $product->setName($this->request->get('name'));
                $product->setQuantity($this->request->get('quantity'));
                $product->setWeight($this->request->get('weight'));
                $product->setDescription($this->request->get('description'));
                $product->setKeywords($this->request->get('keywords'));
                $product->setMetaDescription($this->request->get('meta_description'));
                $product->setCategory(Category::find($this->request->get('category_id')));
                $product->setNewPrice($this->request->get('new_price', 0));
                $product->setOldPrice($this->request->get('old_price', 0));
                $product->setIsFeatured($this->request->get('is_featured', false));
                $product->setPermalink($this->request->get('permalink'));
                $product->setImages('');
                $product->setStoreId($this->store->getId());

                //upload image
                $handle = new \upload($_FILES['image']);
                if($handle->uploaded){
                    //delete the old image
                    if(file_exists($product->getMainImage())){
                        unlink($product->getMainImage());
                    }
                    $file_name = str_replace(' ', '_', $product->getName());
                    $handle->file_new_name_body  = $file_name;

                    $handle->process($this->store->getAssetRootFolder()."/products/original");
                    if($handle->processed){
                        $product->setMainImage($file_name.'.'.$handle->file_dst_name_ext);

                        //save thumbnail getFileFullName
                        $handle->image_max_height = 100;
                        $handle->image_max_width = 100;
                        $handle->process($this->store->getAssetRootFolder()."/products/thumbnail");
                    }


                    $handle->clean();
                }


                $product->save();
                $this->flashSuccess('Product updated');
                return $this->redirectTo(AppService::RouteBackendProducts);
            } catch (\Exception $ex) {
                Utility::slackDebug('Product not edited', $ex->getMessage());
                $this->flashError('Product not upodated. Please review your input and try again');
            }

        }
        $categories = Category::findAll(array('store_id' => $this->store->getId()));

        return $this->render('manage', ['product' => $product, 'categories' => $categories, 'layout' =>
            ['title' => 'Manage Product', 'currentMenu' => 'products']]);
    }

    public function DeleteAction($id){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $product = Product::find($id);
        if(!$product){
            $this->flashError('Product not found');
        }else{
            $product->delete();
            $this->flashSuccess('Product deleted');
        }
        return $this->redirectTo(AppService::RouteBackendProducts);
    }
}