<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;

class User extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST())):
            $user = System::createUser();
//          $user = $user->findAll();
            $data = [
                'page' => 'User',
                'title' => 'Users',
                'users' => $user->findAll(),
            ];
            return view('admin/users/users_list', $data);      
        endif;
    }
    
    public function createUser(){
        return 0;
    }
    
    public function deleteUser()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                // get the selected departments
                $users = RequestVars::getSelected($this->request);
                
                // if nothing is selected display error message
                if(empty($users)){
                    return Messages::errorNoThingSelected();
                }

                // delete the selected department
                $user = System::createUser();
                $status = $user->whereIn('ACCOUNT_ID', $user)->delete();

                // check the deletion
                return Messages::checkDeletionAndRedirect($status, 'users', 'User(s)'); 
            }
        }
    }
}
