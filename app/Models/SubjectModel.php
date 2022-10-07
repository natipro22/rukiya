<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subject sj';
    protected $primaryKey       = 'SUBJ_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
//    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'SUBJ_CODE',
        'SUBJ_DESCRIPTION',
        'UNIT',
        'CT_HR',
        'PRE_REQUISITE',
        'LAB'
    ];
    

//    // Dates
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
