<?php
namespace App\Libraries;

use App\Libraries\UserRole;
/**
 * Description of ValidationRules
 *
 * @author Mohammed
 */
class Validation {
    
    public static function studentRegistrationRules() 
    {
        $validationRules = [
            'id_no' => [
                'label' => 'ID',
                'rules' => 'exact_length[7,15,16]|is_unique[tblstudent.IDNO]|permit_empty'
            ],
            'fname' => [
                'label' => 'First name',
                'rules' => 'required|alpha|min_length[3]|max_length[15]'
            ],
            'mname' => [
                'label' => 'Father name',
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]'
            ],
            'lname' => [
                'label' => 'Grand father name',
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]'
            ],
            'gender' => [
                'label' => 'Gender',
                'rules' => 'required|alpha|max_length[1]'
            ],
            'bday' => [
                'label' => 'Birth Date',
                'rules' => 'required|valid_date'
            ],
            'bplace' => [
                'label' => 'Birth Place',
                'rules' => 'required|string'
            ],
            'contact' => [
                'label' => 'Phone Number',
                'rules' => 'required|numeric|min_length[10]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tblstudent.EMAIL]'
            ],
            'dept' => [
                'label' => 'Department',
                'rules' => 'required|is_not_unique[department.DEPARTMENT_NAME]'
            ],
            'program' => [
                'label' => 'Program',
                'rules' => 'required|is_not_unique[program.PROGRAM_NAME]'
            ],
            'home_address' => [
                'label' => 'Home Address',
                'rules' => 'required|alpha_numeric_space'
            ],
            'f_name' => [
                'label' => 'Father Detail',
                'rules' => 'required|alpha_space|matches[mname]|permit_empty|min_length[3]|max_length[15]'
            ],
            'f_occu' => [
                'label' => 'Father Detail',
                'rules' => 'required|alpha|min_length[3]'
            ],
            'm_name' => [
                'label' => 'Mother Detail',
                'rules' => 'required|alpha|min_length[3]'
            ],
            'm_occu' => [
                'label' => 'Mother Detail',
                'rules' => 'required|alpha|min_length[3]'
            ],
            'g_name' => [
                'label' => 'Guardian Detail',
                'rules' => 'required|alpha|min_length[3]'
            ],
            'g_address' => [
                'label' => 'Guardian Address',
                'rules' => 'required|alpha_numeric_space|min_length[3]'
            ],
            'g_10_sc' => [
                'label' => 'grade 10 school name',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_10_res' => [
                'label' => 'grade 10 result',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_10_yr' => [
                'label' => 'grade 10 result',
                'rules' => 'required|string|exact_length[4]'
            ],
            'g_12_sc' => [
                'label' => 'grade 12 school name',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_12_res' => [
                'label' => 'grade 12 result',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_12_yr' => [
                'label' => 'grade 12 year',
                'rules' => 'required|string|exact_length[4]'
            ],
            'tvet_clg' => [
                'label' => 'TVET school name',
                'rules' => 'required_with[tvet_res,tvet_yr]|string|permit_empty'
            ],
            'tvet_res' => [
                'label' => 'TVET result',
                'rules' => 'required_with[tvet_clg,tvet_yr]|string|permit_empty'
            ],
            'tvet_yr' => [
                'label' => 'TVET year',
                'rules' => 'required_with[tvet_clg,tvet_res]|string|permit_empty'
            ],
            'tvet_level_clg' => [
                'label' => 'TVET Level school name',
                'rules' => 'required_with[tvet_level_res,tvet_level_yr]|string|permit_empty'
            ],
            'tvet_level_res' => [
                'label' => 'TVET Level result',
                'rules' => 'required_with[tvet_level_clg,tvet_level_yr]|string|permit_empty'
            ],
            'tvet_level_yr' => [
                'label' => 'TVET Level year',
                'rules' => 'required_with[tvet_level_clg,tvet_level_res]|string|permit_empty|valid_date'
            ],
            'uni_clg' => [
                'label' => 'College/University Name',
                'rules' => 'required_with[uni_clg_res,uni_clg_yr]|string|permit_empty'
            ],
            'uni_clg_res' => [
                'label' => 'College/University Result',
                'rules' => 'required_with[uni_clg,uni_clg_yr]|string|permit_empty'
            ],
            'uni_clg_yr' => [
                'label' => 'College/University year',
                'rules' => 'required_with[uni_clg,uni_clg_res]|string|permit_empty|valid_date'
            ],
        ];
        return $validationRules;
    }
    
    public static function studentUpdateRegistrationRules($request = null)
    {
        $validationRules = [
            'id_no' => [
                'label' => 'ID #',
                'rules' => 'min_length[15]|is_unique[tblstudent.IDNO,IDNO,'.$request->getPost('id_no').']'
            ],
            'fname' => [
                'label' => 'First name',
                'rules' => 'required|alpha|min_length[3]|max_length[15]'
            ],
            'mname' => [
                'label' => 'Father name',
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]'
            ],
            'lname' => [
                'label' => 'Grand father name',
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]'
            ],
            'gender' => [
                'label' => 'Gender',
                'rules' => 'required|alpha|max_length[1]|in_list[M,F,O]'
            ],
            'bday' => [
                'label' => 'Birth Date',
                'rules' => 'required|valid_date'
            ],
            'bplace' => [
                'label' => 'Birth Place',
                'rules' => 'required|string'
            ],
            'contact' => [
                'label' => 'Phone Number',
                'rules' => 'required|numeric|min_length[10]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[useraccounts.ACCOUNT_USERNAME,ACCOUNT_USERNAME,'.$request->getPost('email').']'
            ],
