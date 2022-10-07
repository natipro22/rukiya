<?php
namespace App\Libraries\Requests;
use App\Libraries\Hash;
use App\Libraries\System;
/**
 * Description of RequestVars
 *
 * @author Mohammed
 */
class RequestVars {
    
    private static function random_ID($request){
        $setting = System::createSetting();
        $campus = $setting->where('SETTING_TYPE', 'CAMPUS')->first()->SETTING_DESC;
        $program = $request->getPost('program',FILTER_SANITIZE_STRING);
        $idno = $request->getPost('id_no',FILTER_SANITIZE_STRING);
        if(strlen($request->getPost('id_no')) == 7){
            $idno .= '/' . firstLetter($campus) .'/'. firstLetter($program).'/'. ethiopianDate('now','y');
        }
        return $idno;
    }
    
    public static function studentInfo($request) 
    {
        return [
                    'IDNO'          => self::random_ID($request),
                    'FNAME'         => trim($request->getPost('fname')),
                    'MNAME'         => trim($request->getPost('mname')),
                    'LNAME'         => trim($request->getPost('lname')),
                    'SEX'           => trim($request->getPost('gender')),
                    'BDAY'          => trim($request->getPost('bday')),
                    'BPLACE'        => trim($request->getPost('bplace')),
                    'CONTACT_NO'    => trim($request->getPost('contact')),
                    'EMAIL'         => trim($request->getPost('email')),
                    'DEPARTMENT'    => trim($request->getPost('dept')),
                    'PROGRAM'       => trim($request->getPost('program')),
                    'HOME_ADD'      => trim($request->getPost('home_address')),
//                    'USER_ID'       => ,
                    'STATUS'        => 'NEW',
                ];
        
    }
    public static function studentDetails($request) 
    {
        return [
                    'FATHER'            => trim($request->getPost('f_name')),
                    'FATHER_OCCU'       => trim($request->getPost('f_occu')),
                    'MOTHER'            => trim($request->getPost('m_name')),
                    'MOTHER_OCCU'       => trim($request->getPost('m_occu')),
                    'GUARDIAN'          => trim($request->getPost('g_name')),
                    'GUARDIAN_ADDRESS'  => trim($request->getPost('g_address')),
                    'IDNO'              => trim(self::random_ID($request)),
                ];
    }
    
    public static function studentUser($request)
    {
        return [
            'ACCOUNT_NAME'      => trim($request->getPost('fname').' '.$request->getPost('mname').' '.$request->getPost('lname')),
            'GENDER'            => trim($request->getPost('gender')),
            'ACCOUNT_USERNAME'  => trim($request->getPost('email')),
            'ACCOUNT_PASSWORD'  => Hash::makePassword(trim($request->getPost('id_no'))),
            'ACCOUNT_TYPE'      => trim('Student'),
        ];
    }
    
    public static function createSchedule($data, $enroll)
    {
        return [
            'STUDSUBJ_ID' => $enroll,
            'MON' => $data['MON'],
            'TUE' => $data['TUE'],
            'WED' => $data['WED'],
            'THU' => $data['THU'],
            'FRI' => $data['FRI'],
            'SAT' => $data['SAT'],
        ];
    }
    public static function studentRequirments($request) 
    {
        return [
                    'G10SC_NAME'            => trim($request->getPost('g_10_sc')),
                    'G10_VAL'               => trim($request->getPost('g_10_res')),
                    'G10_YEAR'              => trim($request->getPost('g_10_yr')),
                    'G12SC_NAME'            => trim($request->getPost('g_12_sc')),
                    'G12_VAL'               => trim($request->getPost('g_12_res')),
                    'G12_YEAR'              => trim($request->getPost('g_12_yr')),
                    'G12_2COLLEGE_NAME'     => trim($request->getPost('tvet_clg')),
                    'G12_2VAL'              => trim($request->getPost('tvet_res')),
                    'G12_2YEAR'             => trim($request->getPost('tvet_yr')),
                    'LEVEL3_4COLLEGENAME'   => trim($request->getPost('tvet_level_clg')),
                    'LEVEL3_4VAL'           => trim($request->getPost('tvet_level_res')),
                    'DATE_OF_ATTEND'        => trim($request->getPost('tvet_level_yr')),
                    'COLLEGE'               => trim($request->getPost('uni_clg')),
                    'DEGREE'                => trim($request->getPost('uni_clg_res')),
                    'DATE_OF_AWARE'         => trim($request->getPost('uni_clg_yr')),
                    'IDNO'                  => trim(self::random_ID($request)),
                ];
    }
    
