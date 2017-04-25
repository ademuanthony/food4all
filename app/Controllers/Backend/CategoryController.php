<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 5:47 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Framework\Pagination\PageInfo;
use Models\Category;
use Globals\AppService;
use Models\Role;

class CategoryController extends BackendBaseController
{
    public function IndexAction()
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        /*$dql = "SELECT c FROM " . Category::getClassName() . " c WHERE c.store_id = '" . $this->store->getId() . "'";

        $query = $this->db->createQuery($dql)
            ->setFirstResult($off_set)
            ->setMaxResults($this->page_size);


        $query->useQueryCache(false);
        $query->useResultCache(false);

        $paginator =  new Paginator($query, $fetchJoinCollection = true);*/

        $page_info = Category::findAll(['store_id' => $this->store->getId()], $off_set, $this->page_size);

        return $this->render('list', ['page_info' => $page_info, 'layout' => ['title' => 'Categories', 'currentMenu' => 'categories']]);
    }

    public function AddAction()
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $category = new Category();
        if ($this->request->isMethod('post')) {
            try {

                $category->setName($this->request->get('name'));
                $category->setDescription($this->request->get('description'));
                $category->setKeywords($this->request->get('keywords'));
                $category->setMetaDescription($this->request->get('meta_description'));
                $category->setParentId(is_numeric($this->request->get('parent_id')) ? $this->request->get('parent_id') : null);
                $category->setStoreId($this->store->getId());
                $category->setPermalink($this->request->get('permalink'));

                if(empty($category->getPermalink())){
                    $category->setPermalink(str_replace(' ', '-', $category->getName()));
                }

                if(Category::findOneBy(['store_id' => $this->store->getId(), 'name' => $category->getName()])){
                    $this->flashError('A Category with the same name has already been added');
                }else{
                    if(Category::findOneBy(['store_id' => $this->store->getId(), 'permalink' => $category->getPermalink()])){
                        $category->setPermalink($category->getPermalink().time());
                    }
                    if($category->save()){
                        $this->flashSuccess('Category added');
                        return $this->redirectTo(AppService::RouteBackendCategories);
                    }else{
                        $this->flashError('A category with the same name already added');
                    }
                }

            } catch (\Exception $ex) {
                dd($ex->getMessage());
                $this->flashError('Category not added. Please review your input and try again');
            }

        }
        $categories = Category::findAll(array('store_id' => $this->store->getId()));

        return $this->render('add', ['category' => $category, 'categories' => $categories, 'layout' =>
            ['title' => 'Categories', 'currentMenu' => 'categories']]);
    }

    public function ManageAction($id)
    {
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        /** @var Category $category */
        $category = Category::find($id);
        if ($this->request->isMethod('post')) {
            try {
                $category->setName($this->request->get('name'));
                $category->setDescription($this->request->get('description'));
                $category->setKeywords($this->request->get('keywords'));
                $category->setMetaDescription($this->request->get('meta_description'));
                $category->setParentId(is_numeric($this->request->get('parent_id')) ? $this->request->get('parent_id') : null);
                $category->setStoreId($this->store->getId());

                /** @var Category $old_record */
                $old_record = Category::findOneBy(['store_id' => $this->store->getId(), 'name' => $category->getName()]);
                if($old_record && $old_record->getId() != $category->getId()){
                    $this->flashError('A category with the same name already exists');
                }else{
                    if(Category::findOneBy(['store_id' => $this->store->getId(), 'permalink' => $category->getPermalink()])){
                        $category->setPermalink($category->getPermalink().time());
                    }
                    if($category->save()){
                        $this->flashSuccess('Category added');
                        return $this->redirectTo(AppService::RouteBackendCategories);
                    }else{
                        $this->flashError('Unable to add category. Please try again later');
                    }
                }

            } catch (\Exception $ex) {
                dd($ex->getMessage());
                $this->flashError('Category not added. Please review your input and try again');
            }

        }
        $categories = Category::findAll(array('store_id' => $this->store->getId()));

        return $this->render('manage', ['category' => $category, 'categories' => $categories, 'layout' =>
            ['title' => 'Categories', 'currentMenu' => 'categories']]);
    }

    public function DeleteAction($id){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $category = Category::find($id);
        if($category){
            $category->delete();
        }
        $this->flashError('Category deleted');
        return $this->redirectTo(AppService::RouteBackendCategories);
    }
}