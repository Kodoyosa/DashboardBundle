<?php

namespace Kodo\DashboardBundle\Entity;

/**
 * Itemmenu
 */
class Itemmenu
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sectionmenuId;

    /**
     * @var string
     */
    private $routename;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $active;




    public function __construct($parent = "")
    {
        $this->sectionmenu = $parent;

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
     * Set sectionmenuId
     *
     * @param integer $sectionmenuId
     *
     * @return Itemmenu
     */
    public function setSectionmenuId($sectionmenuId)
    {
        $this->sectionmenuId = $sectionmenuId;

        return $this;
    }

    /**
     * Get sectionmenuId
     *
     * @return integer
     */
    public function getSectionmenuId()
    {
        return $this->sectionmenuId;
    }

    /**
     * Set routename
     *
     * @param string $routename
     *
     * @return Itemmenu
     */
    public function setRoutename($routename)
    {
        $this->routename = $routename;

        return $this;
    }

    /**
     * Get routename
     *
     * @return string
     */
    public function getRoutename()
    {
        return $this->routename;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Itemmenu
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Itemmenu
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}
