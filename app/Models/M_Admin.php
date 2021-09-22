<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Admin extends Model
{
    protected $table = 'tb_admin';
    // protected $allowedFields = ['user_admin', 'passwd_admin'];

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function ubah_password($data, $id) 
    {
        return $this->builder->update($data, ['id_admin' => $id]);
    }

    // public function ubah_penandatangan($data, )

    function data_peminjam()
    {
        $query = $this->db->query("SELECT 
                barang.nm_barang,
                tb_pinjam.id_barang, COUNT(*)

        FROM tb_pinjam
        JOIN barang ON tb_pinjam.id_barang = barang.id
        GROUP BY id_barang 
        ");

        return $query->getResultArray();
    }

}
