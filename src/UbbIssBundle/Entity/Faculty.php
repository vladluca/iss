<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faculty
 */
class Faculty
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $departments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $specializations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->specializations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Faculty
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
     * Add departments
     *
     * @param \UbbIssBundle\Entity\Department $departments
     * @return Faculty
     */
    public function addDepartment(\UbbIssBundle\Entity\Department $departments)
    {
        $this->departments[] = $departments;

        return $this;
    }

    /**
     * Remove departments
     *
     * @param \UbbIssBundle\Entity\Department $departments
     */
    public function removeDepartment(\UbbIssBundle\Entity\Department $departments)
    {
        $this->departments->removeElement($departments);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Add specializations
     *
     * @param \UbbIssBundle\Entity\Specialization $specializations
     * @return Faculty
     */
    public function addSpecialization(\UbbIssBundle\Entity\Specialization $specializations)
    {
        $this->specializations[] = $specializations;

        return $this;
    }

    /**
     * Remove specializations
     *
     * @param \UbbIssBundle\Entity\Specialization $specializations
     */
    public function removeSpecialization(\UbbIssBundle\Entity\Specialization $specializations)
    {
        $this->specializations->removeElement($specializations);
    }

    /**
     * Get specializations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpecializations()
    {
        return $this->specializations;
    }
}
