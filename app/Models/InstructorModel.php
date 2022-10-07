<?php

namespace App\Models;

use CodeIgniter\Model;

class InstructorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'instructor';
    protected $primaryKey       = 'INST_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'INST_FULLNAME',
        'INST_ADDRESS',
        'INST_SEX',
        'SPECIALIZATION',
        'INST_EMAIL',
        'EMPLOYMENT_STATUS',
        'USER_ID',
    ];
    
}
