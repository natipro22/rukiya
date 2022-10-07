<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\System;
use App\Libraries\UserRole;
use App\Libraries\Validation;
use App\Libraries\Messages\Messages;
use App\Libraries\Requests\RequestVars;

class Enrollment extends BaseController
{
    public function index()
    {
        
    }
    public function sectionEnrollments($section_id)
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            if ($this->request->getMethod() == 'get') {
                $enroll = System::createQuery();
//                echo '<pre>';
//                print_r($enrollments);
//                die();
                $data = [
                    'page'          => 'section',
                    'title'         => 'Section Enrollment',
                    'enrollments'   => $enroll->sectionEnrollments(decrypt_url($section_id)),
                    'section'       => $section_id
                ];
                return view('registrar/enrollments/section_enrollments', $data);
            }
        }
    }
    
    public function enrolledCourses($section_id, $sy_id)
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            if ($this->request->getMethod() == 'get') {
                $course = System::createQuery();
//                $c = $course->enrolledCourses(decrypt_url($section_id), decrypt_url($sy_id));
//                echo '<pre>';
//                print_r($c);
//                die();
                $data = [
                    'page'      => 'section',
                    'title'     => 'Enrolled Courses',
                    'courses'   => $course->enrolledCourses(decrypt_url($section_id), decrypt_url($sy_id)),
                    'section'   => $section_id,
                    'schoolyr'  => $sy_id
                ];
                
                return view('registrar/enrollments/enrolled_courses', $data);
            }
        }
    }
    
    public function enrollCourse($section_id, $sy_id)
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'get') {
                $course = System::createQuery();
                $instructor = System::createInstructor();
                
                $data = [
                    'page'          => 'section',
                    'title'         => 'New Enrollment',
                    'courses'       => $course->sectionCourse(decrypt_url($section_id)),
                    'instructors'   => $instructor->select('INST_ID, INST_FULLNAME')->findAll(),
                    'section'       => $section_id,
                    'schoolyr'      => $sy_id
                ];
//                echo '<pre>';
//                print_r($data);
//                die();
                return view('registrar/enrollments/enroll_course', $data);
            }
            else if($this->request->getMethod() == 'post'){
                $validation = $this->validate(Validation::enrollCourseRules()); // TODO add messages for the rules
                if (!$validation) {
                    return Messages::validationErrorsWithInput($this->validator);
                }
//                $date = date('y');
//                $gr = \DateTime::createFromFormat('y', date('y'));
//                $et = \Andegna\DateTimeFactory::fromDateTime($gr);
//                echo $et->format('y');
                
//                $now =  \Andegna\DateTimeFactory::now()->format('y');
//                echo $now;
//                die();
                // get the student info from the request
                $enroll = RequestVars::enrollCourse($this->request);
                $enroll['SYID'] = decrypt_url($sy_id);
                $enroll['SECTION_ID'] = decrypt_url($section_id);
                $enroll['AY'] = strval(\Andegna\DateTimeFactory::now()->getYear());
                
                $enrollment = System::createEnrollment();
                
                $status = $enrollment->insert($enroll);
                return !empty($enroll['SAVEONLY']) ? Messages::checkInsertionAndRedirect($status, "sections/enrollments/{$section_id}/{$sy_id}", 'Enrollment') 
                                            : Messages::checkInsertionAndRedirect($status, "sections/enrollments/enroll-course/{$section_id}/{$sy_id}", 'Enrollment');
//                return Messages::checkInsertionAndRedirect($status, "sections/enrollments/{$section_id}/{$sy_id}", 'Enrollment');
            }
        }
    }
    
//    public function enrollCourse()
//    {
//        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
//            if ($this->request->getMethod() == 'post') {
//                
//                // validate every input first
//                
//                // @todo 
//                
//                $course = System::createQuery();
//                $instructor = System::createInstructor();
//                
//                $data = [
//                    'page' => 'section',
//                    'title' => 'New Enrollment',
//                    'courses' => $course->sectionCourse(decrypt_url($section_id)),
//                    'instructors' => $instructor->select('INST_ID, INST_FULLNAME')->findAll(),
//                    'section' => $section_id,
//                    'schoolyr' => $sy_id
//                ];
////                echo '<pre>';
////                print_r($data);
////                die();
//                return view('registrar/enrollments/enroll_course', $data);
//            }
//        }
//    }
    
    public function enrollSemester($section_id)
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            if ($this->request->getMethod() == 'get') {
                
                $sect = System::createSection();
                $section = $sect->select('SECTION_ID, SECTION_NAME')
                                ->where('SECTION_ID', decrypt_url($section_id))
                                ->first();
                
                $level = System::createLevel();
                $semester = System::createSemester();
                
                $data = [
                    'page'      => 'section',
                    'title'     => 'Enrollment Form',
                    'section'   => $section,
                    'year'      => \Andegna\DateTimeFactory::now()->getYear(),
                    'levels'    => $level->findAll(),
                    'semesters' => $semester->findAll()
                ];
                return view('registrar/enrollments/enroll_semester', $data);
            } else if($this->request->getMethod() == 'post'){
                // validate the input
                $validation = $this->validate(Validation::enrollSemesterRules(), Validation::enrollSemesterRulesMessages()); // TODO add messages for the rules
                
                if (!$validation) {
                    return Messages::validationErrorsWithInput($this->validator);
                }
                
                $enroll = RequestVars::enrollSemester($this->request);
                $schoolyr = System::createSchoolYear();
                
                $status = $schoolyr->insert($enroll);
                
                return !empty($enroll['SAVEONLY']) ? Messages::checkInsertionAndRedirect($status, "sections/enrollments/{$section_id}", 'Enrollment') 
                                                   : Messages::checkInsertionAndRedirect($status, "sections/enrollments/enroll-semester/{$section_id}", 'Enrollment');
                
            }
        }
    }
    
    public function deleteEnrolledSemester($section_id)
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            if ($this->request->getMethod() == 'post') {
                $semesters = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($semesters)){
                    return Messages::errorNoThingSelected();
                }
                
                // delete the selected items
                $enroll = System::createSchoolYear();
                $status = $enroll->whereIn('SYID',$semesters)->delete();
                
                // check the deletion
                return Messages::checkDeletionAndRedirect($status, "sections/enrollments/{$section_id}", 'Enrollment(s)'); 
            }
        }
    }
    
    public function deleteEnrolledCourse($section_id, $sy_id)
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            if ($this->request->getMethod() == 'post') {
                $courses = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($courses)){
                    return Messages::errorNoThingSelected();
                }
                
                // delete the selected items
                $enroll = System::createEnrollment();
                $status = $enroll->whereIn('STUDSUBJ_ID',$courses)->delete();
                
                // check the deletion
                return Messages::checkDeletionAndRedirect($status, "sections/enrollments/{$section_id}/{$sy_id}", 'Enrollment(s)'); 
            }
        }
    }
    
}
