<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'useraccounts';
    protected $primaryKey       = 'ACCOUNT_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ACCOUNT_NAME',
        'GENDER',
        'ACCOUNT_USERNAME',
        'ACCOUNT_PASSWORD',
        'ACCOUNT_TYPE'
        ];

    
}
