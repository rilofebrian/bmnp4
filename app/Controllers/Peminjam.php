<?php

    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use App\Models\M_Subbagian;
    use App\Models\M_Barang;
    use App\Models\M_Pinjam;
    use CodeIgniter\I18n\Time;
    
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Label\Label;
    use Endroid\QrCode\Logo\Logo;
    use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
    use Endroid\QrCode\Writer\PngWriter;
    use TCPDF;

    class Peminjam extends Controller
    {
        protected $M_Subbagian;
        protected $M_Pinjam;
        protected $M_Barang;

        public function __construct()
        {
            $this->M_Subbagian = new M_Subbagian;
            $this->M_Barang = new M_Barang;
            $this->M_Pinjam = new M_Pinjam;
        }

        public function index()
        {
            $now = date('Y-m-d');

            $data = [
                'judul' => 'Pengambilan Barang',
                'now' => $now,
                'subbagian' => $this->M_Subbagian->getAllData(),
                'barang' => $this->M_Barang->getDataStok_Ada(),
            ];

            // echo view('templates/v_header', $data);
            // echo view('templates/v_sidebar');
            // echo view('templates/v_topbar');
            echo view('peminjam/index', $data);
            echo view('templates/v_footer',);
        }

        // Form Peminjaman
        public function tambah()
        {
            // session();
            if (isset($_POST['tambah'])) {
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
                        'judul' => 'Peminjaman/Pengambilan Barang',
                        'now' => $now,
                        'subbagian' => $this->M_Subbagian->getAllData(),
                        'barang' => $this->M_Barang->getAllData(),
                    ];

                    echo view('peminjam/index', $data);
                    echo view('templates/v_footer');
                } else {

                    $jml_pinjam = $this->request->getPost('jml_pinjam');
                    $id_barang = $this->request->getPost('barang');
                    $nama_depan = $this->request->getPost('nama_depan');
                    $nama_belakang = $this->request->getPost('nama_belakang');

                    // $stok = $this->M_Barang->jumlah_stok($barang)->first();
                    $db = \Config\Database::connect(); // optional; init database if not created yet

                    $builder = $db->table('barang');
                    $builder->where('id', $id_barang);
                    $builder->select('barang.jml_barang');
                    $builder->limit(1);

                    $query = $builder->get();
                    $result = $query->getResult(); // Result as objects eg; $result->kode
                    $stok = $result[0]->jml_barang;

                    $writer = new PngWriter();

                    // Create QR code
                    $qrCode = QrCode::create($nama_depan.'_'.$nama_belakang)
                        ->setEncoding(new Encoding('UTF-8'))
                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                        ->setSize(300)
                        ->setMargin(10)
                        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                        ->setForegroundColor(new Color(0, 0, 0))
                        ->setBackgroundColor(new Color(255, 255, 255));

                    // Create generic logo
                    $logo = Logo::create(__DIR__.'/../../public/favicon.png')
                        ->setResizeToWidth(50);

                    // Create generic label
                    $label = Label::create($nama_depan.'_'.$nama_belakang)
                        ->setTextColor(new Color(0, 0, 0));

                    $result = $writer->write($qrCode, $logo, $label);
                    
                    header('Content-Type: '.$result->getMimeType());

                    // Save it to a file
                    $result->saveToFile(__DIR__.'/../../public/assets/img/qr_code/'.$nama_depan.'_'.$nama_belakang.'.jpg');

                    $data = [
                        'nama_depan'    => $nama_depan,
                        'nama_belakang' => $nama_belakang,
                        'jml_pinjam'    => $jml_pinjam,
                        'id_barang'     => $this->request->getPost('barang'),
                        'tgl_pinjam'    => $this->request->getPost('tgl_pinjam'),
                        'subbagian'     => $this->request->getPost('subbagian'),
                        'qr_code'       => $nama_depan.'_'.$nama_belakang.'.jpg'

                    ];

                    // insert data
                    $success = $this->M_Pinjam->tambah($data);
                    $data_update_stok = [
                        'jml_barang' => $stok - $jml_pinjam
                    ];

                    $update_stok = $this->M_Barang->edit($data_update_stok, $id_barang);

                    $build = $db->table('tb_pinjam');
                    $build->join('barang', 'barang.id = tb_pinjam.id_barang');
                    $build->join('tb_subbagian', 'tb_subbagian.id_subbagian = tb_pinjam.subbagian');
                    $build->select('*', 'tb_subbagian.nm_subbagian', 'barang.nm_barang');
                    $build->orderBy('id', 'DESC');
                    $build->limit(1);

                    $p_tangan = $db->table('tb_penandatangan');
                    $p_tangan->where('id_penandatangan', 1);
                    $p_tangan->select('*');
                    $p_tangan->limit(1);

                    $query = $p_tangan->get();
                    $result = $query->getResult(); // Result as objects eg; $result->kode
                    $nama_penandatangan = $result[0]->nm_penandatangan;
                    $jabatan = $result[0]->jbt_penandatangan;
                    $nip = $result[0]->nip;

                    $query = $build->get();
                    $result = $query->getResult(); // Result as objects eg; $result->kode
                    // dd($result[0]);

                    $now = date('Y-m-d');

                    $html = view('peminjam/cetak_pdf',[
                        'judul'         => 'Data Peminjam',
                        'now'           => $now,
                        'nama_penandatangan' => $nama_penandatangan,
                        'jabatan' => $jabatan,
                        'nip' => $nip,
                        'nama_depan'    => $nama_depan,
                        'nm_barang'     => $result[0]->nm_barang,
                        'nm_subbagian'  => $result[0]->nm_subbagian,
                        'nama_belakang' => $nama_belakang,
                        'jml_pinjam'    => $jml_pinjam,
                        'id_barang'     => $this->request->getPost('barang'),
                        'tgl_pinjam'    => $this->request->getPost('tgl_pinjam'),
                        'subbagian'     => $this->request->getPost('subbagian'),
                        'qr_code'       => $nama_depan.'_'.$nama_belakang.'.png'
                    ]);

                    $pdf = new TCPDF('', PDF_UNIT, 'A4', true, 'UTF-8', true);

                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor('Bagian Perencanaan, Pengembangan, dan Pemberhentian Pegawai');
                    $pdf->SetTitle('Layanan dan Basis Data Kepegawaian');
                    $pdf->SetSubject('Layanan dan Basis Data Kepegawaian');

                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(true);

                    $pdf->addPage();

                    // output the HTML content
                    $pdf->writeHTML($html, true, true, true, true, '');
                    //line ini penting
                    $this->response->setContentType('application/pdf');
                    //Close and output PDF document
                    $pdf->Output('Bukti Pengambilan Barang.pdf', 'I');
                    
                    // if ($success && $update_stok) {
                    //     session()->setFlashdata('message', 'Ditambahkan');
                    //     return redirect()->to('peminjam');
                    // }
                }
            } else {
                return redirect()->to('peminjam');
            }
        }


    }
