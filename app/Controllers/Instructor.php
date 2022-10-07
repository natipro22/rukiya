<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\System;
use App\Libraries\Messages\Messages;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Validation;
use App\Libraries\UserRole;
use App\Models;

class Instructor extends BaseController
{
/**
 * List of Instructors
 *
 * returns list of instructors in the University/College
 * 
 */
    public function index()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $inst = new Models\InstructorModel();
                $data = [
                    'page' => 'instructor',
                    'title' => 'Instructors',
                    'instructors' => $inst->findAll()
                ];
                return view('registrar/instructors/instructors_list',$data);
            }
        }
    }
 /**
 * Instructors Courses Load
 *
 * returns the instructor Course loads for the current year 
 * 
 */
    public function loads(string $inst_id) {
        if(checkUser(UserRole::INST())){
            $load = System::createQuery();
            
            $data = [
                'page' => 'load',
                'title' => 'Instructor Courses Load',
                'loads' => $load->instructorCourses(decrypt_url($inst_id))
            ];
//            echo print_r($load->instructorCourses($inst_id));
            return view('instructor/loads/loads_list', $data);
            
        } else if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get'){
//            if($this->request->getMethod() == 'get'){
                $load = System::createQuery();
                $inst = System::createInstructor();
                $data = [
                    'page' => 'instructor',
                    'title' => 'Instructor Courses Load',
                    'instructor' => $inst->select('INST_ID, INST_FULLNAME, INST_SEX, INST_ADDRESS')
                                         ->where('INST_ID', decrypt_url($inst_id))->first(),
                    'loads' => $load->instructorCourses(decrypt_url($inst_id))
                ];
                return view('registrar/instructors/loads_list', $data);
//            }
        } 
    }
    
    public function classSection(string $inst_id, string $course_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $section = System::createQuery();
                $data = [
                    'page' => 'instructor',
                    'title' => 'Students Class',
                    'sections' => $section->instructorClasses(decrypt_url($inst_id), decrypt_url($course_id)),
                    'instructor' => $inst_id,
                    'course' => $course_id
                ];
                
                return view('registrar/instructors/class_sections', $data);
            }
        }
    }
    
    public function classStudents(string $inst_id, string $course_id, string $section_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $studentsGrade = System::createQuery();
                $data = [
                    'page' => 'instructor',
                    'title' => 'Instructor Students',
                    'students' => $studentsGrade->instructorStudents(decrypt_url($inst_id), decrypt_url($course_id), decrypt_url($section_id)),
                    'instructor' => $inst_id,
                    'course' => $course_id,
                    'section' => $section_id,
                ];
//                helper('array');
//                echo "<pre>";
////                ECHO array_search('UU02633/DSC/R/11', $data['students']).'<br>';
//                $fizz = dot_array_search('students.*.IDNO', $data);
//                print_r($fizz) ;
//                print_r($data['students']);
//                die();
                return view('registrar/instructors/class_students', $data);
            }
            else if($this->request->getMethod() == 'post'){
                $students = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($students)){
                    return Messages::errorNoThingSelected();
                }
                $studentsGrade = System::createQuery();
                $grade = System::createGradeValue();
                $data = [
                    'page' => 'instructor',
                    'title' => 'Edit Students Grade',
                    'grades' => $grade->findAll(),
                    'students' => $studentsGrade->instructorStudents
                        (decrypt_url($inst_id), decrypt_url($course_id), decrypt_url($section_id), $students),
                    'instructor' => $inst_id,
                    'course' => $course_id,
                    'section' => $section_id
                ];
//                echo "<pre>";
//                
//                print_r($data);
//                die();
                return view('registrar/instructors/edit_students_grade', $data);
            }
        }
    }
    
    public function updateStudentsGrade(string $inst_id, string $course_id, string $section_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                $gradesUpdate = RequestVars::updateStudentsGrade($this->request);
//                echo "<pre>";
//                print_r($gradesUpdate);
//                die();
                $grade = System::createGrade();
                $status = $grade->updateBatch($gradesUpdate,'GRADE_ID');
                
                // check for the update
                return Messages::checkforUpdateAndRedirect($status, 'instructors/class-students/'.urlencode($inst_id).'/'.urlencode($course_id).'/'.urlencode($section_id), 'Student(s) Grade');
            }
        }
    }
    
    public function newInstructor()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get'){
