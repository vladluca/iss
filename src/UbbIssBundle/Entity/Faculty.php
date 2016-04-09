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
     * Add department
     *
     * @param \UbbIssBundle\Entity\Department $department
     * @return Faculty
     */
    public function addDepartment(\UbbIssBundle\Entity\Department $department)
    {
        $this->departments[] = $department;

        return $this;
    }

    /**
     * Remove department
     *
     * @param \UbbIssBundle\Entity\Department $department
     */
    public function removeDepartment(\UbbIssBundle\Entity\Department $department)
    {
        $this->departments->removeElement($department);
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
     * Add specialization
     *
     * @param \UbbIssBundle\Entity\Specialization $specialization
     * @return Faculty
     */
    public function addSpecialization(\UbbIssBundle\Entity\Specialization $specialization)
    {
        $this->specializations[] = $specialization;

        return $this;
    }

    /**
     * Remove specialization
     *
     * @param \UbbIssBundle\Entity\Specialization $specialization
     */
    public function removeSpecialization(\UbbIssBundle\Entity\Specialization $specialization)
    {
        $this->specializations->removeElement($specialization);
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

    public function __toString() {
        return $this->name;
    }
}
