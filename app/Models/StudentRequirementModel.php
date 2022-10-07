<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentRequirementModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblrequirements';
    protected $primaryKey       = 'REQ_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'G10SC_NAME',
        'G10_VAL',
        'G10_YEAR',
        'G12SC_NAME',
        'G12_VAL',
        'G12_YEAR',
        'G12_2COLLEGE_NAME',
        'G12_2VAL',
        'G12_2YEAR',
        'LEVEL3_4COLLEGENAME',
        'LEVEL3_4VAL',
        'DATE_OF_ATTEND',
        'COLLEGE',
        'DEGREE',
        'DATE_OF_AWARE',
        'IDNO'
    ];
}
