<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Grid</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Container for main layout */
    .main-panel {
      padding: 20px;
    }

    /* Title and subtitle */
    h3 {
      text-align: center;
      margin-bottom: 15px;
    }

    /* Product grid styling */
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;  /* Jarak antar produk lebih besar */
      justify-content: center;
      padding: 20px;
    }

    /* Product card styling */
    .product-card {
      width: 220px;  /* Set the width of the card to be more uniform */
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;  /* Make corners rounded */
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s;
      margin-bottom: 30px;  /* Menambahkan margin bawah agar ada jarak antar baris */
    }

    .product-card:hover {
      transform: scale(1.05);
    }

    /* Product image */
    .product-image img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 10px;
    }

    /* Product details */
    .product-name {
      font-weight: bold;
      margin-top: 10px;
      font-size: 1.1em;
      color: #333;
    }

    .product-code {
      color: #777;
      font-size: 0.85em;
      margin-top: 5px;
    }

    .product-price {
      font-weight: bold;
      color: #e74c3c;
      margin-top: 10px;
      font-size: 1.2em;
    }

    .product-stock {
      color: #2ecc71;
      font-size: 0.9em;
      margin-top: 5px;
    }

    /* Button styling */
    .action-buttons {
      display: flex;
      flex-direction: column;  /* Stack buttons vertically */
      gap: 5px;
      margin-top: 15px;
    }

    .btn {
      padding: 8px;
      font-size: 0.85em;  /* Reduce font size */
      border: none;
      border-radius: 5px;
      cursor: pointer;
      color: #fff;
      width: 100%;  /* Ensure buttons fill the width of the card */
      text-align: center;
    }

    .btn-info {
      background-color: #3498db;
    }

    .btn-delete {
      background-color: #e74c3c;
    }

    .btn-primary {
      background-color: #2ecc71;
    }

    /* Modal styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      max-width: 800px;
      border-radius: 8px;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <h3><?=$title?></h3>
          <p class="text-subtitle text-muted">Berikut ini adalah produk-produknya. <?=$title?></p>
        </div>
      </div>
      <?php if (session()->get('level') == 1) { ?>
        <button class="btn btn-primary mb-3" onclick="showAddProductModal()">Tambah Barang Jual</button>
      <?php } ?>

      <!-- Product Grid Section -->
      <div class="product-grid">
        <?php
          $no = 1;
          foreach($manda as $flora) {
        ?>
          <div class="product-card">
            <div class="product-image">
              <img src="<?= base_url('images/' . $flora->foto) ?>" alt="Gambar <?= $flora->id_brg ?>">
            </div>
            <div class="product-name"><?= $flora->nama_brg ?></div>
            <div class="product-code"><?= $flora->kode_brg ?></div>
            <div class="product-price">Rp<?= number_format($flora->harga, 2, ',', '.') ?></div>
            <div class="product-stock">Stok: <?= $flora->stok ?></div>
            <div class="action-buttons">
              <a href="<?=base_url('home/restoreupbarang/'.$flora->id_brg)?>" class="btn btn-info">Restore</a>
              <a href="<?=base_url('home/sdbarang/'.$flora->id_brg)?>" class="btn btn-delete">Delete</a>
              <a href="<?=base_url('home/rsbarang/'.$flora->id_brg)?>" class="btn btn-info">Restore Delete</a>
              <?php if (session()->get('level') == 5) { ?>
                <button class="btn btn-primary" onclick="showModal(<?= $flora->id_brg ?>, '<?= $flora->harga ?>')">
                  <i class="fas fa-shopping-cart"></i> Beli
                </button>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>

      <!-- Modal for Adding to Cart -->
      <div id="addToCartModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeModal()">&times;</span>
          <h3>Tambah ke Keranjang</h3>
          <form id="addToCartForm" action="<?= base_url('Home/aksi_keran')?>" method="post">
            <input type="hidden" id="item_id" name="item_id">
            <input type="hidden" id="item_name" name="item_name">
            <div class="form-group">
              <label for="quantity">Jumlah:</label>
              <input type="number" id="quantity" name="quantity" class="form-control" required min="1">
            </div>
            <div class="form-group">
              <label for="note">Catatan:</label>
              <input type="text" id="note" name="note" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
          </form>
        </div>
      </div>

      <!-- JavaScript for Modals -->
      <script>
        function showModal(id, name) {
          const row = document.querySelector(`[data-id="${id}"]`);
          const stock = parseInt(row.getAttribute('data-stock'), 10);

          if (stock === 0) {
            alert('Stok telah habis');
            return;
          }

          document.getElementById('item_id').value = id;
          document.getElementById('item_name').value = name;
          document.getElementById('addToCartModal').style.display = 'block';
        }

        function closeModal() {
          document.getElementById('addToCartModal').style.display = 'none';
        }

        function showAddProductModal() {
          document.getElementById('addProductModal').style.display = 'block';
        }

        function closeAddProductModal() {
          document.getElementById('addProductModal').style.display = 'none';
        }

        window.onclick = function(event) {
          if (event.target == document.getElementById('addToCartModal')) {
            closeModal();
          }
        };
      </script>
    </div>
  </div>
</body>
</html>
