<?php

namespace App\Libraries\Spreadsheet;
use App\Libraries\System;
/**
 * Description of UploadStudentsGrade
 *
 * @author Mohammed
 */
class UploadStudentsGrade extends UploadedXlsx {
    
    public function __construct($file) 
    {
        parent::__construct($file);
//        $this->excel = $file;
    }
    
    public function searchForRequiredData()
    {
//        $department  = new \App\Models\DepartmentModel();
//        $program = new \App\Models\ProgramModel();
        $department = System::createDepartment();
        $program = System::createProgram();
//        $checkedData = '';
        $checkedData = $data = [
            'ID NO'     => '(id)(\s)+((no)|(number))',
            'First'     => '15%',
            'Second'    => '15%',
            'Third'     => '10%',
            'Assessment_key'    => '(25%)|(20%)|(10%)|(15%)|(5%)',
            'Assessment' => [],
            'Final'     => 'final',
            'Total'     => 'total',
            'Grade'     => 'grade',
        ];
//        echo $data['Grade'];
        $worksheet = $this->getActiveSheet();
        $count = 0;
        $flag = false;
        foreach ($worksheet->getRowIterator() as $row) {
            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(TRUE);
            
            foreach ($cellIterator as $cell) {
                    
                    $this->checkValue($checkedData, $cell, $count, $flag);
//                    echo $cell->getFormattedValue().'<br>'; 
                }
                
        }
        $checkedData['Assessment_key'] = '';
//        echo '<pre>';
//                print_r($checkedData);
////                print_r($data);
//                die();
        $missed = $this->missedComponets($data, $checkedData);
//        echo $missed;
//        die();
//        if(empty($missed)){
//            return $checkedData;
//        }else{
//            return $missed;
//        }
        return (empty($missed) ? $checkedData : $missed);
    }
    
    public function checkValue(&$data, $cell, &$count,&$flag)
    {
        
        // foreach field in the data
        foreach ($data as $field => $fval) {
            if(is_array($fval)){
                foreach ($fval as $key => $value) {
                    if(preg_match("/{$value}/i", $cell->getCalculatedValue())){
                        $data[$field] = $value;
                    }
                }
            }
            else{
                
                if(preg_match("/{$fval}/i", $cell->getFormattedValue())){
//                    echo $cell->getCalculatedValue();$fval
//                    $flag = false;
//                    if(array_search($fval, $data,true) === false){
//                        $data[$field] = $cell->getCoordinate();
////                        continue;
//                    }else {
//                        continue;
//                    }
                    if($field == 'Assessment_key' && $count < 5){
//                        echo "<pre>";
                        $data['Assessment'][$count++] = $cell->getCoordinate();
//                        print_r($data);
//                        die();
                        continue;
                    }
                    if(($field == 'Second' || $field == 'Fourth' || $field == 'Total') && $flag == false){
                        $flag = true;
                        continue;
                    }else if(($field == 'Third' || $field == 'First') && $flag == true){
                        $flag = false;
                    }
                    $data[$field] = $cell->getCoordinate();
                    
                }
            }
        }
        
//        return $data;
    }
    
    public function missedComponets($original_data, $checked_data)
    {
        $missedComponets = "";
        foreach ($original_data as $key => $value) {
            if($value == $checked_data[$key]) {
                $missedComponets .= $key . ", ";
            }
        }
        return rtrim($missedComponets,", ");
    }
    
