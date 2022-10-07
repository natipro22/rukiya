<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models;
class Load extends BaseController
{
    public function index()
    {
        if(session()->has('user') && session()->get('user_role') == \App\Libraries\UserRole::INST()):
            $load = new Models\QueryModel();
            
            $data = [
                'page' => '',
                'title' => 'Instructors Load',
                'departments' => $load->instructorCourses($inst_id)
            ];
            return view('instructor/loads/loads_list', $data);
        else:
            return redirect()->to('/');         
        endif;
    }
}
