<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    // protected $allowedFields = ['id_pinjam', 'nama_depan', 'nama_belakang', 'jml_pinjam', 'tgl_pinjam', 'subbagian'];
    

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        $query = $this->db->query("SELECT 
                barang.id,
                barang.nm_barang, 
				barang.jns_barang, 
				barang.tgl_masuk_barang, 
				barang.jml_barang, 
                barang.satuan_barang,
				barang.ket_barang,
                tb_satuan.nama_satuan 

        FROM barang
        INNER JOIN tb_satuan ON barang.satuan_barang = tb_satuan.id_satuan
        ORDER BY id DESC");

        return $query->getResultArray();
    }

    //get data barang.jml_barang > 0
    public function getDataStok_Ada()
    {
        $query = $this->db->query("SELECT 
                barang.id,
                barang.nm_barang, 
				barang.jns_barang, 
				barang.tgl_masuk_barang, 
				barang.jml_barang, 
                barang.satuan_barang,
				barang.ket_barang,
                tb_satuan.nama_satuan 

        FROM barang
        INNER JOIN tb_satuan ON barang.satuan_barang = tb_satuan.id_satuan
        WHERE barang.jml_barang > 0 "); 

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

    function jumlah_stok($id_barang){		
        return $this->db->where('barang', $id_barang);

    }

    public function edit($data, $id) 
    {
        return $this->builder->update($data, ['id' => $id]);
    }
}