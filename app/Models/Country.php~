<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 3:54 PM
 */

namespace Models;
use Doctrine\Common\Collections\ArrayCollection;
use Framework\Base\Model;


/**
 * This is the model class for table "cities".
 * @Entity @Table(name="countries")
 **/
class Country extends Model
{
    public function __construct()
    {
        $this->states = new ArrayCollection();
    }

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string", length=256) **/
    protected $name;

    /** @Column(type="string", length=256) **/
    protected $short_name;

    /** @var ArrayCollection  */
    /** @OneToMany(targetEntity="State", mappedBy="country", cascade={"ALL"}, indexBy="state") */
    protected $states;

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
     * Set name
     *
     * @param string $name
     * @return Country
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
     * Set short_name
     *
     * @param string $shortName
     * @return Country
     */
    public function setShortName($shortName)
    {
        $this->short_name = $shortName;

        return $this;
    }

    /**
     * Get short_name
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * Add states
     *
     * @param \Models\State $states
     * @return Country
     */
    public function addState(\Models\State $states)
    {
        $this->states[] = $states;

        return $this;
    }

    /**
     * Remove states
     *
     * @param \Models\State $states
     */
    public function removeState(\Models\State $states)
    {
        $this->states->removeElement($states);
    }

    /**
     * Get states
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStates()
    {
        return $this->states;
    }
}