//            $inst = System::createInstructor();
            $data = [
                'page' => 'instructor',
                'title' => 'New Instructor',
                
            ];
            return view('registrar/instructors/add_instructor', $data);
        }
    }
    
    public function addInstructor()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            
            // validate every input first
            $validation = $this->validate(Validation::addInstructorRules(), Validation::addInstructorMessages());

            if(!$validation){
                return Messages::validationErrorsWithInput($this->validator);
            }
            // get the section info from the request
            $userInfo = RequestVars::InstructorUserInfo($this->request);
            $instInfo = RequestVars::InstructorInfo($this->request);
            
            // prepare for insetion
            $user = System::createUser();
            $inst = System::createInstructor();
            // insert the data to database
            $userStatus = $user->insert($userInfo);
            $instInfo['USER_ID'] = $user->getInsertID();
            
            $status = $userStatus ? $inst->insert($instInfo) : false;
            return ! empty($instInfo['SAVEONLY'])
                   ? Messages::checkInsertionAndRedirect($status, 'instructors', 'Instructor') 
                   : Messages::checkInsertionAndRedirect($status, 'instructors/new-instructor', 'Instructor');
        }
    }
    
    public function deleteInstructor()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            // get the selected faculties
            $insts = RequestVars::getSelected($this->request);

            // if nothing is selected display error message
            if(empty($insts)){
                return Messages::errorNoThingSelected();
            }

            // delete the selected faculties
            $inst = System::createUser();
            $status = $inst->whereIn('ACCOUNT_ID', $insts)->delete();

            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'instructors', 'Instructor(s)'); 
        }
    }
    
    // upload spreadsheet form
    public function uploadFile(string $inst_id, string $course_id, string $section_id)
    {
        if (checkUser(UserRole::REGIST())) {
            if ($this->request->getMethod() == 'post') {
                $input = [
                    decrypt_url($inst_id),
                    decrypt_url($course_id),
                    decrypt_url($section_id)
                ];
                return $this->uploadSpreadsheet($input);
            }
            
            // prepare the data to be sent
            $data = [
                'page'  => 'instructor', // set the page name
                'title' => 'Uplaod Grade From Spreadsheet', // set the view title
                'instructor' => $inst_id,
                'course' => $course_id,
                'section' => $section_id
            ];

            return view('/registrar/instructors/upload_grade', $data);    // display the registration form view
        } else {
            
            return Messages::errorPageNotFound();   // display error message
        }
    }
    
    private function uploadSpreadsheet(iterable $input) 
    {
        $validation = $this->validate(Validation::uploadSpreadsheetRules());    // validate the uploaded file
        // if the validation fail then display error message
        if (!$validation) {
            return Messages::validationErrorsWithInput($this->validator);
//            return redirect()->back()->withInput()->with('error', 'Something was wrong. Please check your input');
        } else {
            
            ini_set("memory_limit", "-1");  // ignore php memory limit warnning
            $file = $this->request->getFile('xlsxFile');    // get the uploaded file
            
            $sheet = System::uploadStudentsGrade($file);   // load the worksheet

            $requiredData = $sheet->searchForRequiredData(); // search for required data and return missed data or the content
//            echo "<pre>";
//                print_r($requiredData);
//                die();
            // if sothing is miss display error message
            if (is_string($requiredData)) {
                return redirect()->back()->with("error", "The following commponets are missed: " . $requiredData);
            } else if (is_array($requiredData)) {
                [$inst_id, $course_id, $section_id] = array_pad($input, 3, null);
                $data = [
                    'page'          => 'instructor',
                    'title'         => 'Preview',
                    'students'      => $sheet->fetchAll($requiredData,$input),
                    'instructor'    => encrypt_url($inst_id),
                    'course'        => encrypt_url($course_id),
                    'section'       => encrypt_url($section_id),
                ];
//                echo "<pre>";
//                print_r($data['students']);
//                die();
                
                // dispaly the file preview
                return view('/registrar/instructors/upload_preview', $data);
            }
        }
    }
    
    public function uploadGrade(string $inst_id, string $course_id, string $section_id)
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            
            
            // get the grade info from the request
            $gradeInfo = RequestVars::uploadStudentsGrade($this->request);
//            echo "<pre>";
//                print_r($gradeInfo);
//                die();
            $grade = System::createGrade();
            $status = $grade->updateBatch($gradeInfo,'GRADE_ID');
            
            
            return Messages::checkforUpdateAndRedirect($status, 'instructors/class-students/'.urlencode($inst_id).'/'
                                                    .urlencode($course_id).'/'.urlencode($section_id), 'Student(s) Grade');
        }
    }
}
