<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    public function reportStudentInfo($student_id)
    {
        $student = $this->db->table('tblstudent st')
                        ->select("`IDNO` ,UPPER(CONCAT(  `FNAME`, ' ', `MNAME`)) AS 'NAME', fa.FACULTY_NAME, PROGRAM"
                                . ", UPPER(`LNAME`) AS LNAME,`SEX`, `BDAY`,dt.DEPARTMENT_NAME, dt.DEPARTMENT_DESC")
                        ->join('department dt', 'st.DEPARTMENT = dt.DEPARTMENT_NAME')
                        ->join('faculty fa', 'dt.FACULTY_ID = fa.FACULTY_ID')
                        ->where('IDNO', $student_id)
                        ->get()->getRow();
        return $student;
    }

    public function reportStudentEnrollments($student_id)
    {
        $schoolyr = $this->db->table('schoolyr sy')
                             ->select('sy.*, cr.COURSE_NAME, sm.SEM, st.DEPARTMENT')
                             ->join('course cr','sy.COURSE_ID = cr.COURSE_ID')
                             ->join('semester sm', 'sm.SEM_ID = sy.SEMESTER_ID')
                             ->join('tblstudent st', 'st.SECTION_ID = sy.SECTION_ID')
                             ->where('st.IDNO', $student_id)
                             ->where('sy.START_DATE <=', gregorianDate())
//                             ->where('sy.END_DATE >=', gregorianDate())
                             ->get()->getResult();
        return $schoolyr;
    }
    public function reportSectionCourses($section_id, $sy_id)
    {
        $courses = $this->db->table('studentsubjects stsj')->distinct()
                            ->select('stsj.STUDSUBJ_ID, sj.SUBJ_CODE , sj.SUBJ_DESCRIPTION, sj.UNIT')
                            ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
//                            ->where('stsj.SECTION_ID', $section_id)
                            ->where('stsj.SYID', $sy_id)
                            ->get()->getResult();
        return $courses;
    }
    public function reportStudentCourse($student_id, $student_course_id)
    {
        $grade = $this->db->table('grades gr')
                            ->select('GRADE')
                            ->where('IDNO', $student_id)
                            ->where('SSID', $student_course_id)
                            ->get()->getRow();
        return $grade;
    }
    
    public function reportStudentCourses(string $student_id){
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.STUDSUBJ_ID, sj.SUBJ_CODE, sj.SUBJ_DESCRIPTION, sj.UNIT, gr.GRADE')
                        ->join('grades gr','gr.SSID = stsj.STUDSUBJ_ID')
                        ->join('subject sj','stsj.SUBJ_CODE = sj.SUBJ_CODE')
                        ->join('schoolyr sy','sy.SYID = gr.SYID')
                        ->where('gr.IDNO', $student_id)
                        ->get()->getResult();
    }
    
    public function rows(int $sy_id)
    {
        $long = $this->db->table('subject sj')
                         ->select('sj.SUBJ_DESCRIPTION')
                         ->join('studentsubjects stsj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                         ->where('stsj.SYID', $sy_id)
                         ->groupBy('sj.SUBJ_DESCRIPTION')
                         ->having('LENGTH(sj.SUBJ_DESCRIPTION) > 20')
                         ->countAllResults();
        $short = $this->db->table('subject sj')
                         ->select('sj.SUBJ_DESCRIPTION')
                         ->join('studentsubjects stsj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                         ->where('stsj.SYID', $sy_id)
                         ->groupBy('sj.SUBJ_DESCRIPTION')
                         ->having('LENGTH(sj.SUBJ_DESCRIPTION) <= 20')
                         ->countAllResults();
        
        return (($long * 2) + $short);
        //        $current_len = $this->report->rows(current($enrolls)->SYID);
//        $next_len = $this->report->rows(next($enrolls)->SYID);
    }
    
}
