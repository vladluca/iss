<?php

namespace UbbIssBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $authenticatedUser= $this->get('security.context')->getToken()->getUser();
        return $this->render('UbbIssBundle:Default:index.html.twig',
            array(
                'username' => $authenticatedUser->getUsername()
        ));
    }

    public function showGradesAction(){
        $authenticatedUser= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $student = $authenticatedUser->getStudent();
        $Seval = $student->getEvaluations();

        return $this->render('UbbIssBundle:Student:showGrades.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                'grades' => $Seval
            ));
    }

    public function getActivitiesAction(){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();
        $activities = $authenticatedUser->getTeacher()->getActivities();

        return $this->render('UbbIssBundle:Teacher:getActivities.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                /***
                 * list of activities
                 */
                'activities' => $activities
            ));
    }

    public function addGradesAction($SubName){
        /***
         * SubName = a string containing the name of a subject
         *
         *   Returns the students that are under this teacher and at this ($SubName) Subject along side their evaluations
         * for this subject.
         *   If the student i has already a submitted evaluation, it will be the i-th evaluation
         *   If the student i does not have an evaluation, the i-th evaluation will contain null value
         */
        $authenticatedUser= $this->getUser();
        $activities = $authenticatedUser->getTeacher()->getActivities();
        $activity = null;
        foreach ($activities as $a) {
            if($a->getSubject()->getName() == $SubName) {
                $activity = $a;
            }
        }
        $subject = $activity->getSubject();
        $students = $activity->getSubject()->getSpecialization()->getStudents();
        $subjectSem = $subject->getSemester();
        $stu = [];
        $ev = [];
        foreach ($students as $s) {
            if($s->getGroup()->getStudyYear() == floor(($subjectSem+1)/2)) {
                array_push($stu, $s);
            }
        }
        $eval = $subject->getEvaluations();
        foreach ($stu as $s) {
            $found = false;
            foreach ($eval as $e) {
                if($s->getId() == $e->getStudent()->getId()){
                    array_push($ev, $e);
                    break;
                }
            }
            if(!$found){
                array_push($ev, null);
            }
        }

        return $this->render('UbbIssBundle:Teacher:addGrades.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                /**
                 * subject name
                 */
                'subject' => $subject,
                /**
                 * list of the required students
                 */
                'students' => $stu,
                /**
                 * list of corresponding student evaluations
                 */
                'eval' => $ev,
            ));
    }
}
