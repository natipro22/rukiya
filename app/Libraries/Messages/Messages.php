<?php

namespace App\Libraries\Messages;
/**
 * Description of Messages
 *
 * @author Mohammed
 */
class Messages {
    
//    public static function checkValidationAndRedirect(bool $validation, $validator)
//    {
//        if(!$validation){
//            return redirect()->back()->withInput()->with('validation', $validator)
//                             ->with('error', 'Something was wrong. Please check your input');
//        }
//    }
    
    public static function validationErrorsWithInput($validator)
    {
        return redirect()->back()->withInput()->with('validation', $validator)
                             ->with('error', 'Something went wrong. Please check your input');
    }
    public static function checkInsertionAndRedirect(bool $result, string $redirectTo, string $about)
    {
        // if the insertion fail then reditect to the registration form and display error
        if(!$result){
            return redirect()->back()->with('error', "Unable to insert. Please try again.");
        } // else redirect to students list with success message
        else {
            return redirect()->to(base_url('/'.$redirectTo))->with('success',"New $about Created successfully.");
        }
    }
    
//    public static function checkRegsitration(bool $result, string $about)
//    {
//        // if the insertion fail then reditect to the registration form and display error
//        if(!$result){
//            return redirect()->back()->with('error', "Unable register the Student.");
//        } // else redirect to students list with success message
//        else {
//            return redirect()->to('/'.$about)->with('success',"The new Student registration completed successfully.");
//        }
//    }
    
    public static function checkforUpdateAndRedirect(bool $result, string $redirectTo, string $about)
    {
        // if the update fail then reditect to the registration form and display error
        if(!$result){
            return redirect()->back()->with('error', "Unable to Update. Please try again.");
        } // else redirect to students list with success message
        else {
            return redirect()->to(base_url('/'.$redirectTo))->with('success',"The $about Updated successfully.");
        }
    }
    
    public static function checkDeletionAndRedirect(bool $result, string $redirectTo, string $about)
    {
        // if the insertion fail then reditect to the registration form and display error
        if(!$result){
            return redirect()->back()->with('error', "Unable to delete. Please try again.");
        } // else redirect to students list with success message
        else {
            return redirect()->to(base_url('/'.$redirectTo))->with('success',"The $about deleted successfully.");
        }
    }
    public static function errorPageNotFound() 
    {
        return view('errors/html/error_404');
        
    }
    
    public static function errorNoThingSelected()
    {
        return redirect()->back()->with('error', 'You must select atleast one checkbox');
    }
}
