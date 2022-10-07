<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Libraries\System;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {
//        [
//            'user_name'     => 'required',
//            'user_email'    => 'required|valid_email|is_unique[useraccounts.ACCOUNT_NAME]',
//            'password'      => 'required|min_length[5]|max_length[12]',
//            'cpassword'     => 'required|min_length[5]|max_length[12]|matches[password]'
//        
//        ]
        // validate the input
        $validation = $this->validate(Validation::userRegistrationRules());
        
        // if the validation fail then display error
        if(!$validation){
            return view('auth/register', ['validation' => $this->validator]);
        }
        else // else
        {
//            $name       = $this->request->getPost('user_name');
//            $email      = $this->request->getPost('email');
//            $password   = $this->request->getPost('password');
//            $user_role  = $this->request->getPost('role');
//            
            // get the user input request variables
            $userInfo = RequestVars::registerUser($this->request);
            
            // prepare data for insertion
//            $values = [
//                'ACCOUNT_NAME'      => $userInput['user_name'],
//                'ACCOUNT_USERNAME'  => $userInput['email'],
//                'ACCOUNT_PASSWORD'  => Hash::makePassword($userInput['password']),
//                'ACCOUNT_TYPE'      => $userInput['user_role']
//            ];
            
            $user = System::createUser();   // create new user
            $status = $user->insert($userInfo);   // insert user data
            if(!$status){   // if the insertion fail then display error
                return redirect()->back()->withInput()->with('error', "Somethig went wrong");
            }else{  // else display success message
                return redirect()->back()->withInput()->with('success', "User inserted successfully");
            }
        }
//        return view('auth/register');
    }
    
    function login()
    {
        if($this->request->getMethod() == 'post'){
            
            // validation the user input
            $validation = $this->validate(Validation::userLoginRules(), Validation::userLoginMessages());
            if(!$validation){   // if the validation fail then display error message
                
                return redirect()->back()->withInput()  // ->with('validation', $this->validator)
                                 ->with('error', 'Incorrect Username or Password');
            }
            // get the user input
            $userInput = RequestVars::userLogin($this->request);
            // check the input
            $users = System::createUser();
            $user = $users->where('ACCOUNT_USERNAME', $userInput['email'])->first();
            $check_password = Hash::checkPassword($userInput['password'], $user->ACCOUNT_PASSWORD);

            if(!$check_password){
                // if the password doesn't match then display error message
                session()->setFlashdata('error', 'Incorrect Username or Password');
                return redirect()->to('/login')->withInput();
            }
            else{   // else create new session
                $setting = System::createSetting();
                $userSession = [
                    'user'          => $user->ACCOUNT_ID,
                    'user_name'     => $user->ACCOUNT_NAME,
                    'user_email'    => $user->ACCOUNT_USERNAME,
                    'user_role'     => $user->ACCOUNT_TYPE,
                    'company'       => $setting->where('SETTING_TYPE', 'COMPANY')->first()->SETTING_DESC,
                    'sidenav'       => $setting->where('SETTING_TYPE', 'SIDE_NAV')->first()->SETTING_DESC,
                    'topnav'        => $setting->where('SETTING_TYPE', 'TOP_NAV')->first()->SETTING_DESC,
                ];
                
                session()->set($userSession);
                
                // redirect to dashboard
                return redirect()->to('/dashboard');
            }
        }
        // 
        return view('auth/login');

    }
    
    function logout()
    {
        if(session()->has('user')){
//            session()->remove('user');
            $userSession = [
                'user',
                'user_name',
                'user_email',
                'user_role'  
            ];
            session()->remove($userSession);
            // go to the login page
            return redirect()->to('/login')->with('info','You are logged out!');
        }
    }
}

