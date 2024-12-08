<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
            <h4>Halaman Laporan Penitipan Helm Kendaraan Bermotor</h4>
            <p class="text-subtitle text-muted">Berikut ini adalah laporan penitipan helm kendaraan bermotor yang telah dilakukan oleh pengguna.</p>
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
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                
                  <th>Nomor Telepon</th>  
                  <th>Warna Helm</th>
                  <th>Ukuran Helm</th>  
                  <th>Nomor Rak</th>  
                  <th>Tanggal Penitipan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($manda as $flora) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $flora->nama ?></td>
                   
                    <td><?= $flora->no_hp ?></td>
                    <td><?= $flora->warnahelm ?></td>
                    <td><?= $flora->ukuranhelm ?></td>
                    <td><?= $flora->id_rak ?></td>
                    <td><?= date('d-m-Y', strtotime($flora->created_at)) ?></td> <!-- Menampilkan tanggal penitipan -->
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>

          <!-- Tombol untuk membuka modal download -->
          <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#downloadModal">
              <i class="fa fa-download"></i> Download Laporan
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal Pilihan Format Download -->
    <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="downloadModalLabel">Pilih Format Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('home/export_laporanpenitipan') ?>" method="get">
              <div class="form-group">
                <label for="format">Pilih Format Laporan</label>
                <select name="format" id="format" class="form-control">
                  <option value="pdf">PDF</option>
                  <option value="csv">CSV</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
