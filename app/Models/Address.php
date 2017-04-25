<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 9:25 AM
 */

namespace Models;


use Framework\Base\Model;

/**
 * This is the model class for table "addresses".
 * @Entity @Table(name="adddresses")
 **/
class Address extends Model
{
    /** @Id @Column(type="integer"), @GeneratedValue */
    protected $id;

    /** @Column(type="string", length=265)*/
    protected $street1;

    /** @Column(type="string", length=265)*/
    protected $street2;

    /** @Column(type="integer")*/
    protected $city_id;

    /** @ManyToOne(targetEntity="City", inversedBy="addresses") */
    protected $city;




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
     * Set street1
     *
     * @param string $street1
     * @return Address
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;

        return $this;
    }

    /**
     * Get street1
     *
     * @return string 
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * Set street2
     *
     * @param string $street2
     * @return Address
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;

        return $this;
    }

    /**
     * Get street2
     *
     * @return string 
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * Set city_id
     *
     * @param integer $cityId
     * @return Address
     */
    public function setCityId($cityId)
    {
        $this->city_id = $cityId;

        return $this;
    }

    /**
     * Get city_id
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * Set city
     *
     * @param \Models\City $city
     * @return Address
     */
    public function setCity(\Models\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Models\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}
