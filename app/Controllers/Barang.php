<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\M_Barang;
use App\Models\M_Satuan;
use TCPDF;

class Barang extends Controller
{
    protected $M_Barang;
    protected $M_Satuan;
    

    public function __construct()
    {
        $this->M_Barang = new M_Barang;
        $this->M_Satuan = new M_Satuan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Barang',
            'barang' => $this->M_Barang->getAllData(),
            'satuan' => $this->M_Satuan->findAll()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('barang/index', $data);
        echo view('templates/v_footbarang', $data);

    }

    // TAMBAH
    public function tambah()
    {
        // session();
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nm_barang'         => 'required',
                'jns_barang'        => 'required',
                'tgl_masuk_barang'  => 'required',
                'jml_barang'        => 'required|numeric|max_length[3]',
                // 'satuan_barang'     => 'required',
                'ket_barang'        => 'required'
            ]);
            
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors()); 
                // return redirect()->to('/barang')->withInput()->with('validation', $val);
                
                $data = [
                    'judul' => 'Data Barang',
                    'barang' => $this->M_Barang->getAllData()
                ];
                // dd($data);
                echo view('templates/v_header', $data);
                echo view('templates/v_sidebar');
                echo view('templates/v_topbar');
                echo view('barang/index', $data);
                echo view('templates/v_footbarang', $data);
            } else {
                $data = [
                    'nm_barang'         => $this->request->getPost('nm_barang'),
                    'jns_barang'        => $this->request->getPost('jns_barang'),
                    'tgl_masuk_barang'  => $this->request->getPost('tgl_masuk_barang'),
                    'jml_barang'        => $this->request->getPost('jml_barang'),
                    'satuan_barang'     => $this->request->getPost('nama_satuan'),
                    'ket_barang'        => $this->request->getPost('ket_barang')
                ];
                //insert data
                $success = $this->M_Barang->tambah($data);
                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan');
                    return redirect()->to('/barang');
                }
            }
        } else {
            return redirect()->to('/barang');
        }
    }

    public function hapus($id)
    {
        $db = \Config\Database::connect(); // optional; init database if not created yet

        $builder = $db->table('tb_pinjam');
        $builder->where('id_barang', $id);
        $builder->select('tb_pinjam.*');
        $builder->limit(1);

        $query = $builder->get();
        $result = $query->getResult(); // Result as objects eg; $result->kode
        $stok = $result;
        
        if($stok){
            session()->setFlashdata('err', 'Tidak dapat menghapus, data Barang ini telah dipinjam');
            return redirect()->to('/barang');
        } else {
            $success = $this->M_Barang->hapus($id);

            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to('/barang');
        }
    }

    // EDIT
    public function edit()
    {
        // session();
        if (isset($_POST['edit'])) {
            $val = $this->validate([
                'edit_nm_barang'         => 'required',
                'edit_jns_barang'        => 'required',
                'edit_tgl_masuk_barang'  => 'required',
                'edit_jml_barang'        => 'required|numeric|max_length[3]',
                'edit_ket_barang'        => 'required'
            ]);
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors()); 
                // return redirect()->to('/barang')->withInput()->with('validation', $val);
                
                $data = [
                    'judul' => 'Data Barang',
                    'barang' => $this->M_Barang->getAllData()
                ];
                // dd($data);
                echo view('templates/v_header', $data);
                echo view('templates/v_sidebar');
                echo view('templates/v_topbar');
                echo view('barang/index', $data);
                echo view('templates/v_footbarang', $data);
            } else {
                $id = $this->request->getPost('edit_id_barang');

                $data = [
                    'nm_barang'         => $this->request->getPost('edit_nm_barang'),
                    'jns_barang'        => $this->request->getPost('edit_jns_barang'),
                    'tgl_masuk_barang'  => $this->request->getPost('edit_tgl_masuk_barang'),
                    'jml_barang'        => $this->request->getPost('edit_jml_barang'),
                    'satuan_barang'     => $this->request->getPost('edit_nama_satuan'),
                    'ket_barang'        => $this->request->getPost('edit_ket_barang')
                ];
                //update data
                $success = $this->M_Barang->edit($data, $id);
                if ($success) {
                    session()->setFlashdata('message', 'Diupdate');
                    return redirect()->to('/barang');
                }
            }
        } else {
            return redirect()->to('/barang');
        }
    }

    public function cetak_pdf()
	{
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $db = \Config\Database::connect(); // optional; init database if not created yet
        
        $builder = $db->table('barang');
        $builder->join('tb_satuan', 'tb_satuan.id_satuan = barang.satuan_barang');
        $builder->select("*", 'tb_satuan.nama_satuan');
        $builder->where("DATE_FORMAT(tgl_masuk_barang,'%Y-%m-%d') >= '$mulai'");
        $builder->where("DATE_FORMAT(tgl_masuk_barang,'%Y-%m-%d') <= '$akhir'");
        $query = $builder->get();

        $data_barang = $query->getResult();

        $build = $db->table('tb_admin');
        $build->where('id_admin', 1);
        $build->select('*');
        $build->limit(1);

        $query = $build->get();
        $result = $query->getResult(); // Result as objects eg; $result->kode
        $nama_admin = $result[0]->nama_admin;

        $p_tangan = $db->table('tb_penandatangan');
        $p_tangan->where('id_penandatangan', 1);
        $p_tangan->select('*');
        $p_tangan->limit(1);

        $query = $p_tangan->get();
        $result = $query->getResult(); // Result as objects eg; $result->kode
        $nama_penandatangan = $result[0]->nm_penandatangan;
        $jabatan = $result[0]->jbt_penandatangan;
        $nip = $result[0]->nip;

        $now = date('Y-m-d');

		$html = view('barang/cetak_pdf',[
			'judul' => 'Data Barang',
            'now' => $now,
            'nama_admin' => $nama_admin,
            'nama_penandatangan' => $nama_penandatangan,
            'jabatan' => $jabatan,
            'nip' => $nip,
            'mulai' => $mulai,
            'akhir' => $akhir,
            'barang' => $data_barang,
            'satuan' => $this->M_Satuan->findAll()
		]);

		$pdf = new TCPDF('', PDF_UNIT, 'A4', true, 'UTF-8', true);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Rilo Febrian');
		$pdf->SetTitle('LMBD');
		$pdf->SetSubject('LMBD');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, true, true, true, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('data_barang.pdf', 'I');
		
	}

}

