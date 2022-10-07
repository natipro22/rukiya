<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblstuddetails';
    protected $primaryKey       = 'DETAIL_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'FATHER',
        'FATHER_OCCU',
        'MOTHER',
        'MOTHER_OCCU',
        'GUARDIAN',
        'GUARDIAN_ADDRESS',
        'IDNO'
    ];
}
