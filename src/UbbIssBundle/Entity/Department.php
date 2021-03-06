<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 */
class Department
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
    private $teachers;

    /**
     * @var \UbbIssBundle\Entity\Faculty
     */
    private $faculty;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Department
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
     * Add teacher
     *
     * @param \UbbIssBundle\Entity\Teacher $teacher
     * @return Department
     */
    public function addTeacher(\UbbIssBundle\Entity\Teacher $teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \UbbIssBundle\Entity\Teacher $teacher
     */
    public function removeTeacher(\UbbIssBundle\Entity\Teacher $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Set faculty
     *
     * @param \UbbIssBundle\Entity\Faculty $faculty
     * @return Department
     */
    public function setFaculty(\UbbIssBundle\Entity\Faculty $faculty = null)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get faculty
     *
     * @return \UbbIssBundle\Entity\Faculty 
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    public function __toString() {
        return $this->name;
    }
}