    public static function userLogin($request)
    {
        return [
            'email'      => trim($request->getPost('email')),
            'password'   => trim($request->getPost('password')),
            'remember'   => (bool)trim($request->getPost('remember'))
        ];
    }
    
    public static function registerUser($request)
    {
        return [
            'ACCOUNT_NAME'      => trim($request->getPost('name')),
            'ACCOUNT_USERNAME'  => trim($request->getPost('email')),
            'ACCOUNT_PASSWORD'  => Hash::makePassword(trim($request->getPost('password'))),
            'ACCOUNT_TYPE'      => trim($request->getPost('role')),
        ];
    }
    
    public static function sectionInfo($request) 
    {
        return [
            'SECTION_NAME'  => trim($request->getPost('section_name')),
            'SECTION_DESC'  => trim($request->getPost('section_desc')),
            'YEAR'          => trim($request->getPost('section_year')),
            'DEPARTMENT'    => trim($request->getPost('department')),
            'SAVEONLY'      => trim($request->getPost('save_only'))
        ];
    }
    
    public static function InstructorUserInfo($request)
    {
        return [
            'ACCOUNT_NAME'      => trim($request->getPost('inst_name', FILTER_SANITIZE_STRING)),
            'ACCOUNT_USERNAME'  => trim($request->getPost('inst_email', FILTER_SANITIZE_EMAIL)),
            'GENDER'            => trim($request->getPost('inst_sex', FILTER_SANITIZE_STRING)),
            'ACCOUNT_PASSWORD'  => Hash::makePassword(trim($request->getPost('inst_password', FILTER_SANITIZE_STRING))),
            'ACCOUNT_TYPE'      => trim('Instructor'),
//            'SAVEONLY'          => trim($request->getPost('save_only'))
        ];
    }
    
    
    public static function InstructorInfo($request)
    {
        return [
            'INST_FULLNAME'     => trim($request->getPost('inst_name', FILTER_SANITIZE_STRING)),
            'INST_ADDRESS'      => trim($request->getPost('inst_address', FILTER_SANITIZE_STRING)),
            'INST_SEX'          => trim($request->getPost('inst_sex', FILTER_SANITIZE_STRING)),
            'SPECIALIZATION'    => trim($request->getPost('inst_specialization', FILTER_SANITIZE_STRING)),
            'INST_EMAIL'        => trim($request->getPost('inst_email', FILTER_SANITIZE_EMAIL)),
            'EMPLOYMENT_STATUS' => trim($request->getPost('inst_status', FILTER_SANITIZE_STRING)),
            'SAVEONLY'          => trim($request->getPost('save_only'))
        ];
    }
    
    public static function CourseInfo($request)
    {
        return [
            'SUBJ_CODE'         => trim($request->getPost('subj_code', FILTER_SANITIZE_STRING)),
            'SUBJ_DESCRIPTION'  => trim($request->getPost('subj_desc', FILTER_SANITIZE_STRING)),
            'UNIT'              => trim($request->getPost('subj_unit', FILTER_SANITIZE_STRING)),
            'CT_HR'             => trim($request->getPost('subj_cthr', FILTER_SANITIZE_STRING)),
            'PRE_REQUISITE'     => trim($request->getPost('subj_pre', FILTER_SANITIZE_STRING)),
            'LAB'               => trim($request->getPost('subj_lab', FILTER_SANITIZE_STRING)),
            'SAVEONLY'          => trim($request->getPost('save_only'))
        ];
    }
    
