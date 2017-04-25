<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 2:50 PM
 */

namespace Models;
use Doctrine\Common\Collections\ArrayCollection;
use Framework\Base\Model;


/**
 * This is the model class for table "categories".
 * @Entity @Table(name="sc_categories")
 **/
class Category extends Model
{
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->children = new ArrayCollection();
    }


    public function getTablePrefix(){
        return 'sc';
    }

    public function delete()
    {
        self::beginTransaction();
        try{
            $children = $this->getChildren();
            foreach($children as $child){
                $child->delete();
            }
            $products = Product::findAll(['category_id' => $this->getId()]);
            foreach ($products as $product) {
                $product->delete();
            }
            parent::delete(); // TODO: Change the autogenerated stub
            self::commit();
        }catch (\Exception $ex){
            self::rollBack();
        }

    }

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $store_id;

    /** @Column(type="integer", nullable=true) **/
    protected $parent_id = null;

    /** @Column(type="string", length=256) **/
    protected $name;

    /** @Column(type="string", length=128) **/
    protected $permalink;

    /** @Column(type="string", length=1000) **/
    protected $description;

    /** @Column(type="string", length=100, nullable=true) **/
    protected $image;

    /** @Column(type="string", length=256, nullable=true) **/
    protected $meta_description;

    /** @Column(type="string", length=256, nullable=true) **/
    protected $keywords;

    /** @var ArrayCollection  */
    /** @OneToMany(targetEntity="Product", mappedBy="category") */
    protected $products;

    /** @ManyToOne(targetEntity="Category", inversedBy="children")  */
    /** @JoinColumn(name="parent_id", referencedColumnName="id")  */
    protected $parent = null;

    /**
     * @OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;


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
     * @return Category
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
     * Set parent_id
     *
     * @param integer $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parent_id = $parentId;

        return $this;
    }

    /**
     * Get parent_id
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
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

    /**
     * Set description
     *
     * @param string $description
     * @return Category
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
     * Set image
     *
     * @param string $image
     * @return Category
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
     * Set meta_description
     *
     * @param string $metaDescription
     * @return Category
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
     * @return Category
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
     * Add products
     *
     * @param \Models\Product $products
     * @return Category
     */
    public function addProduct(\Models\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Models\Product $products
     */
    public function removeProduct(\Models\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set parent
     *
     * @param \Models\Category $parent
     * @return Category
     */
    public function setParent(\Models\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Models\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Models\Category $children
     * @return Category
     */
    public function addChild(\Models\Category $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Models\Category $children
     */
    public function removeChild(\Models\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }


    public static function getParentCategories($store_id){
        return Category::findAll(['store_id' => $store_id, 'parent_id' => null]);
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return Category
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

}
