<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;
use App\Libraries\Validation;

class Course extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST())):
            $course = System::createCourse();
        
            $data = [
                'page' => 'course',
                'title' => 'Courses Table',
                'courses' => $course->findAll()
            ];
            return view('/registrar/courses/courses_list', $data);        
        endif;
    }
    
    public function newCourse()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get')
        {
            $course = System::createCourse();
            $data = [
                'page' => 'course',
                'title' => 'New Course',
                'courses' => $course->select('SUBJ_CODE, SUBJ_DESCRIPTION')->findAll(),
            ];
            return view('registrar/courses/add_course', $data);
        }
    }
    
    public function addCourse()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            // validate every input first
            $validation = $this->validate(Validation::addCourseRules(), Validation::addCourseMessages());

            if(!$validation){
                return Messages::validationErrorsWithInput($this->validator);
            }
            // get the section info from the request
            $courseInfo = RequestVars::CourseInfo($this->request);
            
            // prepare for insetion
            $course = System::createCourse();
            
            // insert the data to database
            $status = $course->insert($courseInfo);
            return ! empty($courseInfo['SAVEONLY'])
                   ? Messages::checkInsertionAndRedirect($status, 'courses', 'Course') 
                   : Messages::checkInsertionAndRedirect($status, 'courses/new-course', 'Course');
        }
    }
    
    public function editCourse(string $course_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $course = System::createCourse();
                $data = [
                    'page' => 'course',
                    'title' => 'Edit Course',
                    'course' => $course->where('SUBJ_CODE', decrypt_url($course_id))->first(),
                    'courses' => $course->select('SUBJ_CODE, SUBJ_DESCRIPTION, PRE_REQUISITE')->findAll(),
                ];
//                echo '<pre>';
//                print_r($data['course']);
//                die;
                return view('registrar/courses/edit_course', $data);
            }
            if($this->request->getMethod() == 'post'){
                
//                echo $this->request->getPost('subj_code');
//                die();
                // validate every input first
                $validation = $this->validate(Validation::editCourseRules($this->request), Validation::addCourseMessages());

                if(!$validation){
                    return Messages::validationErrorsWithInput($this->validator);
                }
                
                // get the section info from the request
                $courseInfo = RequestVars::CourseInfo($this->request);
                array_pop($courseInfo);
//                echo '<pre>';
//                print_r($courseInfo);
//                die();
                // prepare for update
                $course = System::createCourse();

                // insert the data to database
                $status = $course->where('SUBJ_CODE', decrypt_url($course_id))->set($courseInfo)->update();
                return Messages::checkforUpdateAndRedirect($status, 'courses', 'Course');
                
            }
        }
    }
    
    public function deleteCourse()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post')
        {
            // get the selected faculties
            $courses = RequestVars::getSelected($this->request);

            // if nothing is selected display error message
            if(empty($courses)){
                return Messages::errorNoThingSelected();
            }

            // delete the selected faculties
            $course = System::createCourse();
            $status = $course->whereIn('SUBJ_ID', $courses)->delete();

            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'courses', 'Course(s)'); 
        }
    }
}