    public static function LevelInfo($request)
    {
        return [
            'COURSE_NAME'   => trim($request->getPost('level_name', FILTER_SANITIZE_STRING)),
            'COURSE_LEVEL'  => trim($request->getPost('level_no', FILTER_SANITIZE_STRING)),
            'COURSE_DESC'   => trim($request->getPost('level_desc', FILTER_SANITIZE_STRING)),
            'SAVEONLY'      => trim($request->getPost('save_only'))
        ];
    }
    
    public static function RoomInfo($request)
    {
        return [
            'ROOM_NAME'     => trim($request->getPost('room_name', FILTER_SANITIZE_STRING)),
            'ROOM_DESC'     => trim($request->getPost('room_desc', FILTER_SANITIZE_STRING)),
            'ROOM_STATUS'   => trim($request->getPost('room_type', FILTER_SANITIZE_STRING)),
            'IS_AVAILABLE'  => trim($request->getPost('room_availability', FILTER_SANITIZE_STRING)),
            'SAVEONLY'      => trim($request->getPost('save_only'))
        ];
    }
    
    public static function FacultyInfo($request)
    {
        return [
            'FACULTY_NAME' => trim($request->getPost('facult_name', FILTER_SANITIZE_STRING)),
            'FACULTY_DESC' => trim($request->getPost('facult_desc', FILTER_SANITIZE_STRING)),
//            'FACULTY_OFFICE' => trim($request->getPost('office_no', FILTER_SANITIZE_STRING)),
            'SAVEONLY'     => trim($request->getPost('save_only'))
        ];
    }
    
    public static function DepartmentInfo($request)
    {
        return [
            'DEPARTMENT_NAME'   => trim($request->getPost('dept_name')),
            'DEPARTMENT_DESC'   => trim($request->getPost('dept_desc')),
            'DEPT_DURATION'     => trim($request->getPost('dept_duration')),
            'FACULTY_ID'        => trim($request->getPost('faculty')),
            'SAVEONLY'          => trim($request->getPost('save_only'))
        ];
    }
    
    public static function studentGrade(string $student, iterable $courses, ?int $schoolyr) : iterable
    {
        $grades = [];
        foreach ($courses as $key => $value){
            $grades[$key] = [
                'IDNO'      => $student,
                'SSID'      => $value->STUDSUBJ_ID,
                'SYID'      => $schoolyr ?? $value->SYID,
                'FIRST'     => 0,
                'SECOND'    => 0,
                'THIRD'     => 0,
                'FOURTH'    => 0,
                'FINAL'     => 0,
                'TOTAL'     => 0,
                'GRADE'     => 'F',
                'DAY'       => gregorianDate(),
                'REMARKS'   => '',
                'COMMENT'   => '',
            ];
        }
        return $grades;
         
    }
    public static function updateStudentsGrade($request) {
        $grade_id = $request->getPost('id');
        $first = $request->getPost('first');
        $second = $request->getPost('second');
        $third = $request->getPost('third');
        $fourth = $request->getPost('fourth');
        $final = $request->getPost('final');
        $total = $request->getPost('total');
        $grade = $request->getPost('grade');
        $grades = [];
        foreach($grade_id as $key => $value){
            $grades[$key] = [
                'GRADE_ID'  => $grade_id[$key],
                'FIRST'     => $first[$key],
                'SECOND'    => $second[$key],
                'THIRD'     => $third[$key],
                'FOURTH'    => $fourth[$key],
                'FINAL'     => $final[$key],
                'TOTAL'     => $total[$key],
                'GRADE'     => $grade[$key],
                'DAY'       => gregorianDate(),
            ];
        }
        return $grades;
    }
    
