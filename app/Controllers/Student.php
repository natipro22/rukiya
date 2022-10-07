<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\System;
use App\Libraries\UserRole;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

class Student extends BaseController {

    
    // create new student 
    private function createStudent() 
    {
        // validate every input first
        $validation = $this->validate(Validation::studentRegistrationRules(), Validation::studentRegistrationMessages());
        if (!$validation) {
            return Messages::validationErrorsWithInput($this->validator);
        }
        
        // get the user info from the request
        $userInfo = RequestVars::studentUser($this->request);
        
        // get the student info from the request
        $studentInfo = RequestVars::studentInfo($this->request);
        
        // get the student details from the request
        $studentDetail = RequestVars::studentDetails($this->request);

        // get the student requirement from the request
        $studentReq = RequestVars::studentRequirments($this->request);
        
        // load the appropriate model
//        $user = System::createUser();
        $stud = System::createStudent();
        
//        $userStatus = $user->insert($userInfo);
//        if($userStatus){
//        $studentInfo['USER_ID'] = $user->getInsertID();
        // insert the data to database
        $status = $stud->insertStudent($studentInfo, $studentDetail, $studentReq, $userInfo);
        
        
        // check the insertion
        return Messages::checkInsertionAndRedirect($status, 'registration', 'Student');
    }

    private function uploadStudents()
    {
        $students = RequestVars::getSelected($this->request);
//                $this->request->getPost('selector');    // get the selected students
        
        $stud = System::createStudent();
        $student = $stud->manageInput($students);   // separate the input string and mange for insertion
        
        if ($student != false) {
            // if there any student then
            [$studInfo, $studDetail, $studReq] = array_pad($student, 3, null);
//            $studInfo   = $student[0];
//            $studDetail = $student[1];
//            $studReq    = $student[2];
            
//        echo '<pre>';
//        print_r($studInfo);
//        print_r($studDetail);
//        print_r($studReq);
//        die();
            // upload the students
            $status = $stud->uploadStudents($studInfo, $studDetail, $studReq);     // upload students from the spreadsheet
            // check the insertion.
            return Messages::checkInsertionAndRedirect($status, 'registration', 'Students');
        } else {
            return redirect()->to("/registration/upload")->with('error', 'There is nothing to insert');
        }
    }

    public function index()
    {
        if (session()->has('user') && session()->get('user_role') == UserRole::REGIST()) {
            // load the appropriate model
            $student = System::createStudentInfo();

            // prepare the data to be sent
            $data = [
                'page'          => 'registration',
                'title'         => 'New Students',
                'newStudents'   => $student->where('SECTION_ID ', NULL)->findAll()
            ];

            return view('/registrar/registrations/registrations_list', $data);  // dispaly the new students list 
        } else {
            return Messages::errorPageNotFound();   // display error message          
        }
    }

    // get students in section 
    public function studentsAtSection($section_id)
    {
        if (session()->has('user') && session()->get('user_role') == UserRole::REGIST()) {
            // load the appropriate model
            $student = System::createStudent();
            $section = System::createSection();
            // prepare the data to be sent
            $data = [
                'page'      => 'section',
                'title'     => 'Students',
                'section'   => $section->select('SECTION_ID, SECTION_NAME')
                                       ->where('SECTION_ID', decrypt_url($section_id))
                                       ->first(),
                'students'  => $student->studentInfo->where('SECTION_ID', decrypt_url($section_id))->findAll()
            ];
            return view('/registrar/students/students_list', $data);    // dispaly the new students list
        } else {
            return Messages::errorPageNotFound();   // display error message
        }
    }

    // registration form
    public function register()
    {
        if (session()->has('user') && session()->get('user_role') == UserRole::REGIST()) {
            if ($this->request->getMethod() == 'post') {
                if ($this->request->getPost('upload')) {
                    return $this->uploadStudents();
                } else {
                    return $this->createStudent();
                }
            }
            helper('text');
            // laod the appropriate models
            $department = System::createDepartment();
            $program = System::createProgram();
            $setting = System::createSetting();
            $company = $setting->where('SETTING_TYPE', 'COMPANY')->first()->SETTING_DESC;
            
            $id_no = firstLetter($company).random_string('numeric', 5);
//            die();
            
            // prepare the data to be sent
            $data = [
                'page'          => 'registration', // set the page name
                'title'         => 'Regsiter Student', // set the view title
                'departments'   => $department->findAll(), // find all departments 
                'programs'      => $program->findAll(), // find all programs
                'id_no'         => $id_no,
                    
            ];

            return view('/registrar/registrations/register', $data);    // display the registration form view
        } else {
            return Messages::errorPageNotFound();   // display error message
        }
    }

