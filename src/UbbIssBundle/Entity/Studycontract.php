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
     * Add subject
     *
     * @param \UbbIssBundle\Entity\Subject $subject
     * @return Studycontract
     */
    public function addSubject(\UbbIssBundle\Entity\Subject $subject)
    {
        $this->subjects[] = $subject;

        return $this;
    }

    /**
     * Remove subject
     *
     * @param \UbbIssBundle\Entity\Subject $subject
     */
    public function removeSubject(\UbbIssBundle\Entity\Subject $subject)
    {
        $this->subjects->removeElement($subject);
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
