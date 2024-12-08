<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Barang Masuk</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Tambah Data Penitipan Baru</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Tambah Data Penitipan Baru</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Penitipan Baru</h5>

              <!-- Horizontal Form -->
              <form action="<?= base_url('home/aksi_tp') ?>" method="POST">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Penitip</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama penitip" required>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="no_hp" class="col-sm-2 col-form-label">No Telp</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="warnahelm" class="col-sm-2 col-form-label">Warna Helm</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="warnahelm" name="warnahelm" required>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="ukuranhelm" class="col-sm-2 col-form-label">Ukuran Helm</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="ukuranhelm" name="ukuranhelm" required>
                  </div>
                </div>

<div class="form-group">
  <label for="id_rak">Nomor Rak</label>
  <select class="form-control" id="id_rak" name="id_rak" required>
    <option value="" disabled selected>Pilih Nomor Rak</option>
    <?php foreach ($raks as $rak): ?>
      <option value="<?= $rak->id_rak ?>"><?= $rak->nomor ?></option>
    <?php endforeach; ?>
  </select>
</div>

                

                <div class="text-center">
                  <button type="submit" class="btn btn-primary"  href="bm"> Simpan</button>
                  <button type="reset" class="btn btn-secondary" href="bm">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
