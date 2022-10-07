<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

class Level extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get'):
            $level = System::createLevel();
            
            $data = [
                'page' => 'level',
                'title' => 'Levels',
                'levels' => $level->findAll()
            ];
            return view('/registrar/levels/levels_list', $data);
        else:
            return redirect()->to('/');          
        endif;
    }
    
    public function newLevel()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get'){
            $data = [
                'page' => 'level',
                'title' => 'New Level',
            ];
            return view('registrar/levels/add_level', $data);
        }
    }
    
    public function addLevel()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            // validate every input first
            $validation = $this->validate(Validation::addLevelRules(), Validation::addLevelMessages());

            if(!$validation){
                return Messages::validationErrorsWithInput($this->validator);
            }
            // get the section info from the request
            $levelInfo = RequestVars::LevelInfo($this->request);
            
            // prepare for insetion
            $level = System::createLevel();
            
            // insert the data to database
            $status = $level->insert($levelInfo);
            return ! empty($levelInfo['SAVEONLY'])
                   ? Messages::checkInsertionAndRedirect($status, 'levels', 'Level') 
                   : Messages::checkInsertionAndRedirect($status, 'levels/new-level', 'Level');
        }
    }
    
    public function deleteLevel()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post')
        {
            // get the selected faculties
            $levels = RequestVars::getSelected($this->request);

            // if nothing is selected display error message
            if(empty($levels)){
                return Messages::errorNoThingSelected();
            }

            // delete the selected faculties
            $level = System::createLevel();
            $status = $level->whereIn('COURSE_ID', $levels)->delete();

            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'levels', 'Level(s)'); 
        }
    }
}
