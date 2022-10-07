<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

class Faculty extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST())):
            $facult = new \App\Models\FacultyModel();
            $data = [
                'page' => 'faculty',
                'title' => 'Faculties',
                'faculties' => $facult->findAll()
            ];
            return view('registrar/faculties/faculties_list',$data);
        else:
            return redirect()->to('/');         
        endif;
    }
    public function newFaculty()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() ==  'get'){
                $faculty = System::createFaculty();
                $data = [
                    'page' => 'faculty',
                    'title' => 'New Faculty',
                ];
                return view('registrar/faculties/add_faculty',$data);
            }
        }
    }
    
    public function addFaculty()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            
            // validate every input first
            $validation = $this->validate(Validation::addFacultyRules(), Validation::addFacultyMessages());

            if(!$validation){
                return Messages::validationErrorsWithInput($this->validator);
            }
            // get the section info from the request
            $facultyInfo = RequestVars::FacultyInfo($this->request);

            // prepare for insetion
            $faculty = System::createFaculty();
            // insert the data to database
            $status = $faculty->insert($facultyInfo);
            return ! empty($facultyInfo['SAVEONLY'])
                   ? Messages::checkInsertionAndRedirect($status, 'faculties', 'Faculty') 
                   : Messages::checkInsertionAndRedirect($status, 'faculties/new-faculties', 'Faculty');
        }
    }
    
    public function deleteFaculty()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'post'){
                // get the selected faculties
                $faculties = RequestVars::getSelected($this->request);
                
                // if nothing is selected display error message
                if(empty($faculties)){
                    return Messages::errorNoThingSelected();
                }

                // delete the selected faculties
                $faculty = System::createFaculty();
                $status = $faculty->whereIn('FACULTY_ID', $faculties)->delete();

                // check the deletion
                return Messages::checkDeletionAndRedirect($status, 'faculties', 'Faculty(s)'); 
            }
        }
    }
}
