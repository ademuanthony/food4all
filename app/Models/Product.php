<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 2:56 PM
 */

namespace Models;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\Utility;

/**
 * This is the model class for table "categories".
 * @Entity @Table(name="sc_products")
 **/
class Product extends Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->order_items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->is_featured = false;
    }

    public function getTablePrefix(){
        return 'sc';
    }

    public function delete()
    {
        $order_items = OrderItem::findAll(['product_id' => $this->getId()]);
        if(is_array($order_items) && count($order_items) > 0){
            foreach ($order_items as $order_item) {
                $order_item->delete();
            }
        }

        parent::delete(); // TODO: Change the autogenerated stub
    }
    
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $store_id;

    /** @Column(type="integer") **/
    protected $category_id;

    /** @Column(type="string", length=256) **/
    protected $name;

    /** @Column(type="integer") **/
    protected $quantity;

    /** @Column(type="string", length=1000) **/
    protected $description;

    /** @Column(type="string", length=100) **/
    protected $main_image;

    /** @Column(type="string", length=500) **/
    protected $images;

    /** @Column(type="string", length=256) **/
    protected $meta_description;

    /** @Column(type="string", length=256) **/
    protected $keywords;

    /** @Column(type="decimal", scale=2) **/
    protected $old_price;

    /** @Column(type="decimal", scale=2) **/
    protected $new_price;

    /** @Column(type="decimal", scale=2) **/
    protected $weight;

    /** @Column(type="boolean") */
    protected $is_featured = false;

    /** @Column(type="string", length=128) */
    protected $permalink;

    /** @ManyToOne(targetEntity="Category", inversedBy="products")   */
    /** @JoinColumn(name="category_id", referencedColumnName="id") */
    protected $category;

    /** @OneToMany(targetEntity="OrderItem", mappedBy="product", cascade={"All"}, indexBy="order_item") */
    protected $order_items;


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
     * @return Product
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
     * Set category_id
     *
     * @param integer $categoryId
     * @return Product
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity(){
        return $this->quantity;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set main_image
     *
     * @param string $mainImage
     * @return Product
     */
    public function setMainImage($mainImage)
    {
        $this->main_image = $mainImage;

        return $this;
    }

    /**
     * Get main_image
     *
     * @return string 
     */
    public function getMainImage()
    {
        return $this->main_image;
    }

    public function getFileFullName($type = 'original'){
        return "stores/".Utility::getInstance()->getStore()->getSubDomain()."/products/$type/".$this->getMainImage();
    }

    /**
     * Set images
     *
     * @param string $images
     * @return Product
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set meta_description
     *
     * @param string $metaDescription
     * @return Product
     */
    public function setMetaDescription($metaDescription)
    {
        $this->meta_description = $metaDescription;

        return $this;
    }

    /**
     * Get meta_description
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Product
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set category
     *
     * @param \Models\Category $category
     * @return Product
     */
    public function setCategory(\Models\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Models\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add order_items
     *
     * @param \Models\OrderItem $orderItems
     * @return Product
     */
    public function addOrderItem(\Models\OrderItem $orderItems)
    {
        $this->order_items[] = $orderItems;

        return $this;
    }

    /**
     * Remove order_items
     *
     * @param \Models\OrderItem $orderItems
     */
    public function removeOrderItem(\Models\OrderItem $orderItems)
    {
        $this->order_items->removeElement($orderItems);
    }

    /**
     * Get order_items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * Set old_price
     *
     * @param string $oldPrice
     * @return Product
     */
    public function setOldPrice($oldPrice)
    {
        $this->old_price = $oldPrice;

        return $this;
    }

    /**
     * Get old_price
     *
     * @return string 
     */
    public function getOldPrice()
    {
        return $this->old_price;
    }

    /**
     * Set new_price
     *
     * @param string $newPrice
     * @return Product
     */
    public function setNewPrice($newPrice)
    {
        $this->new_price = $newPrice;

        return $this;
    }

    /**
     * Get new_price
     *
     * @return string 
     */
    public function getNewPrice()
    {
        return $this->new_price;
    }

    /**
     * Set is_featured
     *
     * @param boolean $isFeatured
     * @return Product
     */
    public function setIsFeatured($isFeatured)
    {
        $this->is_featured = $isFeatured;

        return $this;
    }

    /**
     * Get is_featured
     *
     * @return boolean 
     */
    public function getIsFeatured()
    {
        return $this->is_featured;
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return Product
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * Get permalink
     *
     * @return string 
     */
    public function getPermalink()
    {
        return $this->permalink;
    }


    /**
     * @param $id
     * @return Product|null
     */
    public static function find($id)
    {
        return parent::find($id); // TODO: Change the autogenerated stub
    }

    /**
     * @param $store_id
     * @param $offset
     * @param $limit
     * @return Paginator
     */
    public static function getAllProducts($store_id, $offset, $limit){
        return self::findAll(['store_id' => $store_id], $offset, $limit);
        /*$dql = "SELECT c FROM " . self::getClassName() . " c WHERE c.store_id = '$store_id'";

        $db = TinyMvc::$config['db'];
        $query = $db->createQuery($dql)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return  new Paginator($query, $fetchJoinCollection = false);*/
    }

    /**
     * @param $store_id
     * @return array
     */
    public static function getFeaturedProducts($store_id){
        return self::findAll(['store_id' => $store_id, 'is_featured' => true]);
    }

    /**
     * @param $store_id
     * @param $max_result
     * @return Paginator
     */
    public static function getLatestProducts($store_id, $max_result){
        return self::findAll(['store_id' => $store_id], 0, $max_result)->data;

       /* $dql = "SELECT c FROM " . self::getClassName() . " c WHERE c.store_id = '$store_id'";

        $db = TinyMvc::$config['db'];
        $query = $db->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults($max_result);
        return  new Paginator($query, $fetchJoinCollection = false);*/
    }

}
