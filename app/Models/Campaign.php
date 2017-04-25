<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 1/7/2017
 * Time: 1:16 PM
 */

namespace Models;


use Framework\Base\Model;
use Globals\Utility;

class Campaign extends Model
{
    protected $id;

    protected $title;

    protected $content;

    protected $image;

    public function getTitle(){
        return $this->title;
    }

    public function getContent(){
        return $this->content;
    }

    public function getImage(){
        return $this->image;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    public function setImage($image){
        $this->image = $image;
        return $this;
    }

    public function getFileFullName($type = 'original'){
        return "stores/food/campaigns/$type/".$this->getImage();
    }

}