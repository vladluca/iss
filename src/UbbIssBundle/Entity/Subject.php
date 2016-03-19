<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 */
class Subject
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
    private $credits;

    /**
     * @var integer
     */
    private $semester;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $activities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $evaluations;

    /**
     * @var \UbbIssBundle\Entity\Specialization
     */
    private $specialization;

    /**
     * @var \UbbIssBundle\Entity\Studyline
     */
    private $studyline;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $studycontracts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->studycontracts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Subject
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
     * Set credits
     *
     * @param integer $credits
     * @return Subject
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set semester
     *
     * @param integer $semester
     * @return Subject
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
     * Add activities
     *
     * @param \UbbIssBundle\Entity\Activity $activities
     * @return Subject
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
     * Add evaluations
     *
     * @param \UbbIssBundle\Entity\Evaluation $evaluations
     * @return Subject
     */
    public function addEvaluation(\UbbIssBundle\Entity\Evaluation $evaluations)
    {
        $this->evaluations[] = $evaluations;

        return $this;
    }

    /**
     * Remove evaluations
     *
     * @param \UbbIssBundle\Entity\Evaluation $evaluations
     */
    public function removeEvaluation(\UbbIssBundle\Entity\Evaluation $evaluations)
    {
        $this->evaluations->removeElement($evaluations);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Set specialization
     *
     * @param \UbbIssBundle\Entity\Specialization $specialization
     * @return Subject
     */
    public function setSpecialization(\UbbIssBundle\Entity\Specialization $specialization = null)
    {
        $this->specialization = $specialization;

        return $this;
    }

    /**
     * Get specialization
     *
     * @return \UbbIssBundle\Entity\Specialization 
     */
    public function getSpecialization()
    {
        return $this->specialization;
    }

    /**
     * Set studyline
     *
     * @param \UbbIssBundle\Entity\Studyline $studyline
     * @return Subject
     */
    public function setStudyline(\UbbIssBundle\Entity\Studyline $studyline = null)
    {
        $this->studyline = $studyline;

        return $this;
    }

    /**
     * Get studyline
     *
     * @return \UbbIssBundle\Entity\Studyline 
     */
    public function getStudyline()
    {
        return $this->studyline;
    }

    /**
     * Add studycontracts
     *
     * @param \UbbIssBundle\Entity\Studycontract $studycontracts
     * @return Subject
     */
    public function addStudycontract(\UbbIssBundle\Entity\Studycontract $studycontracts)
    {
        $this->studycontracts[] = $studycontracts;

        return $this;
    }

    /**
     * Remove studycontracts
     *
     * @param \UbbIssBundle\Entity\Studycontract $studycontracts
     */
    public function removeStudycontract(\UbbIssBundle\Entity\Studycontract $studycontracts)
    {
        $this->studycontracts->removeElement($studycontracts);
    }

    /**
     * Get studycontracts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudycontracts()
    {
        return $this->studycontracts;
    }
}
