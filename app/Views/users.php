<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
            <h3>Halaman Data Users</h3>
            <p class="text-subtitle text-muted">Berikut ini adalah data users <?=$title?></p>
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
              <a href="<?=base_url('home/t_u')?>">
                <button class="btn btn-success">Tambah Data users</button>
              </a>
              <a href="<?=base_url('home/print_u')?>">
                <button class="btn btn-danger" id="printButton">Print Data users</button>
              </a>
            </div>
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                
                  <th>Nomor Telepon</th>
                  <th>Status</th>
                  <th>Aksi</th>  
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
                  <td><?= $flora->nama ?></td>
                  <td><?= $flora->no_hp ?></td>
                  <td><?= $jabatanNama ?></td>
                  <td>
                    <!-- Detail Button -->
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_user ?>">Detail</button>
                   <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_user ?>">Change Password</button>
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
        <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userDetailForm" action="<?= base_url('home/update_u') ?>" method="POST">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $flora->nama?>" required>
          </div>
         
          <div class="form-group">
            <label for="no_hp">Nomor Telepon</label>
           <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $flora->no_hp?>" required>
          </div>
          <div class="form-group">
            <label for="id_level">Jabatan</label>
            <select class="form-control" id="id_level" name="id_level">
              <?php foreach ($levels as $level): ?>
                <option value="<?= $level->id_level ?>"><?= $level->nama_level ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group d-inline-block">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="<?= base_url('home/delete_users/'.$flora->id_user) ?>" class="btn btn-danger">Hapus</a>
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
          $('#nama').val(data.nama);
         
          $('#no_hp').val(data.no_hp);
          $('#id_level').val(data.id_level);
        }
      });
    });
  });
</script>
