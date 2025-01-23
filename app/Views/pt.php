<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit data profile</title>
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
                        <h3>Halaman Data Profile</h3>
                        <p class="text-subtitle text-muted">Edit detail  <?=$title?></p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <!-- Breadcrumb jika diperlukan -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('home/edit_pt') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_pt" value="<?= $setting->id_pt ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_pt" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama_pt" name="nama_pt" value="<?= $setting->nama_pt ?>" required>
                            </div>

                           <!--  <div class="col-md-6 mb-3">
                                <label for="nama_pemimpin" class="form-label">Nama Pemimpin</label>
                                <input type="text" class="form-control" id="nama_pemimpin" name="nama_pemimpin" value="<?= $setting->nama_pemimpin ?>" required>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="logo" class="form-label">Logo Perusahaan</label>
                                <input type="file" class="form-control" id="logo" name="logo" value="<?= $setting->logo?>">
                                <!-- Tampilkan logo yang sudah ada jika ada -->
                                <?php if (!empty($setting->logo)): ?>
                                    <img src="<?= base_url('images/' . $setting->logo) ?>" alt="Logo Perusahaan" style="max-width: 100px; margin-top: 10px;">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" value="<?=$setting->id_pt?>" name="id">
<!--  intput
                            <div class="col-md-6 mb-3">
                                <label for="alamat_pt" class="form-label">Alamat Perusahaan</label>
                                <textarea class="form-control" id="alamat_pt" name="alamat_pt" rows="4" required><?= $setting->alamat_pt ?></textarea>
                            </div>
                        </div>
 -->

                        
                    </form>
                    <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                </div>
            </div>
        </section>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
