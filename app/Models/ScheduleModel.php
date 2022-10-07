<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'schedule';
    protected $primaryKey       = 'SCHEDULE_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'STUDSUBJ_ID',
        'MON',
        'TUE',
        'WED',
        'THU',
        'FRI',
        'SAT'
    ];
    public function getSchedule(){
        return $this->builder()->select()
                    ->join('studentsubjects stsj', 'schedule.STUDSUBJ_ID = stsj.STUDSUBJ_ID')
                    ->join('instructor inst','inst.INST_ID = stsj.INST_ID')
                    ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                    ->join('section sc', 'sc.SECTION_ID = sy.SECTION_ID')
                    ->where('START_DATE <=', gregorianDate())
//                    ->where('END_DATE >=', gregorianDate())
                    ->get()->getResult();
    }
    public function availableRooms()
    {
        return $this->db->table('room')->where('IS_AVAILABLE', true)->countAllResults();
    }
    
    public function getTheoryRooms()
    {
        return $this->db->table('room')
                    ->select('ROOM_NAME')
                    ->where('IS_AVAILABLE',true)
                    ->where('ROOM_STATUS','THEORY');
    }
    
    public function getTheoryCourses()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.STUDSUBJ_ID')
                        ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                        ->where('stsj.ROOM', NULL)
                        ->where('sy.START_DATE <=', gregorianDate())
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sj.LAB', 0);
    }
    
    public function getLabCourses()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.STUDSUBJ_ID')
                        ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE AND sj.LAB = sj.CT_HR')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
//                        ->where('sj.LAB', 'sj.CT_HR')s
                        ->where('stsj.ROOM', NULL)
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate());
    }
    
    public function getSemilabCourses()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.STUDSUBJ_ID')
                        ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE AND sj.LAB < sj.CT_HR')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
//                        ->where('sj.LAB <', 'sj.CT_HR')
                        ->where('sj.LAB !=', 0)
                        ->where('stsj.ROOM', NULL)
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate());
    }
    
    public function getAvailableRooms($room_type = 'THEORY')
    {
        return $this->db->table('room')
                    ->select('ROOM_NAME')
                    ->where('IS_AVAILABLE',true)
                    ->where('ROOM_STATUS', strtoupper($room_type));
    }
    
    public function getCurrentCourses()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.STUDSUBJ_ID')
                        ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate())
                        ->get()->getResult();
    }
    public function getInstructors()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.INST_ID')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                        ->join('instructor inst', 'inst.INST_ID = stsj.INST_ID')
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate())
                        ->get()->getResult();
    }
    
    public function getRooms()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.ROOM')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate())
                        ->get()->getResult();
    }
    
    public function getSections()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.SECTION_ID')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate())
                        ->get()->getResult();
    }
    
    public function getSectionEnrollments()
    {
        return $this->db->table('studentsubjects stsj')
                        ->select('stsj.*, rm.ROOM_STATUS, sj.CT_HR, sj.LAB')
                        ->join('subject sj', 'sj.SUBJ_CODE = stsj.SUBJ_CODE')
                        ->join('schoolyr sy', 'sy.SYID = stsj.SYID')
                        ->join('room rm', 'rm.ROOM_NAME = stsj.ROOM')
//                        ->where('sy.END_DATE >=', gregorianDate()) // uncomment
                        ->where('sy.START_DATE <=', gregorianDate())
                        ->get()->getResult();
    }
}
