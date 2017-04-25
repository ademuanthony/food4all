<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/10/2016
 * Time: 2:23 AM
 */

namespace Models;


class Node
{
    /** @var  Node */
    protected $left_node;
    /** @var  Node */
    protected $right_node;

    protected $left_index;

    protected $right_index;

    protected $stage;


    protected $title;
    protected $username;
    protected $parent;
    protected $level;

    public function __construct($data, $level)
    {
        $this->title = $data['membership_id'];
        $this->parent = $data['parent_id'];
        $this->username = $data['username'];
        $this->left_index = $data['left_index'];
        $this->right_index = $data['right_index'];
        $this->stage = array_key_exists('stage_id', $data)? $data['stage_id']: 0;
        $this->level = $level;
    }

    public function addChildren(&$data_array, $max_stage){
        if($this->level == $max_stage) return;
        //set his left and his right
        //his left is the first closest left to his left and right 

        $left_item = from($data_array)->where(function($item){
            return $item['left_index'] > $this->left_index && $item['right_index'] < $this->right_index;
        })->firstOrDefault();
        if($left_item == null) $left_item = ['username' => 'Empty', 'membership_id' => 'Empty', 'parent_id' => '',
            'left_index' => 0, 'right_index' => 0];
        else
            if(($key = array_search($left_item, $data_array)) !== false) {
                unset($data_array[$key]);
            }else{
                dd('y');
            }

        $this->left_node = new Node($left_item, $this->level+1);
        $this->left_node->addChildren($data_array, $max_stage);

        $right_item = from($data_array)->where(function($item){
            return $item['left_index'] > $this->left_index && $item['right_index'] < $this->right_index;
        })->firstOrDefault();

        if($right_item == null) $right_item = ['username' => 'Empty', 'membership_id' => 'Empty', 'parent_id' => '',
            'left_index' => 0, 'right_index' => 0];
        else
            if(($key = array_search($right_item, $data_array)) !== false) {
                unset($data_array[$key]);
            }else{
                dd('yr');
            }


        $this->right_node = new Node($right_item, $this->level+1);
        $this->right_node->addChildren($data_array, $max_stage);




       /* foreach ($data_array as $item) {
            if($item['parent_id'] == $this->title){
                if($this->left_node == null){
                    $this->left_node = new Node($item, $this->level+1);
                    $this->left_node->addChildren($data_array, $max_stage);
                }else{
                    $this->right_node = new Node($item, $this->level+1);
                    $this->right_node->addChildren($data_array, $max_stage);
                }
            }
        }


        if($this->left_node == null){
            $this->left_node =  new Node(['username' => 'Empty', 'membership_id' => 'Empty', 'parent_id' => '', 'left_index' => $this->left_index + 1, 'right_index' => $this->right_index -1], $this->level+1);
            $this->left_node->addChildren($data_array, $max_stage);
        }
        if($this->right_node == null){
            $this->right_node = new Node(['username' => 'Empty', 'membership_id' => 'Empty', 'parent_id' => '', 'left_index' => $this->left_index + 1, 'right_index' => $this->right_index -1], $this->level+1);
            $this->right_node->addChildren($data_array, $max_stage);
        }*/

    }

    public function display(){
        $img = $this->stage == 0?'/web/themes/food/images/empty-member.png':MatrixStage::getStageImage($this->stage, 'male');
        echo "<li><span><img style='width:25px;' src='$img'/><br/>
                    $this->username</span>";
        if($this->left_node != null || $this->right_node != null){
            echo '<ul>';
            if($this->left_node != null){
                $this->left_node->display();
            }
            if($this->right_node!=null){
                $this->right_node->display();
            }
            echo '</ul>';
        }
        echo '</li>';
    }
}