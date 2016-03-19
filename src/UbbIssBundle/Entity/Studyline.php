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
     * Add students
     *
     * @param \UbbIssBundle\Entity\Student $students
     * @return Studyline
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
     * @return Studyline
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
     * Add specializations
     *
     * @param \UbbIssBundle\Entity\Specialization $specializations
     * @return Studyline
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
