<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Users</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .main-panel {
      padding: 20px;
    }
    .content-wrapper {
      background: #f5f5f5;
      padding: 20px;
      border-radius: 8px;
    }
    .breadcrumb-header {
      background: #007bff;
      color: #fff;
      padding: 10px;
      border-radius: 4px;
    }
    .breadcrumb-header a {
      color: #fff;
      text-decoration: none;
    }
    .card {
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }
  </style>
</head>
<body>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>Tambah Data Users</h3>
              <p class="text-subtitle text-muted">Form untuk menambah data pengguna</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <!-- Breadcrumb jika diperlukan -->
              </nav>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Tambah Data Users -->
      <section class="section">
        <div class="card">
          <div class="card-body">
            <form action="<?= base_url('home/aksi_tu') ?>" method="POST">
              <div class="row mb-3">
                <label for="nama_users" class="col-sm-2 col-form-label">Nama Users</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_users" name="nama_users" placeholder="Masukkan nama users" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="id_level" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                  <select class="form-control" id="id_level" name="id_level" required>
                    <option value="">Pilih Jabatan</option>
                    <?php foreach ($levels as $level): ?>
                      <option value="<?= $level->id_level ?>"><?= $level->nama_level ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
