<?php

namespace App\Libraries\Report;
use PhpOffice\PhpWord\SimpleType\Jc;
use App\Libraries\System;

/**
 * Description of AcademicFinalReport
 *
 * @author Mohammed
 */
class AcademicFinalReport extends Report{
    private $report;
//    private $colorBlack = '000000';
//    private $colorWhite = 'FFFFFF';
    private $normalCol = [
        'valign' => 'center', 
        'borderTopSize' => 10, 
        'borderTopColor' => '000000', 
        'borderLeftSize' => 10,
        'borderLeftColor' => '000000',
        'borderRightSize' => 10,
        'borderRightColor' => '000000',
        'borderBottomSize' => 10,
        'borderBottomColor' => '000000'
    ];
    private $spanCol = [
        'valign' => 'bottom', 
        'gridSpan' => 5, 
        'borderTopSize' => 10,
        'borderTopColor' => '000000',
        'borderLeftSize' => 10,
        'borderLeftColor' => '000000',
        'borderRightSize' => 10,
        'borderRightColor' => '000000',
        'borderBottomSize' => 10,
        'borderBottomColor' => '000000'
    ];
    private $spanEntireCol = [
        'valign' => 'center', 
        'gridSpan' => 9, 
        'borderTopSize' => 10,
        'borderTopColor' => '000000',
        'borderLeftSize' => 10,
        'borderLeftColor' => '000000',
        'borderRightSize' => 10,
        'borderRightColor' => '000000',
        'borderBottomSize' => 10,
        'borderBottomColor' => '000000'
    ];
    
    public function __construct() {
        parent::__construct();
        $this->report = System::createReport();
    }
    
    
    
//    public function downloadReport(string $filename){
//        return $this->msWord->save($filename, 'Word2007', true);
//    }


