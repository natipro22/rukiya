<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//$routes->add('/my-token', 'Home::tocken');
//$routes->get('/login', 'Auth::index');


$routes->group('',['filter' => 'AuthCheck'], function($routes){
    
    // logout page
    $routes->get('/logout', 'Auth::logout');
    
    // settings
    $routes->get('/settings/', 'Setting::index');
    $routes->post('/settings/update/', 'Setting::update');
    
    // user dashboard
    $routes->get('/dashboard','Dashboard::index');
    
    // user management
    $routes->get('/users','User::index');
    
    // department management
    $routes->get('/departments','Department::index');
    $routes->get('/departments/courses/(:segment)', 'Department::departmentCourses/$1');
    $routes->match(['get', 'post'], '/departments/assign-courses/(:segment)','Department::assignCourses/$1');
    $routes->get('/departments/new-department/','Department::newDepartment');
    $routes->post('/departments/delete-department/','Department::deleteDepartment');
    $routes->post('/departments/add-department/','Department::addDepartment');
    
    $routes->post('/departments/remove-courses/(:segment)','Department::removeCourses/$1');
    
    // faculty management
    $routes->get('/faculties','Faculty::index');
    $routes->get('/faculties/new-faculty', 'Faculty::newFaculty');
    $routes->post('/faculties/add-faculty', 'Faculty::addFaculty');
    $routes->post('/faculties/delete-faculty', 'Faculty::deleteFaculty');
    
    
    // instructor management
    $routes->get('/instructors','Instructor::index');
    $routes->match(['get', 'post'], '/instructors/loads/(:segment)','Instructor::loads/$1');
    $routes->get('/instructors/new-instructor/','Instructor::newInstructor');
    $routes->post('/instructors/add-instructor/','Instructor::addInstructor');
    $routes->post('/instructors/delete-instructor/','Instructor::deleteInstructor');
    $routes->get('/instructors/class/(:segment)/(:segment)','Instructor::classSection/$1/$2');
    $routes->match(['get', 'post'], '/instructors/class/upload-grade/(:segment)/(:segment)/(:segment)','Instructor::uploadFile/$1/$2/$3');
    $routes->post('/instructors/class-students/update-grade/(:segment)/(:segment)/(:segment)','Instructor::updateStudentsGrade/$1/$2/$3');
    $routes->post('/instructors/class-students/update-grade-excel/(:segment)/(:segment)/(:segment)','Instructor::uploadGrade/$1/$2/$3');
    $routes->match(['get', 'post'], '/instructors/class-students/(:segment)/(:segment)/(:segment)','Instructor::classStudents/$1/$2/$3');
    
    // level management
    $routes->get('/levels','Level::index');
    $routes->get('/levels/new-level','Level::newLevel');
    $routes->post('/levels/add-level','Level::addLevel');
    $routes->post('/levels/delete-level','Level::deleteLevel');
    
    // registration management
    $routes->match(['get', 'post'], '/registration','Student::index');
    $routes->match(['get', 'post'], '/registration/register/','Student::register');
    $routes->match(['get', 'post'], '/registration/upload/','Student::uploadFile');
    $routes->post('/registration/delete/','Student::deleteStudent');
//    $routes->match(['get', 'post'], '/registration/edit/(:alphanum)/(:alpha)/(:alpha)/(:num)', 'Student::editStudent/$1/$2/$3/$4');
    $routes->match(['get', 'post'], '/registration/edit-student/(:any)', 'Student::updateStudent/$1');
    
    // room management
    $routes->get('/rooms','Room::index');
    $routes->get('/rooms/new-room','Room::newRoom');
    $routes->post('/rooms/add-room','Room::addRoom');
    $routes->post('/rooms/delete-room','Room::deleteRoom');
    
    // section management
    
    $routes->get('/sections/','Section::index');
    $routes->match(['get', 'post'], '/sections/add-section/','Section::addSection');
    $routes->match(['get', 'post'], '/sections/edit-section/(:segment)','Section::updateSection/$1');
    $routes->get('/sections/download-report/(:segment)','Section::downloadReport/$1');
    $routes->get('/sections/student-enrollment/enrolled-courses/download-report/(:segment)/(:segment)','Student::downloadReport/$1/$2');
    $routes->post('/sections/delete-section/','Section::deleteSection');
    
    // section enrollments
    $routes->get('/sections/enrollments/(:segment)','Enrollment::sectionEnrollments/$1');
    $routes->match(['get', 'post'], '/sections/enrollments/enroll-semester/(:segment)', 'Enrollment::enrollSemester/$1');
    $routes->get('/sections/enrollments/(:segment)/(:segment)','Enrollment::enrolledCourses/$1/$2');
    $routes->match(['get', 'post'], '/sections/enrollments/enroll-course/(:segment)/(:segment)','Enrollment::enrollCourse/$1/$2');
    $routes->post('/sections/enrollments/delete-semester/(:segment)','Enrollment::deleteEnrolledSemester/$1');
    $routes->post('/sections/enrollments/delete-course/(:segment)/(:segment)','Enrollment::deleteEnrolledCourse/$1/$2');
    
    // student management
    
    
    $routes->match(['get', 'post'], "/sections/students/(:segment)","Student::studentsAtSection/$1");
    $routes->match(['get', 'post'], "/sections/assign-students/(:segment)","Section::assignStudents/$1");
    $routes->get("/sections/student-enrollment/(:segment)/(:segment)","StudentEnrollment::studentEnrollments/$1/$2");
    $routes->post("/sections/student-enrollment/delete-semester/(:segment)/(:segment)","StudentEnrollment::deleteStudentEnrollments/$1/$2");
    $routes->match(['get', 'post'], "/sections/student-enrollment/enroll-semester/(:segment)/(:segment)","StudentEnrollment::semestersToEnroll/$1/$2");
    $routes->get("/sections/student-enrollment/courses/(:segment)/(:segment)/(:segment)","StudentEnrollment::coursesToEnroll/$1/$2/$3");
    $routes->get("/sections/student-enrollment/enrolled-courses/(:segment)/(:segment)/(:segment)","StudentEnrollment::enrolledCourses/$1/$2/$3");
    $routes->match(['get', 'post'], "/sections/student-enrollment/add-courses/(:segment)/(:segment)/(:segment)","StudentEnrollment::addCourses/$1/$2/$3");
    $routes->post('/sections/student-enrollment/drop-courses/(:segment)/(:segment)/(:segment)','StudentEnrollment::dropCourses/$1/$2/$3');
    
    // course management
    $routes->get('/courses/','Course::index');
    $routes->get('/courses/new-course','Course::newCourse');
    $routes->post('/courses/add-course','Course::addCourse');
    $routes->match(['get','post'],'/courses/edit-course/(:segment)','Course::editCourse/$1');
    $routes->post('/courses/delete-course','Course::deleteCourse');
    
    // academic year management
    $routes->get('/academic-years/','AcademicYear::index');
    
    // schedule management
    $routes->get('/schedules/','Schedule::index');
    $routes->match(['get','post'],'/schedules/create','Schedule::createSchedule');
    $routes->post('/schedules/delete-schedule', 'Schedule::deleteSchedule');
    
    
    
    /**
     * Student User
     */
    $routes->get('/student/enrollments', 'StudentEnrollment::studentEnrollemnts');
    $routes->get('student/enrolled-courses/(:segment)', 'StudentEnrollment::studentCourses/$1');
    
});
$routes->group('',['filter' => 'AlreadyLoggedIn'], function($routes){
    
    // default page
    $routes->get('/', 'Auth::index');
    
    // login page
    $routes->match(['get', 'post'], '/login','Auth::login');
    
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
