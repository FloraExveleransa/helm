<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
            <h3>Halaman Data Ketersediaan Rak Helm</h3>
            <p class="text-subtitle text-muted">Berikut ini adalah data rak helm <?=$title?></p>
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
              <a href="<?=base_url('home/t_rak')?>">
                <button class="btn btn-success">Tambah Data Rak</button>
              </a>
             
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Rak</th>
                  <th>Status</th>
                  <th>Aksi</th>
                 
                </tr>
              </thead>
             <tbody>
  <?php
  $no = 1;
  foreach ($manda as $flora) {
  ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $flora->nomor ?></td>
    <td><?= $flora->status ?></td>

    <td>
      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_rak ?>">Detail</button>

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
        <h5 class="modal-title" id="detailModalLabel">Detail Rak </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userDetailForm" action="<?= base_url('home/update_penitipan') ?>" method="POST">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="nomor">Nama Rak</label>
            <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $flora->nomor?>" required>
          </div>
          <div class="form-group">
            <label for="status">Status Rak</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= $flora->status?>" required>
          </div>
          
          <div class="form-group d-inline-block">
            <button type="submit" class="btn btn-danger">Simpan</button>
           <a href="<?= base_url('home/delete_rak/' . $flora->id_rak) ?>" class="btn btn-danger">Hapus</a>

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
    var userId = button.data('id'); // Ambil ID dari tombol yang diklik

    $.ajax({
      url: '<?= base_url('home/get_user') ?>', // URL untuk mengambil data detail
      method: 'POST',
      data: { id: userId }, // Kirim ID ke server
      dataType: 'json',
      success: function(data) {
        // Update input form di modal dengan data dari server
        $('#user_id').val(data.id_rak);
        $('#nomor').val(data.nomor);
       $('#status').val(data.status);
      },
      error: function(xhr, status, error) {
        console.error('Error: ' + error); // Debugging jika terjadi error
      }
    });
  });

  



</script>