//            'email' => [
//                'label' => 'Email',
//                'rules' => 'required|valid_email|is_unique[useraccounts.ACCOUNT_USERNAME, ACCOUNT_USERNAME, '.$request->getPost('email').']'
//            ],
            'dept' => [
                'label' => 'Department',   
                'rules' => 'required|is_not_unique[department.DEPARTMENT_NAME]'
            ],
            'program' => [
                'label' => 'Program',
                'rules' => 'required|is_not_unique[program.PROGRAM_NAME]'
            ],
            'home_address' => [
                'label' => 'Home Address',
                'rules' => 'required|string'
            ],
            'f_name' => [
                'label' => 'Father Detail',
                'rules' => 'required_without[mname]|matches[mname]|alpha_space|min_length[3]|max_length[15]'
            ],
            'f_occu' => [
                'label' => 'Father Detail',
                'rules' => 'required|alpha_space|min_length[3]'
            ],
            'm_name' => [
                'label' => 'Mother Detail',
                'rules' => 'required|alpha|min_length[3]'
            ],
            'm_occu' => [
                'label' => 'Mother Detail',
                'rules' => 'required|alpha_space|min_length[3]'
            ],
            'g_name' => [
                'label' => 'Guardian Detail',
                'rules' => 'required|alpha_space|min_length[3]'
            ],
            'g_address' => [
                'label' => 'Guardian Address',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_10_sc' => [
                'label' => 'grade 10 school name',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_10_res' => [
                'label' => 'grade 10 result',
                'rules' => 'required|string|max_length[4]'
            ],
            'g_10_yr' => [
                'label' => 'grade 10 result',
                'rules' => 'required|string|exact_length[4]'
            ],
            'g_12_sc' => [
                'label' => 'grade 12 school name',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_12_res' => [
                'label' => 'grade 12 result',
                'rules' => 'required|string|min_length[3]'
            ],
            'g_12_yr' => [
                'label' => 'grade 12 year',
                'rules' => 'required|string|exact_length[4]'
            ],
            'tvet_clg' => [
                'label' => 'TVET school name',
                'rules' => 'required_with[tvet_res,tvet_yr]|string|permit_empty'
            ],
            'tvet_res' => [
                'label' => 'TVET result',
                'rules' => 'required_with[tvet_clg,tvet_yr]|string|permit_empty'
            ],
            'tvet_yr' => [
                'label' => 'TVET year',
                'rules' => 'required_with[tvet_clg,tvet_res]|string|permit_empty'
            ],
            'tvet_level_clg' => [
                'label' => 'TVET Level school name',
                'rules' => 'required_with[tvet_level_res,tvet_level_yr]|string|permit_empty'
            ],
            'tvet_level_res' => [
                'label' => 'TVET Level result',
                'rules' => 'required_with[tvet_level_clg,tvet_level_yr]|string|permit_empty'
            ],
            'tvet_level_yr' => [
                'label' => 'TVET Level year',
                'rules' => 'required_with[tvet_level_clg,tvet_level_res]|string|permit_empty|valid_date'
            ],
            'uni_clg' => [
                'label' => 'College/University Name',
                'rules' => 'required_with[uni_clg_res,uni_clg_yr]|string|permit_empty'
            ],
            'uni_clg_res' => [
                'label' => 'College/University Result',
                'rules' => 'required_with[uni_clg,uni_clg_yr]|string|permit_empty'
            ],
            'uni_clg_yr' => [
                'label' => 'College/University year',
                'rules' => 'required_with[uni_clg,uni_clg_res]|string|permit_empty|valid_date'
            ],
        ];
        return $validationRules;
    }
    
    public static function studentRegistrationMessages() 
    {
        $validationMessages = [
            'email' => [
                'is_unique' => 'This email is taken by another user.'
            ],
            'uni_clg' => [
                'required_with' => 'The College/University name field is required when '
                . 'College/University Result or College/University year is present'
            ],
            'uni_clg_res' => [
                'required_with' => 'The College/University Result field is required when '
                . 'College/University name or College/University year is present'
            ],
            'uni_clg_yr' => [
                'required_with' => 'The College/University year field is required when '
                . 'College/University name or College/University result is present'
            ],
            'tvet_level_clg' => [
                'required_with' => 'The TVET Level school name field is required when '
                . 'TVET Level result or TVET Level year is present'
            ],
            'tvet_level_res' => [
                'required_with' => 'The TVET Level result field is required when '
                . 'TVET Level school name or TVET Level year is present'
            ],
            'tvet_level_yr' => [
                'required_with' => 'The TVET Level year field is required when '
                . 'TVET Level school name or TVET Level result is present'
            ],
            'tvet_clg' => [
                'required_with' => 'The TVET school name field is required when '
                . 'TVET result or TVET year is present'
            ],
            'tvet_res' => [
                'required_with' => 'The TVET result field is required when '
                . 'TVET school name or TVET year is present'
            ],
            'tvet_yr' => [
                'required_with' => 'The TVET year field is required when '
                . 'TVET school name or TVET result is present'
            ],
            
            
        ];
        return $validationMessages;
    }
    
    public static function uploadSpreadsheetRules()
    {
        $validationRules = [
            'xlsxFile' => [
                'label' => 'Spread Sheet file',
                'rules' => 'mime_in'
                . '[xlsxFile,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]|'
                . 'ext_in[xlsxFile,xlsx,xls]|uploaded[xlsxFile]|max_size[xlsxFile,10240]'
                ],
            ];
        return $validationRules;
    }
    
    public static function uploadSpreadsheetMessages()
    {
        $validationMessages = [
            'xlsxFile' => [],
            ];
        return $validationMessages;
    }
    
    public static function userLoginRules()
    {
        $validationRules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_not_unique[useraccounts.ACCOUNT_USERNAME]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[20]'
            ]
        ];
        return $validationRules;
    }
    
    public static function userLoginMessages()
    {
        $validationMessages = [
            'email' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Enter a valid email address' ,
                        'is_not_unique' => 'This email is not registered'
                    ],
            'password' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must have atleast 5 character in length' ,
                        'max_length' => 'Password must not have more than 12 character in length'
                    ]
        ];
        return $validationMessages;
    }
    
    public static function userRegistrationRules()
    {
        $validationRules = [
            'user_name' => [
                'label' => 'User Name',
                'rules' => 'required'
            ],
            'user_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[useraccounts.ACCOUNT_NAME]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[12]'
            ],
            'cpassword' => [
                'label' => 'Confirmation password',
                'rules' => 'required|min_length[5]|max_length[12]|matches[password]'
            ],
            'role' => [
                'label' => 'User Role',
                'rules' => 'required|in_list['.UserRole::REGIST().','.UserRole::ADMIN().','.UserRole::INST().']'
            ]
        ];
        return $validationRules;
    }
    
    public static function addRoomRules()
    {
        $validationRules = [
            'room_name' => [
                'label' => 'Room Name',
                'rules' => 'required|string|is_unique[room.ROOM_NAME]'
            ],
            'room_desc' => [
                'label' => 'Room Description',
                'rules' => 'required|string'
            ],
            'room_type' => [
                'label' => 'Room Type',
                'rules' => 'required|in_list[LAB,THEORY,SEMILAB]'
            ],
            'room_availability' => [
                'label' => 'Room Availability',
                'rules' => 'required|in_list[1,0]'
            ],
        ];
        return $validationRules;
    }
    
    public static function addRoomMessages()
    {
        return [
            'room_name' => [
                'is_unique' => 'The {field} {value} already exists',
            ],
            'room_type' => [
                'in_list' => 'The {field} field must be one of Theory, Lab or Semilab'
            ],
            'room_availability' => [
                'in_list' => 'The {field} field must be one of Open or Closed'
            ],
        ];
    }
    
    public static function addCourseRules()
    {
        return [
            'subj_code' => [
                'label' => 'Course Code',
                'rules' => 'required|string|is_unique[subject.SUBJ_CODE]'
            ],
            'subj_desc' => [
                'label' => 'Course Description',
                'rules' => 'required|string'
            ],
            'subj_unit' => [
                'label' => 'Credit Hour',
                'rules' => 'required|integer|is_natural_no_zero|exact_length[1]|less_than_equal_to_field[subj_cthr]'
            ],
            'subj_cthr' => [
                'label' => 'Contact Hour',
                'rules' => 'required|integer|is_natural_no_zero|exact_length[1]|greater_than_equal_to_field[subj_unit]'
            ],
            'subj_lab' => [
                'label' => 'Lab Hour',
                'rules' => 'required|integer|is_natural|exact_length[1]|less_than_equal_to_field[subj_cthr]'
            ],
            'subj_pre' => [
                'label' => 'Prerequisite',
                'rules' => 'string|is_not_unique[subject.SUBJ_CODE]|permit_empty'
            ],
            
        ];
    }
    
    public static function editCourseRules($request = null)
    {
        return [
            'subj_code' => [
                'label' => 'Course Code',
                'rules' => 'required|string|is_unique[subject.SUBJ_CODE,SUBJ_CODE,'.$request->getPost('subj_code').']'
            ],
            'subj_desc' => [
                'label' => 'Course Description',
                'rules' => 'required|string'
            ],
            'subj_unit' => [
                'label' => 'Credit Hour',
                'rules' => 'required|integer|is_natural_no_zero|exact_length[1]|less_than_equal_to_field[subj_cthr]'
            ],
            'subj_cthr' => [
                'label' => 'Contact Hour',
                'rules' => 'required|integer|is_natural_no_zero|exact_length[1]|greater_than_equal_to_field[subj_unit]'
            ],
            'subj_lab' => [
                'label' => 'Lab Hour',
                'rules' => 'required|integer|is_natural|exact_length[1]|less_than_equal_to_field[subj_cthr]'
            ],
            'subj_pre' => [
                'label' => 'Prerequisite',
                'rules' => 'string|is_not_unique[subject.SUBJ_CODE]|permit_empty'
            ],
            
        ];
    }
    
    public static function addCourseMessages()
    {
        return [
            'subj_code' => [
                'is_unique' => 'The {field} {value} already exists'
            ],
            'subj_pre' => [
                'is_not_unique' => 'The {field} field must contain a previously existing course in the database.'
            ],
            'subj_unit' => [
                'less_than_equal_to_field' => 'The {field} field must contain a value less than or equal to {param} field value.'
            ],
            'subj_lab' => [
                'less_than_equal_to_field' => 'The {field} field must contain a value less than or equal to {param} field value.'
            ],
            'subj_cthr' => [
                'greater_than_equal_to_field' => 'The {field} field must contain a value greater than or equal to {param} field value.'
            ],
        ];
    }
    
    public static function addLevelRules()
    {
        $validationRules = [
            'level_name' => [
                'label' => 'Level Name',
                'rules' => 'required|is_unique[course.COURSE_NAME]'
            ],
            'level_desc' => [
                'label' => 'Level Description',
                'rules' => 'required|alpha_space'
            ],
            'level_no' => [
                'label' => 'Level Number',
                'rules' => 'required|is_unique[course.COURSE_LEVEL]'
            ],
        ];
        return $validationRules;
    }
    
    public static function addLevelMessages()
    {
        return [
            'level_name' => [
                'is_unique' => 'The {field} {value} already exists'
            ],
            'level_no' => [
                'is_unique' => 'The {field} {value} already exists'
            ],
        ];
    }
    
    public static function addInstructorRules()
    {
        $validationRules = [
            'inst_name' => [
                'label' => 'Instructor Full Name',
                'rules' => 'required|is_unique[instructor.INST_FULLNAME]'
            ],
            'inst_address' => [
                'label' => 'Address',
                'rules' => 'required|permit_empty|string'
            ],
            'inst_sex' => [
                'label' => 'Gender',
                'rules' => 'required|in_list[M,F,O]'
            ],
            'inst_specialization' => [
                'label' => 'Specialization',
                'rules' => 'required|string'
            ],
            'inst_status' => [
                'label' => 'Employment Status',
                'rules' => 'required|string'
            ],
            'inst_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[useraccounts.ACCOUNT_USERNAME]'
            ],
            'inst_password' => [
                'label' => 'Password',
                'rules' => 'required|string'
            ],
        ];
        return $validationRules;
    }
    
    public static function addInstructorMessages()
    {
        return [
            'inst_sex' => [
                'in_list' => 'The {field} field must be one of Male, Female or Other'
            ],
        ];
    }
    
    public static function addFacultyRules()
    {
        $validationRules = [
            'facult_name' => [
                'label' => 'Faculty Name',
                'rules' => 'required|is_unique[faculty.FACULTY_NAME]'
            ],
            'facult_desc' => [
                'label' => 'Faculty Description',
                'rules' => 'required|min_length[6]'
            ],
//            'office_no' => [
//                'label' => 'Office',
//                'rules' => 'required|min_length[6]'
//            ],
        ];
        return $validationRules;
    }
    
    public static function addFacultyMessages()
    {
        return [
            'facult_name' => [
                'is_unique' => 'The {field} {value} already exists'
            ],
        ];
    }
    
    public static function addDepartmentRules()
    {
        $validationRules = [
            'dept_name' => [
                'label' => 'Department Name',
                'rules' => 'required|is_unique[department.DEPARTMENT_NAME]'
            ],
            'dept_desc' => [
                'label' => 'Department Description',
                'rules' => 'required|min_length[6]'
            ],
            'dept_duration' => [
                'label' => 'Department Duration',
                'rules' => 'required|greater_than_equal_to[1]|less_than_equal_to[9]'
            ],
            'faculty' => [
                'label' => 'Faculty',
                'rules' => 'required|is_not_unique[faculty.FACULTY_ID]'
            ],
        ];
        return $validationRules;
    }
    
    public static function addSectionRules()
    {
        $validationRules = [
            'section_name' => [
                'label' => 'Section Name',
                'rules' => 'required|is_unique[section.SECTION_NAME]'
            ],
            'section_desc' => [
                'label' => 'Section Description',
                'rules' => 'required|min_length[6]'
            ],
            'section_year' => [
                'label' => 'Enterance Year',
                'rules' => 'required|exact_length[4]'
            ],
            'department' => [
                'label' => 'Department',
                'rules' => 'required|is_not_unique[department.DEPARTMENT_NAME]'
            ],
        ];
        return $validationRules;
    }
    
    public static function updateSectionRules($request)
    {
        $validationRules = [
            'section_name' => [
                'label' => 'Section Name',
                'rules' => 'required|is_unique[section.SECTION_NAME,SECTION_NAME,'.$request->getPost("section_name").']'
            ],
            'section_desc' => [
                'label' => 'Section Description',
                'rules' => 'required|min_length[6]'
            ],
            'section_year' => [
                'label' => 'Enterance Year',
                'rules' => 'required|exact_length[4]'
            ],
            'department' => [
                'label' => 'Department',
                'rules' => 'required|is_not_unique[department.DEPARTMENT_NAME]'
            ],
        ];
        return $validationRules;
    }
    
    public static function addDepartmentMessages()
    {
        return [
            'dept_name' => [
                'is_unique' => 'The {field} {value} already exists'
            ]
        ];
    }
    
    public static function addSectionMessages() 
    {
        return [
            'section_name' => [
                'is_unique' => 'The {field} {value} already exists'
            ],
            'department' => [
                'is_not_unique' => 'The {field} must contain a previously existing {field}'
            ]
        ];
    }
    
    public static function enrollCourseRules()
    {
        return [
            'subj_code' => [
                'label' => 'Course',
                'rules' => 'required|is_not_unique[subject.SUBJ_CODE]'
            ],
            'instructor' => [
                'label' => 'Instructor',
                'rules' => 'permit_empty|is_not_unique[instructor.INST_ID]'
            ],
        ];
    }
    
    public static function enrollSemesterRules()
    {
        return [
            'section_id' => [
                'label' => 'Section',
                'rules' => 'required|are_unique[schoolyr.SECTION_ID,level.COURSE_ID,semester.SEMESTER_ID]'
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required|is_not_unique[course.COURSE_ID]'
            ],
            'semester' => [
                'label' => 'Instructor',
                'rules' => 'required|is_not_unique[semester.SEM_ID]'
            ],
            'start_date' => [
                'label' => 'Class Start',
                'rules' => 'required|valid_date'
            ],
            'end_date' => [
                'label' => 'Class End',
                'rules' => 'required|valid_date'
            ],
            'no_of_subj' => [
                'label' => 'Number of Courses',
                'rules' => 'required|integer|greater_than[1]|less_than[9]'
            ],
        ];
    }
    public static function enrollSemesterRulesMessages() 
    {
        return [
            'section_id' => [
                        'are_unique' => 'This Enrollment already exists'
                    ]
        ];
    }
    
    public static function settingUpdateRules()
    {
        return [
            'system_name' => [
                'label' => 'System Name',
                'rules' => 'required|alpha_space'
            ],
            'company_name' => [
                'label' => 'University/College Name',
                'rules' => 'required|alpha_space'
            ],
            'campus_name' => [
                'label' => 'Campus Name',
                'rules' => 'required|alpha_space'
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'required|string'
            ],
            'website' => [
                'label' => 'Website',
                'rules' => 'alpha_numeric_punct'
            ],
            'pobox' => [
                'label' => 'PO Box',
                'rules' => 'required|numeric'
            ],
            'sidenav' => [
                'label' => 'Sidenav Type',
                'rules' => 'alpha'
            ],
            'topnav' => [
                'label' => 'Topnav Fixed',
                'rules' => 'permit_empty|alpha'
            ],
        ];
    }
    
}
