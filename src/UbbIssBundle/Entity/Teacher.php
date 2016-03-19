<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 */
class Teacher
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
     * @var string
     */
    private $rank;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $activities;

    /**
     * @var \UbbIssBundle\Entity\Department
     */
    private $department;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Teacher
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
     * Set rank
     *
     * @param string $rank
     * @return Teacher
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Teacher
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add activities
     *
     * @param \UbbIssBundle\Entity\Activity $activities
     * @return Teacher
     */
    public function addActivity(\UbbIssBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \UbbIssBundle\Entity\Activity $activities
     */
    public function removeActivity(\UbbIssBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set department
     *
     * @param \UbbIssBundle\Entity\Department $department
     * @return Teacher
     */
    public function setDepartment(\UbbIssBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \UbbIssBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }
}
