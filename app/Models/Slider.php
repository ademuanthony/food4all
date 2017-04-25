<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 4:48 PM
 */

namespace Models;

use Framework\Base\Model;

/** @Entity @Table(name="sc_sliders") */
class Slider extends Model
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @var  @Column(type="integer") */
    protected $store_id;

    /** @Column(type="string", length=28) */
    protected $title;

    /** @Column(type="string", length=50) */
    protected $short_info;

    /** @Column(type="string", length=128) */
    protected $body;

    /** @Column(type="string", length=50) */
    protected $image;

    /** @Column(type="string", length=50) */
    protected $image2;

    /** @Column(type="string", length=128) */
    protected $landing_page;

    /** @Column(type="string", length=128) */
    protected $action_text;

    /** @Column(type="integer") */
    protected $sort_order;

    /** @ManyToOne(targetEntity="Store", inversedBy="sliders") */
    /** @JoinColumn(name="store_id", referencedColumnName="id") */
    protected $store;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set store_id
     *
     * @param integer $storeId
     * @return Slider
     */
    public function setStoreId($storeId)
    {
        $this->store_id = $storeId;

        return $this;
    }

    /**
     * Get store_id
     *
     * @return integer 
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Slider
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set short_info
     *
     * @param string $shortInfo
     * @return Slider
     */
    public function setShortInfo($shortInfo)
    {
        $this->short_info = $shortInfo;

        return $this;
    }

    /**
     * Get short_info
     *
     * @return string 
     */
    public function getShortInfo()
    {
        return $this->short_info;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Slider
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Slider
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set store
     *
     * @param \Models\Store $store
     * @return Slider
     */
    public function setStore(\Models\Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \Models\Store 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set sort_order
     *
     * @param integer $sortOrder
     * @return Slider
     */
    public function setSortOrder($sortOrder)
    {
        $this->sort_order = $sortOrder;

        return $this;
    }

    /**
     * Get sort_order
     *
     * @return integer 
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * Set landing_page
     *
     * @param string $landingPage
     * @return Slider
     */
    public function setLandingPage($landingPage)
    {
        $this->landing_page = $landingPage;

        return $this;
    }

    /**
     * Get landing_page
     *
     * @return string 
     */
    public function getLandingPage()
    {
        return $this->landing_page;
    }

    /**
     * Set action_text
     *
     * @param string $actionText
     * @return Slider
     */
    public function setActionText($actionText)
    {
        $this->action_text = $actionText;

        return $this;
    }

    /**
     * Get action_text
     *
     * @return string 
     */
    public function getActionText()
    {
        return $this->action_text;
    }

    /**
     * Set image2
     *
     * @param string $image2
     * @return Slider
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return string 
     */
    public function getImage2()
    {
        return $this->image2;
    }

    public function getTablePrefix(){
        return 'sc';
    }
}
