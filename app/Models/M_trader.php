<?php namespace App\Models;

use CodeIgniter\Model;

class M_trader extends Model
{
    // Properties for the `barang_keluar` table
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_bk';
    protected $allowedFields = ['id_bk', 'id_brg', 'nama_brg', 'jumlah', 'tgl_klr', 'created_at', 'updated_at'];

    // Method to get all data from `barang_keluar`
    public function get_all_barang_keluar()
    {
        return $this->db->table($this->table)
                        ->get()
                        ->getResult();
    }

    // Properties for the `pesanan` table
    protected $table_pesanan = 'pesanan';
    protected $primaryKey_pesanan = 'id_pesanan';
    protected $allowedFields_pesanan = ['nama_brg', 'berat', 'Qty', 'alamat', 'tgl_pesan', 'tgl_kirim', 'status_pesanan', 'total_harga'];

    // Method to get all data from `pesanan`
    public function getAllPesanan()
    {
        return $this->db->table($this->table_pesanan)
                        ->get()
                        ->getResult();
    }
    public function update_schedule($id, $data)
    {
        return $this->update($id, $data);  // Use update method to update data
    }
    // Methods for other functionalities...
protected $table_history_hapus = 'history_hapus';
    protected $primaryKey_history_hapus = 'id_hps';
    protected $allowedFields_history_hapus = ['id_users', 'table_name', 'record_id', 'deleted_data', 'deleted_at'];

