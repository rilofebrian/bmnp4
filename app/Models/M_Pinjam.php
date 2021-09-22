<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pinjam extends Model
{
    protected $table = 'tb_pinjam';
    // protected $allowedFields = ['nm_barang', 'jns_barang', 'tgl_masuk_barang', 'jml_barang', 'ket_barang'];
    

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        $query = $this->db->query("SELECT 
                tb_pinjam.id_pinjam,
                tb_pinjam.nama_depan, 
				tb_pinjam.nama_belakang, 
				tb_pinjam.jml_pinjam, 
				tb_pinjam.tgl_pinjam, 
                tb_pinjam.subbagian,
                tb_pinjam.id_barang,
                tb_subbagian.nm_subbagian,
                barang.nm_barang 

        FROM tb_pinjam
        JOIN barang ON tb_pinjam.id_barang = barang.id
        JOIN tb_subbagian ON tb_pinjam.subbagian = tb_subbagian.id_subbagian
        ORDER BY id_pinjam DESC");

        return $query->getResultArray();
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }

    public function hapus($id)
    {
        return $this->builder->delete(['id_pinjam' => $id]);
    }

    public function edit($data, $id) 
    {
        return $this->builder->update($data, ['id_pinjam' => $id]);
    }
}