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
     * Add students
     *
     * @param \UbbIssBundle\Entity\Student $students
     * @return Specialization
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

    /**
     * Add subjects
     *
     * @param \UbbIssBundle\Entity\Subject $subjects
     * @return Specialization
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
     * Add studylines
     *
     * @param \UbbIssBundle\Entity\Studyline $studylines
     * @return Specialization
     */
    public function addStudyline(\UbbIssBundle\Entity\Studyline $studylines)
    {
        $this->studylines[] = $studylines;

        return $this;
    }

    /**
     * Remove studylines
     *
     * @param \UbbIssBundle\Entity\Studyline $studylines
     */
    public function removeStudyline(\UbbIssBundle\Entity\Studyline $studylines)
    {
        $this->studylines->removeElement($studylines);
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
}
