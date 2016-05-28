<?php

namespace UbbIssBundle\Controller;

use Doctrine\ORM\Mapping\Id;
use Proxies\__CG__\UbbIssBundle\Entity\Studycontract;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
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

    public function addGradesAction(Request $request, $line, $SubName, $SpecName, $Group){
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
        $date = $request->request->get('date');
        $session_type = $request->request->get('session_type');

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

//        foreach ($students as $s) {
//            if($s->getGroup()->getStudyYear() == floor(($subjectSem+1)/2) && $s->getGroup()->getName() == $Group) {
//                array_push($stu, $s);
//            }
//        }
//
//        $eval = $subject->getEvaluations();
//        foreach ($stu as $s) {
//            array_push($ev, $this->tryGetEval($s, $eval));
//        }
        if($session_type == null){
            $eval = $subject->getEvaluations();

            foreach ($students as $s) {
                if($s->getGroup()->getStudyYear() == floor(($subjectSem+1)/2) && $s->getGroup()->getName() == $Group) {
                    if($this->tryGetEval($s, $eval) == null) {
                        array_push($stu, $s);
                        array_push($ev, null);
                    }
                }
            }


        }
        else {
            foreach ($students as $s) {
                if ($s->getGroup()->getStudyYear() == floor(($subjectSem + 1) / 2) && $s->getGroup()->getName() == $Group) {
                    array_push($stu, $s);
                }
            }

            $eval = $subject->getEvaluations();
            foreach ($stu as $s) {
                array_push($ev, $this->tryGetEval($s, $eval));
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
                'allEvalCC' => count($eval),
                'line' => $line,
                'SpecName' => $SpecName,
                'Group' => $Group,
                'date' => $date,
                'type' => $session_type
            ));
    }



    public function editContractsAction($contractYear)
    {
        $em = $this->getDoctrine()->getManager();

        $contractsRepo = $em->getRepository('UbbIssBundle:Studycontract');
        $subjRepo = $em->getRepository('UbbIssBundle:Subject');

        $lower = $contractYear*2 -1;
        $upper = $contractYear*2;

        $contract1 = $contractsRepo->findOneBy (
            array('semester' => $lower)
        );
        $contract2 = $contractsRepo->findOneBy (
            array('semester' => $upper )
        );

        $addedSubjects1 = $contract1->getSubjects();
        $availableSubj1 = $subjRepo->findBy(
            array('semester' => $contract1->getSemester())
        );

        $availables1=[];
        foreach($addedSubjects1 as $adds){
            array_push($availables1,$adds);
        }

        $result1 = array_diff($availableSubj1,$availables1);
        $result1=array_values($result1);


        $addedSubjects2 = $contract2->getSubjects();
        $availableSubj2 = $subjRepo->findBy(
            array('semester' => $contract2->getSemester())
        );

        $availables2=[];
        foreach($addedSubjects2 as $adds){
            if($adds->getptional() == "yes") {
                array_push($availables2, $adds);
            }
        }

//        $result2 = array_diff($availableSubj2,$availables2);
//        $result2 = array_values($result2);


        return $this->render('UbbIssBundle:Student:editStudyContracts.html.twig',
            array(

                'contractYear' => $contractYear,

                'addedSubj1' => $addedSubjects1,
                'availableSubj1' => $result1,
                'contractId1' => $contract1->getId(),

                'addedSubj2' => $addedSubjects2,
                'availableSubj2' => $availables2,
                'contractId2' => $contract2->getId()

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

        $date = $request->request->get('date');

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

            $date = new \DateTime($date);
            $test = new \DateTime('0000-00-00');
            $ev->setSessionDateOne($date);
            $ev->setSessionDateTwo($test);
            $ev->setRetakeSessionDate($test);

            $em->persist($ev);
            $em->flush();
        }


        return $this->redirectToRoute('ubb_iss_add_student_grades',array('SubName'=>$sbj, 'line'=>$line, 'SpecName'=>$SpecName, 'Group'=>$Group) );
    }

    public function showContractsAction(){

        return $this->render('UbbIssBundle:Student:showStudyContracts.html.twig');
    }


    public function addSubjectAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $subjectToAddId = $request->request->get('availableSubjectId');

        $subjectToAdd = $em->getRepository('UbbIssBundle:Subject')
            ->find((int)$subjectToAddId);

        $contractYear = $request->request->get('contractYear');
        $contractId = $request->request->get('contractId');

        $contract = $em->getRepository('UbbIssBundle:Studycontract')
            ->find((int)$contractId);

        $contract->addSubject($subjectToAdd);
        $em->flush();

        return $this->redirectToRoute('ubb_iss_edit_contracts',
            array(
                'contractYear' => $contractYear
            ));
    }

    public function removeSubjectAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $subjectToRemoveId = $request->request->get('addedSubjectId');

        $subjectToRemove = $em->getRepository('UbbIssBundle:Subject')
            ->find($subjectToRemoveId);

        $contractYear = $request->request->get('contractYear');
        $contractId = $request->request->get('contractId');

        $contract = $em->getRepository('UbbIssBundle:Studycontract')
            ->find((int)$contractId);

        $contract->removeSubject($subjectToRemove);
        $em->flush();

        return $this->redirectToRoute('ubb_iss_edit_contracts',
            array(
                'contractYear' => $contractYear
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

        $teachers = $em->getRepository('UbbIssBundle:Teacher')->findAll();


        $subjecs = $em->getRepository('UbbIssBundle:Subject')->findAll();

        $activities = [];

        array_push($activities,"Lab","Seminar","Curs");

        return $this->render('UbbIssBundle:Teacher:listAssistents.html.twig',
            array(
                'teachers' => $teachers,
                'subjects' => $subjecs,
                'activities' =>$activities
            ));
    }

    public function addActivityAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $activityType = $request->request->get('activity');
//        var_dump($activityType);

        $assistantId = $request->request->get('assistantId');
//        var_dump((int)$assistantId);

        $asssistant = $em->getRepository('UbbIssBundle:Teacher')->find((int)$assistantId);
//        var_dump($asssistant->getName());

        $subjectId = $request->request->get('subjectId');
        $subject = $em->getRepository('UbbIssBundle:Subject')->find((int)$subjectId);

        $hoursPerWeek = $request->request->get('weekHours');

        if ($hoursPerWeek) {
            $activity = new Activity();
            $activity->setHoursPerWeek($hoursPerWeek);
            $activity->setTeacher($asssistant);
            $activity->setSubject($subject);
            $activity->setType($activityType);

            $em->persist($activity);
            $em->flush();

            return $this->assignActivitiesAction();
        }
        return $this->assignActivitiesAction();
    }

    public function removeActivityAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $assistantId = $request->request->get('assistantId');

        $assistant = $em->getRepository('UbbIssBundle:Teacher')->find((int)$assistantId);


        $activityId = $request->request->get('activityId');

        $activity = $em->getRepository('UbbIssBundle:Activity')->find((int)$activityId);

        $assistant->removeActivity($activity);

        $em->remove($activity);

        $em->persist($assistant);
        $em->flush();

        return $this->assignActivitiesAction();


    }

    public function studentsTopAction(){

        $em = $this->getDoctrine()->getManager();
        $specializations = $em->getRepository('UbbIssBundle:Specialization')->findAll();

        return $this->render('UbbIssBundle:Teacher:getSpecializations.html.twig',
            array(
                'specializations'=>$specializations
            ));

    }

    public function topStudylinesAction($specialization){

        $em = $this->getDoctrine()->getManager();
        $spec = $em->getRepository('UbbIssBundle:Specialization')->find((int)$specialization);

        $lines = $spec->getStudylines();

        return $this->render('UbbIssBundle:Teacher:getStudylines.html.twig',
            array(
                'lines'=>$lines,
                'specialization'=>$specialization
            ));

    }

    public function topStudentsAction($specialization, $line){

        $em = $this->getDoctrine()->getManager();
        $spec = $em->getRepository('UbbIssBundle:Specialization')->findOneBy(array('id' => $specialization));
        $line = $em->getRepository('UbbIssBundle:Studyline')->findOneBy(array('id' => $line));

        $students = $spec->getStudents();

        $stu = [];
        $avg = [];
        foreach($students as $s){
            if($s->getStudyline()->getId() == $line->getId()){
                $eval = $s->getEvaluations();
                $a = 0;
                $count = 0;
                foreach($eval as $e){
                    if($e->getSessionGrade() > $e->getRetakeSessionGrade()) {
                        $a = $a + ($e->getSessionGrade()*$e->getSubject()->getCredits());
                        $count = $count + $e->getSubject()->getCredits();
                    }
                    else {
                        $a = $a + ($e->getRetakeSessionGrade()*$e->getSubject()->getCredits());
                        $count = $count + $e->getSubject()->getCredits();
                    }
                }
                if($count != 0){
                    array_push($stu, $s);
                    $a = $a / $count;
                    array_push($avg, $a);
                }
            }
        }

        if(count($stu) > 5){
            $stu2 = [];
            $avg2 = [];
            for ($x = 0; $x < 5; $x++) {
                array_push($stu2, $stu[$x]);
                array_push($avg2, $avg[$x]);
            }
            $stu = $stu2;
            $avg = $avg2;
        }


        return $this->render('UbbIssBundle:Teacher:getTopStudents.html.twig',
            array(
                'message' => "test",
                'students' => $stu,
                'avg' => $avg
            ));

    }


    public function selectDateAction($line, $SubName, $SpecName, $Group){

        $em = $this->getDoctrine()->getManager();

        return $this->render('UbbIssBundle:Teacher:selectDate.html.twig',
            array(
                'line' => $line,
                'SubName' => $SubName,
                'SpecName' => $SpecName,
                'Group' => $Group
            ));

    }

}






















