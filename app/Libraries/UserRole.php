<?php
namespace App\Libraries;
use MyCLabs\Enum\Enum;
/**
 * Description of UserRole
 *
 * @author almehdiu
 * @method static Action ADMIN()
 * @method static Action REGIST()
 * @method static Action INST()
 * @method static Action STUDENT()
 */
final class UserRole extends Enum{
    
    private const ADMIN     = 'Administrator';
    private const REGIST    = 'Registrar';
    private const INST      = 'Instructor';
    private const STUDENT   = 'Student';
    
//    public function ADMIN() {
//        return new Action(self::ADMIN);    
//    }
//    
//    public function REGISTRAR() {
//        return new Action(self::REGIST);    
//    }
//    
//    public function INSTRUCTOR() {
//        return new Action(self::INST);    
//    }
//    public function STUDENT() {
//        return new Action(self::STUDENT);    
//    }
}
