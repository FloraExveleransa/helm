<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>

  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

  <!-- Bootstrap for layout -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">

  <link rel="shortcut icon" href="images/pt.jpg" />

  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Arial', sans-serif;
    }
    .navbar {
      background-color: #fff;
      border-bottom: 1px solid #ddd;
    }
    .navbar a {
      color: #333 !important;
      padding: 15px 20px;
      font-size: 16px;
    }
    .navbar a:hover {
      background-color: #f0f0f0;
      border-radius: 4px;
    }
    .nav-item {
      margin: 0 10px;
    }
    .container {
      margin-top: 30px;
    }
    .card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border: none;
      background-color: #fff;
    }
    .card-header {
      background-color: #f5f5f5;
      color: #333;
      font-weight: bold;
      border-bottom: 1px solid #ddd;
    }
    .card-body {
      padding: 20px;
    }
    .btn-custom {
      background-color: #e0e0e0;
      color: #333;
      font-size: 16px;
      margin-top: 10px;
      transition: background-color 0.3s;
      border: 1px solid #ddd;
    }
    .btn-custom:hover {
      background-color: #d6d6d6;
    }
    .form-section {
      margin-bottom: 20px;
    }
    .form-section h5 {
      margin-bottom: 15px;
    }
    .form-group {
      margin-bottom: 15px;
    }
  </style>
</head>

<body>

  <!-- Main content -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Aplikasi Penitipan Helm Kendaraan Bermotor</h4>
          </div>
          <div class="card-body">
            
            <div class="form-section">
              <h5>Menu Utama</h5>
              <div class="row">
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="penitipan" class="btn btn-custom btn-block"><i class="fas fa-box"></i> Data Penitipan</a>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="users" class="btn btn-custom btn-block"><i class="fas fa-users"></i> Daftar Users</a>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="jenishelm" class="btn btn-custom btn-block"><i class="fas fa-helmet-safety"></i> Jenis Helm</a>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="laporanpenitipan" class="btn btn-custom btn-block"><i class="fas fa-chart-line"></i> Laporan Penitipan</a>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="pt" class="btn btn-custom btn-block"><i class="fas fa-cogs"></i> Edit Profile Aplikasi</a>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <a href="rak" class="btn btn-custom btn-block"><i class="fas fa-warehouse"></i> Daftar Rak Helm</a>
                </div>
              </div>
            </div>
            
            <!-- Add more sections if needed -->
            <div class="form-section">
              <h5>Informasi Tambahan</h5>
             <div class="form-section">
  <h5>Peraturan Penitipan Helm Kendaraan Bermotor</h5>
  <ul>
    <li>Setiap helm yang dititipkan harus dalam kondisi baik dan layak pakai.</li>
    <li>Pengguna wajib memberikan informasi yang akurat terkait helm yang dititipkan, termasuk jenis dan nomor identitas kendaraan.</li>
    <li>Pihak pengelola tidak bertanggung jawab atas kerusakan atau kehilangan helm yang tidak dicatat secara resmi dalam sistem.</li>
    <li>Helm yang tidak diambil dalam waktu lebih dari 7 hari setelah tanggal pengambilan yang disepakati akan dianggap abandoned dan dapat dilelang atau dibuang sesuai kebijakan.</li>
  </ul>

  <h5>Syarat-syarat Penitipan Helm</h5>
  <ol>
    <li>Helm harus disertai dengan bukti pembayaran atau tiket penitipan.</li>
    <li>Pemilik helm wajib menyerahkan identitas diri berupa KTP atau identitas resmi lainnya.</li>
    <li>Hanya helm dalam kondisi utuh tanpa modifikasi yang akan diterima.</li>
    <li>Pemilik harus memastikan helm yang dititipkan sesuai dengan jenis kendaraan yang dimiliki (misalnya, helm motor pribadi). Helm untuk kendaraan lain tidak akan diterima.</li>
    <li>Penitipan helm hanya berlaku pada jam operasional yang telah ditentukan oleh pihak pengelola.</li>
  </ol>
</div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
