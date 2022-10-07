<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'section';
    protected $primaryKey       = 'SECTION_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
//    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'SECTION_NAME',
        'SECTION_DESC',
        'YEAR',
        'DEPARTMENT'
    ];

}
