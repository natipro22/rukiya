<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
namespace App\Libraries;
/**
 * Description of Hash
 *
 * @author Mohammed
 */
class Hash {
    public static function makePassword($password){
        // return the hashed password ,['cost' => 12]
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function checkPassword($entered_password, $db_password)
    {
        // if the password maches return true else return false
        if(password_verify($entered_password, $db_password)){
            return true;
        }
        return false;
    }
}
