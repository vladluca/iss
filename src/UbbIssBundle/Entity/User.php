<?php

namespace UbbIssBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \UbbIssBundle\Entity\Student
     */
    private $student;

    /**
     * @var \UbbIssBundle\Entity\Teacher
     */
    private $teacher;


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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set student
     *
     * @param \UbbIssBundle\Entity\Student $student
     * @return User
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
     * Set teacher
     *
     * @param \UbbIssBundle\Entity\Teacher $teacher
     * @return User
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

    public function getRoles()
    {
        return array('ROLE_USER' => 'User');
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function equals(User $user)
    {
        return $user->getUsername() == $this->getUsername();
    }
}
