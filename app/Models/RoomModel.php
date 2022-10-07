<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'room';
    protected $primaryKey       = 'ROOM_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ROOM_NAME',
        'ROOM_DESC',
        'ROOM_STATUS',
        'IS_AVAILABLE'
    ];
   
}
