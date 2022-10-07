<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\System;
use App\Libraries\UserRole;
use App\Libraries\Messages\Messages;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;

class Section extends BaseController {
      
    public function index()
    {
        if(checkUser(UserRole::REGIST())){
            
            $section = System::createSection();
            
            $data = [
                'page'      => 'section',
                'title'     => 'Sections',
                'sections'  => $section->findAll(),
            ];
            return view('/registrar/sections/sections_list', $data);
        } else {
            return redirect()->to('/');          
        }
    }
    
    public function addSection()
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'post') {
                // validate every input first
                $validation = $this->validate(Validation::addSectionRules(), Validation::addSectionMessages());
                
                if(!$validation){
                    return Messages::validationErrorsWithInput($this->validator);
                }
                
                // get the section info from the request
                $sectionInfo = RequestVars::sectionInfo($this->request);

                // prepare for insetion
                $section = System::createSection();
                // insert the data to database
                $status = $section->insert($sectionInfo);
                return !empty($sectionInfo['SAVEONLY']) ? Messages::checkInsertionAndRedirect($status, 'sections', 'Section') 
                                                        : Messages::checkInsertionAndRedirect($status, 'sections/add-section', 'Section');
            }
            
            $department = System::createDepartment();
            $data = [
                'page'          => 'section',
                'title'         => 'Sections',
                'departments'   => $department->findColumn('DEPARTMENT_NAME')
            ];
            return view('/registrar/sections/add_section', $data);
            
            
        }
        return Messages::errorPageNotFound();
    }
    
    public function updateSection(string $section_id)
    {
//        echo 'edit';
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $section = System::createSection();
                $department = System::createDepartment();
                $data = [
                    'page' => 'section',
                    'title' => 'Edit Section Information',
                    'section' => $section->where('SECTION_ID' , decrypt_url($section_id))->first(),
                    'departments' => $department->findColumn('DEPARTMENT_NAME')
                ];
                return view('registrar/sections/edit_section',$data);
            }
            if($this->request->getMethod() == 'post'){
                
                // validate every input first
                $validation = $this->validate(Validation::updateSectionRules($this->request), Validation::addSectionMessages());
                
                if(!$validation){
                    return Messages::validationErrorsWithInput($this->validator);
                }
                
                // get the section info from the request
                $sectionInfo = RequestVars::sectionInfo($this->request);
                
//                echo '<pre>';
//                print_r($sectionInfo);
//                die();

                // prepare for insetion
                $section = System::createSection();
                // insert the data to database
                $status = $section->where('SECTION_ID', decrypt_url($section_id))->set($sectionInfo)->update();
                return Messages::checkforUpdateAndRedirect($status, 'sections', 'Section');
            }
        }
    }
    
    public function deleteSection()
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'post') {
    //            $students = $this->request->getPost('selector');
                $sections = RequestVars::getSelected($this->request);
                if(empty($sections)){
                    return Messages::errorNoThingSelected();
                }

                // delete the selected sections
                $section = System::createSection();
                $status = $section->whereIn('SECTION_ID', $sections)->delete();

                // check the deletion
                return Messages::checkDeletionAndRedirect($status, 'sections', 'Section(s)'); 
            }
        } 
    }
    
    public function assignStudents($section_id)
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'post') {
                $students = RequestVars::getSelected($this->request);
                if(empty($students)){
                    return Messages::errorNoThingSelected();
                }
                
                // update the selected students section
                $student = System::createStudentInfo();
                $status = $student->whereIn('IDNO',$students)->set('SECTION_ID', decrypt_url($section_id))->update();
                
                return Messages::checkforUpdateAndRedirect($status, "/sections/students/{$section_id}", 'Students Section');
            }
            $student = System::createStudentInfo();
            $data = [
                'page'      => 'section',
                'title'     => 'Unsectioned Students',
                'section'   => decrypt_url($section_id),
                'students'  => $student->where('SECTION_ID', NULL)->findAll()
            ];
            return view('registrar/sections/assign_students',$data);
        }
    }
    
    public function downloadReport($student_id){
        
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'get') {
                
                // @TODO: check first if the student take all courses in the section enrollment
//                    echo decrypt_url($student_id);
//                    die();
                $student = decrypt_url($student_id);
                $report = new \App\Libraries\Report\AcademicFinalReport();
                $report->reportBanner();
                $report->reportStudentDetails($student);
                $report->reportStudentAcademicRecord($student);
                $report->reportFooter();
                $report->downloadReport('report.docx');
                exit;
            }
        }
        
    }
    
}
