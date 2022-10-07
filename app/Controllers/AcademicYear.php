<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Messages\Messages;
class AcademicYear extends BaseController
{
    public function index()
    {
        if(session()->has('user') && session()->get('user_role') == UserRole::REGIST()){
            // create new academic year
            $ay = System::createAcademicYear();
            
            $data = [
                'page' => 'academic-year',
                'title' => 'Academic Years',
                'ays' => $ay->findAll()     // find all academic years
            ];
            // display academic year list
            return view('/registrar/academic_years/academic_years_list', $data);
        } else {
            return Messages::errorPageNotFound();   // display error message
        }
    }
}
