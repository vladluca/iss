<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studycontract
 */
class Studycontract
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $semester;

    /**
     * @var \UbbIssBundle\Entity\Student
     */
    private $student;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $subjects;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set semester
     *
     * @param integer $semester
     * @return Studycontract
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return integer 
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set student
     *
     * @param \UbbIssBundle\Entity\Student $student
     * @return Studycontract
     */
    public function setStudent(\UbbIssBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \UbbIssBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Add subjects
     *
     * @param \UbbIssBundle\Entity\Subject $subjects
     * @return Studycontract
     */
    public function addSubject(\UbbIssBundle\Entity\Subject $subjects)
    {
        $this->subjects[] = $subjects;

        return $this;
    }

    /**
     * Remove subjects
     *
     * @param \UbbIssBundle\Entity\Subject $subjects
     */
    public function removeSubject(\UbbIssBundle\Entity\Subject $subjects)
    {
        $this->subjects->removeElement($subjects);
    }

    /**
     * Get subjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
}
