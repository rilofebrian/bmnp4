<?php

    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use App\Models\M_Masuk;

    class Masuk extends Controller
    {
        public function index()
        {
            $data = [
                'judul' => 'Login Admin'
            ];

            // echo view('templates/v_header', $data);
            // echo view('templates/v_sidebar');
            // echo view('templates/v_topbar');
            echo view('masuk/index', $data);
            echo view('templates/v_footer',);
        }

        public function auth()
        {
            $session = session();
            $model = new M_Masuk();
            $user_admin = $this->request->getVar('user_admin');
            $password = $this->request->getVar('password');
            $data = $model->where('user_admin', $user_admin)->first();
            
            if($data){
                $pass = $data['passwd_admin'];
                $verify_pass = password_verify($password, $pass);
                if($verify_pass){
                    $ses_data = [
                        'id_admin'       => $data['id_admin'],
                        'user_admin'    => $data['user_admin'],
                        'logged_in'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/admin');
                }else{
                    $session->setFlashdata('msg', 'Wrong Password');
                    return redirect()->to('/masuk');
                }
            }else{
                $session->setFlashdata('msg', 'Username not Found');
                return redirect()->to('/masuk');
            }
        }

        public function logout()
        {
            $session = session();
            $session->destroy();
            
            return redirect()->to('/masuk');
        }
    }