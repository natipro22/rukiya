<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentInfoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblstudent';
    protected $primaryKey       = 'S_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'IDNO',
        'FNAME',
        'LNAME',
        'MNAME',
        'SEX',
        'DEPARTMENT',
        'BDAY',
        'BPLACE',
        'SECTION_ID',
        'CONTACT_NO',
        'HOME_ADD',
        'EMAIL',
        'USER_ID',
        'PROGRAM',
        'STATUS'
        ];

}