    public function fetchAll($data,$input)
    {
        $worksheet  = $this->getActiveSheet();
        $lastRow    = $worksheet->getHighestRow();
        $output     = [];
        [$inst_id, $course_id, $section_id] = array_pad($input, 3, null);
        $studentsGrade = System::createQuery();
        
        $grades = $studentsGrade->instructorStudentsID($inst_id, $course_id, $section_id);
//        $grade_ids = $studentsGrade->instructorStudents($inst_id, $course_id, $section_id);
        
        [$first, $second, $third, $fourth, $fifth] = array_pad($data['Assessment'], 5, null);
//        echo $fifth.'-';
//        die();
        $idnoCoordinate         = is_null($data['ID NO']) ? null : $this->getColumnAndRow($data['ID NO']);
        $firstCoordinate        = is_null($first) ? null : $this->getColumnAndRow($first);
        $secondCoordinate       = is_null($second) ? null : $this->getColumnAndRow($second);
        $thirdCoordinate        = is_null($third) ? null : $this->getColumnAndRow($third);
        $fourthCoordinate       = is_null($fourth) ? null : $this->getColumnAndRow($fourth);
        $fifthCoordinate        = is_null($fifth) ? null : $this->getColumnAndRow($fifth);
//        $assessmentCoordinate   = $this->getColumnAndRow($data['Assessment_val']);
        $finalCoordinate        = is_null($data['Final']) ? null : $this->getColumnAndRow($data['Final']);
        $totalCoordinate        = is_null($data['Total']) ? null : $this->getColumnAndRow($data['Total']);
        $gradeCoordinate        = is_null($data['Grade']) ? null : $this->getColumnAndRow($data['Grade']);
//        echo '<pre>';
//        print_r($idnoCoordinate).'<br>';
//        print_r($firstCoordinate).'<br>';
//        print_r($secondCoordinate).'<br>';
//        print_r($thirdCoordinate).'<br>';
//        print_r($fourthCoordinate).'<br>';
//        print_r($finalCoordinate).'<br>';
//        print_r($totalCoordinate).'<br>';
//        print_r($gradeCoordinate);
        
//        $department               = $data['Department'];
//        $program                  = $data['Program'];
        $count = 0;
        for($row = $idnoCoordinate['row']+1; $row <= $lastRow; $row++){
            
            $idno           = is_null($idnoCoordinate)   ? null : $worksheet->getCell($idnoCoordinate['col'].$row)->getValue();
            $first          = is_null($firstCoordinate)  ? null : $worksheet->getCell($firstCoordinate['col'].$row)->getValue();
            $second         = is_null($secondCoordinate) ? null : $worksheet->getCell($secondCoordinate['col'].$row)->getValue();
            $third          = is_null($thirdCoordinate)  ? null : $worksheet->getCell($thirdCoordinate['col'].$row)->getValue();
            $fourth         = is_null($fourthCoordinate) ? null : $worksheet->getCell($fourthCoordinate['col'].$row)->getValue();
            $fifth          = is_null($fifthCoordinate)  ? null : $worksheet->getCell($fifthCoordinate['col'].$row)->getValue();
            $final          = is_null($finalCoordinate)  ? null : $worksheet->getCell($finalCoordinate['col'].$row)->getValue();
            $total          = is_null($totalCoordinate)  ? null : $worksheet->getCell($totalCoordinate['col'].$row)->getCalculatedValue();
            $grade          = is_null($gradeCoordinate)  ? null : $worksheet->getCell($gradeCoordinate['col'].$row)->getCalculatedValue();
            
            if(!empty($idno) && !empty($first) && !empty($second) && !empty($third) &&
               !empty($fourth) && !empty($final) && !empty($total) && !empty($grade)){
                $student    = [];
                
                helper('array');
                $id = dot_array_search('*.IDNO', $grades);

                if(array_search($idno, $id) !== false){
                    
                    $grade_id = dot_array_search('*.GRADE_ID', $grades);
                    $student['GRADE_ID'] = $grade_id[array_search($idno, $id)];
                    $student['IDNO']     = $idno;
                    $student['FIRST']    = $first;
                    $student['SECOND']   = $second;
                    $student['THIRD']    = $third;
                    $student['FOURTH']   = $fourth;
                    $student['FIFTH']    = $fifth;
                    $student['FINAL']    = $final;
                    $student['TOTAL']    = $total;
                    $student['GRADE']    = $grade;
                    
                    $output[$count++] = $student;
                    
                }
                
            }
        }
        
        return $output;
    }
    
    public function getColumnAndRow($cellCoordinate)
    {
        $rowAndCol = preg_split('#(?<=[a-z])(?=\d)#i', $cellCoordinate);
        $output = [
            'col' => $rowAndCol[0], 
            'row' => $rowAndCol[1]
        ];
        return $output;
    }
}
