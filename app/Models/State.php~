<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 3:50 PM
 */

namespace Models;
use Doctrine\Common\Collections\ArrayCollection;
use Framework\Base\Model;


/**
 * This is the model class for table "state".
 * @Entity @Table(name="states")
 **/
class State extends Model
{
    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $country_id;

    /** @Column(type="string", length=256) **/
    protected $name;

    /** @var ArrayCollection  */
    /** @OneToMany(targetEntity="City", mappedBy="state", cascade={"ALL"}, indexBy="city") */
    protected $cities;

    /** @ManyToOne(targetEntity="Country", inversedBy="states") */
    protected $country;

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
     * Set country_id
     *
     * @param integer $countryId
     * @return State
     */
    public function setCountryId($countryId)
    {
        $this->country_id = $countryId;

        return $this;
    }

    /**
     * Get country_id
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return State
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
     * Add cities
     *
     * @param \Models\City $cities
     * @return State
     */
    public function addCity(\Models\City $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \Models\City $cities
     */
    public function removeCity(\Models\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set country
     *
     * @param \Models\Country $country
     * @return State
     */
    public function setCountry(\Models\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Models\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
