<?php


namespace App\Libraries\Spreadsheet;
use App\Libraries\System;

/**
 * Description of registerStudents
 *
 * @author Mohammed
 */
class UploadStudentsInfo extends UploadedXlsx{
    
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
            'ID NO' => '(id)(\s)+((no)|(number))',
            'Name' => 'name',
            'Sex'  => '(sex)|(gender)',
            'Birth Date' => '((birth)(\s)+(date)(\s)*)|(bdate)(\s)*|((birth)(\s)+(day)(\s)*)|(bday)(\s)*',
            'Grade 10 Result' => '(grade )?(10 result)',
            'Grade 10 Year' => '(grade )?(10 year)',
            'Grade 12 Result' => '(grade )?(12 result)',
            'Grade 12 Year' => '(grade )?(12 year)',
            'Department' => $department->asArray()->findColumn('DEPARTMENT_NAME'),
            'Program' => $program->asArray()->findColumn('PROGRAM_NAME'),
        ];
        $worksheet = $this->getActiveSheet();
        
        foreach ($worksheet->getRowIterator() as $row) {
            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(TRUE);
            
            foreach ($cellIterator as $cell) {
                    $this->checkValue($checkedData, $cell);
                }
        }
        $missed = $this->missedComponets($data, $checkedData);
//        if(empty($missed)){
//            return $checkedData;
//        }else{
//            return $missed;
//        }
        return (empty($missed) ? $checkedData : $missed);
    }
    
    public function checkValue(&$data, $cell)
    {
        // foreach field in the data
        foreach ($data as $field => $fval) {
            if(is_array($fval)){
                foreach ($fval as $key => $value) {
                    if(preg_match("/{$value}/i", $cell->getValue())){
                        $data[$field] = $value;
                    }
                }
            }
            else{
                if(preg_match("/{$fval}/i", $cell->getValue())){
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
    
    public function fetchAll($data)
    {
        $worksheet  = $this->getActiveSheet();
        $lastRow    = $worksheet->getHighestRow();
        $output     = [];
        
        $idnoCoordinate           = $this->getColumnAndRow($data['ID NO']);
        $nameCoordinate           = $this->getColumnAndRow($data['Name']);
        $sexCoordinate            = $this->getColumnAndRow($data['Sex']);
        $bdayCoordinate           = $this->getColumnAndRow($data['Birth Date']);
        $g10resCoordinate         = $this->getColumnAndRow($data['Grade 10 Result']);
        $g10yrCoordinate          = $this->getColumnAndRow($data['Grade 10 Year']);
        $g12resCoordinate         = $this->getColumnAndRow($data['Grade 12 Result']);
        $g12yrCoordinate          = $this->getColumnAndRow($data['Grade 12 Year']);
//        $department               = $data['Department'];
//        $program                  = $data['Program'];
        $count = 0;
        for($row = $nameCoordinate['row']+1; $row <= $lastRow; $row++){
            
            $idno           = $worksheet->getCell($idnoCoordinate['col'].$row)->getValue();
            $name           = $worksheet->getCell($nameCoordinate['col'].$row)->getValue();
            $sex            = $worksheet->getCell($sexCoordinate['col'].$row)->getValue();
            $bday           = $worksheet->getCell($bdayCoordinate['col'].$row)->getFormattedValue();
            $g10res         = $worksheet->getCell($g10resCoordinate['col'].$row)->getValue();
            $g10yr          = $worksheet->getCell($g10yrCoordinate['col'].$row)->getValue();
            $g12res         = $worksheet->getCell($g12resCoordinate['col'].$row)->getValue();
            $g12yr          = $worksheet->getCell($g12yrCoordinate['col'].$row)->getValue();
            
            if(!empty($idno) && !empty($name) && !empty($sex) && !empty($bday) &&
               !empty($g10res) && !empty($g10yr) && !empty($g12res) && !empty($g12yr)){
                $student    = [];
                
                $student['IDNO']        = $idno;
                $student['FULLNAME']    = $name;
                $student['SEX']         = $sex;
                $student['BDAY']        = $bday;
                $student['G10RES']      = $g10res;
                $student['G10YR']       = $g10yr;
                $student['G12RES']      = $g12res;
                $student['G12YR']       = $g12yr;
//                $student['department']  = $department;
//                $student['program']     = $program;
                
                $output[$count++] = $student;
            }
        }
        
        return $output;
    }
    
    public function getColumnAndRow($cellCoordinate)
    {
        $rowAndCol = preg_split('#(?<=[a-z])(?=\d)#i', $cellCoordinate);
        $output = [
            'col' => strval($rowAndCol[0]), 
            'row' => $rowAndCol[1]
        ];
        return $output;
    }
}
