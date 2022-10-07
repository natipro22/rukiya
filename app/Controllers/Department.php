<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;
use App\Libraries\Validation;

class Department extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'get'){
                $dept = System::createDepartment();
                $data = [
                    'page'          => 'department',
                    'title'         => 'Departments',
                    'departments'   => $dept->select('*,f.FACULTY_NAME')
                                            ->join('faculty f','department.FACULTY_ID = f.FACULTY_ID')
                                            ->findAll()
                ];
                return view('registrar/departments/departments_list',$data);
            }
        }
    }
    public function newDepartment()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $faculty = System::createFaculty();
                $data = [
                    'page' => 'department',
                    'title' => 'New Department',
                    'faculties' => $faculty->select('FACULTY_NAME, FACULTY_ID')->findAll(),
                ];
                return view('registrar/departments/add_department',$data);
            }
        }
    }
    
    public function addDepartment()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                // validate every input first
                $validation = $this->validate(Validation::addDepartmentRules(), Validation::addDepartmentMessages());
                
                if(!$validation){
                    return Messages::validationErrorsWithInput($this->validator);
                }
                // get the section info from the request
                $deptInfo = RequestVars::DepartmentInfo($this->request);
                
                // prepare for insetion
                $dept = System::createDepartment();
                // insert the data to database
                $status = $dept->insert($deptInfo);
                return ! empty($deptInfo['SAVEONLY']) 
                       ? Messages::checkInsertionAndRedirect($status, 'departments', 'Department') 
                       : Messages::checkInsertionAndRedirect($status, 'departments/new-department', 'Department');
            }
        }
    }
    
    public function deleteDepartment()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                // get the selected departments
                $depts = RequestVars::getSelected($this->request);
                
                // if nothing is selected display error message
                if(empty($depts)){
                    return Messages::errorNoThingSelected();
                }

                // delete the selected department
                $dept = System::createDepartment();
                $status = $dept->whereIn('DEPT_ID', $depts)->delete();

                // check the deletion
                return Messages::checkDeletionAndRedirect($status, 'departments', 'Department(s)'); 
            }
        }
    }
    
    public function departmentCourses(string $department)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'get'){
                $course = System::createCourse();
                $data = [
                    'page'          => 'department',
                    'title'         => 'Courses In '.decrypt_url($department).' Department',
                    'department'    => $department,
                    'courses'       => $course->select('sjdp.SUBJDEPT_ID, sjdp.IS_MAJOR, subject.SUBJ_CODE, subject.SUBJ_DESCRIPTION, subject.UNIT, subject.CT_HR, subject.PRE_REQUISITE')
                                              ->join('subjdept sjdp', 'sjdp.SUBJ_CODE = subject.SUBJ_CODE')
                                              ->where('sjdp.DEPT_NAME', decrypt_url($department))
                                              ->findAll(),
                ];
                return view('registrar/departments/department_courses', $data);
            }
        }
    }
    public function removeCourses(string $department)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'post'){
                $courses = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($courses)){
                    return Messages::errorNoThingSelected();
                }
                
                $departmentCourse = System::createCoursesDepartment();
                $status = $departmentCourse->whereIn('SUBJDEPT_ID', $courses)->delete();
                // check the deletion
                return Messages::checkDeletionAndRedirect($status, "departments/courses/{$department}", 'Coures(s)'); 
                
            }
        }
    }
    public function assignCourses(string $department)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'get'){
                $course = System::createQuery();
                $data = [
                    'page'          => 'department',
                    'title'         => 'Courses',
                    'courses'       => $course->departmentCourses(decrypt_url($department)),
                    'department'    => $department,
                ];
                return view('registrar/departments/assign_courses', $data);
            }
            else if($this->request->getMethod() === 'post'){
                
                $courses = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($courses)){
                    return Messages::errorNoThingSelected();
                }
                $courses_department = !empty($this->request->getPost('major')) 
                                    ? RequestVars::courseDepartment(decrypt_url($department), $courses)
                                    : RequestVars::courseDepartment(decrypt_url($department), $courses, false);
//                echo '<pre>';
//                print_r($courses_department);
//                die();
                $course_dept = System::createCoursesDepartment();
                
                $status = $course_dept->insertBatch($courses_department);
                
                // check the insertion
                return Messages::checkInsertionAndRedirect($status, "departments/courses/{$department}", 'Course(s)'); 
            }
        }
    }
}
