<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 */
class Student
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
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $evaluations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $studycontracts;

    /**
     * @var \UbbIssBundle\Entity\Specialization
     */
    private $specialization;

    /**
     * @var \UbbIssBundle\Entity\Studyline
     */
    private $studyline;

    /**
     * @var \UbbIssBundle\Entity\Group
     */
    private $group;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return Student
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
     * Set email
     *
     * @param string $email
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Student
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Add evaluation
     *
     * @param \UbbIssBundle\Entity\Evaluation $evaluation
     * @return Student
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
     * Add studycontract
     *
     * @param \UbbIssBundle\Entity\Studycontract $studycontract
     * @return Student
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

    /**
     * Set specialization
     *
     * @param \UbbIssBundle\Entity\Specialization $specialization
     * @return Student
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
     * @return Student
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
     * Set group
     *
     * @param \UbbIssBundle\Entity\Group $group
     * @return Student
     */
    public function setGroup(\UbbIssBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \UbbIssBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }

    public function __toString() {
        return $this->id .'. '. $this->name;
    }
    /**
     * @var string
     */
    private $cnp;


    /**
     * Set cnp
     *
     * @param string $cnp
     * @return Student
     */
    public function setCnp($cnp)
    {
        $this->cnp = $cnp;

        return $this;
    }

    /**
     * Get cnp
     *
     * @return string 
     */
    public function getCnp()
    {
        return $this->cnp;
    }
}
