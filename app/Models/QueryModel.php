<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Class QueryModel
 *
 * BaseController provides a connection to database for all queries that
 * is not related to specific database table.
 *
 * 
 */
class QueryModel extends Model
{  
    public function instructorCourses($inst_id) : iterable
    {
        $subj = $this->db->table('studentsubjects stsj')->distinct()
                         ->select('sj.SUBJ_CODE, sj.SUBJ_DESCRIPTION, sj.UNIT, sj.PRE_REQUISITE')
                         ->join('subject sj', "sj.SUBJ_CODE = stsj.SUBJ_CODE ")
                         ->join("schoolyr sy", "stsj.SYID = sy.SYID")
//                         ->join("course co", "sy.COURSE_ID = co.COURSE_ID")
                         ->where('sy.START_DATE <=', gregorianDate())
//                         ->where('sy.END_DATE >=', gregorianDate()) // TODO: uncomment this line when you finish
                         ->where("stsj.INST_ID",$inst_id)
                         ->get()->getResult();
        return $subj;
    }
    
    public function sectionEnrollments($section_id) : iterable
    {
        $enrollments = $this->db->table('schoolyr sy')->select('sy.SYID, sy.AY, sy.START_DATE, cr.COURSE_NAME, sm.SEM')
                                ->join('course cr', 'sy.COURSE_ID = cr.COURSE_ID')
                                ->join('semester sm', 'sy.SEMESTER_ID = sm.SEM_ID')
                                ->where('sy.SECTION_ID',$section_id)
                                ->get()->getResult();
        return $enrollments;
    }
    
    public function semestersToEnroll($section_id, $student_id)
    {
        $studenroll = $this->db->table('studentsubjects stsj')->select('sy.SYID')
                          ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                          ->join('grades gr','stsj.STUDSUBJ_ID = gr.SSID')
//                          ->where('sy.SECTION_ID', $section_id)
                          ->where('gr.IDNO', $student_id);
        $notenroll = $this->db->table('schoolyr sy')
                              ->select('sy.SYID, sy.AY, sy.START_DATE, cr.COURSE_NAME, sm.SEM')
                              ->join('course cr', 'sy.COURSE_ID = cr.COURSE_ID')
                              ->join('semester sm', 'sy.SEMESTER_ID = sm.SEM_ID')
                              ->where('sy.SECTION_ID', $section_id)
                              ->whereNotIn('sy.SYID', $studenroll)
                              ->get()->getResult();
        return $notenroll;                  
    }
    
    public function departmentCourses(string $department) : iterable
    {
        $courses = $this->db->table('subjdept sjdp')
                            ->select('sj.SUBJ_CODE')
                            ->join('subject sj', 'sj.SUBJ_CODE = sjdp.SUBJ_CODE')
                            ->where('sjdp.DEPT_NAME', $department);
        return $this->db->table('subject sj')
                        ->select('SUBJ_CODE, SUBJ_DESCRIPTION, UNIT, CT_HR, PRE_REQUISITE')
                        ->whereNotIn('sj.SUBJ_CODE', $courses)
                        ->get()->getResult();
    }
    public function studentEnrollments($section_id,$student_id) : iterable 
    {
        $enrollments = $this->db->table('schoolyr sy')->distinct('sy.SYID')
                                ->select('sy.SYID, sy.AY, sy.START_DATE,sy.COURSE_ID, sy.SEMESTER_ID, cr.COURSE_NAME, sm.SEM')
                                ->join('course cr', 'sy.COURSE_ID = cr.COURSE_ID')
                                ->join('semester sm', 'sy.SEMESTER_ID = sm.SEM_ID')
                                ->join('studentsubjects stsj', 'stsj.SYID = sy.SYID')
                                ->join('grades gr','stsj.STUDSUBJ_ID = gr.SSID')
                                ->where('sy.SECTION_ID',$section_id)
                                ->where('gr.IDNO', $student_id)
                                ->get()->getResult();
        return $enrollments;
    }
    
    public function studentCourses($sy_id, $student_id) : iterable
    {
        return $this->db->table('studentsubjects stsj')->distinct()
                        ->select('stsj.STUDSUBJ_ID, sj.SUBJ_CODE, sj.SUBJ_DESCRIPTION, sj.UNIT, gr.GRADE_ID, gr.IDNO, gr.FIRST, '
                                . 'gr.SECOND, gr.THIRD, gr.FOURTH, gr.FINAL, gr.TOTAL, gr.GRADE, gr.REMARKS')
                        ->join('subject sj', 'stsj.SUBJ_CODE = sj.SUBJ_CODE')
                        ->join('grades gr','gr.SSID = stsj.STUDSUBJ_ID')
                        ->join('schoolyr sy', 'sy.SYID = gr.SYID')
                        ->where('gr.SYID', $sy_id)
                        ->where('gr.IDNO', $student_id)
                        ->get()->getResult();
    }
    
