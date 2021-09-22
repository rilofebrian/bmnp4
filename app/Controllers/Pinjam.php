<?php 

    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use App\Models\M_Pinjam;
    use App\Models\M_Barang;
    use App\Models\M_Subbagian;
    use TCPDF;

    class Pinjam extends Controller
    {
        protected $M_Pinjam;
        protected $M_Barang;
        protected $M_Subbagian;

        public function __construct()
        {
            $this->M_Pinjam = new M_Pinjam;
            $this->M_Barang = new M_Barang();
            $this->M_Subbagian = new M_Subbagian();
        }

        public function index()
        {
            $now = date('Y-m-d');

            $data = [
                'judul' => 'Data Peminjam',
                'now' => $now,
                'subbagian' => $this->M_Subbagian->getAllData(),
                'barang' => $this->M_Barang->getDataStok_Ada(),
                'pinjam' => $this->M_Pinjam->getAllData()
            ];
            
            echo view('templates/v_header', $data);
            echo view('templates/v_sidebar');
            echo view('templates/v_topbar');
            echo view('pinjam/index', $data);
            echo view('templates/v_footpinjam', $data);
        }
        
        public function hapus($id)
        {
            
            $success = $this->M_Pinjam->hapus($id);
            if ($success) {
                session()->setFlashdata('message', 'Dihapus');
                return redirect()->to('/pinjam');
            }
        }

        // EDIT
        public function edit()
        {
            // session();
            if (isset($_POST['edit'])) {
                $val = $this->validate([
                    'nama_depan'        => 'required',
                    'nama_belakang'     => 'required',
                    'jml_pinjam'        => 'required',
                    'tgl_pinjam'        => 'required',
                    'barang'            => 'required',
                    'subbagian'         => 'required'
                ]);
                if (!$val) {
                    session()->setFlashdata('err', \Config\Services::validation()->listErrors()); 
                    // return redirect()->to('/barang')->withInput()->with('validation', $val);
                    
                    $now = date('Y-m-d');

                    $data = [
                        'judul' => 'Data Barang',
                        'now' => $now,
                        'subbagian' => $this->M_Subbagian->getAllData(),
                        'barang' => $this->M_Barang->getDataStok_Ada(),
                        'pinjam' => $this->M_Pinjam->getAllData()
                    ];
                    // dd($data);
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('pinjam/index', $data);
                    echo view('templates/v_footpinjam');
                } else {
                    $id = $this->request->getPost('id_pinjam');

                    $data = [
                        'nama_depan'    => $this->request->getPost('nama_depan'),
                        'nama_belakang' => $this->request->getPost('nama_belakang'),
                        'jml_pinjam'    => $this->request->getPost('jml_pinjam'),
                        'id_barang'     => $this->request->getPost('barang'),
                        'tgl_pinjam'    => $this->request->getPost('tgl_pinjam'),
                        'subbagian'     => $this->request->getPost('subbagian')
                    ];

                    //update data
                    $success = $this->M_Pinjam->edit($data, $id);
                    if ($success) {
                        session()->setFlashdata('message', 'Diupdate');
                        return redirect()->to('/pinjam');
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
            
            $builder = $db->table('tb_pinjam');
            $builder->join('barang', 'barang.id = tb_pinjam.id_barang');
            $builder->join('tb_subbagian', 'tb_subbagian.id_subbagian = tb_pinjam.subbagian');
            $builder->select("*", 'tb_subbagian.nm_subbagian', 'barang.nm_barang');
            $builder->where("DATE_FORMAT(tgl_pinjam,'%Y-%m-%d') >= '$mulai'");
            $builder->where("DATE_FORMAT(tgl_pinjam,'%Y-%m-%d') <= '$akhir'");
            $builder->orderBy('id_pinjam', 'DESC');
            $query = $builder->get();

            $data_pinjam = $query->getResult();
            
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

            $html = view('pinjam/cetak_pdf',[
                'judul' => 'Data Peminjam',
                'now' => $now,
                'nama_admin' => $nama_admin,
                'nama_penandatangan' => $nama_penandatangan,
                'jabatan' => $jabatan,
                'nip' => $nip,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'pinjam' => $data_pinjam
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
            $this->response->setContentType("application/pdf");
            //Close and output PDF document
            $pdf->Output('data_barang.pdf', 'I');
            
        }
    }
    