    public static function uploadStudentsGrade($request) {
        $grade_id = $request->getPost('id');
//        $first = $request->getPost('first');
//        $second = $request->getPost('second');
//        $third = $request->getPost('third');
//        $fourth = $request->getPost('fourth');
        $assessment = $request->getPost('assessment');
        $final = $request->getPost('final');
        $total = $request->getPost('total');
        $grade = $request->getPost('grade');
        $grades = [];
        foreach($grade_id as $key => $value){
            $grades[$key] = [
                'GRADE_ID'  => $value,
//                'FIRST'     => $first[$key],
//                'SECOND'    => $second[$key],
//                'THIRD'     => $third[$key],
//                'FOURTH'    => $fourth[$key],
                'ASSESSMENT'=> $assessment[$key],
                'FINAL'     => $final[$key],
                'TOTAL'     => $total[$key],
                'GRADE'     => $grade[$key],
                'DAY'       => gregorianDate(),
            ];
        }
        return $grades;
    }
    
    public static function courseDepartment(string $department, iterable $courses, bool $is_major = true)
    {
        $crdp = [];
        foreach ($courses as $key => $course) {
            $crdp[$key] = [
                'SUBJ_CODE' => $course,
                'DEPT_NAME' => $department,
                'IS_MAJOR'  => $is_major,
            ];
        }
        return $crdp;
    }
    
    public static function getSelected($request)
    {
        return $request->getPost('selector');
    }
    
    public static function enrollCourse($request)
    {
        return [
            'SUBJ_CODE' => trim($request->getPost('subj_code')),
            'INST_ID'   => trim($request->getPost('instructor')),
            'SAVEONLY'  => trim($request->getPost('save_only'))
        ];
    }
    public static function enrollSemester($request)
    {
        return [
            'AY'            => trim($request->getPost('year')),
            'SECTION_ID'    => trim($request->getPost('section_id')),
            'COURSE_ID'     => trim($request->getPost('level')),
            'START_DATE'    => trim($request->getPost('start_date')),
            'END_DATE'      => trim($request->getPost('end_date')),
//            'CURRENT'       =>  true,
            'SEMESTER_ID'   => trim($request->getPost('semester')),
            'NO_OF_SUBJ'    => trim($request->getPost('no_of_subj')),
            'SAVEONLY'      => trim($request->getPost('save_only'))
        ];
    }
    
    public static function updateSettings($request)
    {
        return [
            [
                'SETTING_TYPE' => 'SYSTEM_NAME',
                'SETTING_DESC' => trim($request->getPost('system_name'))
            ],
            [
                'SETTING_TYPE' => 'COMPANY',
                'SETTING_DESC' => trim($request->getPost('company_name'))
            ],
            [
                'SETTING_TYPE' => 'CAMPUS',
                'SETTING_DESC' => trim($request->getPost('campus_name'))
            ],
            [
                'SETTING_TYPE' => 'ADDRESS',
                'SETTING_DESC' => trim($request->getPost('address'))
            ],
            [
                'SETTING_TYPE' => 'WEBSITE',
                'SETTING_DESC' => trim($request->getPost('website'))
            ],
            [
                'SETTING_TYPE' => 'PO_BOX',
                'SETTING_DESC' => trim($request->getPost('pobox'))
            ],
            [
                'SETTING_TYPE' => 'SIDE_NAV',
                'SETTING_DESC' => trim($request->getPost('sidenav'))
            ],
            [
                'SETTING_TYPE' => 'TOP_NAV',
                'SETTING_DESC' => trim($request->getPost('topnav'))
            ],
        ];
    }
    
    public static function updateEnrollmentsRoom($enroll, $room)
    {
        $output = [];
        foreach ($enroll as $key => $value){
            $output[$key] = [
                'STUDSUBJ_ID' => $value->STUDSUBJ_ID,
                'ROOM' => $room->ROOM_NAME
            ];
        
        }
        return $output;
    }
    
    public static function List($data,$column)
    {
        $list = [];
        foreach ($data as $value) {
            $key = (string)$value->$column;
            $list[$key] = '';
        }
        return $list;
    }
}