    public function enrolledCourses($section_id, $sy_id)
    {
        return $this->db->table('studentsubjects stsj')->distinct()
                        ->select('stsj.STUDSUBJ_ID, sj.*, inst.INST_FULLNAME')
                        ->join('subject sj', 'stsj.SUBJ_CODE = sj.SUBJ_CODE')
                        ->join('schoolyr sy', 'sy.SYID = sy.SYID')
                        ->join('instructor inst', 'stsj.INST_ID = inst.INST_ID')
                        ->where('stsj.SYID',$sy_id)
                        ->where('sy.SECTION_ID', $section_id)
                        ->get()->getResult();
    }
    public function sectionCourse($section_id)
    {
        $this->db->transStart();
        $department = $this->db->table('section sc')->select('sc.DEPARTMENT')->where('SECTION_ID', $section_id)->get()->getRow()->DEPARTMENT;
        $output = $this->db->table('subjdept sjdt')->select('sj.SUBJ_CODE, sj.SUBJ_DESCRIPTION')
                           ->join('subject sj' ,'sj.SUBJ_CODE = sjdt.SUBJ_CODE')
                           ->where('sjdt.DEPT_NAME', $department)
                           ->get()->getResult();
        $this->db->transComplete();
        
        return ($this->db->transStatus === false ? false : $output);
        
    }
    
    public function deleteEnrollemt($sy_id)
    {
        $this->db->transStart();
        $this->db->table('schoolyr sy')
                 ->join('studentsubjects stsj', 'sy.SYID = stsj.SYID')
                 ->where('sy.SYID', $sy_id)
                 ->delete();
        $this->db->transComplete();
        
        return ($this->db->transStatus === false ? false : true);
    }
    
    public function availableCourses($section_id, $sy_id, $student_id) : iterable
    {
        $enrolledCourses = $this->db->table('studentsubjects stsj')
                                    ->select('sj.SUBJ_ID')
                                    ->join('grades gr', 'gr.SSID = stsj.STUDSUBJ_ID')
                                    ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                                    ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                                    ->where('stsj.SYID', $sy_id)
                                    ->where('sy.SECTION_ID',$section_id)
                                    ->where('gr.IDNO',$student_id);
        $courses = $this->db->table('studentsubjects stsj')->distinct()
                            ->select('stsj.STUDSUBJ_ID, sj.SUBJ_CODE, sj.SUBJ_DESCRIPTION, sj.UNIT, sc.SECTION_NAME')
                            ->join('subject sj', 'stsj.SUBJ_CODE = sj.SUBJ_CODE')
                            ->join('subjdept sjdp', 'sjdp.SUBJ_CODE = sj.SUBJ_CODE')
                            ->join('department dp', 'dp.DEPARTMENT_NAME = sjdp.DEPT_NAME')
                            ->join('schoolyr sy', 'stsj.SYID = sy.SYID')
                            ->join('section sc', 'sc.SECTION_ID = sy.SECTION_ID')
                            ->where('sy.START_DATE <=',gregorianDate())
//                            ->where('sy.END_DATE >=', gregorianDate())
                            ->whereNotIn('sj.SUBJ_ID', $enrolledCourses)
                            ->get()->getResult();
        return $courses;               
    }
    
    public function instructorClasses($inst_id, $subj_code)
    {
        $section = $this->db->table('schoolyr sy')
                            ->select('sc.*')
                            ->join('section sc', 'sc.SECTION_ID = sy.SECTION_ID')
                            ->join('studentsubjects stsj', 'stsj.SYID = sy.SYID')
                            ->where('stsj.INST_ID', $inst_id)
                            ->where('stsj.SUBJ_CODE', $subj_code)
                            ->where('sy.START_DATE <=', gregorianDate())
//                            ->where('sy.END_DATE >=', gregorianDate()) // TODO: uncomment this when you finish
                            ->get()->getResult();
        return $section;
                            
    }
    
    public function instructorStudents($inst_id, $subj_code, $section_id,$students_id = null)
    {
        $student = $this->db->table('grades gr')
                            ->select('gr.IDNO, st.FNAME, MNAME, LNAME,gr.GRADE_ID,'
                                    . 'FIRST, SECOND, THIRD, FOURTH, FINAL, TOTAL, GRADE')
                            ->join('studentsubjects stsj', 'gr.SSID  = stsj.STUDSUBJ_ID')
                            ->join('tblstudent st', 'gr.IDNO = st.IDNO')
                            ->join('schoolyr sy', 'stsj.SYID = sy.SYID')
                            ->where('stsj.SECTION_ID', $section_id)
                            ->where('stsj.SUBJ_CODE', $subj_code)
                            ->where('stsj.INST_ID', $inst_id)
                            ->where('sy.START_DATE <=', gregorianDate())
//                            ->where('sy.END_DATE >=', gregorianDate()) // TODO: Uncomment this when you finish
                            ;
        if($students_id != null){
            $student->whereIn('gr.GRADE_ID', $students_id);
        }
        return $student->get()->getResult();
    }
    
    public function instructorStudentsID($inst_id, $subj_code, $section_id,$students_id = null)
    {
        $student = $this->db->table('grades gr')
                            ->select('gr.IDNO,gr.GRADE_ID')
                            ->join('studentsubjects stsj', 'gr.SSID  = stsj.STUDSUBJ_ID')
                            ->join('tblstudent st', 'gr.IDNO = st.IDNO')
                            ->join('schoolyr sy', 'stsj.SYID = sy.SYID')
                            ->where('stsj.SECTION_ID', $section_id)
                            ->where('stsj.SUBJ_CODE', $subj_code)
                            ->where('stsj.INST_ID', $inst_id)
                            ->where('sy.START_DATE <=', gregorianDate())
//                            ->where('sy.END_DATE >=', gregorianDate()) // TODO: Uncomment this when you finish
                            ;
        if($students_id != null){
            $student->whereIn('gr.IDNO', $students_id);
        }
        return $student->get()->getResultArray();
    }
}
