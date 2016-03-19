<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 */
class Group
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
     * @var integer
     */
    private $studyYear;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $students;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Group
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
     * Set studyYear
     *
     * @param integer $studyYear
     * @return Group
     */
    public function setStudyYear($studyYear)
    {
        $this->studyYear = $studyYear;

        return $this;
    }

    /**
     * Get studyYear
     *
     * @return integer 
     */
    public function getStudyYear()
    {
        return $this->studyYear;
    }

    /**
     * Add students
     *
     * @param \UbbIssBundle\Entity\Student $students
     * @return Group
     */
    public function addStudent(\UbbIssBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \UbbIssBundle\Entity\Student $students
     */
    public function removeStudent(\UbbIssBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
}
