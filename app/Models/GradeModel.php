<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'grades';
    protected $primaryKey       = 'GRADE_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
//    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'IDNO',
        'SSID',
        'SYID',
        'FIRST',
        'SECOND',
        'THIRD',
        'FOURTH',
        'ASSESSMENT',
        'FINAL',
        'TOTAL',
        'GRADE',
        'DAY',
        'REMARKS',
        'COMMENT'
    ];
}