    public function reportBanner(){
        $margin = [
            'marginTop' => 500,
            'marginLeft' => 500,
            'marginRight' => 500,
            'marginBottom' => 500
        ];
        
        $this->section = $this->msWord->addSection($margin);
	$this->section->getStyle()->setOrientation("landscape");
        
        // New Table
	$universityLogoTable = $this->section->addTable(['borderColor' => $this->colorWhite, 'borderSize' => 6]);
	
	// add a row to the Table
	$universityLogoTable->addRow();
        
        // set text style for the texts in the table
        $textStyle = [
            'name'      => 'Times new Roman', 
            'size'      => 8,
            'bold'      => true,
            'halign'    => 'center'
            ];
        // create Setting 
        $setting = \App\Libraries\System::createSetting();
        # add column to the row 
	$addressCell = $universityLogoTable->addCell(2000, ['valign' => 'center']);
	$addresstextrun = $addressCell->addTextRun(['alignment' => Jc::CENTER]);
	$addresstextrun->addText("Office of The Registrar PO.Box {$setting->where('SETTING_TYPE', 'PO_BOX')->first()->SETTING_DESC}, "
                                                                 .$setting->where('SETTING_TYPE', 'ADDRESS')->first()->SETTING_DESC , $textStyle);
        
        $universityLogoTable->addCell(2000);
        
        # add column to the row
	$logoCell = $universityLogoTable->addCell(1000, ['valign' => 'center']);
	$logoTextrun = $logoCell->addTextRun(['alignment' => Jc::RIGHT]);
	$logoTextrun->addImage(site_url('/public/assets/img/logo.png'), ['width' => 70, 'height' => 50]);
        
        $companyCell = $universityLogoTable->addCell(8000, ['valign' => 'center', 'halign'=> 'center']);
	$companyTextrun = $companyCell->addTextRun();
	$companyTextrun->addText("         ".$setting->where('SETTING_TYPE', 'COMPANY')->first()->SETTING_DESC, ['size' => 24, 'bold' => true]);
	$companyTextrun->addTextBreak();
	$companyTextrun->addText(" Student Academic Record", ['size' => 24, 'bold' => true]);
        
    }
    public function reportStudentDetails($student_id)
    {
        $studInfoTable = $this->section->addTable(['borderColor' => $this->colorWhite, 'borderSize' => 1]);
        
        # table text style
	$textStyle = ['name' => 'Times new Roman', 'size' => 10, 'bold' => false];
        
        # add row to the Table
	$studInfoTable->addRow(200, ['exactHeight' => true]);
	$borderSize = 15;
        
	# add column to the row 
	$cell = $studInfoTable->addCell(3500, ['borderTopColor' => $this->colorBlack, 'borderTopSize' => $borderSize,
                                               'borderLeftColor' => $this->colorBlack, 'borderLeftSize' => $borderSize]);
	$textrun = $cell->createTextRun();
	$textrun->addText();
        
        # add column to the row 
	$cell = $studInfoTable->addCell(4000, ['borderTopColor' => $this->colorBlack,'borderTopSize' => $borderSize, 
                                               'borderRightColor' => $this->colorBlack, 'borderRightSize' => $borderSize]);
	$textrun = $cell->createTextRun();
	$textrun->addText();
	
	# add column to the row
	$cell = $studInfoTable->addCell(3000, ['borderTopColor' => $this->colorBlack, 'borderTopSize' => $borderSize, 
                                               'borderLeftColor' => $this->colorBlack, 'borderLeftSize' => $borderSize]);
	$textrun = $cell->createTextRun();
	$textrun->addText();
        
        # add column to the row
	$cell = $studInfoTable->addCell(5000, ['borderTopColor' => $this->colorBlack, 'borderTopSize' => $borderSize, 
                                               'borderRightColor' => $this->colorBlack, 'borderRightSize' => $borderSize]);
	$textrun = $cell->createTextRun();
	$textrun->addText();
        
        $rowHeight = 300;
        $left = [
            'borderLeftColor'   => $this->colorBlack, 
            'borderLeftSize'    => $borderSize,
//            'borderBottomSize'  => 0,
            'borderTopSize'     => 0, 
//            'cellMarginTop'     => 200
        ];
        $right = [
            'borderRightColor'  => $this->colorBlack,
            'borderRightSize'   => $borderSize,
//            'borderBottomSize'  => 0,
            'borderTopSize'     => 0, 
//            'cellMarginTop'     => 200
        ];
        
        $stud = $this->report->reportStudentInfo($student_id);
        
        $studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
        
        # add column to the row 
	$cell = $studInfoTable->addCell(3500, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Medium of Instruction:", $textStyle);
        
        # add column to the row 
        $cell = $studInfoTable->addCell(4000, $right);
	$textrun = $cell->addTextRun();
	$textrun->addText("ENGLISH", $textStyle);
        
	# add column to the row
	$cell = $studInfoTable->addCell(3000, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Faculty:", $textStyle);
        
        # add column to the row
	$cell = $studInfoTable->addCell(5000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->FACULTY_NAME, $textStyle);
        
	// add new row
	$studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
	
	$cell = $studInfoTable->addCell(3500, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Name:", $textStyle);
        
        $cell = $studInfoTable->addCell(4000, $right);
	$textrun = $cell->addTextRun();
	$textrun->addText($stud->NAME, $textStyle);
        
	$cell = $studInfoTable->addCell(3000, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Department:", $textStyle);
        
        $cell = $studInfoTable->addCell(5000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->DEPARTMENT_DESC, $textStyle);
	
	$studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
	
	$cell = $studInfoTable->addCell(3500, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Grand Father's Name:", $textStyle);
        
        $cell = $studInfoTable->addCell(4000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->LNAME, $textStyle);
	
	$cell = $studInfoTable->addCell(3000, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Field Of Study:", $textStyle);
        
        $cell = $studInfoTable->addCell(5000, $right);
	$textrun = $cell->addTextRun();
	$textrun->addText($stud->DEPARTMENT_NAME, $textStyle);
        
	$studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
	
	$cell = $studInfoTable->addCell(3500, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   ID Number:", $textStyle);
        
        $cell = $studInfoTable->addCell(4000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->IDNO, $textStyle);
	
	$cell = $studInfoTable->addCell(3000, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Program Type:", $textStyle);
        
        $cell = $studInfoTable->addCell(5000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText("Degree", $textStyle);
	
	$studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
	
	$cell = $studInfoTable->addCell(3500, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Sex:", $textStyle);
        
        $cell = $studInfoTable->addCell(4000, $right);
	$textrun = $cell->addTextRun();
        
        $textrun->addText(($stud->SEX == 'F') ? 'Female' : 'Male', $textStyle);
	
	$cell = $studInfoTable->addCell(3000, $left);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Enrollment Type:", $textStyle);
        
        $cell = $studInfoTable->addCell(5000, $right);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->PROGRAM, $textStyle);
	
	$studInfoTable->addRow($rowHeight, ['exactHeight' => true]);
	
	$cell = $studInfoTable->addCell(3500, ['borderBottomColor' => $this->colorBlack, 'borderBottomSize' => $borderSize,
                                               'borderLeftColor' => $this->colorBlack, 'borderLeftSize' => $borderSize]);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Date Of Birth:", $textStyle);
        
        $cell = $studInfoTable->addCell(4000, ['borderBottomColor' => $this->colorBlack, 'borderBottomSize' => $borderSize]);
	$textrun = $cell->addTextRun();
        $textrun->addText($stud->BDAY, $textStyle);
	
        $mydate = getdate(date("U")); 
	$cell = $studInfoTable->addCell(3000, ['borderBottomColor' => $this->colorBlack,'borderBottomSize' => $borderSize,
                                               'borderLeftColor' => $this->colorBlack, 'borderLeftSize' => $borderSize]);
	$textrun = $cell->addTextRun();
	$textrun->addText("   Awarded Date:", $textStyle);
        
        $cell = $studInfoTable->addCell(5000, ['borderBottomColor' => $this->colorBlack,'borderBottomSize' => $borderSize, 
                                               'borderRightColor' => $this->colorBlack, 'borderRightSize' => $borderSize]);
	$textrun = $cell->addTextRun();
        $textrun->addText("$mydate[month] $mydate[mday], $mydate[year]", $textStyle);
	
        $this->section->addTextBreak();
    }
    
    public function reportStudentAcademicRecord($student_id)
    {
        ini_set("memory_limit", "-1");  // ignore php memory limit warnning
        // Styles for new Talble
	
        $valueStyle = ['name' => 'Times new Roman', 'size' => 10];
        
        $grade_val = System::createGradeValue();
        $major = System::createCoursesDepartment();
        // create new table
        $parentTable = $this->section->addTable(['borderColor' => $this->colorWhite,'alignment' => Jc::START,'cellMarginBottom' => 100]);
        $sumOfGP = $sumOfCRHR = $majorGP = $majorCRHR = $count_table= $current_len = $next_len = 0;
//        echo '<pre>';
        $enrolls = $this->report->reportStudentEnrollments($student_id);
//        $current_len = $this->report->rows(current($enrolls)->SYID);
//        $next_len = $this->report->rows(next($enrolls)->SYID);
//        echo '<pre>';
//        print_r($enrolls);
//        echo $current_len.'-';
//        echo $next_len;
//            die();
        
        foreach ($enrolls as $key => $enroll) {
//            echo $enrolls[$key]->SYID;
//            echo $enrolls[$key+1]->SYID;
//            die
//            $current_len = $this->report->rows($enrolls[$key]->SYID);
            if(count($enrolls) > 1){
//            global $next_len;
//            $next_len = $this->report->rows($enrolls[$key+1]->SYID);
//            echo $next_len;
//            die();
            }
            $len = $current_len;
            $count_table = $count_table + 1;
            $courses = $this->report->reportSectionCourses($enroll->SECTION_ID, $enroll->SYID);
//            print_r($courses);
//            die();
            if(($count_table % 2) != 0)
            {
                $parentTable->addRow(0,['cantSplit' => true]);
                $len = max($current_len,$next_len);
//                echo $len;
                if($count_table == 3){
//                    echo '<pre>';
//                    echo $len.'len-';
//                    echo $current_len.'crr-';
//                    echo $next_len.'nxt-';
//                    die();
                }
                
                
//                $childTable->addRow((300 * $len)/$current_len);
            }
            $parentCell = $parentTable->addCell(8000);
            // add new table inside the parent table	
            $childTable = $parentCell->addTable(['borderColor' => $this->colorWhite]);
            $childTable->addRow();
            $childCell = $childTable->addCell(1500, $this->spanEntireCol);
            $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
            $childText->addText("Academic Year: ". academicYear($enroll->START_DATE, $enroll->END_DATE));
            helper('number');
            $childText->addText(" Semester: ". number_to_roman($enroll->SEMESTER_ID));
            // add head row to the table
            $this->tableHeader($childTable);
//            die();
            $gradePoint = $totalPoint = $total_crhr = $majorPoint = $major_total_point = $major_crhr = 0;
//            print_r($courses);
//            die();
            foreach ($courses as $cr) {
               
                $grade = $this->report->reportStudentCourse($student_id, $cr->STUDSUBJ_ID);
                
                $gradePoint = $cr->UNIT * $grade_val->where('GRADE', $grade->GRADE)->first()->VAL;
                
                $is_major = $major->where('SUBJ_CODE', $cr->SUBJ_CODE)
                                  ->where('DEPT_NAME', $enroll->DEPARTMENT)
                                  ->where('IS_MAJOR', true)
                                  ->countAllResults();
//                echo $len;
//                die();
                if($current_len == $len && strlen($cr->SUBJ_DESCRIPTION) > 20){
                    $childTable->addRow(400 * 2, ['exactHeight' => true]);
//                    $childTable->addRow(((300 * $len) / $current_len),['exactHeight' => true]);
                }else if($current_len == $len && strlen($cr->SUBJ_DESCRIPTION) <= 20){
                    $childTable->addRow(400, ['exactHeight' => true]);
                }else{
                    $childTable->addRow( ((400 * $len) / count($courses)), ['exactHeight' => true]);
//                    $childTable->addRow(((400 * $len) + ($len * 50) / count($courses) ), ['exactHeight' => true]);
                }
//                $childTable->addRow();
                
                $childCell = $childTable->addCell(1500, $this->normalCol);
                $childText = $childCell->addTextRun(['alignment' => Jc::START]);
                $childText->addText($cr->SUBJ_CODE);

                $childCell = $childTable->addCell(4500, $this->spanCol);
                $childText = $childCell->addTextRun(['alignment' => Jc::START]);
                $childText->addText($cr->SUBJ_DESCRIPTION);

                $childCell = $childTable->addCell(500, $this->normalCol);
                $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
                $childText->addText($cr->UNIT);

                $childCell = $childTable->addCell(500, $this->normalCol);
                $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
                $childText->addText($grade->GRADE);

                $childCell = $childTable->addCell(500, $this->normalCol);
                $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
                $childText->addText($gradePoint, $valueStyle);
                
                $totalPoint += $gradePoint;
                $total_crhr += $cr->UNIT; 
                if($is_major):
                    $majorPoint = $cr->UNIT * $grade_val->where('GRADE', $grade->GRADE)->first()->VAL;
                    $major_total_point += $gradePoint;
                    $major_crhr += $cr->UNIT;
                endif;
                
            }
            $sumOfGP    += $totalPoint;
            $sumOfCRHR  += $total_crhr;
            $majorCRHR  += $major_crhr;
            $majorGP    += $major_total_point;
            
            
            
            $GPA = "SEMESTER GPA : ".@number_format($totalPoint/$total_crhr,2)
                  ."                                      ".
                   "CUMULATIVE GPA: ".@number_format($sumOfGP/$sumOfCRHR,2);
           $this->tableFooter($childTable, $GPA, $total_crhr, $totalPoint);
            
        }
        $this->section->addTextBreak();
        
        $this->tableMajor($majorCRHR, $majorGP);
//        $this->tableMajor($major_crhr, $major_total_point);
    }
    
    public function reportFooter(){
        
        $footer = $this->section->addFooter();
	
	$note = $footer->addTextRun(['alignment' => Jc::CENTER]);
	$note->addText("Grading System A=Excellent, B=Good, C=Satisfactory, D=Unsatisfactory, F=Failing, I=Incomplete, "
                . "Do=Dropout ", ['size' => 8]);
	$note->addTextBreak();
	$note->addText("Points:A=4,B=3,C=2,D=1,F=0,as of October 2003,B+=3.5,C+=2.5 TR=Course Transfer,*Course Repeated "
                . "DATE OF Issue Monday, October 30,2017		Registrar _______________________", ['size' => 8]);
    }
    
    private function tableHeader(&$table)
    {
        $headStyle = ['name' => 'Cambria', 'size' => 10, 'bold' => true , 'italic' => true];
        
        $table->addRow();

        $childCell = $table->addCell(1500, $this->normalCol);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText("Course No", $headStyle);

        $childCell = $table->addCell(4500, $this->spanCol);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText("Course Title", $headStyle);

        $childCell = $table->addCell(500, $this->normalCol);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText("Cr.Hrs", $headStyle);

        $childCell = $table->addCell(500, $this->normalCol);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText("Grade", $headStyle);

        $childCell = $table->addCell(500, $this->normalCol);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText("Grade Points", $headStyle);

    }
    private function tableFooter(&$table, $gpa, $crhr, $gp)
    {
        $col1 = [
            'gridSpan' => 6, 
            'valign' => 'bottom', 
            'borderTopSize' => 10,
            'borderTopColor' => $this->colorBlack,
            'borderLeftSize' => 10,
            'borderLeftColor' => $this->colorBlack,
            'borderBottomSize' => 10,
            'borderBottomColor' => $this->colorBlack
        ];
        $col2_3 = [
            'valign' => 'top',
            'borderTopSize' => 10,
            'borderTopColor' => $this->colorBlack,
            'borderBottomSize' => 10,
            'borderBottomColor' => $this->colorBlack
        ];
        $col4 = [
            'valign' => 'top',
            'borderTopSize' => 10,
            'borderTopColor' => $this->colorBlack, 
            'borderRightSize' => 10,
            'borderRightColor' => $this->colorBlack, 
            'borderBottomSize' => 10,
            'borderBottomColor' => $this->colorBlack
        ];

        $table->addRow();

        $childCell = $table->addCell(6000, $col1);
        $childText = $childCell->addTextRun();
        $childText->addText($gpa);

        $childCell = $table->addCell(500, $col2_3);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText($crhr);

        $childCell = $table->addCell(500, $col2_3);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText();

        $childCell = $table->addCell(500, $col4);
        $childText = $childCell->addTextRun(['alignment' => Jc::CENTER]);
        $childText->addText($gp);
    }
    
    private function tableMajor($crhr, $gp)
    {
        $majorTable = $this->section->addTable(['borderColor' => $this->colorWhite]);

        $majorTable->addRow();

        $majorCell = $majorTable->addCell(8000, $this->normalCol);
        $majorText = $majorCell->addTextRun();
        $majorText->addText("Major Credit Hrs: ");
        $majorText->addText(@number_format($crhr,2));

        $majorTable->addRow();

        $majorCell = $majorTable->addCell(8000, $this->normalCol);
        $majorText = $majorCell->addTextRun();
        $majorText->addText("Major Cumulative GPA: ");
        $majorText->addText(@number_format($gp/$crhr,2));
        
    }
}