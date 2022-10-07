<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UserRole;
use App\Libraries\System;
use App\Libraries\Validation;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;


class Room extends BaseController
{
    public function index()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get'):
            $room = System::createRoom();
            
            $data = [
                'page' => 'room',
                'title' => 'Rooms',
                'rooms' => $room->findAll()
            ];
            return view('/registrar/rooms/rooms_list', $data);        
        endif;
    }
    
    public function newRoom()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'get')
        {
            $data = [
                'page' => 'room',
                'title' => 'New Room',
            ];
            return view('registrar/rooms/add_room', $data);
        }
    }
    
    public function addRoom()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post'){
            // validate every input first
            $validation = $this->validate(Validation::addRoomRules(), Validation::addRoomMessages());

            if(!$validation){
                return Messages::validationErrorsWithInput($this->validator);
            }
            // get the section info from the request
            $roomInfo = RequestVars::RoomInfo($this->request);
            
            // prepare for insetion
            $room = System::createRoom();
            
            // insert the data to database
            $status = $room->insert($roomInfo);
            return ! empty($roomInfo['SAVEONLY'])
                   ? Messages::checkInsertionAndRedirect($status, 'rooms', 'Room') 
                   : Messages::checkInsertionAndRedirect($status, 'rooms/new-room', 'Room');
        }
    }
    
    public function deleteRoom()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post')
        {
            // get the selected faculties
            $rooms = RequestVars::getSelected($this->request);

            // if nothing is selected display error message
            if(empty($rooms)){
                return Messages::errorNoThingSelected();
            }

            // delete the selected faculties
            $room = System::createRoom();
            $status = $room->whereIn('ROOM_ID', $rooms)->delete();

            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'rooms', 'Room(s)'); 
        }
    }
}
