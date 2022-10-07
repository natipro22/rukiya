<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\System;

class StudentModel extends Model
{
    public $userInfo;
    public $studentInfo;
    public $studentDetail;
    public $studentRequirment;
    
    public function __construct($studentInfo, $studentDetail, $studentReqirment, $userInfo = null)
    {
        parent::__construct();
        $this->studentInfo = $studentInfo;
        $this->studentDetail = $studentDetail;
        $this->studentRequirment = $studentReqirment;
        $this->userInfo = $userInfo;
    }
    
    
    function insertStudent(iterable $studentInfo, iterable $studentDetails, iterable $studentRequirments, ?iterable $userInfo = null): bool 
    {   
        // begin the transaction
        $this->db->transStart();
        $this->userInfo->insert($userInfo);
        $studentInfo['USER_ID'] = $this->userInfo->getInsertID();
        $this->studentInfo->insert($studentInfo);
        $this->studentDetail->insert($studentDetails);
        $this->studentRequirment->insert($studentRequirments);
        $this->db->transComplete();
        
        // if the transaction is fail return false else return true.
        return ($this->db->transStatus === false ? false : true);
    }
    
    function updateStudent(iterable $studentInfo, iterable $studentDetails, iterable $studentRequirments, ?iterable $userInfo = null) : bool
    {
        // begin the transaction
        $this->db->transStart();
//        $student->whereIn('IDNO',$students)->set('SECTION_ID', decrypt_url($section_id))->update();
        if($userInfo['ACCOUNT_ID'] == ''){
            $this->userInfo->insert($userInfo);
            $studentInfo['USER_ID'] = $this->userInfo->getInsertID();
        }else{
            $this->userInfo->where('ACCOUNT_USERNAME',$userInfo['ACCOUNT_USERNAME'])->set($userInfo)->update();
        }
        
        $this->studentInfo->where('IDNO',$studentInfo['IDNO'])->set($studentInfo)->update();
        $this->studentDetail->where('IDNO',$studentDetails['IDNO'])->set($studentDetails)->update();
        $this->studentRequirment->where('IDNO',$studentRequirments['IDNO'])->set($studentRequirments)->update();
        
        $this->db->transComplete();
        
        // if the transaction failS return false else return true.
        return ($this->db->transStatus === false ? false : true);
    }
    
    function getStudentById(string $student_id)
    {
        return $this->db->table('tblstudent st')
                    ->join('tblstuddetails dt', 'st.IDNO = dt.IDNO')
                    ->join('tblrequirements rq', 'st.IDNO = rq.IDNO')
                    ->where('st.IDNO', $student_id)
                    ->get()->getRow();
                
    }
    
    function uploadStudents(iterable $studentInfo, iterable $studentDetail, iterable $studentReq, ?iterable $userInfo = null) : bool
    {
        $this->db->transStart();
        $this->studentInfo->insertBatch($studentInfo);
        $this->studentDetail->insertBatch($studentDetail);
        $this->studentRequirment->insertBatch($studentReq);
//        $this->userInfo->insertBatch($userInfo);
        $this->db->transComplete();
        
        return ($this->db->transStatus === false ? false : true);
    }
    
    public function manageInput($students)
    {
        $enumInfo = ['IDNO', 'FULLNAME', 'SEX', 'BDAY', 'DEPARTMENT', 'PROGRAM'];
        $enumDetail = [];
        $enumReq = ['G10_VAL', 'G10_YEAR', 'G12_VAL', 'G12_YEAR'];
        $enumUser = [];
        $st1 = $st2 = $st3 = $user = $student = [];

        if ($students) {
            foreach ($students as $skey => $svalue) {
                $student[$skey] = explode(',', $svalue);    // split the string 
                $student[$skey] = array_chunk($student[$skey], 6);  // split the array in to two

                $stInfo[$skey] = $student[$skey][0];
                $stReq[$skey] = $student[$skey][1];

                foreach ($stInfo[$skey] as $key => $value) {
                    if ($enumInfo[$key] == 'FULLNAME') {
                        $FULLNAME = preg_split("/[ ]+/", $value);
                        $st1[$skey]['FNAME'] = $FULLNAME[0];
                        $st1[$skey]['MNAME'] = $FULLNAME[1];
                        $st1[$skey]['LNAME'] = $FULLNAME[2];
                    } else {
                        $st1[$skey][$enumInfo[$key]] = $enumInfo[$key] == 'BDAY' ? gregorianDate($value) : $value;
                        
                        if ($enumInfo[$key] == 'IDNO') {
                            $st2[$skey][$enumInfo[$key]] = $value;
                            $st3[$skey][$enumInfo[$key]] = $value;
                        }
                    }
                }
                foreach ($stReq[$skey] as $key => $value) {
                    $st3[$skey][$enumReq[$key]] = $value;
                }
            }
            return [$st1, $st2, $st3];
        }
        return false;
    }
    
    function deleteSelected($selected)
    {
        $this->db->transStart();
        $user = $this->studentInfo->whereIn('IDNO',$selected)->findColumn('USER_ID');
        $this->studentInfo->whereIn('IDNO', $selected)->delete();
        $this->studentDetail->whereIn('IDNO', $selected)->delete();
        $this->studentRequirment->whereIn('IDNO', $selected)->delete();
        $this->userInfo->whereIn('ACCOUNT_ID',$user)->delete();
        $this->db->transComplete();
        
        return ($this->db->transStatus === false ? false : true);
    }
}
