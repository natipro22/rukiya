<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesDepartmentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subjdept';
    protected $primaryKey       = 'SUBJDEPT_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'SUBJ_CODE',
        'DEPT_NAME',
        'IS_MAJOR',
    ];
}
