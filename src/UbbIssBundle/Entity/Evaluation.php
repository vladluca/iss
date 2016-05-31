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
    /**
     * @var \DateTime
     */
    private $sessionDateOne;

    /**
     * @var \DateTime
     */
    private $sessionDateTwo;

    /**
     * @var \DateTime
     */
    private $retakeSessionDate;


    /**
     * Set sessionDateOne
     *
     * @param \DateTime $sessionDateOne
     * @return Evaluation
     */
    public function setSessionDateOne($sessionDateOne)
    {
        $this->sessionDateOne = $sessionDateOne;

        return $this;
    }

    /**
     * Get sessionDateOne
     *
     * @return \DateTime 
     */
    public function getSessionDateOne()
    {
        return $this->sessionDateOne;
    }

    /**
     * Set sessionDateTwo
     *
     * @param \DateTime $sessionDateTwo
     * @return Evaluation
     */
    public function setSessionDateTwo($sessionDateTwo)
    {
        $this->sessionDateTwo = $sessionDateTwo;

        return $this;
    }

    /**
     * Get sessionDateTwo
     *
     * @return \DateTime 
     */
    public function getSessionDateTwo()
    {
        return $this->sessionDateTwo;
    }

    /**
     * Set retakeSessionDate
     *
     * @param \DateTime $retakeSessionDate
     * @return Evaluation
     */
    public function setRetakeSessionDate($retakeSessionDate)
    {
        $this->retakeSessionDate = $retakeSessionDate;

        return $this;
    }

    /**
     * Get retakeSessionDate
     *
     * @return \DateTime 
     */
    public function getRetakeSessionDate()
    {
        return $this->retakeSessionDate;
    }
}
