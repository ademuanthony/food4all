<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 1/7/2017
 * Time: 1:20 PM
 */

namespace Controllers\Backend;



use Globals\AppService;
use Models\Campaign;
use Models\Role;
use Framework\TinyMvc;

class CampaignsController extends BackendBaseController
{
    public function indexAction(){
        if(!$this->requestIsAuthenticated() || !$this->isInRole([Role::Admin])) return $this->accessDenied();
        $page = $this->request->get('page', 1);
        $off_set = ($page - 1) * $this->page_size;

        $page_info = Campaign::findAll([], $off_set, $this->page_size);

        return $this->render('index', ['page_info' => $page_info,
            'layout' => ['title' => 'Campaigns setup', 'currentMenu' => AppService::BackendCampaigns]]);
    }

    public function AddAction(){
        $campaign = new Campaign();

        if($this->request->isMethod('post')){
            $title = $this->request->get('title');
            $content = $this->request->get('content');
            if(in_array(null, [$title, $content])){
                $this->flashError('Required fields not sent');
                return $this->back();
            }
            $campaign->setContent($content);
            $campaign->setTitle($title);

            //upload image
            $handle = new \upload($_FILES['image']);
            if($handle->uploaded){
                $file_name = str_replace(' ', '_', $campaign->getTitle());
                //delete the old image
                $old_file = TinyMvc::$config['root'].'/web/'.$file_name.'.'.$handle->file_src_name_ext;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
                $handle->file_new_name_body  = $file_name;

                $handle->process($this->store->getAssetRootFolder()."/campaigns/original");
                if($handle->processed){
                    $campaign->setImage($file_name.'.'.$handle->file_src_name_ext);

                    //save thumbnail getFileFullName
                    $handle->image_max_height = 100;
                    $handle->image_max_width = 100;
                    $handle->process($this->store->getAssetRootFolder()."/campaigns/thumbnail");
                }


                $handle->clean();
            }
            $campaign->save();
            $this->flashError('Campaign saved');
            return $this->redirectTo(AppService::BackendCampaigns);
        }

        return $this->render('add', ['campaign' => $campaign]);
    }

    public function ManageAction(){
        $id = $this->request->get('id');
        /** @var \Models\Campaign $campaign */
        $campaign = Campaign::find($id);
        if(!$campaign){
            $this->flashError('Campaign not found');
            return $this->back();
        }

        if($this->request->isMethod('post')){
            $title = $this->request->get('title');
            $content = $this->request->get('content');
            if(in_array(null, [$title, $content])){
                $this->flashError('Required fields not sent');
                return $this->back();
            }
            $campaign->setContent($content);
            $campaign->setTitle($title);

            //upload image
            $handle = new \upload($_FILES['image']);
            if($handle->uploaded){
                $file_name = str_replace(' ', '_', $campaign->getTitle());
                //delete the old image
                $old_file = TinyMvc::$config['root'].'/web/'.$file_name.'.'.$handle->file_src_name_ext;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
                $handle->file_new_name_body  = $file_name;

                $handle->process($this->store->getAssetRootFolder()."/campaigns/original");
                if($handle->processed){
                    $campaign->setImage($file_name.'.'.$handle->file_src_name_ext);

                    //save thumbnail getFileFullName
                    $handle->image_max_height = 100;
                    $handle->image_max_width = 100;
                    $handle->process($this->store->getAssetRootFolder()."/campaigns/thumbnail");
                }


                $handle->clean();
            }
            $campaign->save();
            $this->flashSuccess('Campaign saved');
            return $this->redirectTo(AppService::BackendCampaigns);
        }


        return $this->render('add', ['campaign' => $campaign]);
    }
}