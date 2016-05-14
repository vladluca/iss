<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialization
 */
class Specialization
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
    private $students;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $subjects;

    /**
     * @var \UbbIssBundle\Entity\Faculty
     */
    private $faculty;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $studylines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->studylines = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Specialization
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
     * Add student
     *
     * @param \UbbIssBundle\Entity\Student $student
     * @return Specialization
     */
    public function addStudent(\UbbIssBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \UbbIssBundle\Entity\Student $student
     */
    public function removeStudent(\UbbIssBundle\Entity\Student $student)
    {
        $this->students->removeElement($student);
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

    /**
     * Add subject
     *
     * @param \UbbIssBundle\Entity\Subject $subject
     * @return Specialization
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

    /**
     * Set faculty
     *
     * @param \UbbIssBundle\Entity\Faculty $faculty
     * @return Specialization
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

    /**
     * Add studyline
     *
     * @param \UbbIssBundle\Entity\Studyline $studyline
     * @return Specialization
     */
    public function addStudyline(\UbbIssBundle\Entity\Studyline $studyline)
    {
        $this->studylines[] = $studyline;

        return $this;
    }

    /**
     * Remove studyline
     *
     * @param \UbbIssBundle\Entity\Studyline $studyline
     */
    public function removeStudyline(\UbbIssBundle\Entity\Studyline $studyline)
    {
        $this->studylines->removeElement($studyline);
    }

    /**
     * Get studylines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudylines()
    {
        return $this->studylines;
    }

    public function __toString() {
        return $this->name;
    }
}
