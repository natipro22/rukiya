<?php

namespace App\Libraries\Report;
use PhpOffice\PhpWord\PhpWord;
/**
 * Description of Report
 *
 * @author Mohammed
 */
class Report implements IReport {
    
    protected $msWord;
    protected $section;
    protected $colorBlack = '000000';
    protected $colorWhite = 'FFFFFF';

    public function __construct() {
        $this->msWord = new PhpWord();
        $this->msWord->setDefaultFontName('Times New Roman');
	$this->msWord->setDefaultFontSize(12);
    }
    
    
    public function downloadReport(string $filename){
        return $this->msWord->save($filename, 'Word2007', true);
    }
    
//    public function createWordDocument() {
//        $phpWord = new PhpWord();
//        $phpWord->setDefaultFontName('Times New Roman');
//	$phpWord->setDefaultFontSize(12);
//        return $phpWord;
//    }
    
//    public function createAcademicReport(iterable $student) 
//    {
//        
////        $docx = $this->createWordDocument();
//        
//        // set document orientation to landscape and margin
//        $this->section = $this->msWord->addSection(['marginTop' => 500, 'marginLeft' => 500, 'marginRight' => 500, 'marginBottom' => 500]);
//	$this->section->getStyle()->setOrientation("landscape");
//        
//        // New Table
//	$universityLogoTable = $this->section->addTable(['borderColor' => 'FFFFFF', 'borderSize' => 6]);
//	
//	// add a row to the Table
//	$universityLogoTable->addRow();
//        
//        // set text style for the texts in the table
//        $textStyle = [
//            'name'      => 'Times new Roman', 
//            'size'      => 8,
//            'bold'      => true,
//            'halign'    => 'center'
//            ];
//        
//        # add column to the row 
//	$addressCell = $universityLogoTable->addCell(2000, ['valign' => 'center']);
//	$addresstextrun = $addressCell->addTextRun(['alignment' => Jc::CENTER]);
//	$addresstextrun->addText("Office of The Registrar PO.Box 6722, Addis Ababa, Ethiopia", $textStyle);
//        
//        $universityLogoTable->addCell(1000);
//        
//        # add column to the row
//	$logoCell = $universityLogoTable->addCell(1000, ['valign' => 'center']);
//	$logoTextrun = $logoCell->addTextRun(['alignment' => Jc::RIGHT]);
//	$logoTextrun->addImage(ROOTPATH."public/assets/img/Unity_University_logo.png", ['width' => 70, 'height' => 50]);
//        
//        $companyCell = $universityLogoTable->addCell(8000, ['valign' => 'center', 'halign'=> 'center']);
//	$companyTextrun = $companyCell->addTextRun();
//	$companyTextrun->addText("         Unity University", ['size' => 24, 'bold' => true]);
//	$companyTextrun->addTextBreak();
//	$companyTextrun->addText(" Student Academic Record", ['size' => 24, 'bold' => true]);
//        
////        $footerTable = $section->addTable(['borderColor' => 'FFFFFF', 'borderSize' => 1]);
//        
//        $footer = $this->section->addFooter();
//	
//	$note = $footer->addTextRun(['alignment' => Jc::CENTER]);
//	$note->addText("Grading System A=Excellent, B=Good, C=Satisfactory, D=Unsatisfactory, F=Failing, I=Incomplete, "
//                . "Do=Dropout ", ['size' => 8]);
//	$note->addTextBreak();
//	$note->addText("Points:A=4,B=3,C=2,D=1,F=0,as of October 2003,B+=3.5,C+=2.5 TR=Course Transfer,*Course Repeated "
//                . "DATE OF Issue Monday, October 30,2017		Registrar _______________________", ['size' => 8]);
//       
//       return $docx;
//    }
    
//    public function download($data, $filename = '')
//    {
//        $data->save(ROOTPATH.("/public/assets/doc/{$filename}"));
//        header('Content-Description: File Transfer');
//        header('Content-Disposition: attachment; filename="' . $filename . '"');
//        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//        header('Content-Transfer-Encoding: binary');
//        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//        header('Expires: 0');
//        ob_clean();
//        flush();
//        readfile(ROOTPATH.("/public/assets/doc/{$filename}"));
//        exit;
////        unlink(ROOTPATH.("/public/assets/doc/{$filename}"));
//        return true;
//    }
    
    
    
    
    
    
    

}
