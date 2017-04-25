<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/10/2016
 * Time: 2:20 AM
 */

namespace Models;


class Tree
{
    const TYPE_GENEALOGY = 1;
    const TYPE_DIRECT_DOWNLINE = 2;
    const TYPE_ALL_DOWNLINE = 3;

    /**
     * @var Node
     */
    protected $root;

    public function __construct($root_title, $data, Genealogy $genealogy, $type = self::TYPE_GENEALOGY)
    {
        switch($type){
            case self::TYPE_GENEALOGY:
                $block =  $genealogy->getStage()->getBlock() + 1;
                break;
            case self::TYPE_DIRECT_DOWNLINE:
                $block = 2;
                break;
            case self::TYPE_ALL_DOWNLINE:
                $count  = count($data);
                $nth = (pow((1 - (($count * (1 - 2))/1)), 0.5));//find the n for the gp whose sum is $count
                //take out the decimal part
                $whole = floor($nth);
                $fraction = $nth - $whole;
                if($fraction > 0){
                    $whole += 1; //if there is a decimal, add 1
                }
                $block = $whole;
                break;
            default;
                throw new \Exception('Invalid tree type');
        }
        $root_item = from($data)->firstOrDefault(function($item) use ($root_title) {return $item['membership_id'] == $root_title;});

        $this->root = new Node($root_item, 1);
        $this->root->addChildren($data, $block);

        /*foreach ($data as $item) {
            if($item['membership_id'] == $root_title){
                $this->root = new Node($item, 1);
                $this->root->addChildren($data, $block);
            }
        }*/
    }

    public function display(){
        echo '<ul id="org"  class="tree">';
        $this->root->display();
        echo '</ul>';
    }

}