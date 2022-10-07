<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

class StudentEnrollment extends BaseController
{
    public function index()
    {
        // no defalult url
    }
    
    public function studentEnrollments(string $section_id, string $student_id) 
    {
        if (checkUser(UserRole::REGIST())) {
            if($this->request->getMethod() === 'get'){
                $enroll = System::createQuery();
                $data = [
                    'page'          => 'section',
                    'title'         => 'Student '. decrypt_url($student_id).' Enrollment Records',
                    'enrollments'   => $enroll->studentEnrollments(decrypt_url($section_id), decrypt_url($student_id)),
                    'section'       => $section_id,
                    'student'       => $student_id
                ];
                return view('registrar/students/student_enrollments', $data);
            }
        }
    }
    
    public function deleteStudentEnrollments(string $section_id, string $student_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                $schoolyr = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($schoolyr)){
                    return Messages::errorNoThingSelected();
                }
                $grade = System::createGrade();
//                print_r($schoolyr);
//                die();
                $status = $grade->whereIn('SYID', $schoolyr)->delete();
                
                // check the deletion and redirect
                return Messages::checkDeletionAndRedirect($status, "sections/student-enrollment/{$section_id}/{$student_id}", 'Enrolled Semester(s)'); 
            }
        }
    }
    public function semestersToEnroll(string $section_id,string $student_id)
    {
        if (session()->has('user') && session()->get('user_role') == UserRole::REGIST()) {
            if($this->request->getMethod() == 'post'){
                $schoolyr = RequestVars::getSelected($this->request);
                
                // check if any this selected
                if(empty($schoolyr)){
                    return Messages::errorNoThingSelected();
                }
                
                $enroll = System::createEnrollment();
                $courses = $enroll->whereIn('SYID',$schoolyr)->select('SYID, STUDSUBJ_ID')->findAll();
                
                // @TODO: check if the grade exists with this STUDSUBJ_ID and IDNO
                $grades = RequestVars::studentGrade(decrypt_url($student_id), $courses,null);
//                echo '<pre>';
////                print_r($schoolyr);
////                echo '-------------------';
////                print_r($courses);
//                print_r($grades);
//                die();
                $grade = System::createGrade();
                
                $status = $grade->insertBatch($grades);
                
                return Messages::checkInsertionAndRedirect($status, "sections/student-enrollment/{$section_id}/{$student_id}", 'Student Enrollments');
            }
            
            $enroll = System::createQuery();
//            $enroll->studentToEnroll(decrypt_url($section_id), decrypt_url($student_id));
            $data = [
                'page'          => 'section',
                'title'         => 'Section Enrollment Records',
                'enrollments'   => $enroll->semestersToEnroll(decrypt_url($section_id), decrypt_url($student_id)),
                'section'       => $section_id,
                'student'       => $student_id
            ];
            return view('registrar/students/section_enrollments', $data);
        }
    }
    
    public function coursesToEnroll(string $section_id, string $sy_id, string $student_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $course = System::createQuery();
                $data = [
                    'page' => 'section',
                    'title' => 'Courses To Enroll',
                    'courses' => $course->enrolledCourses(decrypt_url($section_id), decrypt_url($sy_id)),
                    'section' => $section_id,
                    'student' => $student_id,
                ];
                return view('registrar/students/courses_to_enroll',$data);
            }
        }
    }
    
    public function enrolledCourses(string $section_id, string $sy_id, string $student_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $course = System::createQuery();
//                echo '<pre>';
//                print_r();
//                die();
                $data = [
                    'page'      => 'section',
                    'title'     => 'Enrolled Courses',
                    'courses'   => $course->studentCourses(decrypt_url($sy_id), decrypt_url($student_id)),
                    'section'   => $section_id,
                    'schoolyr'  => $sy_id,
                    'student'   => $student_id,
                ];
                return view('registrar/students/enrolled_courses', $data);
            }
        }
    }
    
    public function addCourses(string $section_id, string $sy_id, string $student_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'get'){
                $course = System::createQuery();
                
                $data = [
                    'page' => 'section',
                    'title' => 'Add Courses',
                    // TODO: Uncomment the commented line in the avalilableCourses function
                    'courses' => $course->availableCourses(decrypt_url($section_id), decrypt_url($sy_id), decrypt_url($student_id)),
                    'section' => $section_id,
                    'schoolyr' => $sy_id,
                    'student' => $student_id,
                ];
                return view('registrar/students/add_courses', $data);
            }
            else if($this->request->getMethod() === 'post'){
                $courses = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($courses)){
                    return Messages::errorNoThingSelected();
                }
                $course = System::createEnrollment();
                $courses = $course->whereIn('STUDSUBJ_ID',$courses)->select('STUDSUBJ_ID, SYID')->findAll();
                
                $grade = System::createGrade();
                $grades = RequestVars::studentGrade(decrypt_url($student_id), $courses, decrypt_url($sy_id));
//                echo '<pre>';
//                print_r($grades);
//                die();
                $status = $grade->insertBatch($grades);
                
                return Messages::checkInsertionAndRedirect($status, "sections/student-enrollment/enrolled-courses/{$section_id}/{$sy_id}/{$student_id}", 'Course(s) Grade');
            }
        }
    }
    
    public function dropCourses(string $section_id, string $sy_id, string $student_id)
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() === 'post'){
//                $validation = $this->validate(Validation::enrollCourseRules()); // TODO add messages for the rules
//                if (!$validation) {
//                    return Messages::validationErrorsWithInput($this->validator);
//                }
                $grades = RequestVars::getSelected($this->request);
                // check if any this selected
                if(empty($grades)){
                    return Messages::errorNoThingSelected();
                }
                $grade = System::createGrade();
                
                $status = $grade->whereIn('GRADE_ID',$grades)->delete();
                
                // check the deletion
                return Messages::checkDeletionAndRedirect($status, "sections/student-enrollment/enrolled-courses/{$section_id}/{$sy_id}/{$student_id}", 'Course(s)'); 
                
            }
        }
    }
    
    /**
     *  this section only for the student
     *  users that uses the system
     */
    
    public function studentEnrollemnts()
    {
        if (checkUser(UserRole::STUDENT()) && $this->request->getMethod() === 'get') {
            
            $student = System::createStudent();
            $studentInfo = $student->studentInfo->where('USER_ID',session()->get('user'))->first();
            $enroll = System::createQuery();
            $data = [
                'page'          => 'course',
                'title'         => 'Enrollment Records',
                'enrollments'   => $enroll->studentEnrollments($studentInfo->SECTION_ID, $studentInfo->IDNO),
//                'section'       => $studentInfo->SECTION_ID,
//                'student'       => $studentInfo->IDNO
            ];
//            helper('inflector');
            return view('student/student_enrollments', $data);
        }
    }
    
    public function studentCourses(string $sy_id)
    {
        if(checkUser(UserRole::STUDENT()) && $this->request->getMethod() === 'get'){
            $student = System::createStudentInfo();
            $course = System::createQuery();
            $studInfo = $student->where('USER_ID',session()->get('user'))->first();
            $data = [
                'page'      => 'course',
                'title'     => 'Courses',
                'courses'   => $course->studentCourses(decrypt_url($sy_id), $studInfo->IDNO),
            ];
            return view('student/enrolled_courses', $data);
        }
    }
    
}
