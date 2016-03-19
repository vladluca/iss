<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 */
class Evaluation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sessionGrade;

    /**
     * @var integer
     */
    private $retakeSessionGrade;

    /**
     * @var \UbbIssBundle\Entity\Subject
     */
    private $subject;

    /**
     * @var \UbbIssBundle\Entity\Student
     */
    private $student;


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
     * Set sessionGrade
     *
     * @param integer $sessionGrade
     * @return Evaluation
     */
    public function setSessionGrade($sessionGrade)
    {
        $this->sessionGrade = $sessionGrade;

        return $this;
    }

    /**
     * Get sessionGrade
     *
     * @return integer 
     */
    public function getSessionGrade()
    {
        return $this->sessionGrade;
    }

    /**
     * Set retakeSessionGrade
     *
     * @param integer $retakeSessionGrade
     * @return Evaluation
     */
    public function setRetakeSessionGrade($retakeSessionGrade)
    {
        $this->retakeSessionGrade = $retakeSessionGrade;

        return $this;
    }

    /**
     * Get retakeSessionGrade
     *
     * @return integer 
     */
    public function getRetakeSessionGrade()
    {
        return $this->retakeSessionGrade;
    }

    /**
     * Set subject
     *
     * @param \UbbIssBundle\Entity\Subject $subject
     * @return Evaluation
     */
    public function setSubject(\UbbIssBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \UbbIssBundle\Entity\Subject 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set student
     *
     * @param \UbbIssBundle\Entity\Student $student
     * @return Evaluation
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
}
