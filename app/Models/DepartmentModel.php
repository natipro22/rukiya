<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'department';
    protected $primaryKey       = 'DEPT_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'DEPARTMENT_NAME',
        'DEPARTMENT_DESC',
        'DEPARTMENT_DERATION',
        'FACULTY_ID'
        ];
}
