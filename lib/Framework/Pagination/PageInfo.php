<?php

/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 1:47 AM
 */
namespace Framework\Pagination;

class PageInfo
{
    public function __construct(array $data, $limit, $off_set, $total)
    {
        $this->data = $data;
        $this->off_set = $off_set;
        $this->limit = $limit;
        $this->total = $total;

        $this->page = $this->limit == 0? 1: ($this->off_set/$this->limit) + 1;

        $this->number_of_pages = $this->limit == 0? 1: $this->total%$this->limit == 0?
            ($this->total - $this->total%$this->limit)/$this->limit : ($this->total - $this->total%$this->limit)/$this->limit + 1;
    }

    /** @var  array */
    public $data;

    public $off_set;

    public $page;

    public $limit;

    public $total;

    private $number_of_pages;

    /**
     * @return array
     */
    public function getPages(){

        $pages = array();
        for($i = 1; $i <= $this->number_of_pages; $i++){
            $pages[] = $i;
        }
        return $pages;
    }

    public function pageDetail($record_title = "records"){
        $off_set = $this->off_set + 1;
        $max = $this->off_set + $this->limit;
        $max = $max > $this->total?$this->total:$max;
        return "Showing $off_set - $max of ".$this->total." $record_title";
    }

    /**
     * @return bool
     */
    public function hasRecord(){
        return $this->total > 0;
    }
    /**
     * @param int $page
     * @return bool
     */
    public function isCurrentPage($page){
        return $this->page == $page;
    }

    public function isFirstPage(){
        return $this->page == 1;
    }

    public function isLastPage(){
        return $this->number_of_pages == $this->page;
    }

}