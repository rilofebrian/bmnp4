<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Masuk extends Model
{
    protected $table = 'tb_admin';
    protected $allowedFields = ['user_admin', 'passwd_admin'];


//     public function __construct()
//     {
//         $this->db = db_connect();
//         $this->builder = $this->db->table($this->table);
//     }

//     public function getAllData()
//     {
//         return $this->builder->get();
//     }
}
