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
     * Add activity
     *
     * @param \UbbIssBundle\Entity\Activity $activity
     * @return Subject
     */
    public function addActivity(\UbbIssBundle\Entity\Activity $activity)
    {
        $this->activities[] = $activity;

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \UbbIssBundle\Entity\Activity $activity
     */
    public function removeActivity(\UbbIssBundle\Entity\Activity $activity)
    {
        $this->activities->removeElement($activity);
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
     * Add evaluation
     *
     * @param \UbbIssBundle\Entity\Evaluation $evaluation
     * @return Subject
     */
    public function addEvaluation(\UbbIssBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \UbbIssBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\UbbIssBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
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
     * Add studycontract
     *
     * @param \UbbIssBundle\Entity\Studycontract $studycontract
     * @return Subject
     */
    public function addStudycontract(\UbbIssBundle\Entity\Studycontract $studycontract)
    {
        $this->studycontracts[] = $studycontract;

        return $this;
    }

    /**
     * Remove studycontract
     *
     * @param \UbbIssBundle\Entity\Studycontract $studycontract
     */
    public function removeStudycontract(\UbbIssBundle\Entity\Studycontract $studycontract)
    {
        $this->studycontracts->removeElement($studycontract);
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

    public function __toString() {
        return $this->name;
    }
}