    // upload spreadsheet form
    public function uploadFile()
    {
        if (checkUser(UserRole::REGIST())) {
            if ($this->request->getMethod() == 'post') {
                return $this->uploadSpreadsheet();
            }
            // prepare the data to be sent
            $data = [
                'page'  => 'registration', // set the page name
                'title' => 'Uplaod From Spreadsheet', // set the view title
            ];

            return view('/registrar/registrations/upload', $data);    // display the registration form view
        } else {
            
            return Messages::errorPageNotFound();   // display error message
        }
    }

    private function uploadSpreadsheet() 
    {
        $validation = $this->validate(Validation::uploadSpreadsheetRules());    // validate the uploaded file
        // if the validation fail then display error message
        if (!$validation) {
            return Messages::validationErrorsWithInput($this->validator);
//            return redirect()->back()->withInput()->with('error', 'Something was wrong. Please check your input');
        } else {
            
            ini_set("memory_limit", "-1");  // ignore php memory limit warnning
            $file = $this->request->getFile('xlsxFile');    // get the uploaded file
            
            $sheet = System::uploadStudentsInfo($file);   // load the worksheet

            $requiredData = $sheet->searchForRequiredData(); // search for required data and return missed data or the content
            
            // if sothing is miss display error message
            if (is_string($requiredData)) {
                return redirect()->back()->with("error", "The following commponets are missed: " . $requiredData);
            } else if (is_array($requiredData)) {
                
                $data = [
                    'page'          => 'registration',
                    'title'         => 'Preview',
                    'students'      => $sheet->fetchAll($requiredData),
                    'department'    => $requiredData['Department'],
                    'program'       => $requiredData['Program']
                ];
                
                // dispaly the file preview
                return view('/registrar/registrations/upload_preview', $data);
            }
        }
    }
    
    public function deleteStudent()
    {
        if ($this->request->getMethod() == 'post') {
//            $students = $this->request->getPost('selector');
            $students = RequestVars::getSelected($this->request);
            if(empty($students)){
                return Messages::errorNoThingSelected();
            }
            $stud = System::createStudent();
            $status = $stud->deleteSelected($students);
            
            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'registration', 'Student(s)'); 
        }
    }
    
    public function updateStudent($student_id)
    {
//        echo "Edit ". decrypt_url($student_id);
        if(checkUser(UserRole::REGIST())){
            $student = System::createStudent();
            if($this->request->getMethod() == 'get'){
                
                $department = System::createDepartment();
                $programs = System::createProgram();
                $data = [
                    'page'  => 'registration',
                    'title' => 'Edit Student Information',
                    'departments' => $department->findAll(),
                    'programs' => $programs->findAll(),
                    'student' => $student->getStudentById(decrypt_url($student_id)),
                ];
//                echo '<pre>';
//                print_r($data['student']);
//                die();
                return view('registrar/registrations/edit_student',$data);
            }
            if($this->request->getMethod() == 'post'){
                // validate every input first
                $validation = $this->validate(Validation::studentUpdateRegistrationRules($this->request), Validation::studentRegistrationMessages());
                if (!$validation) {
                    return Messages::validationErrorsWithInput($this->validator);
                }
                
                // get the user information from the request
                $userInfo = RequestVars::studentUser($this->request);
                $student = $student->studentInfo->where('IDNO', decrypt_url($student_id))->first();
                $userInfo['ACCOUNT_ID'] = $student->USER_ID;
                
                // get the student info from the request
                $studentInfo = RequestVars::studentInfo($this->request);

                // get the student details from the request
                $studentDetail = RequestVars::studentDetails($this->request);

                // get the student requirement from the request
                $studentReq = RequestVars::studentRequirments($this->request);

                // load the appropriate model
                $stud = System::createStudent();
                
                
//                echo '<pre>';
//                print_r($userInfo);
//                print_r($studentInfo);
//                print_r($studentDetail);
//                print_r($studentReq);
//                die();
                
                // update the data in the database
                $status = $stud->updateStudent($studentInfo, $studentDetail, $studentReq, $userInfo);

                // check for update
                return Messages::checkforUpdateAndRedirect($status, 'registration', 'Student');
            }
        }
    }
    
    public function downloadReport(string $schoolyr_id, string $student_id){
        $student = decrypt_url($student_id);
        $report = new \App\Libraries\Report\SemesterGradeReport();
        $report->reportBanner();
        $report->reportStudentDetails(decrypt_url($schoolyr_id), $student);
        $report->reportStudentGrade(decrypt_url($schoolyr_id), $student);
        $report->downloadReport('gradeReport.docx');
        
        exit;
    }
    
    
    /**
     * this part is for student account users in this system
     * 
     */
    public function studentProfile(){
        
    }

}
