<?php

namespace UbbIssBundle\Controller;

use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UbbIssBundle\Entity\Subject;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $authenticatedUser= $this->getUser();
        return $this->render('UbbIssBundle:Default:index.html.twig',
            array(
                'username' => $authenticatedUser->getUsername()
        ));
    }

    public function showGradesAction(){
        $authenticatedUser= $this->getUser();
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
            foreach ($eval as $e) {
                if($s->getId() == $e->getStudent()->getId()){
                    array_push($ev, $e);
                    break;
                }
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

    public function editContractAction($contractId){

        $em = $this->getDoctrine()->getManager();

        $contract = $em->getRepository('UbbIssBundle:Studycontract')
            ->find((int)$contractId);

        $addedSubjects = $contract->getSubjects();

        $subjRepo = $em->getRepository('UbbIssBundle:Subject');
        $availableSubj = $subjRepo->findBy(
            array('semester' => $contract->getSemester())
        );

        $availables=[];
        foreach($addedSubjects as $adds){
            array_push($availables,$adds);
        }

        $result = array_diff($availableSubj,$availables);
        $result2=array_values($result);

        return $this->render('UbbIssBundle:Student:editStudyContracts.html.twig',
            array(
                'addedSubj' => $addedSubjects,
                'availableSubj' => $result2,
                'contractId' => $contractId
            ));
    }

    public function editGradesAction(Request $request){

        $newSgrade = $request->request->get('sessionGrade');
        $newRgrade = $request->request->get('retakeGrade');

        $subjectId = $request->request->get('subjectId');
        $studentId = $request->request->get('studentId');

        $em = $this->getDoctrine()->getManager();

        $sbj = $em->getRepository('UbbIssBundle:Subject')->find($subjectId);

        $eval= $em->getRepository('UbbIssBundle:Evaluation')->findOneBy(array('subject'=> $subjectId, 'student'=>$studentId));

        $eval->setSessionGrade((int)$newSgrade);
        $eval->setRetakeSessionGrade((int)$newRgrade);

        $em->flush();



        return $this->redirectToRoute('ubb_iss_add_student_grades',array('SubName'=>$sbj) );
    }

    public function showContractsAction(){

        $user = $this->getUser();
        $student = $user->getStudent();
        $studName = $student->getName();
        $contracts = $student->getStudycontracts();

        return $this->render('UbbIssBundle:Student:showStudyContracts.html.twig',
            array(
                'studName' => $studName,
               'contracts' => $contracts
            ));
    }

    public function addSubjectAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $subjectToAddId = $request->request->get('availableSubjectId');

        $subjectToAdd = $em->getRepository('UbbIssBundle:Subject')
            ->find((int)$subjectToAddId);

        $contractId = $request->request->get('contractId');
        $contract = $em->getRepository('UbbIssBundle:Studycontract')
            ->find((int)$contractId);

        $contract->addSubject($subjectToAdd);
        $em->flush();

        return $this->redirectToRoute('ubb_iss_edit_contract',
            array(
                'contractId' => $contractId
            ));
    }

    public function removeSubjectAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $subjectToRemoveId = $request->request->get('addedSubjectId');

        $subjectToRemove = $em->getRepository('UbbIssBundle:Subject')
            ->find((int)$subjectToRemoveId);

        $contractId = $request->request->get('contractId');
        $contract = $em->getRepository('UbbIssBundle:Studycontract')
            ->find((int)$contractId);

        $contract->removeSubject($subjectToRemove);
        $em->flush();

        return $this->redirectToRoute('ubb_iss_edit_contract',
            array(
                'contractId' => $contractId
            ));

    }

}






