    public function logDelete($userId, $tableName, $recordId, $data)
    {
        $this->db->table($this->table_history_hapus)->insert([
            'id_users' => $userId,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'deleted_data' => json_encode($data),
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
    public function tambahPengumuman($data)
{
    return $this->db->table('pengumuman')->insert($data);
}
  public function tampil($table)
{
    return $this->db->table($table)->get()->getResult();
}
public function getSchedulesWithUsers()
{
    $builder = $this->db->table('schedules'); // Mendapatkan Query Builder untuk tabel schedules
    $builder->select('schedules.*, users.nama_users as created_by_name'); // Pilih kolom yang akan diambil
    $builder->join('users', 'schedules.created_by = users.id_users', 'left'); // Gabungkan dengan tabel users
    $query = $builder->get(); // Eksekusi query
    return $query->getResult(); // Kembalikan hasil query
}

    
      public function getAllPengumuman() {
        // Ambil semua data pengumuman dari tabel 'pengumuman'
        return $this->db->get('pengumuman')->result_array();
    }
public function getAnnouncementsWithUsers()
{
    $this->db->select('announcements.*, users.nama_users');
    $this->db->from('announcements');
    $this->db->join('users', 'announcements.created_by = users.id_users', 'left'); // Left join untuk mencocokkan id_users
    $query = $this->db->get();
    return $query->result();
}


    public function join($tabel, $tabel2, $on)
    {
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->get()
                        ->getResult();
    }

    public function getLevels()
    {
        return $this->db->table('level')->select('id_level, nama_level')->get()->getResult();
    }

    public function countAll($table)
    {
        return $this->db->table($table)->countAllResults();
    }

    public function joinWhere($tabel, $tabel2, $on, $where)
    {
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->getWhere($where)
                        ->getRow();
    }

    public function getWhere($tabel, $where)
    {
        $query = $this->db->table($tabel)
                          ->getWhere($where);

        if (!$query) {
            log_message('error', 'Query failed for table: ' . $tabel);
            return false; // Handle the error as needed
        }

        return $query->getRow();
    }
public function get_all_pengumuman() {
        // Fetch all pengumuman data from the database
        $query = $this->db->get('pengumuman'); // Assuming 'pengumuman' is your table name
        return $query->result();
    }
    public function getWheres($tabel, $where)
{
    $query = $this->db->table($tabel)
                      ->getWhere($where);

    if (!$query) {
        log_message('error', 'Query failed for table: ' . $tabel);
        return false; // Handle the error as needed
    }

    return $query->getRowArray();
}

    public function editpw($tabel, $isi, $where)
    {
        return $this->db->table($tabel)
                        ->update($isi, $where);
    }

    public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where)
    {
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->orderby($id, 'desc')
                        ->getWhere($where);
    }

    public function tambah($tabel, $isi)
    {
        return $this->db->table($tabel)
                        ->insert($isi);
    }

    public function edit($tabel, $isi, $where)
    {
        return $this->db->table($tabel)
                        ->update($isi, $where);
    }
public function hapus($table, $where)
    {
        return $this->db->table($table)
                        ->delete($where);
    }


    public function insert_user($data)
    {
        return $this->db->table('users')->insert($data);
    }

    public function get_all_users()
    {
        return $this->db->table('users')->get()->getResult();
    }

    public function getWhere1($tabel, $where)
    {
        return $this->db->table($tabel)
                        ->where($where)
                        ->get()
                        ->getRow();
    }

    public function getWhere1nel($tabel, $where)
    {
        return $this->db->table($tabel)
                        ->where($where)
                        ->get()
                        ->getResult();
    }

    public function uploaded($file)
    {
        $imageName = $file->getName();
        $file->move(ROOTPATH . 'public/images', $imageName);
    }

    public function getLoginHistoryByUserId($userId)
    {
        $loginModel = new \App\Models\HsLoginModel();
        return $loginModel->where('id_users', $userId)->orderBy('login_time')->findAll();
    }

    public function joinWherenel($tabel, $tabel2, $on, $where)
    {
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->where($where)
                        ->get()
                        ->getResult();
    }
    public function getPesanan($userId, $userLevel)
{
    if ($userLevel == 1) { // Admin can see all data
        return $this->db->table('hs_pesan')
                        // ->select('hs_pesan.kode_hs_pesan, hs_pesan.id_makanan, barang.nama_brg, hs_pesan.jumlah, users.nama_users, hs_pesan.total_harga, hs_pesan.catatan, hs_pesan.metode_pembayaran, hs_pesan.alamat_pengiriman, hs_pesan.created_at, hs_pesan.updated_at, hs_pesan.status_admin, hs_pesanstatus_transit')
                        ->join('barang', 'barang.id_brg=hs_pesan.id_makanan', 'left')
                        ->join('users', 'users.id_users=hs_pesan.id_users', 'left')
                        ->get()
                        ->getResult();
    } else { // Trader can see only their data
        return $this->db->table('hs_pesan')
                        ->join('barang', 'barang.id_brg=hs_pesan.id_makanan', 'left')
                        ->join('users', 'users.id_users=hs_pesan.id_users', 'left')
                        ->where('hs_pesan.id_users', $userId)
                        ->get()
                        ->getResult();
    }
}
public function insert_barang($data) {
        $this->db->insert('barang', $data);
    }


    public function get_all_barang() {
        return $this->db->get('barang')->result();
    }

    public function updateStatus($id_pesanan, $status)
    {
        return $this->db->table($this->table_pesanan)
                        ->update(['status_pengiriman' => $status], ['id_pesanan' => $id_pesanan]);
    }

    public function restoreProduct($table,$column,$id)
{
    // Ambil data dari tabel backup
    $backupData = $this->db->table($table)->where($column, $id)->get()->getRowArray();

    if ($backupData) {
        // Tentukan nama tabel utama tempat data akan di-restore
        $mainTable = str_replace('_backup', '', $table);

        // Update data di tabel utama
        $this->db->table($mainTable)->where($column, $id)->update($backupData);
    }
}

public function softdelete1($table,$kolom, $noTrans)
{
    
    $this->db->table($table)->update(['deleted_at' => date('Y-m-d H:i:s')], [$kolom => $noTrans]);

   
}

public function restore1($table,$kolom,$noTrans)
{
    
    $this->db->table($table)->update(['deleted_at' => Null], [$kolom => $noTrans]);
   
}

public function tampilwhere($tabel){
    return $this->db->table($tabel)
                    ->getwhere('deleted_at IS NOT NULL')
                    ->getResult();
}

public function tampilwherenull($tabel){
    return $this->db->table($tabel)
                    ->getwhere('deleted_at IS NULL')
                    ->getResult();
}
    
}
