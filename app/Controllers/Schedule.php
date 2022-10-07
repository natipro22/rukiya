<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\System;
use App\Libraries\UserRole;
use App\Libraries\Requests\RequestVars;
use App\Libraries\Messages\Messages;

class Schedule extends BaseController
{
    private $error;
    public function __construct() {
        $this->error = 0;
    }
    public function index()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $schedule = System::createSchedule();
                
                $data = [
                    'page' => 'schedule',
                    'title' => 'Schedules List',
                    'schedules' => $schedule->getSchedule(),
                ];
                return view('registrar/schedules/schedules_list', $data);
            }
        }
    }
    
    public function deleteSchedule()
    {
        if(checkUser(UserRole::REGIST()) && $this->request->getMethod() == 'post')
        {
            // get the selected faculties
            $schedules = RequestVars::getSelected($this->request);

            // if nothing is selected display error message
            if(empty($schedules)){
                return Messages::errorNoThingSelected();
            }

            // delete the selected faculties
            $schedule = System::createSchedule();
            $status = $schedule->whereIn('SCHEDULE_ID', $schedules)->delete();

            // check the deletion
            return Messages::checkDeletionAndRedirect($status, 'schedules', 'Schedule(s)'); 
        }
    }
    
    public function createSchedule()
    {
        if(checkUser(UserRole::REGIST())){
            if($this->request->getMethod() == 'get'){
                $schedule = System::createSchedule();
                $noOfRoomsAvailable = $schedule->availableRooms();
                
                if($noOfRoomsAvailable == 0){
                    return redirect()->back()->with('error', "There is no available room.");
                }
                
                $this->assignRoomForTheoryClass();
                $this->assignRoomForLabClass();
                $this->assignRoomForSemiLabClass();
//                die();
                $instructors = $schedule->getInstructors();
                $instructorsList = RequestVars::List($instructors, 'INST_ID');
                
//                $rooms = $schedule->getRooms();
                $rooms = System::createRoom();
                $roomsList = RequestVars::List($rooms->findAll(), 'ROOM_NAME');
                
                $sections = $schedule->getSections();
                $sectionsList = RequestVars::List($sections, 'SECTION_ID');
                
                $singleClass = '';
                
                $sectionEnroll = $schedule->getSectionEnrollments();
//                echo '<pre>';
//                print_r($sectionEnroll);
//                die();
                $schedules = [];
//                echo '<pre>';
                foreach ($sectionEnroll as $key => $enroll) {
                    $instId = (string)$enroll->INST_ID;
                    $roomId = (string)$enroll->ROOM;
                    $sectionId = (string)$enroll->SECTION_ID;
                    $labId = [$roomId];
                    
                    if($enroll->ROOM_STATUS == 'SEMILAB' && preg_match("#[_,\- ]+#", $enroll->ROOM)){
                        $labId = preg_split("#[_,\- ]+#", $enroll->ROOM);
                    }
                    
                    $days = $this->getScheduleDays($enroll->CT_HR,$instructorsList[$instId],$roomsList,$roomId,$labId,$sectionsList[$sectionId],$singleClass);
                    $instructorsList[$instId] .= $days;
                    $roomsList[$roomId] .= $days;
                    $sectionsList[$sectionId] .= $days;
//                    $schedules[$key] = RequestVars::createSchedule($days);
                    $schedules[$key] = $this->getSchedule($days, $enroll->STUDSUBJ_ID);
//                    echo '<pre>';
//                    echo $enroll->CT_HR;
//                    echo $singleClass.'*';
//                    print_r($schedules[$key]);
                }
//                echo '<pre>';
//                echo $singleClass;
//                print_r($schedules);
//                die();
                $status = $schedule->insertBatch($schedules);
                if(!$status){   // if the insertion fail then display error
                    return redirect()->back()->with('error', "Somethig went wrong. Please try again.");
                }
//                else if($this->error > 0){  // else display success message
//                    return redirect()->back()->with('info', "Completed successfully with {$this->error} error ");
//                }
                else{
                    return redirect()->back()->with('success', "Completed successfully");
                }
                
            }
        }
    }
    
    private function getSchedule($days,$enroll)
    {
        $day = str_split($days);
        $mon = $tue = $wed = $thu = $fri = $sat = '';
        foreach ($day as $d) {
            $day = ord($d);
            if($day > 64 && $day <= 72){
                 $mon .= $this->getTime($day). ' ';
             }elseif($day > 72 && $day <= 80){
                 $tue .= $this->getTime($day). ' ';
             }elseif($day > 80 && $day <= 88){
                 $wed .= $this->getTime($day). ' ';
             }elseif($day > 96 && $day <= 104){
                 $thu .= $this->getTime($day). ' ';
             }elseif($day > 104 && $day <= 112){
                 $fri .= $this->getTime($day).' ';
             }elseif($day > 112 && $day <= 116){
                 $sat .= $this->getTime($day).' ';
             }
        }
        return [
            'STUDSUBJ_ID' => $enroll,
            'MON' => $mon,
            'TUE' => $tue,
            'WED' => $wed,
            'THU' => $thu,
            'FRI' => $fri,
            'SAT' => $sat,
        ];
    }
    private function getTime($day)
    {
        if($day == 65 || $day == 73 || $day == 81 || $day == 97 || $day == 105 || $day == 113){
            return '1';
        }elseif($day == 66 || $day == 74 || $day == 82 || $day == 98 || $day == 106 || $day == 114){
            return '2';
        }elseif($day == 67 || $day == 75 || $day == 83 || $day == 99 || $day == 107 || $day == 115){
            return '3';
        }elseif($day == 68 || $day == 76 || $day == 84 || $day == 100 || $day == 108 || $day == 116){
            return '4';
        }elseif($day == 69 || $day == 77 || $day == 85 || $day == 101 || $day == 109){
            return '5';
        }elseif($day == 70 || $day == 78 || $day == 86 || $day == 102 || $day == 110){
            return '6';
        }elseif($day == 71 || $day == 79 || $day == 87 || $day == 103 || $day == 111){
            return '7';
        }elseif($day == 72 || $day == 80 || $day == 88 || $day == 104 || $day == 112){
            return '8';
        }else{
            return '';
        }    
    }
    
    private function getScheduleDays($ct_hr, $instructor, $rooms, $roomId, $labId, $section, &$singleClass)
    {
        $mon = $this->random(65, 72, $instructor, $rooms, $roomId, $labId, $section);
        $tue = $this->random(73, 80, $instructor, $rooms, $roomId, $labId, $section);
        $wed = $this->random(81, 88, $instructor, $rooms, $roomId, $labId, $section);
        $thu = $this->random(97, 104, $instructor, $rooms, $roomId, $labId, $section);
        $fri = $this->random(105, 112, $instructor, $rooms, $roomId, $labId, $section);
        $sat = $this->random(113, 116, $instructor, $rooms, $roomId, $labId, $section);
        $days = [$mon, $tue, $wed, $thu, $fri, $sat];
        shuffle($days);
        if($ct_hr % 2 == 0){
//            $day = '';
//            for($hr = 0; $hr <= (int)($ct_hr/2); $hr++){
//                $day .= $days[$hr];
//            }
            $day = $this->getDay($days, $ct_hr);
            return $day;
        } else {
            $day = '';
            $single = $this->getSingleClass($instructor, $rooms, $roomId, $labId, $section, $singleClass);
            if(!empty($single)){
                $day = $this->getDay($days, $ct_hr - 1,$single);
//                echo $day.'<br>';
                return $day.$single;
            } else {
                $day = $this->getDay($days, $ct_hr + 1);
                $singleClass = substr($day,-1);
                return substr($day, 0, $ct_hr);
            }
            
        }
        
            
    }
    private function getSpecificDay($days)
    {
        $day = str_split($days);
        if($day){
            foreach ($day as $d) {
            $day = ord($d);
            if($day > 64 && $day <= 72){
                 return 'MON';
             }elseif($day > 72 && $day <= 80){
                 return 'TUE';
             }elseif($day > 80 && $day <= 88){
                 return 'WED';
             }elseif($day > 96 && $day <= 104){
                 return 'THU';
             }elseif($day > 104 && $day <= 112){
                 return 'FRI';
             }elseif($day > 112 && $day <= 116){
                 return 'SAT';
             }else {
                 return false;
             }
            }
        }
    }
    
    private function getDay($days, $contact_hour,$single = '')
    {
        $day = '';
        for($hr = 0; $hr < ($contact_hour/2); $hr++){
            if(($hr + 1) == 6) {
//                    print_r($days);
//                    echo 'Errrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr';
                    $day .= $days[$hr]; 
                    $this->error++;
                    break;
                }
            if($days[$hr] == '' || $this->getSpecificDay($days[$hr]) == $this->getSpecificDay($single)){
//                if(($hr + 1) >= 6) {
////                    echo $this->getSpecificDay($days[$hr]);
////                    print_r($days);
////                    echo 'Errrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr';
////                    die();
//                    $day .= $days[$hr]; 
//                    $this->error++;
//                    break;
//                }
                $contact_hour += 2;
                continue;
            }
            
            $day .= $days[$hr];
        }
        return $day;
    }
    private function random($min, $max, $inst, $roomList, $roomId, $lab, $section)
    {
        $count = $num = 0;
        $instFlag = $roomFlag = $labFlag = $sectionFlag = false;
        $day = '';
        $data = range($min, $max);
        shuffle($data);
        do {
            if($count == count($data)){
                return '';
            }
            $num = $data[$count];
//            $num = rand($min, $max);
            $day = chr($num);
            
            if($num % 2 == 0){
                $instFlag = (strpos($inst, $day) !== false) || (strpos($inst, chr($num - 1)) !== false);
                $roomFlag = (strpos($roomList[$roomId], $day) !== false) || (strpos($roomList[$roomId], chr($num - 1)) !== false);
                $labFlag = (strpos($roomList[((string)$lab[0])], $day) !== false) || (strpos($roomList[((string)$lab[0])], chr($num - 1)) !== false);
                $sectionFlag = (strpos($section, $day) !== false) || (strpos($section, chr($num - 1)) !== false);
            } else {
                $instFlag = (strpos($inst, $day) !== false) || (strpos($inst, chr($num + 1)) !== false);
                $roomFlag = (strpos($roomList[$roomId], $day) !== false) || (strpos($roomList[$roomId], chr($num + 1)) !== false);
                $labFlag = (strpos($roomList[$lab[0]], $day) !== false) || (strpos($roomList[$lab[0]], chr($num + 1)) !== false);
                $sectionFlag = (strpos($section, $day) !== false) || (strpos($section, chr($num + 1)) !== false);
            }
            $count += 1;
        } while ($instFlag || $roomFlag || $labFlag || $sectionFlag );
        
        if($num % 2 == 0){
            $one = chr($num - 1);
            $two = chr($num);
            return $one.$two;
        }else{
            $one = chr($num);
            $two = chr($num + 1);
            return $one.$two;
        }
    }
    
    private function getSingleClass($inst,$roomList, $roomId, $lab,$section,&$singleClass)
    {
        if($singleClass != ''){
            $lists = str_split($singleClass);
            foreach ($lists as $list) {
                $singleFlag = (strpos($inst, $list) === false) && (strpos($roomList[$roomId], $list) === false) &&
                          (strpos($roomList[$lab[0]], $list) === false) && (strpos($section, $list) === false);
                if($singleFlag){
                    $single = $list;
                    $singleClass = preg_replace('#'.$list.'#', '', $singleClass);
                    return $single;
                }
                return '';
            }
            
        }
    }
    
    private function assignRoomForTheoryClass()
    {
        $schedule = System::createSchedule();
        $NO_theoryCourses = $schedule->getTheoryCourses()->countAllResults();
        $NO_theoryRooms = $schedule->getAvailableRooms()->countAllResults();
//        echo $NO_theoryCourses . " - ". $NO_theoryRooms.'<br>';
//        DIE();
        $average = intval($NO_theoryCourses / $NO_theoryRooms) + 1;
        $theoryRooms = $schedule->getAvailableRooms()->get()->getResult();
        foreach ($theoryRooms as $room){
            $theoryCourses = $schedule->getTheoryCourses()->get($average)->getResult();
            if($theoryCourses){
                $student_courses = System::createEnrollment();
                $enroll = RequestVars::updateEnrollmentsRoom($theoryCourses, $room);
            
                $student_courses->updateBatch($enroll, 'STUDSUBJ_ID');
            }
            
        }
//        die();
    }
    
    private function assignRoomForLabClass()
    {
        $schedule = System::createSchedule();
        $NO_labCourses = $schedule->getLabCourses()->countAllResults();
        $NO_labRooms = $schedule->getAvailableRooms('LAB')->countAllResults();
//        echo $NO_labCourses . " -- ". $NO_labRooms.'<br>';
//        die();
        $average = intval($NO_labCourses / $NO_labRooms) + 1;
        $labRooms = $schedule->getAvailableRooms('LAB')->get()->getResult();
        foreach ($labRooms as $room) {
            $labCourses = $schedule->getLabCourses()->get($average)->getResult();
            if($labCourses){
                $student_courses = System::createEnrollment();
                $enroll = RequestVars::updateEnrollmentsRoom($labCourses, $room);
                $student_courses->updateBatch($enroll, 'STUDSUBJ_ID');
            }
            
        }
        
    }
    
    private function assignRoomForSemiLabClass()
    {
        $schedule = System::createSchedule();
        $NO_semilabCourses = $schedule->getLabCourses()->countAllResults();
        $NO_semilabRooms = $schedule->getAvailableRooms('SEMILAB')->countAllResults();
//        echo $NO_semilabCourses .' --- '. $NO_semilabRooms .'<br>';
        $average = intval($NO_semilabCourses / $NO_semilabRooms) + 1;
        $labRooms = $schedule->getAvailableRooms('semilab')->get()->getResult();
        foreach ($labRooms as $room) {
            $semilabCourses = $schedule->getSemilabCourses()->get($average)->getResult();
            if($semilabCourses){ 
                $student_courses = System::createEnrollment();
                $enroll = RequestVars::updateEnrollmentsRoom($semilabCourses, $room);
                $student_courses->updateBatch($enroll, 'STUDSUBJ_ID');
            }
        }
    }
    
}
