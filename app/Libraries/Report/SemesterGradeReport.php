<?php


namespace App\Libraries\Report;
use \PhpOffice\PhpWord\Settings;
use App\Libraries\System;
use PhpOffice\PhpWord\SimpleType\Jc;
use \PhpOffice\PhpWord\SimpleType\Border;

/**
 * Description of SemesterGradeReport
 *
 * @author Mohammed
 */
class SemesterGradeReport extends Report {
    
    private $report;
    public function __construct() {
        parent::__construct();
        Settings::setDefaultPaper('Letter');
        $this->report = System::createReport();
    }
    
    public function reportBanner(){
        $this->section = $this->msWord->addSection();
        $headTable = $this->section->addTable(['borderColor' => $this->colorWhite, 'borderSize' => 6]);
	
	# add row to the Table
	$headTable->addRow();
	
	# table text style
	$textStyle = ['name' => 'Times new Roman', 'size' => 16, 'bold' => true];
	
	# add column to the row 
	$cell = $headTable->addCell(3000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Unity University", $textStyle);
	
	# add column to the row
	$cell = $headTable->addCell(1000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addImage(site_url('/public/assets/img/logo.png'), ['width' => 150, 'height' => 80]);
	
	
	$cell = $headTable->addCell(4000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Office of the Registrar", $textStyle);
	
        $this->section->addTextBreak();
	# add text 
	$headerText = $this->section->addText("Student Grade Report", 
                ['name' => 'Cooper Black', 'size' => 36 ], ['align' => 'center']);
    }
    
    public function reportStudentDetails($schoolyr_id, $student_id){
        
        $stud = System::createStudent();
        $sect = System::createSection();
        $sy = System::createSchoolYear();
        $schoolyr = $sy->where('SYID',$schoolyr_id)->first();
        
        $student = $stud->studentInfo->where('IDNO', $student_id)->first();
        $section = $sect->where('SECTION_ID', $student->SECTION_ID)->first();
        $mainTable = $this->section->addTable(array('borderColor' => $this->colorWhite, 'borderSize' => 6));
	$mainTable->addRow();
	
	$textStyle = ['name' => 'Times new Roman', 'size' => 14];
	$valueStyle = ['name' => 'Times new Roman', 'size' => 14, 'bold' => true];
        
	$cell = $mainTable->addCell(7000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("ID NO:- ", $textStyle);
	$textrun->addText($student->IDNO, $valueStyle);
       
	
	
	$cell = $mainTable->addCell(6000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Program:- ", $textStyle);
	$textrun->addText($student->PROGRAM, $valueStyle);
	
	$mainTable->addRow();
	
	$cell = $mainTable->addCell(7000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Name:- ", $textStyle);
        $textrun->addText($student->FNAME." ".$student->MNAME." ". $student->LNAME , $valueStyle);
	
	
	$cell = $mainTable->addCell(6000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Campus:- ", $textStyle);
        $setting = System::createSetting();
        $campus = $setting->where('SETTING_TYPE','CAMPUS')->first()->SETTING_DESC;
	$textrun->addText($campus, $valueStyle);
	
	$mainTable->addRow();
	$sex = ($student->SEX == 'F') ? 'FEMALE' : 'MALE';
	$cell = $mainTable->addCell(7000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Sex:- ", $textStyle);
        $textrun->addText($sex, $valueStyle);
	
	
//        $sect = new includes/Section();
//        $sect = $sect->single_section($cur->SECTION_ID);
        
	$cell = $mainTable->addCell(6000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Section:- ", $textStyle);
	$textrun->addText($section->SECTION_NAME, $valueStyle);
	
	$mainTable->addRow();
	// dept
	
	$cell = $mainTable->addCell(7000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Academic Year:- ", $textStyle);
        $textrun->addText(academicYear($schoolyr->START_DATE, $schoolyr->END_DATE), $valueStyle);
        
        $cell = $mainTable->addCell(6000, ['valign' => 'center']);
	$textrun = $cell->addTextRun();
	$textrun->addText("Department:- ", $textStyle);
	$textrun->addText($student->DEPARTMENT, $valueStyle);
//	
	helper('inflector');
	$mainTable->addRow();
//	\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false);
	$cell = $mainTable->addCell(6000, ['valign' => 'center','gridSpan' => 2]);
	$textrun = $cell->addTextRun(['alignment' => Jc::CENTER,'size' => 16]);
	$textrun->addText($schoolyr->COURSE_ID, $valueStyle);
        $textrun->addText(ordinal($schoolyr->COURSE_ID), ['superScript' => true]);
        $textrun->addText(' Year '.$schoolyr->SEMESTER_ID, $valueStyle);
        $textrun->addText(ordinal($schoolyr->SEMESTER_ID), ['superScript' => true]);
        $textrun->addText(' Semester', $valueStyle);
        
        
        $this->section->addTextBreak();
    }
    
    public function reportStudentGrade($schoolyr_id, string $student_id){
        
        ini_set("memory_limit", "-1");  // ignore php memory limit warnning
        
//        $this->section = $this->msWord->addSection();
        $gradeTable = $this->section->addTable(array( 'borderSize' => 10));
    //    array('borderColor' => '000000', 'borderSize' => 10, 'cellMargin' => 20)
        $gradeTable->addRow();

        $headStyle = ['name' => 'Cambria', 'size' => 13, 'bold' => true , 'italic' => true];
        $valueStyle = ['name' => 'Times new Roman', 'size' => 12, 'bold' => true];

        $cell = $gradeTable->addCell(1000, ['valign' => 'bottom','borderLeftSize' => 25, 'borderTopSize' => 25,'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP, 'borderLeftStyle' => Border::THICK_THIN_MEDIUM_GAP]);
        $textrun = $cell->addTextRun(['alignment' => Jc::RIGHT]);
        $textrun->addText("NO   ", $headStyle);

        $cell = $gradeTable->addCell(6000, array('valign' => 'bottom', 'gridSpan' => 5, 'borderTopSize' => 25, 'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText("Course title ", $headStyle);

    //    $cell = $gradeTable->addCell(1000, array('valign' => 'center'));
    //    $textrun = $cell->createTextRun();
    ////    $textrun->addText("Course title ", $headStyle);
    //    
    //    $cell = $gradeTable->addCell(1000, array('valign' => 'center'));
    //    $textrun = $cell->createTextRun();
    ////    $textrun->addText("Course title ", $headStyle);

        $cell = $gradeTable->addCell(3000, array('valign' => 'bottom','borderTopSize' => 25,'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText("Course No ", $headStyle);

        $cell = $gradeTable->addCell(1200, array('valign' => 'bottom','borderTopSize' => 25,'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText("Credit hour ", $headStyle);

        $cell = $gradeTable->addCell(1200, array('valign' => 'bottom','borderTopSize' => 25,'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText("Grade ", $headStyle);

        $cell = $gradeTable->addCell(1200, array('valign' => 'bottom','borderRightSize' => 25,'borderRightStyle' => Border::THICK_THIN_MEDIUM_GAP,'borderTopSize' => 25,'borderTopStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText("Grade point ", $headStyle);

        $cr_hr = 0;
        $tot_gr = 0;
        $no = 0;
        $gradePoint = $totalPoint = $total_crhr = 0;
        $stud  = System::createStudent();
        $grade_val = System::createGradeValue();
        $student = $stud->studentInfo->where('IDNO', $student_id)->first();
        $courses = $this->report->reportSectionCourses($student->SECTION_ID, $schoolyr_id);
//        echo '<pre>';
//        print_r($courses);
//        die();
        
        foreach($courses as $cr){

            $gradeTable->addRow();

//            $cr_hr += $cr->UNIT;
            $grade = $this->report->reportStudentCourse($student_id, $cr->STUDSUBJ_ID);
            $gradePoint = $cr->UNIT * $grade_val->where('GRADE', $grade->GRADE)->first()->VAL;

            $cell = $gradeTable->addCell(1000,array('borderLeftSize' => 25,'borderLeftStyle' => Border::THICK_THIN_MEDIUM_GAP));
            $textrun = $cell->addTextRun(array('alignment' => Jc::RIGHT));
            $textrun->addText(++$no);

            $cell = $gradeTable->addCell(6000, array('gridSpan' => 5));
            $textrun = $cell->addTextRun();
            $textrun->addText($cr->SUBJ_DESCRIPTION);

            $cell = $gradeTable->addCell(3000);
            $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
            $textrun->addText($cr->SUBJ_CODE);

            $cell = $gradeTable->addCell(1200);
            $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
            $textrun->addText($cr->UNIT);

            $cell = $gradeTable->addCell(1200);
            $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
            $textrun->addText($grade->GRADE);

            $cell = $gradeTable->addCell(1200,array('borderRightSize' => 25,'borderRightStyle' => Border::THICK_THIN_MEDIUM_GAP));
            $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
            $textrun->addText($gradePoint);
            
            $totalPoint += $gradePoint;
            $total_crhr += $cr->UNIT; 

        }

        $gradeTable->addRow();

        $cell = $gradeTable->addCell(6000, array('gridSpan' => 7,'borderLeftSize' => 25,'borderLeftStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText();

        $cell = $gradeTable->addCell(1200);
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText($total_crhr, $valueStyle);

        $cell = $gradeTable->addCell(1200);
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText();

        $cell = $gradeTable->addCell(1200,array('borderRightSize' => 25,'borderRightStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText($totalPoint, $valueStyle);

        $gradeTable->addRow();

        $cell = $gradeTable->addCell(6000, array('gridSpan' => 6,'borderLeftSize' => 25,'borderLeftStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::RIGHT));
        $textrun->addText("SEMESTER GPA  ",$valueStyle);

        $cell = $gradeTable->addCell(1200, array('gridSpan' => 4,'borderRightSize' => 25,'borderRightStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText(@number_format($totalPoint/$total_crhr,2),$valueStyle);

        $gradeTable->addRow();

        $tot_crhr = $tot_grade = $totalgp = 0;
        $allCourses = $this->report->reportStudentCourses($student_id);
//        echo '<pre>';
//        print_r($allCourses);
//        die();
        foreach ($allCourses as $course) {
             
//             $tot_grade += $course->UNIT * gradeVal($course->GRADE);
             $grades = $this->report->reportStudentCourse($student_id, $course->STUDSUBJ_ID);
             $tot_grade = $course->UNIT * $grade_val->where('GRADE', $grades->GRADE)->first()->VAL;
             
             $totalgp += $tot_grade;
             $tot_crhr += $course->UNIT;
        }
        

        $cell = $gradeTable->addCell(6000, array('gridSpan' => 6,'borderLeftSize' => 25,'borderLeftStyle' => Border::THICK_THIN_MEDIUM_GAP,'borderBottomSize' => 25,'borderBottomStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::RIGHT));
        $textrun->addText("COMULATIVE GPA  ",$valueStyle);

        $cell = $gradeTable->addCell(1200, array('gridSpan' => 4,'borderBottomSize' => 25,'borderBottomStyle' => Border::THICK_THIN_MEDIUM_GAP,'borderRightSize' => 25,'borderRightStyle' => Border::THICK_THIN_MEDIUM_GAP));
        $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText(@number_format($totalgp/$tot_crhr,2), $valueStyle);

        $this->section->addTextBreak();
    }
    
    
    
}
