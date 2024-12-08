<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
            <h3>Halaman Data Jenis Helm</h3>
            <p class="text-subtitle text-muted">Berikut ini adalah data jenis helm <?=$title?></p>
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
            <div class="form-group">
              <a href="<?=base_url('home/t_jenishelm')?>">
                <button class="btn btn-success">Tambah Data Jenis Helm</button>
              </a>
              <a href="<?=base_url('home/print_jenishelm')?>">
                <button class="btn btn-danger" id="printButton">Print Data Jenis Helm</button>
              </a>
            </div>
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Warna Helm</th>
                  <th>Ukuran Helm</th>
                  <th>Kondisi</th>
                  <th>Keterangan</th>  
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($manda as $flora) {
                  // Cari nama jabatan berdasarkan id_level
                  $jabatanNama = 'Tidak Diketahui';
                  foreach ($levels as $level) {
                    if ($level->id_level == $flora->id_level) {
                      $jabatanNama = $level->nama_level;
                      break;
                    }
                  }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $flora->nama_helm ?></td>
                  <td><?= $flora->warna_helm ?></td>
                  <td><?= $flora->ukuran_helm ?></td>
                  <td><?= $flora->kondisi_helm ?></td>
                   <td><?= $flora->keterangan ?></td>
                  <td>
                    <!-- Detail Button -->
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_helm ?>">Detail</button>
                    <button class="btn btn-warning btn-sm" href="aksireset" data-id="<?= $flora->id_helm ?>" id="resetPasswordBtn">Reset Password</button>
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Jenis Helm </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userDetailForm" action="<?= base_url('home/update_penitipan') ?>" method="POST">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="nama_helm">Nama</label>
            <input type="text" class="form-control" id="nama_helm" name="nama_helm" value="<?= $flora->nama_helm?>" required>
          </div>
          <div class="form-group">
            <label for="warna_helm">Warna Helm</label>
            <input type="text" class="form-control" id="warna_helm" name="warna_helm" value="<?= $flora->warna_helm?>" required>
          </div>
          <div class="form-group">
            <label for="ukuran_helm">Ukuran</label>
           <input type="text" class="form-control" id="ukuran_helm" name="ukuran_helm" value="<?= $flora->ukuran_helm?>" required>
          </div>
        <div class="form-group">
            <label for="kondisi_helm">Kondisi</label>
           <input type="text" class="form-control" id="kondisi_helm" name="kondisi_helm" value="<?= $flora->kondisi_helm?>" required>
          </div>
          <div class="form-group">
            <label for="keterangan">keterangan</label>
           <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $flora->keterangan?>" required>
          </div>
          <div class="form-group d-inline-block">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="<?= base_url('home/delete_helm/'.$flora->id_helm) ?>" class="btn btn-danger">Hapus</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#detailModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var userId = button.data('id');

      $.ajax({
        url: '<?= base_url('home/get_user') ?>', // Update URL jika perlu
        method: 'POST',
        data: { id: userId },
        dataType: 'json',
        success: function(data) {
          $('#user_id').val(data.id_users);
          $('#nama_helm').val(data.nama_helm);
          $('#warna_helm').val(data.warna_helm);
          $('#ukuran_helm').val(data.ukuran_helm);
          $('#kondisi_helm').val(data.kondisi_helm);
          $('#keterangan').val(data.keterangan);
                 }
      });
    });
  });
</script>
