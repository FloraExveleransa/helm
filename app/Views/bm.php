<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
             <h3>Surat Masuk</h3>
            <p class="text-subtitle text-muted">Berikut ini adalah data Surat Masuk <?=$title?></p>
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
         <?php
          if(session()->get('level')==1 || session()->get('level') == 2){
            ?>
          <a href="<?=base_url('home/t_bm')?>">
            <button class="btn btn-success">Tambah Data Surat Masuk</button>
          </a>
          <?php } ?>
          <a href="<?=base_url('home/print_bm')?>">
            <button class="btn btn-danger" id="printButton">Print Data Surat Masuk</button>
          </a>
        </div>
        <table class="table table-striped" id="table1">
          <thead>
                <tr>
                  <th>No</th>
                  <th>kode surat </th>
                  <th>Nama </th>
                  <th>jumlah</th>
                  <th>tgl masuk</th>
                  <th>created at</th>
                  <th>updated at</th>
                   <?php if(session()->get('level')==1 || session()->get('level') == 2): ?>
                  <th>Aksi</th>  
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($manda as $flora){
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $flora->id_brg ?></td>
                  <td><?= $flora->nama_brg ?></td>
                  <td><?= $flora->jumlah ?></td>
                  <td><?= $flora->tglmsk ?></td>
                  <td><?= $flora->created_at ?></td>
                  <td><?= $flora->updated_at ?></td>
               <td>
              <?php if(session()->get('level')==1 || session()->get('level') == 2): ?>

  <!-- Detail Button -->
  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_bm ?>">Detail</button>
 

</td>

<?php endif; ?>
<script >
  function showDetailModal() {
  const userLevel = <?= session()->get('level') ?>; // Ambil level pengguna dari session
  if (userLevel === 1) {
    $('#detailModal').modal('show');
  } else {
    alert('Anda tidak memiliki izin untuk mengakses Surat Masuk');
  }
}

</script>

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

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="detailModalLabel">Detail barang masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <!-- User Details Form -->
        <form id="userDetailForm" action="<?= base_url('home/update_bm') ?>" method="POST">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userDetailForm">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">




            <label for="id_brg">kode barang</label>
                <input type="text" class="form-control" id="id_brg" name="id_brg" value="<?= $flora->id_brg?>" required>
          </div>
          <div class="form-group">
            <label for="nama_brg">nama</label>
              <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="<?= $flora->nama_brg?>" required>
          </div>
          <div class="form-group">
            <label for="jumlah"> jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $flora->jumlah?>" required>
          </div>
          <div class="form-group">
            <label for="tglmsk"> tgl msk</label>
                <input type="text" class="form-control" id="tglmsk" name="tglmsk" value="<?= $flora->tglmsk?>" required>
          </div>
          
         <div class="form-group">
            <label for="created_at">created at</label>
             <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="<?= $flora->created_at?>" required>
          </div>
          <div class="form-group"> x
            <label for="updated_at">updated at</label>
             <input type="datetime-local" class="form-control" id="updated_at" name="updated_at" value="<?= $flora->updated_at?>" required>
          </div>
       <div class="form-group d-inline-block">
  <div class="form-group d-inline-block ml-2">
  <a href="<?= base_url('home/update_bm/'.$flora->id_bm) ?>">
    <button type="button" class="btn btn-danger" id="deleteUserBtn">simpan</button>
  </a>
<div class="form-group d-inline-block ml-2">
  <a href="<?= base_url('home/delete_bm/'.$flora->id_bm) ?>">
    <button type="button" class="btn btn-danger" id="deleteUserBtn">Hapus</button>
  </a>
</div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#detailModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var userId = button.data('id_bm');

      $.ajax({
        url: '<?= base_url('home/update_bm') ?>',
        method: 'POST',
        data: { id: userId },
        dataType: 'json',
        success: function(data) {
          $('#user_id').val(data.id_bm);
          $('#id_brg').val(data.id_brg);
          $('#nama_brg').val(data.nama_brg);
          $('#jumlah').val(data.jumlah);
          $('#tglmsk').val(data.tglmsk);
          
        }
      });
    });

    $('#userDetailForm').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: '<?= base_url('home/update_bm') ?>',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            alert(response.message);
            $('#detailModal').modal('hide');
            location.reload(); // Untuk reload halaman agar tabel terupdate
          } else {
            alert(response.message);
          }
        },
        error: function() {
          alert('Terjadi kesalahan saat memperbarui data.');
        }
      });
    });
  });
</script>
