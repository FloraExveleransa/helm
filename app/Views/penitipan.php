<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?=$title?></h3>
            <h3>Halaman Data Penitipan Helm Kendaraan Bermotor</h3>
            <p class="text-subtitle text-muted">Berikut ini adalah data penitipan helm <?=$title?></p>
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
              <a href="<?=base_url('home/t_penitipan')?>">
                <button class="btn btn-success">Tambah Data Penitipan</button>
              </a>

              <table class="table table-striped" id="table1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Warna Helm</th>
                    <th>Ukuran Helm</th>
                    <th>Nomor Rak</th>
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
                      <td><?= $flora->nama ?></td>
                      <td><?= $flora->no_hp ?></td>
                      <td><?= $flora->warnahelm ?></td>
                      <td><?= $flora->ukuranhelm ?></td>
                      <td><?= $flora->nama_rak ?></td>
                      <td>
                     <td>
  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_datapenitipan ?>">Detail</button>
  <button class="btn btn-primary btn-sm" onclick="printNota('<?= $flora->nama ?>', '<?= $flora->no_hp ?>', '<?= $flora->warnahelm ?>', '<?= $flora->ukuranhelm ?>', '<?= $flora->nama_rak ?>')">Print Nota</button>
</td>


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
      </div>
    </section>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Penitipan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userDetailForm" action="<?= base_url('home/update_penitipan') ?>" method="POST">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama_brg" name="nama" value="<?= $flora->nama?>" required>
          </div>
         
          <div class="form-group">
            <label for="no_hp">Nomor Telepon</label>
           <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $flora->no_hp?>" required>
          </div>
           <div class="form-group">
            <label for="warnahelm">Warna Helm</label>
           <input type="text" class="form-control" id="warnahelm" name="warnahelm" value="<?= $flora->warnahelm?>" required>
          </div>
           <div class="form-group">
            <label for="ukuranhelm">Ukuran Helm </label>
           <input type="text" class="form-control" id="ukuranhelm" name="ukuranhelm" value="<?= $flora->ukuranhelm?>" required>
          </div>
           <div class="form-group">
            <label for="id_rak">Rak Helm </label>
           <input type="text" class="form-control" id="id_rak" name="id_rak" value="<?= $flora->id_rak?>" required>
          </div>
          <div class="form-group d-inline-block">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <a href="<?= base_url('home/delete_penitipan/' . $flora->id_datapenitipan) ?>" class="btn btn-danger">Hapus</a>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
  // Show modal with data
  $('#detailModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var userId = button.data('id');

    $.ajax({
      url: '<?= base_url('home/get_user1') ?>',
      method: 'POST',
      data: { id: userId },
      dataType: 'json',
     success: function(data) {
    console.log(data); // Periksa apakah data valid
    $('#user_id').val(data.id_datapenitipan);
    $('#nama').val(data.nama);
    $('#no_hp').val(data.no_hp);
    $('#warnahelm').val(data.warnahelm);
    $('#ukuranhelm').val(data.ukuranhelm);
    $('#id_rak').val(data.id_rak);
}

      error: function(xhr, status, error) {
        console.error('Error: ' + error);
      }
    });
  });

  // Print Nota
  $('#printNota').on('click', function() {
    var printContent = `
      <div>
        <h3>Nota Penitipan Helm</h3>
        <p><strong>Nama:</strong> ${$('#nama').val()}</p>
        <p><strong>Nomor Telepon:</strong> ${$('#no_hp').val()}</p>
        <p><strong>Warna Helm:</strong> ${$('#warnahelm').val()}</p>
        <p><strong>Ukuran Helm:</strong> ${$('#ukuranhelm').val()}</p>
        <p><strong>Rak Helm:</strong> ${$('#id_rak').val()}</p>
      </div>
    `;

    var newWindow = window.open('', '_blank');
    newWindow.document.write(printContent);
    newWindow.document.close();
    newWindow.print();
  });
});
</script>
<script>
function printNota(nama, noHp, warnaHelm, ukuranHelm, namaRak) {
  var printContent = `
    <div>
      <h3>Nota Penitipan Helm</h3>
      <p><strong>Nama:</strong> ${nama}</p>
      <p><strong>Nomor Telepon:</strong> ${noHp}</p>
      <p><strong>Warna Helm:</strong> ${warnaHelm}</p>
      <p><strong>Ukuran Helm:</strong> ${ukuranHelm}</p>
      <p><strong>Rak Helm:</strong> ${namaRak}</p>
    </div>
  `;

  var newWindow = window.open('', '_blank');
  newWindow.document.write(`
    <html>
      <head>
        <title>Nota Penitipan Helm</title>
        <style>
          @media print {
            body {
              margin: 0;
              padding: 0;
            }
            div {
              font-size: 12px;
              width: 8cm;
              height: auto;
              margin: auto;
              border: 1px dashed #000;
            }
            h3 {
              text-align: center;
              margin-bottom: 10px;
            }
            p {
              margin: 0;
              padding: 2px 0;
            }
          }
        </style>
      </head>
      <body>${printContent}</body>
    </html>
  `);
  newWindow.document.close();
  newWindow.print();
}

</script>
