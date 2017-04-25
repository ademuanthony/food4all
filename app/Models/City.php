<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 3:46 PM
 */

namespace Models;
use Framework\Base\Model;


/**
 * This is the model class for table "cities".
 * @Entity @Table(name="cities")
 **/
class City extends Model
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $state_id;

    /** @Column(type="string", length=256) **/
    protected $name;

    /** @ManyToOne(targetEntity="State", inversedBy="cities")   */
    protected $state;


    /** @OneToMany(targetEntity="Address", mappedBy="city", cascade={"ALL"}, indexBy="address") */
    protected $addresses;

    /** @OneToMany(targetEntity="ShippingAddress", mappedBy="city", cascade={"ALL"}, indexBy="shipping_address") */
    protected $shipping_addresses;


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
     * Set state_id
     *
     * @param integer $stateId
     * @return City
     */
    public function setStateId($stateId)
    {
        $this->state_id = $stateId;

        return $this;
    }

    /**
     * Get state_id
     *
     * @return integer 
     */
    public function getStateId()
    {
        return $this->state_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
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
     * Set state
     *
     * @param \Models\State $state
     * @return City
     */
    public function setState(\Models\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Models\State 
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->shipping_addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add addresses
     *
     * @param \Models\Address $addresses
     * @return City
     */
    public function addAddress(\Models\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \Models\Address $addresses
     */
    public function removeAddress(\Models\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add shipping_addresses
     *
     * @param \Models\ShippingAddress $shippingAddresses
     * @return City
     */
    public function addShippingAddress(\Models\ShippingAddress $shippingAddresses)
    {
        $this->shipping_addresses[] = $shippingAddresses;

        return $this;
    }

    /**
     * Remove shipping_addresses
     *
     * @param \Models\ShippingAddress $shippingAddresses
     */
    public function removeShippingAddress(\Models\ShippingAddress $shippingAddresses)
    {
        $this->shipping_addresses->removeElement($shippingAddresses);
    }

    /**
     * Get shipping_addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShippingAddresses()
    {
        return $this->shipping_addresses;
    }
}
