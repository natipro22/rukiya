<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeValueModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gradeval';
    protected $primaryKey       = 'GVAL_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
//    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'GRADE',
        'VAL'
    ];

}
