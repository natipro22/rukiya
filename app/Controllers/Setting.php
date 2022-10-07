<?php

namespace App\Controllers;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

use App\Controllers\BaseController;

class Setting extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'get') {
                $settings = System::createSetting();
                $data = [
                    'page' => 'setting',
                    'title' => 'System Settings',
                    'setting' => $settings->findColumn('SETTING_DESC'),
                ];
                // display
                return view('admin/settings/index', $data);
            }
        }
            
    }
    
    public function update()
    {
        if(checkUser(UserRole::REGIST())){
            if ($this->request->getMethod() == 'post') {
                // validate every input first
                $validation = $this->validate(Validation::settingUpdateRules());
                if (!$validation) {
                    return Messages::validationErrorsWithInput($this->validator);
                }
                $setting = RequestVars::updateSettings($this->request);
                $settings = System::createSetting();
                
                $status = $settings->updateBatch($setting,'SETTING_TYPE');
                if($status){
                    $change = [
                        'company'       => trim($this->request->getPost('company_name')),
                        'sidenav'       => trim($this->request->getPost('sidenav')),
                        'topnav'        => trim($this->request->getPost('topnav')),
                    ];
                    session()->set($change);
                }
                // check the updation
                return Messages::checkforUpdateAndRedirect($status, 'settings', 'Settings');
            }
        }
    }
}
