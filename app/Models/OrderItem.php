<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 4:22 PM
 */

namespace Models;

    /**
     * This is the model class for table "order_item".
     *
     * @property integer $id
     * @property integer $order_id
     * @property integer $product_id
     * @property integer $quantity
     *
     * @property Order $order
     * @property Product $product
     */
use Framework\Base\Model;

/**
 * This is the model class for table "order_items".
 * @Entity @Table(name="sc_order_items")
 **/
class OrderItem extends Model
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") */
    protected $order_id;

    /** @Column(type="integer") */
    protected $product_id;

    /** @Column(type="integer") */
    protected $quantity;

    /** @Column(type="decimal", scale=2) */
    protected $unit_price;

    /** @ManyToOne(targetEntity="Order", inversedBy="items") */
    protected $order;

    /** @ManyToOne(targetEntity="Product", inversedBy="order_items") */
    protected $product;

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
     * Set order_id
     *
     * @param integer $orderId
     * @return OrderItem
     */
    public function setOrderId($orderId)
    {
        $this->order_id = $orderId;

        return $this;
    }

    /**
     * Get order_id
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set product_id
     *
     * @param integer $productId
     * @return OrderItem
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit_price
     *
     * @param string $unit_price
     * @return OrderItem
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * Get unit_price
     *
     * @return string
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set order
     *
     * @param \Models\Order $order
     * @return OrderItem
     */
    public function setOrder(\Models\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Models\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \Models\Product $product
     * @return OrderItem
     */
    public function setProduct(\Models\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Models\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    public function getTotal(){
        return $this->getUnitPrice() * $this->getQuantity();
    }

    public function getTablePrefix(){
        return 'sc';
    }
}
