<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\M_trader;
use CodeIgniter\I18n\Time;
class Home extends BaseController
{
    private function log_activity($activity)
    {
		$model = new M_trader();
        $data = [
            'id_user'    => session()->get('id'),
            'activity'   => $activity,
			'timestamp' => date('Y-m-d H:i:s'),
			'deleted' => ''
        ];

        $model->tambah('activity', $data);
    }

	private function log_activitys($activity, $id)
    {
		$model = new M_trader();
         $this->log_activity('User membuka halaman riwayat_login'); ///log akt
        $data = [
            'id_user'    => $id,
            'activity'   => $activity,
			'timestamp' => date('Y-m-d H:i:s'),
			'delete' => '0'
        ];

        $model->tambah('activity', $data);
    }
	    public function index()
    {
        echo view('header');
        echo view('login');
        echo view('footer');
        }
	
		public function dashboard()
	{
		 if(session()->get('level')>0) {
        $this->log_activity('User membuka Dashboard'); ///log akt
		 $model = new M_trader();
         $where = array('id_pt' => 2);
         $data['setting'] = $model->getwhere('pt',$where); 
		 $where=array(
            'id_toko'=>1
        );
        //  $data['setting'] = $model->getWhere('toko', $where);
		echo view('header',$data);
        echo view('menu', $data);
        echo view('dashboard');
       
     }else{
     	return redirect()->to('home/login');
}
}
 

		public function pt()
{
    $model = new M_trader();
    $this->log_activity('User membuka halaman edit profile aplikasi'); 
    $where = array('id_pt' => 2);
    $data['setting'] = $model->getwhere('pt',$where);   
    $level = session()->get('level');
    
    echo view('header',$data);
    echo view('menu',$data);

    if ($level == 1) { // Level 1 untuk admin
        // Mengambil data yang diperlukan untuk halaman 'pt'
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where);

        
        echo view('pt', $data);
    } else {
        // Jika level pengguna bukan admin, arahkan ke halaman error
        echo view('access_denied'); // Halaman ini bisa Anda desain sendiri untuk menampilkan pesan akses ditolak
    }
}



