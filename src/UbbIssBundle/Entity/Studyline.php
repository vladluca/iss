<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studyline
 */
class Studyline
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $language;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $students;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $subjects;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $specializations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set language
     *
     * @param string $language
     * @return Studyline
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add student
     *
     * @param \UbbIssBundle\Entity\Student $student
     * @return Studyline
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
     * @return Studyline
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
     * Add specialization
     *
     * @param \UbbIssBundle\Entity\Specialization $specialization
     * @return Studyline
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
}
