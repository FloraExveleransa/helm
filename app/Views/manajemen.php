<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akses Surat Masuk & Keluar</title>

    <!-- Link ke CSS untuk desain modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .main-panel {
            margin-top: 20px;
        }
        .content-wrapper {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .section-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .modal-dialog {
            max-width: 800px;
        }
    </style>
</head>
<body>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3 class="section-title">Manajemen Akses Surat Masuk & Keluar</h3>
                    <p class="text-muted">Atur akses surat masuk dan surat keluar berdasarkan jabatan atau divisi.</p>
                </div>
            </div>

            <!-- Form Akses Surat -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="manajemen.php">

                            <!-- Akses Berdasarkan Jabatan -->
                            <div class="section">
                                <h4 class="section-title">Akses Berdasarkan Jabatan</h4>
                                <div class="checkbox-group">
                                    <label>
                                        <input type="checkbox" name="jabatan[]" value="Manager"> Manager
                                    </label>
                                    <label>
                                        <input type="checkbox" name="jabatan[]" value="Supervisor"> Supervisor
                                    </label>
                                    <label>
                                        <input type="checkbox" name="jabatan[]" value="Staff"> Staff
                                    </label>
                                    <label>
                                        <input type="checkbox" name="jabatan[]" value="Admin"> Admin
                                    </label>
                                </div>
                            </div>

                            <!-- Akses Berdasarkan Divisi -->
                            <div class="section">
                                <h4 class="section-title">Akses Berdasarkan Divisi</h4>
                                <div class="checkbox-group">
                                    <label>
                                        <input type="checkbox" name="divisi[]" value="HRD"> HRD
                                    </label>
                                    <label>
                                        <input type="checkbox" name="divisi[]" value="Finance"> Finance
                                    </label>
                                    <label>
                                        <input type="checkbox" name="divisi[]" value="IT"> IT
                                    </label>
                                    <label>
                                        <input type="checkbox" name="divisi[]" value="Marketing"> Marketing
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-custom">Update Akses</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Data Tabel Akses Surat -->
            <section class="section mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data tabel surat akan muncul di sini -->
                                    <tr>
                                        <td>1</td>
                                        <td>Manager</td>
                                        <td>HRD</td>
                                        <td><button class="btn btn-info btn-sm">Lihat Akses</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Admin</td>
                                        <td>IT</td>
                                        <td><button class="btn btn-info btn-sm">Lihat Akses</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Detail Akses Surat -->
    <div class="modal fade" id="aksesModal" tabindex="-1" role="dialog" aria-labelledby="aksesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aksesModalLabel">Detail Akses Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Jabatan:</strong> Manager</p>
                    <p><strong>Divisi:</strong> HRD</p>
                    <p><strong>Jenis Akses:</strong> Surat Masuk, Surat Keluar</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript and Bootstrap JS for modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk membuka modal dan menampilkan detail akses
        $(document).ready(function() {
            $('.btn-info').on('click', function() {
                $('#aksesModal').modal('show');
            });
        });
    </script>

</body>
</html>
