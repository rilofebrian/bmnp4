<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Subbagian extends Model
{
    protected $table = 'tb_subbagian';
    // protected $allowedFields = ['nm_barang', 'jns_barang', 'tgl_masuk_barang', 'jml_barang', 'ket_barang'];
    

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        $query = $this->db->query("SELECT 
                tb_subbagian.id_subbagian,
                tb_subbagian.nm_subbagian

        FROM tb_subbagian");
        return $query->getResultArray();
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }

    public function hapus($id)
    {
        return $this->builder->delete(['id' => $id]);
    }

    public function edit($data, $id) 
    {
        return $this->builder->update($data, ['id' => $id]);
    }
}