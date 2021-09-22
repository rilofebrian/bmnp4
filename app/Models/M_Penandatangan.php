<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Penandatangan extends Model
{
    protected $table = 'tb_penandatangan';
    // protected $allowedFields = ['user_admin', 'passwd_admin'];

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function ubah_penandatangan($data, $id) 
    {
        return $this->builder->update($data, ['id_penandatangan' => $id]);
    }
}
