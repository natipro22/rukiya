<?php

namespace App\Libraries;
use App\Models;
/**
 * Description of System
 *
 * @author Mohammed
 */
class System {
    public static function createStudent()
    {
        return new Models\StudentModel(
                                        self::createStudentInfo(), 
                                        self::createStudentDetail(), 
                                        self::createStudentRequirement(),
                                        self::createUser()
                                );
    }
    
    public static function createSetting()
    {
        return new Models\SettingModel();
    }
    
    public static function createStudentInfo()
    {
        return new Models\StudentInfoModel();
    }
    
    public static function createStudentDetail()
    {
        return new Models\StudentDetailModel();
    }
    
    public static function createStudentRequirement() 
    {
        return new Models\StudentRequirementModel();
    }
    
    public static function createSection()
    {
        return new Models\SectionModel();
    }
    
    public static function createDepartment()
    {
        return new Models\DepartmentModel();
    }
    
    public static function createProgram()
    {
        return new Models\ProgramModel();
    }
    
    public static function createAcademicYear()
    {
        return new Models\AcademicYearModel();
    }
    
    public static function createGradeValue()
    {
        return new Models\GradeValueModel();
    }
//    
//    public static function createDepartmentCourses()
//    {
//        return new Models\SubjDeptModel();
//    }
    
    public static function createFaculty()
    {
        return new Models\FacultyModel();
    }
    
    public static function createInstructor()
    {
        return new Models\InstructorModel();
    }
    
    public static function createLevel()
    {
        return new Models\LevelModel();
    }
    
    public static function createMessage()
    {
        return new Models\MessageModel();
    }
    
    public static function createPhoto()
    {
        return new Models\PhotoModel();
    }
    
    public static function createRoom()
    {
        return new Models\RoomModel();
    }
    
    public static function createCourse()
    {
        return new Models\CourseModel();
    }
    
    public static function createCoursesDepartment()
    {
        return new Models\CoursesDepartmentModel();
    }
    
    public static function createUser()
    {
        return new Models\UserModel();
    }
    
    public static function uploadStudentsInfo($file)
    {
        return new Spreadsheet\UploadStudentsInfo($file);
    }
    
    public static function uploadStudentsGrade($file)
    {
        return new Spreadsheet\UploadStudentsGrade($file);
    }
    
    public static function createQuery()
    {
        return new Models\QueryModel();
    }
    
    public static function createSemester()
    {
        return new Models\SemesterModel();
    }
    
    public static function createEnrollment()
    {
        return new Models\StudentCourseModel();
    }
    
    public static function createGrade()
    {
        return new Models\GradeModel();
    }

    public static function createSchoolYear()
    {
        return new Models\SchoolyrModel();
    }
    
    public static function createReport()
    {
        return new Models\ReportModel();
    }
    
    public static function createSchedule()
    {
        return new Models\ScheduleModel();
    }
}
