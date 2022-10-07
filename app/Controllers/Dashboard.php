<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->has('user')):
            // create new user with profile
            $user = System::createUser();
            $photo = System::createPhoto();
            $student = System::createStudentInfo();
            $instructor = System::createInstructor();
            $department = System::createDepartment();
            $room = System::createRoom();
            
            $userID = session()->get('user');
            $userInfo = $user->find($userID);
            $data = [
                'page'          => 'dashboard',
                'title'         => 'Dashboard',
                'profile'       => $photo->where('USER_ID', $userID)->first() ?? NULL,
                'user'          => $userInfo,
                'students'      => $student->countAllResults(),
                'instructors'   => $instructor->countAllResults(),
                'departments'   => $department->countAllResults(),
                'rooms'         => $room->countAllResults(),
            ];
//            print_r(session()->get('sidenav'));
//            die();
//            echo '<pre>';
//            print_r($data);
//            die();
            switch (session()->get('user_role')) {
                case UserRole::ADMIN():                         // in case of admin goto admin dashboard
                    return view('admin/dashboard',$data);
//                    break;
                case UserRole::REGIST():                        // in case of admin goto registrar dashboard
                    return view('registrar/dashboard',$data);
//                    break;
                case UserRole::INST():                          // in case of admin goto instructor dashboard
                    return view('instructor/dashboard',$data);
//                    break;
                case UserRole::STUDENT():
                    return view('student/dashboard',$data);
//                    break;
                default:                                        
                    return view('auth/login');
//                    break;
            }
//            return view('admin/dashboard',$data);
        endif;
        return view('auth/login');
    }
    
}
