<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 */
class Activity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $hoursPerWeek;

    /**
     * @var \UbbIssBundle\Entity\Teacher
     */
    private $teacher;

    /**
     * @var \UbbIssBundle\Entity\Subject
     */
    private $subject;


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
     * Set type
     *
     * @param string $type
     * @return Activity
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set hoursPerWeek
     *
     * @param integer $hoursPerWeek
     * @return Activity
     */
    public function setHoursPerWeek($hoursPerWeek)
    {
        $this->hoursPerWeek = $hoursPerWeek;

        return $this;
    }

    /**
     * Get hoursPerWeek
     *
     * @return integer 
     */
    public function getHoursPerWeek()
    {
        return $this->hoursPerWeek;
    }

    /**
     * Set teacher
     *
     * @param \UbbIssBundle\Entity\Teacher $teacher
     * @return Activity
     */
    public function setTeacher(\UbbIssBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \UbbIssBundle\Entity\Teacher 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set subject
     *
     * @param \UbbIssBundle\Entity\Subject $subject
     * @return Activity
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
}
