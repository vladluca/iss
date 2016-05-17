<?php

namespace UbbIssBundle\Controller;

use Doctrine\ORM\Mapping\Id;
use Proxies\__CG__\UbbIssBundle\Entity\Studycontract;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UbbIssBundle\Entity\Activity;
use UbbIssBundle\Entity\Evaluation;
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

    public function getSpecializationAction($Sname){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $Sname = $em->getRepository('UbbIssBundle:Subject')->findOneBy(array('name' => $Sname));
        $spec = [];
        if(!in_array($Sname->getSpecialization(), $spec)){
            array_push($spec, $Sname->getSpecialization());
        }

        return $this->render('UbbIssBundle:Teacher:getSpecialization.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                /***
                 * list of specs
                 */
                'spec' => $spec
            ));
    }

    public function getSpecializationLinesAction($SubName, $SpecName){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $SpecName = $em->getRepository('UbbIssBundle:Specialization')->findOneBy(array('name' => $SpecName));
        $SubName = $em->getRepository('UbbIssBundle:Subject')->findOneBy(array('id' => $SubName));

        $spc = $SubName->getSpecialization();
        $lin = $SubName->getStudyline();

        $Sline = [];

        $Lines = $spc->getStudylines();

        foreach($Lines as $l){
            array_push($Sline, $l);
        }

        return $this->render('UbbIssBundle:Teacher:getSpecializationLines.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                /***
                 * list of activities
                 */
                'lines' => $Sline,
                'sub' => $SubName,
                'spec' => $SpecName
            ));
    }


    public function getGroupsAction($line, $SubName, $SpecName){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $SpecName = $em->getRepository('UbbIssBundle:Specialization')->findOneBy(array('name' => $SpecName));
        $SubName = $em->getRepository('UbbIssBundle:Subject')->findOneBy(array('name' => $SubName));
        $line = $em->getRepository('UbbIssBundle:Studyline')->findOneBy(array('id' => $line));

        $lineSubjects = $line->getSubjects();
        $lineSub = [];
        foreach($lineSubjects as $s){
            if($s->getName() == $SubName->getName()){
                array_push($lineSub, $s);
            }
        }
        $subject = null;
        foreach($lineSub as $s){
            if($s->getSpecialization()->getName() == $SpecName->getName()){
                $subject = $s;
                break;
            }
        }
        $groups = [];
        if($subject != null) {
            $students = [];
            $studentsSub = $subject->getSpecialization()->getStudents();
            $studentsLine = $line->getStudents();


            foreach ($studentsLine as $sl) {
                if ($studentsSub->contains($sl)) {
                    array_push($students, $sl);
                }
            }


            foreach ($students as $s) {
                if (!in_array($s->getGroup(), $groups)) {
                    array_push($groups, $s->getGroup());
                }
            }
        }

        return $this->render('UbbIssBundle:Teacher:getGroups.html.twig',
            array(
                'username' => $authenticatedUser->getUsername(),
                /***
                 * list of activities
                 */
                'groups' => $groups,
                'sub' => $SubName->getName(),
                'line' => $line,
                'spec' => $SpecName
            ));
    }

    private function tryGetEval($student, $eval){
        $found = false;
        $evaluation = null;
        foreach ($eval as $e) {
            if($student->getId() == $e->getStudent()->getId()){
                $found = true;
                $evaluation = $e;
                break;
            }
        }
        if($found){
            return $evaluation;
        }
        else{
            return null;
        }
    }

    public function addGradesAction($line, $SubName, $SpecName, $Group){
        /***
         * SubName = a string containing the name of a subject
         *
         *   Returns the students that are under this teacher and at this ($SubName) Subject along side their evaluations
         * for this subject.
         *   If the student i has already a submitted evaluation, it will be the i-th evaluation
         *   If the student i does not have an evaluation, the i-th evaluation will contain null value
         */
        $authenticatedUser= $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $SpecName = $em->getRepository('UbbIssBundle:Specialization')->findOneBy(array('name' => $SpecName));
        $SubName = $em->getRepository('UbbIssBundle:Subject')->findOneBy(array('name' => $SubName));
        $line = $em->getRepository('UbbIssBundle:Studyline')->findOneBy(array('id' => $line));

        $lineSubjects = $line->getSubjects();
        $lineSub = [];
        foreach($lineSubjects as $s){
            if($s->getName() == $SubName->getName()){
                array_push($lineSub, $s);
            }
        }
        $subject = null;
        foreach($lineSub as $s){
            if($s->getSpecialization()->getName() == $SpecName->getName()){
                $subject = $s;
                break;
            }
        }

        $subjectSem = $subject->getSemester();
        $stu = [];
        $ev = [];

        $students = [];
        $studentsSub = $subject->getSpecialization()->getStudents();
        $studentsLine = $line->getStudents();

        foreach($studentsLine as $sl) {
            if($studentsSub->contains($sl)){
                array_push($students, $sl);
            }
        }

        foreach ($students as $s) {
            if($s->getGroup()->getStudyYear() == floor(($subjectSem+1)/2) && $s->getGroup()->getName() == $Group) {
                array_push($stu, $s);
            }
        }

        $eval = $subject->getEvaluations();
        foreach ($stu as $s) {
            array_push($ev, $this->tryGetEval($s, $eval));
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
                'allEvalCC' => count($eval),
                'line' => $line,
                'SpecName' => $SpecName,
                'Group' => $Group
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

        $line = $request->request->get('lineId');
        $SpecName = $request->request->get('SpecName');
        $Group = $request->request->get('Group');

        $em = $this->getDoctrine()->getManager();

        $sbj = $em->getRepository('UbbIssBundle:Subject')->find($subjectId);

        $eval= $em->getRepository('UbbIssBundle:Evaluation')->findOneBy(array('subject'=> $subjectId, 'student'=>$studentId));
        $ev = new Evaluation();
        if($eval != null) {
            $eval->setSessionGrade((int)$newSgrade);
            $eval->setRetakeSessionGrade((int)$newRgrade);

            $em->flush();
        }
        elseif($eval == null) {
            $em = $this->getDoctrine()->getManager();
            $sj = $em->getRepository('UbbIssBundle:Subject')->findOneBy(array('id' => $subjectId));
            $st = $em->getRepository('UbbIssBundle:Student')->findOneBy(array('id' => $studentId));

            $ev->setSubject($sj);
            $ev->setStudent($st);
            $ev->setSessionGrade((int)$newSgrade);
            $ev->setRetakeSessionGrade((int)$newRgrade);

            $em->persist($ev);
            $em->flush();
        }


        return $this->redirectToRoute('ubb_iss_add_student_grades',array('SubName'=>$sbj, 'line'=>$line, 'SpecName'=>$SpecName, 'Group'=>$Group) );
    }

    public function showContractsAction(){

        $user = $this->getUser();
        $student = $user->getStudent();
        $studName = $student->getName();
        $contracts = $student->getStudycontracts();

        $sems = [];

        $requiredSems= range(1,6);

        foreach($contracts as $contr){
            array_push($sems,$contr->getSemester());
        }

        $rest = array_diff($requiredSems, $sems);

        return $this->render('UbbIssBundle:Student:showStudyContracts.html.twig',
            array(
                'studName' => $studName,
               'contracts' => $contracts,
                'rest' => $rest
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

    public function editPasswordAction(Request $request){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();

        $oldpass = $request->request->get('oldPassword');
        $newpass = $request->request->get('newPassword');
        $renewpass = $request->request->get('retypedNewPassword');

        if($authenticatedUser->getPassword() == $oldpass){
            if($newpass == $renewpass){
                $authenticatedUser->setPassword($newpass);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('ubb_iss_change_pass',
                    array(
                        'message' => "1"
                    ));

            }
            else{
                return $this->redirectToRoute('ubb_iss_change_pass',
                    array(
                        'message' => "2"
                    ));
            }

        }
        else{
            return $this->redirectToRoute('ubb_iss_change_pass',
                array(
                    'message' => "3"
                ));
        }
    }


    public function changePasswordAction(){
        /***
         *   Returns all the activities present under the current teacher
         */
        $authenticatedUser= $this->getUser();

        return $this->render('UbbIssBundle:changePassword.html.twig',
            array(
                'message' => "0"
            ));
    }

    public function addContractAction($semester){

        $contract = new Studycontract();

        $contract->setSemester((int)$semester);

        $user = $this->getUser();
        $student = $user->getStudent();
        $contract->setStudent($student);

        $em = $this->getDoctrine()->getManager();
        $em->persist($contract);
        $em->flush();

        return $this->showContractsAction();

    }

    public function assignActivitiesAction(){

        $em = $this->getDoctrine()->getManager();

        $teachers = $em->getRepository('UbbIssBundle:Teacher')->findBy(
            array('rank' => 'Asistent')
        );


        $subjecs = $em->getRepository('UbbIssBundle:Subject')->findAll();

        $activities = [];

        array_push($activities,"Lab","Seminar");

        return $this->render('UbbIssBundle:Teacher:listAssistents.html.twig',
            array(
                'teachers' => $teachers,
                'subjects' => $subjecs,
                'activities' =>$activities
            ));
    }

    public function addActivityAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $assistantId = $request->request->get('assistantId');
        $asssistant = $em->getRepository('UbbIssBundle:Teacher')->find((int)$assistantId);

        $subjectId = $request->request->get('subjectId');
        $subject = $em->getRepository('UbbIssBundle:Subject')->find((int)$subjectId);

        $hoursPerWeek = $request->request->get('weekHours');

        $activity = new Activity();

        $activity->setHoursPerWeek($hoursPerWeek);
        $activity->setTeacher($asssistant);
        $activity->setSubject($subject);

        $em->persist($activity);
        $em->flush();

        return $this->assignActivitiesAction();

        return null;
    }

}






















