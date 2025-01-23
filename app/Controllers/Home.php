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

    public function print_u() {
    // Check if the user is logged in and has the correct level
    if (session()->get('level') > 0) {
        // Load the model
        $model = new M_trader(); 

        // Fetch all data from the barang_keluar table
        $data['manda'] = $model->findAll(); 

        // Load the view with the fetched data
        return view('print_u', $data); 
    } else {
        // Redirect to login page if the user doesn't have the correct level
        return redirect()->to('home/login');
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



public function users()
{
    if (session()->get('level') > 0) { 
         $this->log_activity('User membuka halaman daftar users'); ///log akt
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where = array('id_users' => session()->get('id'));

        // Ambil data users
        $data['manda'] = $model->tampil('users');

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
public function schedules()
{
    // Periksa apakah user memiliki akses
    if (session()->get('level') > 0) {
        $this->log_activity('User membuka halaman daftar jadwal'); // Logging aktivitas

        // Load model
        $model = new M_trader();

        // Ambil data dari tabel schedules dengan JOIN ke tabel users
        $data['schedules'] = $model->getSchedulesWithUsers();

        // Beri judul untuk halaman
        $data['title'] = 'Jadwal Bel';

        // Load view
        echo view('header', $data);
        echo view('menu', $data);
        echo view('schedules', $data);

    } else {
        return redirect()->to('home/login');
    }
}
public function toggle_alarm($id) {
    // Ambil jadwal berdasarkan ID
    $schedule = $this->Schedule_model->get_schedule($id);
    
    // Toggle status alarm
    $newStatus = ($schedule->status == 'active') ? 'inactive' : 'active';
    
    // Update status alarm di database
    $this->Schedule_model->update_status($id, $newStatus);
    
    // Redirect kembali setelah mengupdate status
    redirect('home/schedule');
}

 public function t_jadwal()
    {
         if(session()->get('level')>0){ 
        $model = new M_trader();
        $where = array('id_pt' => 2);
        $data['setting'] = $model->getwhere('pt',$where); 
        $where=array('id_users'=>session()->get('id'));
        $data ['manda'] = $model->tampil('schedules'); 
        $data['levels'] = $model->getLevels(); 


        echo view('header',$data);
        echo view('menu',$data);
        echo view('t_jadwal',$data);
     
         }else{
        return redirect()->to('home/login');
    }
    }
   public function del_jadwal($id)
{
    $model = new M_trader();
    $where = array('id' => $id);
    $model->hapus('schedules', $where); // Delete the schedule with the provided ID
    return redirect()->to('home/schedules'); // Redirect back to the schedule list
}

public function aksi_tj()
{
    if (session()->get('level') > 0) { 
        $model = new M_trader();

        // Mengambil data dari POST
        $nama = $this->request->getPost('event_name');
        $time = $this->request->getPost('time');
        $repeat = $this->request->getPost('repeat'); // Waktu pengulangan (daily/weekly)
        $days_of_week = $this->request->getPost('days_of_week'); // Hari-hari (Senin-Jumat)

        // Menyusun data untuk disimpan
        $isi = array(
            'event_name' => $nama,
            'time' => $time,
            'repeat' => $repeat, // Menyimpan pilihan waktu pengulangan
            'day_of_week' => implode(',', $days_of_week), // Menggabungkan array hari menjadi string
            'created_by' => 1 // Menambahkan created_by dengan nilai 1
        );

        // Menyimpan data ke dalam tabel 'schedules'
        $model->tambah('schedules', $isi);

        // Redirect ke halaman jadwal
        return redirect()->to('home/schedules');
    } else {
        return redirect()->to('home/login');
    }
}

public function toggle_alarm_duration($schedule_id) {
    $duration_type = $this->input->post('duration_type');
    $duration_value = $this->input->post('duration_value');

    // Proses durasi dan matikan alarm sesuai durasi
    // Misalnya jika durasi adalah 1 minggu, 1 hari, dsb
    // Anda bisa menyimpan durasi dalam database dan atur alarm

    // Misalnya dengan menggunakan `scheduled_time` yang sudah disesuaikan

    // Kirim respon sukses
    echo json_encode(['status' => 'success']);
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
        $where=array('id_users'=>session()->get('id'));
        $data ['manda'] = $model->tampil('users'); 
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
      
      
        $nama= $this->request->getPost('nama_users');
        $email= $this->request->getPost('email');
        $password= md5($this->request->getPost('password'));
        $no_telp= $this->request->getPost('no_telp');
        $idlevel= $this->request->getPost('id_level');
        
        


        $isi=array(
            'nama_users'=>$nama,
            'email'=>$email,
            'password'=>$password,
            'no_telp'=>$no_telp,
            'id_level'=>$idlevel,
             
            
        );

        $model= new M_trader;
        $model->tambah('users', $isi);
        return redirect()->to ('home/users');
    }else{
        return redirect()->to('home/login');
    }
        
}
public function update_jadwal()
{
    // Retrieve the data from the form
    $scheduleId = $this->request->getPost('schedule_id');
    $eventName = $this->request->getPost('event_name');
    $time = $this->request->getPost('time');
    $repeat = $this->request->getPost('repeat');
    $dayOfWeek = $this->request->getPost('day_of_week');
    
    // Validate input data
    if ($scheduleId && $eventName && $time && $repeat) {
        $model = new M_schedule();
        $data = [
            'event_name' => $eventName,
            'time' => $time,
            'repeat' => $repeat,
            'day_of_week' => $dayOfWeek
        ];
        $where = ['id' => $scheduleId];
        
        // Update the schedule data in the database
        $model->update($scheduleId, $data);
        return redirect()->to('home/schedules'); // Redirect to the schedule list
    } else {
        // Handle validation failure
        return redirect()->back()->with('error', 'Data tidak valid');
    }
}
public function delete_users($id)
    {
        $model = new M_trader;
        $where = array('id_users' => $id);
        $model->hapus('users', $where);
        return redirect()->to('home/users');
    }

    public function delete_jadwal($id)
    {
        $model = new M_trader;  // Pastikan model ini sesuai untuk tabel schedules
        $where = array('id' => $id);  // Gunakan 'id' untuk menghapus berdasarkan ID jadwal
        $model->hapus('schedules', $where);  // 'schedules' adalah nama tabel untuk jadwal
        return redirect()->to('home/schedules');
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

public function forgot_password_action()
{
    $email = $this->request->getPost('email');

    // Validate the email and handle the password reset logic here
    // For now, we'll just simulate success
    
    session()->setFlashdata('message', 'Check your email for the password reset instructions.');

    return redirect()->to('/home/lppw'); // Redirect back to the form with a message
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
        return redirect()->to('login');
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



