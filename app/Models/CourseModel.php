<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subject';
    protected $primaryKey       = 'SUBJ_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'SUBJ_CODE',
        'SUBJ_DESCRIPTION',
        'UNIT',
        'CT_HR',
        'PRE_REQUISITE',
        'LAB'
    ];
}
