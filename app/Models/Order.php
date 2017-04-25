<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 4:18 PM
 */

namespace Models;
use Framework\Base\Model;
use Framework\TinyMvc;
use Globals\AppConstants;
use Models\Status;


/**
 * This is the model class for table "orders".
 * @Entity @Table(name="sc_orders")
 **/
class Order extends Model
{
    const TYPE_PINP = 1, TYPE_FOOD = 2;

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") */
    protected $member_id;

    /** @Column(type="datetime") */
    protected $date;

    /** @Column(type="integer") */
    protected $status;

    /** @Column(type="integer") */
    protected $payment_status;

    protected $payment_method;

    /** @Column(type="integer") */
    protected $shipping_address_id;

    protected $type; //food, reg, pin

    protected $description;

    protected $extras;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setStatus(Status::Pending);
        $this->setPaymentStatus(Status::Pending);
        $this->setShippingAddressId(0);
        $this->setDate(date('Y-m-d H:i:s'));
    }

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
     * Set user_id
     *
     * @param $member_id
     * @return Order $this
     */
    public function setMemberId($member_id){
        $this->member_id = $member_id;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getMemberId(){
        return $this->member_id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set payment_Status
     *
     * @param integer $paymentStatus
     * @return Order
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->payment_status = $paymentStatus;

        return $this;
    }

    /**
     * Get payment_Status
     *
     * @return integer 
     */
    public function getPaymentStatus()
    {
        return $this->payment_Status;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    /**
     * Set shipping_address_id
     *
     * @param integer $shippingAddressId
     * @return Order
     */
    public function setShippingAddressId($shippingAddressId)
    {
        $this->shipping_address_id = $shippingAddressId;

        return $this;
    }

    /**
     * Get shipping_address_id
     *
     * @return integer 
     */
    public function getShippingAddressId()
    {
        return $this->shipping_address_id;
    }


    /**
     * Get shipping_address
     *
     * @return \Models\ShippingAddress 
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function setExtras($extras)
    {
        $this->extras = $extras;
        return $this;
    }

    public function getTablePrefix(){
        return 'sc';
    }

    public function getRef(){
        switch($this->type){
            case self::TYPE_FOOD:
                $type_text = "FOOD";
                break;
            case self::TYPE_PINP:
                $type_text = "PINP";
                break;
            default:
                $type_text = 'FOOD';
        }
        return $type_text.str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

    public static function getIdFromReference($order_ref){
        $id_text = substr($order_ref, 4, strlen($order_ref)-4);
        return intval($id_text);
    }

    /**
     * @param $order_ref
     * @return Order|null
     */
    public static function getOrderFromReference($order_ref){
        $id = self::getIdFromReference($order_ref);
        return self::find($id);
    }

    /**
     * @return SoldPin[]|OrderItem[]
     */
    public function getItems(){
        if($this->getType() == self::TYPE_PINP){
            return SoldPin::findAll(['order_id' => $this->getId()]);
        }else{
            return OrderItem::findAll(['order_id' => $this->getId()]);
        }
    }

    public function getItemsCount(){
        if($this->getType() == self::TYPE_PINP){
            return $this->getExtras();
        }else{
            $sql = "SELECT SUM(quantity) AS no FROM scorderitems WHERE order_id = $this->id";
        }
        $result = \R::getAll($sql);
        return $result[0]['no'];
    }

    public function getAmount(){
        if($this->getType() == self::TYPE_PINP){
            return TinyMvc::$config[AppConstants::REGISTRATION_FEE] * $this->getItemsCount();
        }else{
            $sql = "SELECT SUM((quantity * unit_price)) AS no FROM scorderitems WHERE order_id = $this->id";
            $result = \R::getAll($sql);
            return $result[0]['no'];
        }
    }

}
