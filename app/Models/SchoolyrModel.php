<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolyrModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'schoolyr';
    protected $primaryKey       = 'SYID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
//    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'AY',
        'COURSE_ID',
        'SEMESTER_ID',
        'SECTION_ID',
        'CURRENT',
        'START_DATE',
        'END_DATE',
        'NO_OF_SUBJ'
    ];

    // Dates
//    protected $useTimestamps = false;
//    protected $dateFormat    = 'datetime';
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';
//
//    // Validation
//    protected $validationRules      = [];
//    protected $validationMessages   = [];
//    protected $skipValidation       = false;
//    protected $cleanValidationRules = true;
//
//    // Callbacks
//    protected $allowCallbacks = true;
//    protected $beforeInsert   = [];
//    protected $afterInsert    = [];
//    protected $beforeUpdate   = [];
//    protected $afterUpdate    = [];
//    protected $beforeFind     = [];
//    protected $afterFind      = [];
//    protected $beforeDelete   = [];
//    protected $afterDelete    = [];
}