public function history_hapus()
    {
        $model = new M_trader();
        $session = session();
        $userId = $session->get('id_users');

        // Ambil riwayat hapus untuk pengguna yang login
        $history = $model->db->table('history_hapus')
                             ->where('id_users', $userId)
                             ->orderBy('deleted_at', 'desc')
                             ->get()
                             ->getResultArray();

        return view('history_hapus', ['history' => $history]);
    }

    public function hapus($table, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);

        // Ambil data yang akan dihapus
        $data = $builder->getWhere($where)->getRowArray();
        
        if ($data) {
            // Hapus data dari tabel
            $builder->delete($where);

            // Catat detail penghapusan di tabel history_hapus
            $historyBuilder = $db->table('history_hapus');
            $historyBuilder->insert([
                'user_id' => session()->get('id_users'),
                'table_name' => $table,
                'deleted_data' => json_encode($data),
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            return true;
        }
        return false;
    }


   public function t_rak()
{
    if(session()->get('level') > 0) {
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt', $where); 
        $data['raks'] = $model->getAllRaks();  // Mengambil semua data rak

        // Ambil rak-rak yang sudah terisi
        $data['rak_terisi'] = $model->getRakTerisi(); // Pastikan method ini mengembalikan rak yang sudah digunakan

        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_rak', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}
public function aksi_trak()
{
    if(session()->get('level') > 0) { 
        $model = new M_trader();

        $nama = $this->request->getPost('nomor');
        $status = $this->request->getPost('status');
       

        $isi = [
            'nomor' => $nama,
            'status' => $npm,
           
        ];

        $model->tambah('rak', $isi);
        return redirect()->to('home/rak');
    } else {
        return redirect()->to('home/login');
    }
}
 public function t_penitipan()
{
    if(session()->get('level') > 0) {
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt', $where); 
        $data['raks'] = $model->getAllRaks();  // Mengambil semua data rak

        // Ambil rak-rak yang sudah terisi
        $data['rak_terisi'] = $model->getRakTerisi(); // Pastikan method ini mengembalikan rak yang sudah digunakan

        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_penitipan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function penitipan()
{
    if (session()->get('level') > 0) { 
         $this->log_activity('User membuka Halaman penitipan'); ///log akt
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where = array('id_datapenitipan' => session()->get('id'));

        // Ambil data penitpan
        $data['manda'] = $model->getDataPenitipan();

        // Ambil data levels untuk jabatan
        $data['levels'] = $model->tampil('level'); // Pastikan model `M_trader` punya method `tampil('level')`

        echo view('header',$data);
        echo view('menu',$data);
        echo view('penitipan', $data);
      
    } else {
        return redirect()->to('home/login');
    }
}
public function get_user1()
{
    if ($this->request->isAJAX()) {
        $id = $this->request->getPost('id');
        $model = new M_trader(); // Pastikan model ini sesuai
        $data = $model->find($id); // Gunakan metode yang tepat untuk mendapatkan data

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
    }
}

public function aksi_tp()
{
    if(session()->get('level') > 0) { 
        $model = new M_trader();

        $nama = $this->request->getPost('nama');
      
        $no_hp = $this->request->getPost('no_hp');
        $warnahelm = $this->request->getPost('warnahelm');
        $ukuranhelm = $this->request->getPost('ukuranhelm');
         $id_rak = $this->request->getPost('id_rak');

        $isi = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'warnahelm' => $warnahelm,
            'ukuranhelm' => $ukuranhelm,
            'id_rak' => $id_rak,
        ];

        $model->tambah('data_penitipan', $isi);
        return redirect()->to('home/penitipan');
    } else {
        return redirect()->to('home/login');
    }
}


 public function aksi_tbm()
    {
        if(session()->get('level')>0){ 
        $model = new M_trader();
        $kode = $this->request->getPost('id_brg');
        $nama = $this->request->getPost('nama_brg');
        $jumlah= $this->request->getPost('jumlah');
        $tglmsk = $this->request->getPost('tglmsk');
        


        $isi=array(
            'id_brg'=>$kode,
            'nama_brg'=>$nama,
            'jumlah'=>$jumlah,
            'tglmsk'=>$tglmsk,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

            
        );

        $model= new M_trader;
        $model->tambah('barang_masuk', $isi);
        return redirect()->to ('home/bm');
    }else{
        return redirect()->to('home/login');
    }
        
}
public function show_detail($id_bm)
{
    if (session()->get('level') == 1) {
        $model = new M_trader();
         $where = array('id_pt' => 2);
         $data['setting'] = $model->getwhere('pt',$where); 
        $data['flora'] = $model->getDetail('barang_masuk', $id_bm); // Sesuaikan nama metode dan model

        echo view('header');
        echo view('menu');
        echo view('detail_barang_masuk', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login')->with('error', 'Anda tidak memiliki akses.');
    }
}


public function get_user()
{
    $id = $this->request->getPost('id');
    $model = new M_trader(); // Gunakan model yang sesuai
    $data = $model->find($id); // Ambil data berdasarkan ID

    return $this->response->setJSON($data);
}

public function laporanpenitipan()
    {
         if(session()->get('level')>0){ 
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where);
        $where=array('id_datapenitipan'=>session()->get('id'));
        $data ['manda'] = $model->tampil('data_penitipan'); 

        echo view('header',$data);
        echo view('menu',$data);
        echo view('laporanpenitipan',$data);
       
         }else{
        return redirect()->to('home/login');
    }
    }


public function update_penitipan()
{
    $id = $this->request->getPost('id_datapenitipan'); // ID penitipan
    $data = [
        'nama'        => $this->request->getPost('nama'),
        'npm'         => $this->request->getPost('npm'),
        'fakultas'    => $this->request->getPost('fakultas'),
        'jk'          => $this->request->getPost('jk'),
        'no_hp'       => $this->request->getPost('no_hp'),
        'warnahelm'   => $this->request->getPost('warnahelm'),
        'ukuranhelm'  => $this->request->getPost('ukuranhelm'),
        'id_rak'      => $this->request->getPost('id_rak'),
    ];

    // Debugging log
    log_message('debug', 'Update data penitipan: ' . print_r($data, true));

    $model = new \App\Models\M_trader();
    $update = $model->updatePenitipan($id, $data);

    if ($update) {
        return redirect()->to('home/penitipan')->with('success', 'Data penitipan berhasil diperbarui.');
    } else {
        return redirect()->to('home/penitipan')->with('error', 'Gagal memperbarui data penitipan.');
    }
}


    public function signup() {
        // Load model Level untuk mengambil daftar level (jabatan)
        $levelModel = new \App\Models\M_trader(); // Use the correct model
        $data['levels'] = $levelModel->findAll();

        // Load view untuk form sign-up
        echo view('signup', $data);
    }

    public function register()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_users' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'no_telp' => 'required',
            'id_level' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            // Tampilkan kembali form signup dengan pesan error
            $data['validation'] = $this->validator;
            return view('signup', $data);
        }

        // Ambil data dari form
        $userModel = new M_trader(); // Ensure you have a UserModel
        $userData = [
            'nama_users' => $this->request->getPost('nama_users'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_telp' => $this->request->getPost('no_telp'),
            'id_level' => $this->request->getPost('id_level'),
        ];

        // Simpan data ke tabel users
        if ($userModel->insert($userData)) {
            // Redirect ke halaman login setelah berhasil registrasi
            return redirect()->to(base_url('login'))->with('success', 'Registrasi berhasil, silakan login.');
        } else {
            // Tampilkan pesan error jika gagal menyimpan data
            return redirect()->back()->with('error', 'Gagal melakukan registrasi.');
        }
    }


 
public function rak()
    {
        if(session()->get('level')>0){ 
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where=array('id_rak'=>session()->get('id'));
        $data ['manda'] = $model->tampil('rak'); 

        echo view('header',$data);
        echo view('menu',$data);
        echo view('rak',$data);
       
         }else{
        return redirect()->to('home/login');
    }
    }



public function jenishelm()
{
    if (session()->get('level') > 0) { 
         $this->log_activity('User membuka halaman jenis helm'); ///log akt
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where = array('id_helm' => session()->get('id'));

        // Ambil data penitpan
        $data['manda'] = $model->tampil('jenishelm');

        // Ambil data levels untuk jabatan
        $data['levels'] = $model->tampil('level'); // Pastikan model `M_trader` punya method `tampil('level')`

        echo view('header',$data);
        echo view('menu',$data);
        echo view('jenishelm', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}


public function users()
{
    if (session()->get('level') > 0) { 
         $this->log_activity('User membuka halaman daftar users'); ///log akt
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where = array('id_user' => session()->get('id'));

        // Ambil data users
        $data['manda'] = $model->tampil('user');

        // Ambil data levels untuk jabatan
        $data['levels'] = $model->tampil('level'); // Pastikan model `M_trader` punya method `tampil('level')`

        echo view('header',$data);
        echo view('menu',$data);
        echo view('users', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function aksireset()
    {
        $model = new M_trader();
        $id = $this->request->getPost('id');
        
        $where= array('id_users'=>$id);
           
        $isi = array(

            'password' => md5('12345')
            
            
        );
        $model->edit('users', $isi,$where);

        return redirect()->to('Home/users');
        
        
        
    }

    public function edit_pt()
    {
        $model = new M_trader();
        $id = $this->request->getPost('id');
        $pt = $this->request->getPost('nama_pt');
        $uploadedFile = $this->request->getFile('logo');
        $where = array('id_pt' => $id);
        
        // Initialize the array with non-file fields
        $isi = array(
            'nama_pt' => $pt,
        );
        
        // Check if a file was uploaded and is valid
        if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $foto = $uploadedFile->getName();
            $model->uploaded($uploadedFile); // Upload the new file
            $isi['logo'] = $foto; // Add the new file name to the array data
        }
        
        // Update the record in the database
        $model->edit('pt', $isi, $where);
    
        return redirect()->to('Home/pt');
    }
    
   
  public function t_u()
    {
         if(session()->get('level')>0){ 
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where=array('id_user'=>session()->get('id'));
        $data ['manda'] = $model->tampil('user'); 
        $data['levels'] = $model->getLevels(); 


        echo view('header',$data);
        echo view('menu',$data);
        echo view('t_u',$data);
        echo view('footer');
         }else{
        return redirect()->to('home/login');
    }
    }


public function aksi_tu()
    {
        if(session()->get('level')>0){ 
        $model = new M_trader();
      
      
        $nama= $this->request->getPost('nama');
      
        $no_telp= $this->request->getPost('no_hp');
        $idlevel= $this->request->getPost('id_level');
        
        


        $isi=array(
            'nama'=>$nama,
            
            'no_hp'=>$no_telp,
            'id_level'=>$idlevel,
             
            
        );

        $model= new M_trader;
        $model->tambah('user', $isi);
        return redirect()->to ('home/users');
    }else{
        return redirect()->to('home/login');
    }
        
}

  
public function delete_users($id)
    {
        $model = new M_trader;
        $where = array('id_user' => $id);
        $model->hapus('user', $where);
        return redirect()->to('home/users');
    }


public function setting()
    {
        // if(session()->get('level')>0) {
        // $model = new M_trader();
        // $where=array('id_user'=session()->get('id'));

        echo view('header');
        echo view('menu');
        echo view('setting');
        echo view('footer');

    // }else{
    //  return redirect()->to('home/login');

       
}
public function reset_password()
{
    $id = $this->request->getPost('id_users');
    $model = new M_traders(); // Sesuaikan dengan nama model yang benar

    // Logika untuk mereset password
    $new_password = 'default_password'; // Ganti dengan logika pengaturan password yang aman
    $data = ['password' => password_hash($new_password, PASSWORD_BCRYPT)];

    if ($model->update($id, $data)) {
        return $this->response->setJSON(['status' => 'success', 'message' => 'Password berhasil direset']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Password gagal direset']);
    }
}

 
 public function login()
    {
        
        session()->destroy();
        return redirect()->to('login', $data);
    }
    public function generateCaptcha()
    {
        // Create a string of possible characters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $captcha_code = '';
        
        // Generate a random CAPTCHA code with letters and numbers
        for ($i = 0; $i < 6; $i++) {
            $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Store CAPTCHA code in session
        session()->set('captcha_code', $captcha_code);
        
        // Create an image for CAPTCHA
        $image = imagecreate(120, 40); // Increased size for better readability
        $background = imagecolorallocate($image, 200, 200, 200);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $line_color = imagecolorallocate($image, 64, 64, 64);
        
        imagefilledrectangle($image, 0, 0, 120, 40, $background);
        
        // Add some random lines to the CAPTCHA image for added complexity
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
        }
        
        // Add the CAPTCHA code to the image
        imagestring($image, 5, 20, 10, $captcha_code, $text_color);
        
        // Output the CAPTCHA image
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
    
 public function aksi_login()
{
    $session = session();
    $model = new M_trader();
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if ($session->get('captcha_code') !== $captcha_code) {
            $session->setFlashdata('toast_message', 'Invalid CAPTCHA');
            $session->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6Lc3hiAqAAAAAF_9qCtiHo9IdUW8zlzjMQIETuPV'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            $session->setFlashdata('toast_message', 'Captcha validation failed');
            $session->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }

    // Proses login seperti biasa
    $user = $model->getWheres('users', ['nama_users' => $u]);

    if ($user) {
        $lock_time = $user['lock_time'];
        $current_time = date('Y-m-d H:i:s');

        // Periksa apakah akun terkunci
        if ($lock_time && strtotime($current_time) < strtotime($lock_time) + 5 * 60) { // 5 menit terkunci
            $remaining_time = (strtotime($lock_time) + 5 * 60) - strtotime($current_time);
            $minutes = floor($remaining_time / 60);
            $seconds = $remaining_time % 60;
            $session->setFlashdata('toast_message', "Akun terkunci. Coba lagi dalam $minutes menit dan $seconds detik.");
            $session->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }

        $where = array(
            'nama_users' => $u,
            'password' => md5($p),
        );
    
        $cek = $model->getWhere('users', $where);

        // Validasi password menggunakan password_verify
        if ($cek) {
            // Reset jumlah percobaan login jika berhasil
            $model->edit('users', ['login_attempts' => 0, 'lock_time' => null], ['id_users' => $user['id_users']]);

            // Set session dan redirect ke dashboard
            $session->set('nama', $user['nama_users']);
            $session->set('id', $user['id_users']);
            $session->set('level', $user['id_level']);
            return redirect()->to('home/dashboard');
        } else {
            // Tambahkan jumlah percobaan login
            $attempts = $user['login_attempts'] + 1;
            $data = ['login_attempts' => $attempts];

            // Kunci akun jika 3 kali percobaan gagal
            if ($attempts >= 3) {
                $data['lock_time'] = date('Y-m-d H:i:s');
                $session->setFlashdata('toast_message', 'Akun terkunci karena 3 kali percobaan gagal. Coba lagi setelah 5 menit.');
            } else {
                $session->setFlashdata('toast_message', 'Password salah. Percobaan ke-' . $attempts);
            }

            $model->edit('users', $data, ['id_users' => $user['id_users']]);
            $session->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika pengguna tidak ditemukan
        $session->setFlashdata('toast_message', 'Nama pengguna tidak ditemukan');
        $session->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}


    
    public function checkInternetConnection()
    {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }
   
public function logonama() {
    if (session()->get('level') == 1 || session()->get('level') == 0) {
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        // Menentukan id_toko yang ingin diambil
        $id = 1; // id_toko yang diinginkan
        
        // Mengambil data dari tabel 'toko' berdasarkan id_toko
        $data['setting'] = $model->getWhere('toko', ['id_toko' => $id]);
        
        echo view('header',$data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}


public function aksietoko()
{
    $model = new M_trader();
    $nama = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = ['id_toko' => $id];

    $isi = [
        'nama_toko' => $nama
    ];

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('toko', $isi, $where);

    return redirect()->to('home/setting/'.$id);
}

public function aksi_reset($id)
{
    $model = new M_trader();

    $where= array('id_users'=>$id);

    $isi = array(

        'password' => md5('123')      

    );
    $model->editpw('users', $isi,$where);

    return redirect()->to('home/users');



}


    public function logout()
    {
        $model = new M_trader();
        $where = ['id_users' => session()->get('id_users')];

    $isi = [
        'logout_time' => date('Y-m-d H:i:s')
    ];
        $model->edit('hs_login', $isi, $where);
        session()->destroy();
        return redirect()->to('home/login');
    }


public function riwayat_login()
{
    $model = new M_trader();
    $data['logins'] = $model->tampil('hs_login');
    
    echo view('menu');
    echo view('header');
    echo view('hslogin', $data);
    
}

public function activity(){
     $this->log_activity('User membuka halaman riwayat_login'); ///log akt
    $model = new M_trader();
    $where = array('id_pt' => 2);
    $data['setting'] = $model->getwhere('pt',$where);
    $data['activity'] = $model->join('activity','users','activity.id_user = users.id_users');
    echo view('menu',$data);
    echo view('header',$data);
    echo view('activity', $data);
}

}

   