<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Jadwal Bel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            background-color: #007bff;
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header-section h2 {
            margin: 0;
            font-size: 28px;
        }

        .header-section p {
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-custom {
            border-radius: 25px;
            font-size: 16px;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .modal-footer button {
            border-radius: 25px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 10px;
            display: none;
        }

        .done {
            text-decoration: line-through;
            color: gray;
        }
        /* Tombol Info Keren */
.btn-custom-info {
    background-color: #28a745; /* Warna hijau cerah */
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 30px;
    padding: 8px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-custom-info i {
    margin-right: 5px; /* Spasi antara icon dan teks */
}

/* Efek saat hover */
.btn-custom-info:hover {
    background-color: #218838; /* Warna lebih gelap saat hover */
    transform: scale(1.05); /* Efek zoom in saat hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.btn-custom-info:focus {
    outline: none;
}

/* Efek fokus tombol */
.btn-custom-info:focus, .btn-custom-info:active {
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
}

    </style>
</head>
<body>
<div class="container">
    <!-- Header Section -->
    <div class="header-section">
        <h2>Pengaturan Jadwal Bel</h2>
        <p>Atur jadwal bel dengan mudah dan efisien menggunakan dashboard ini.</p>
    </div>

    <!-- Notification Section -->
    <div class="alert alert-info text-center">
        <i class="fas fa-bell"></i> <strong>Fitur Bel Sekolah Akan Berbunyi Secara Otomatis!</strong> Sesuai dengan pengaturan waktu, tanggal, dan hari yang ditentukan.
    </div>
    <style>
    /* CSS untuk menyembunyikan menu/tombol saat print */
    @media print {
        /* Menyembunyikan elemen-elemen yang tidak perlu dicetak */
        .no-print {
            display: none;
        }

        /* Menambahkan logo di bagian atas setiap halaman print */
        body {
            background: url('C:/bel/public/images/sph.jpg') no-repeat center top;
            background-size: contain;
            padding-top: 150px; /* Menyesuaikan dengan ukuran logo */
        }

        /* Menyesuaikan tampilan tabel dan elemen lainnya */
        .table, .table th, .table td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
    }
</style>

<!-- Action Button -->
<div class="d-flex justify-content-end mb-3 no-print">
    <!-- Button Print Semua Data -->
    <button class="btn btn-danger btn-custom mr-2" id="printAllSchedules">
        <i class="fas fa-print"></i> Print Semua Data
    </button>

    <!-- Button Tambah Jadwal -->
    <a href="<?= base_url('home/t_jadwal') ?>" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Tambah Jadwal
    </a>
</div>
    <!-- Schedule List -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Jadwal Bel</h4>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                       <thead>
    <tr>
        <th>No</th>
        <th>Nama Event</th>
        <th>Pengulangan</th>
        <th>Waktu</th>
        <th>Hari</th>
        <th>Dibuat Oleh</th>
        <th>Dibuat Pada</th>
        <th>Detail</th>
        <th>Aksi Alarm</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($schedules)): ?>
        <?php $no = 1; ?>
        <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $schedule->event_name ?></td>
                <td><?= ucfirst($schedule->repeat) ?></td>
                <td><?= $schedule->time ?></td>
                <td><?= $schedule->day_of_week ?? '-' ?></td>
                <td><?= $schedule->created_by_name ?? 'Tidak Diketahui' ?></td>
                <td><?= $schedule->created_at ?></td>
              <td>
    
 <button class="btn btn-custom-info btn-sm btn-custom" data-toggle="modal" data-target="#scheduleModal" 
    data-id="<?= $schedule->id ?>" 
    data-name="<?= $schedule->event_name ?>" 
    data-time="<?= $schedule->time ?>" 
    data-repeat="<?= $schedule->repeat ?>" 
    data-day="<?= $schedule->day_of_week ?>" 
    data-created="<?= $schedule->created_at ?>"
    data-created-by="<?= $schedule->created_by_name ?>"> <!-- Add data-created-by here -->
    <i   data-toggle="modal" data-target="#detailModal" data-id="<?= $flora->id_users ?>">!</i> 
</button>

</td>
<td>
    <!-- Tombol Matikan / Aktifkan Alarm -->
    <button class="btn btn-warning btn-sm" id="toggleAlarm" data-id="<?= $schedule->id ?>" data-status="<?= $schedule->alarm_status ?>">
        <i class="fas fa-bell-slash"></i> <?= $schedule->alarm_status ? 'Matikan Alarm' : 'Aktifkan Alarm' ?>
    </button>
</td>

        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" class="text-center">Tidak ada data.</td>
        </tr>
    <?php endif; ?>
</tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Modal for showing the schedule details -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Detail Jadwal Bel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="scheduleDetails">
                    <p><strong>Nama Event:</strong> <span id="modalEventName"></span></p>
                    <p><strong>Waktu:</strong> <span id="modalEventTime"></span></p>
                    <p><strong>Pengulangan:</strong> <span id="modalEventRepeat"></span></p>
                    <p><strong>Hari:</strong> <span id="modalEventDay"></span></p>
                    <p><strong>Dibuat Pada:</strong> <span id="modalCreatedAt"></span></p>
                    <p><strong>Dibuat Oleh:</strong> <span id="modalCreatedBy"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Link Hapus Jadwal dengan ID yang benar -->
                

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="printSchedule">Print</button>
                <a href="<?= site_url('home/delete_jadwal/' . $schedule->id) ?>" class="btn btn-danger">Hapus Jadwal</a>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

   <!-- jQuery, Bootstrap JS, and additional script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $('#deleteSchedule').click(function() {
    var scheduleId = $(this).data('id');
    if (confirm('Yakin ingin menghapus jadwal ini?')) {
        // Redirect to del_jadwal method in the Home controller
        window.location.href = '<?= site_url('home/del_jadwal/') ?>' + scheduleId;
    }
});
  $('.btn-warning').click(function() {
    var scheduleId = $(this).data('id');
    $('#durationModal').data('schedule-id', scheduleId).modal('show');
});
$('#saveDuration').click(function() {
    var scheduleId = $('#durationModal').data('schedule-id');
    var durationType = $('#durationType').val();
    var durationValue = $('#durationValue').val();

    if (!durationValue || durationValue <= 0) {
        alert("Durasi tidak valid!");
        return;
    }

    // Mengirim durasi ke server
    $.ajax({
        url: '<?= site_url('home/toggle_alarm_duration/') ?>' + scheduleId,
        type: 'POST',
        data: {
            duration_type: durationType,
            duration_value: durationValue
        },
        success: function(response) {
            alert('Durasi berhasil disimpan!');
            $('#durationModal').modal('hide');
        },
        error: function() {
            alert('Terjadi kesalahan!');
        }
    });
});

  // Ketika tombol toggle diklik
$('.btn-custom').click(function() {
    var scheduleId = $(this).data('id');
    var currentStatus = $(this).data('status'); // Status saat ini (active/inactive)
    
    // Mengubah status alarm di backend
    $.ajax({
        url: '<?= site_url('home/toggle_alarm/') ?>' + scheduleId,
        type: 'POST',
        success: function(response) {
            // Setelah status diperbarui, sesuaikan UI
            if (currentStatus == 'active') {
                // Update button UI ke status non-aktif
                $(this).html('<i class="fas fa-bell-slash"></i> Matikan');
                $(this).data('status', 'inactive');
            } else {
                // Update button UI ke status aktif
                $(this).html('<i class="fas fa-bell"></i> Aktifkan');
                $(this).data('status', 'active');
            }
        }
    });
});
function checkBellSchedules() {
    var currentTime = new Date();
    var currentDay = currentTime.getDay(); // Hari dalam angka (0-6)
    var currentHour = currentTime.getHours();
    var currentMinute = currentTime.getMinutes();

    <?php foreach ($schedules as $schedule): ?>
        var scheduleTime = '<?= $schedule->time ?>'; // Format: 'HH:mm'
        var scheduleDay = '<?= $schedule->day_of_week ?>'; // '0' to '6'
        var scheduleStatus = '<?= $schedule->status ?>'; // 'active' or 'inactive'
        
        var scheduleHour = parseInt(scheduleTime.split(':')[0]);
        var scheduleMinute = parseInt(scheduleTime.split(':')[1]);

        if (scheduleStatus === 'active' && currentHour === scheduleHour && currentMinute === scheduleMinute && (scheduleDay == currentDay || scheduleDay == '')) {
            // Play bell sound and show notification
            playBellSound();
            showNotification();
        }
    <?php endforeach; ?>
}

// Fungsi untuk mencetak semua jadwal
$('#printAllSchedules').click(function() {
    var printContent = `<div style="text-align: center;">
                            <h2>Daftar Jadwal Bel</h2>
                            <table style="width: 100%; border: 1px solid #000; padding: 10px;">
                                <tr>
                                    <th>Nama Event</th>
                                    <th>Waktu</th>
                                    <th>Pengulangan</th>
                                    <th>Hari</th>
                                    <th>Dibuat Pada</th>
                                </tr>`;
    
    <?php foreach ($schedules as $schedule): ?>
        printContent += `
            <tr>
                <td><?= $schedule->event_name ?></td>
                <td><?= $schedule->time ?></td>
                <td><?= ucfirst($schedule->repeat) ?></td>
                <td><?= $schedule->day_of_week ?? '-' ?></td>
                <td><?= $schedule->created_at ?></td>
            </tr>
        `;
    <?php endforeach; ?>

    printContent += `</table></div>`;

    var newWindow = window.open('', '', 'height=600,width=800');
    newWindow.document.write('<html><head><title>Print Semua Jadwal Bel</title><style>body { font-family: Arial, sans-serif; padding: 20px; }</style></head><body>');
    newWindow.document.write(printContent);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print();
});
$('#scheduleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var scheduleId = button.data('id');
    var eventName = button.data('name');
    var eventTime = button.data('time');
    var eventRepeat = button.data('repeat');
    var eventDay = button.data('day');
    var createdAt = button.data('created');
    var createdBy = button.data('created-by'); // Add this line to capture 'created_by'

    // Set the values in the modal
    $('#modalEventName').text(eventName);
    $('#modalEventTime').text(eventTime);
    $('#modalEventRepeat').text(eventRepeat);
    $('#modalEventDay').text(eventDay);
    $('#modalCreatedAt').text(createdAt);
    $('#modalCreatedBy').text(createdBy); // Set the 'created_by' value in the modal

    // Pass the scheduleId to the delete and print buttons
    $('#deleteSchedule').data('id', scheduleId);
    $('#printSchedule').data('id', scheduleId);
});


// Handle delete schedule
$('#deleteSchedule').click(function() {
    var scheduleId = $(this).data('id');
    if (confirm('Yakin ingin menghapus jadwal ini?')) {
        window.location.href = '<?= base_url('home/delete_schedule/') ?>' + scheduleId;
    }
});
$('#scheduleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var scheduleId = button.data('id'); // Get the schedule ID
    $('#deleteSchedule').data('id', scheduleId); // Store the schedule ID in the button
});

// Handle print schedule
$('#printSchedule').click(function() {
    var scheduleId = $(this).data('id');
    var eventName = $('#modalEventName').text();
    var eventTime = $('#modalEventTime').text();
    var eventRepeat = $('#modalEventRepeat').text();
    var eventDay = $('#modalEventDay').text();
    var createdAt = $('#modalCreatedAt').text();

    var printContent = `
        <div style="text-align: center;">
            <h2>Detail Jadwal Bel</h2>
            <table style="width: 100%; border: 1px solid #000; padding: 10px;">
                <tr>
                    <td><strong>Nama Event:</strong></td>
                    <td>${eventName}</td>
                </tr>
                <tr>
                    <td><strong>Waktu:</strong></td>
                    <td>${eventTime}</td>
                </tr>
                <tr>
                    <td><strong>Pengulangan:</strong></td>
                    <td>${eventRepeat}</td>
                </tr>
                <tr>
                    <td><strong>Hari:</strong></td>
                    <td>${eventDay}</td>
                </tr>
                <tr>
                    <td><strong>Dibuat Pada:</strong></td>
                    <td>${createdAt}</td>
                </tr>
            </table>
        </div>
    `;

    var newWindow = window.open('', '', 'height=600,width=800');
    newWindow.document.write('<html><head><title>Print Jadwal Bel</title><style>body { font-family: Arial, sans-serif; padding: 20px; }</style></head><body>');
    newWindow.document.write(printContent);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print();
});
</script>

<!-- Notifikasi Bel -->
<div id="bell-notification" class="notification">
    <strong>Bel sedang berbunyi!</strong>
</div>

<!-- Tambahkan suara bel -->
<audio id="bell-sound" src="<?= base_url('assets/bell.mp3') ?>" preload="auto"></audio>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Fungsi untuk memainkan suara bel
function playBellSound() {
    var bellSound = document.getElementById('bell-sound');
    var times = 3; // Jumlah bunyi bel yang diinginkan
    var interval = setInterval(function() {
        bellSound.play();
        times--;
        if (times <= 0) {
            clearInterval(interval); // Hentikan interval setelah 3 kali
        }
    }, 1000); // Interval 1 detik
}

// Fungsi untuk menampilkan notifikasi
function showNotification() {
    var notification = document.getElementById('bell-notification');
    notification.style.display = 'block';
    setTimeout(function() {
        notification.style.display = 'none';
    }, 3000); // Notifikasi akan hilang setelah 3 detik
}
// Menampilkan detail jadwal di modal
$('#scheduleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Tombol yang meng-trigger modal
    var scheduleId = button.data('id'); // ID jadwal yang dikirimkan
    var eventName = button.data('event-name');
    var eventTime = button.data('event-time');
    var eventRepeat = button.data('event-repeat');
    var eventDay = button.data('event-day');
    var createdAt = button.data('created-at');

    // Mengisi detail jadwal di modal
    $('#modalEventName').text(eventName);
    $('#modalEventTime').text(eventTime);
    $('#modalEventRepeat').text(eventRepeat);
    $('#modalEventDay').text(eventDay);
    $('#modalCreatedAt').text(createdAt);

    // Mengatur aksi hapus
    $('#deleteSchedule').off('click').on('click', function () {
        window.location.href = '<?= base_url('home/hapus_jadwal/') ?>' + scheduleId;
    });
});

// Fungsi untuk memeriksa dan menjalankan jadwal bel
function checkBellSchedules() {
    var currentTime = new Date();
    var currentDay = currentTime.getDay(); // Hari dalam angka (0-6, 0=Sunday, 6=Saturday)
    var currentHour = currentTime.getHours();
    var currentMinute = currentTime.getMinutes();

    // Loop through schedules and check if bell time matches current time
    <?php foreach ($schedules as $schedule): ?>
        var scheduleTime = '<?= $schedule->time ?>'; // Format: 'HH:mm'
        var scheduleDay = '<?= $schedule->day_of_week ?>'; // '0' to '6'
        
        var scheduleHour = parseInt(scheduleTime.split(':')[0]);
        var scheduleMinute = parseInt(scheduleTime.split(':')[1]);

        if (currentHour === scheduleHour && currentMinute === scheduleMinute && (scheduleDay == currentDay || scheduleDay == '')) {
            // Play bell sound and show notification
            playBellSound();
            showNotification();

            // Mark schedule as bell played (update the row)
            $('#schedule-<?= $schedule->id ?>').addClass('done');
        }
    <?php endforeach; ?>
}

// Run the check every minute
setInterval(checkBellSchedules, 60000);
</script>

</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize modal content with schedule details
    document.getElementById('scheduleModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('modalEventName').textContent = button.getAttribute('data-name');
        document.getElementById('modalEventTime').textContent = button.getAttribute('data-time');
        document.getElementById('modalEventRepeat').textContent = button.getAttribute('data-repeat');
        document.getElementById('modalEventDay').textContent = button.getAttribute('data-day');
        document.getElementById('modalCreatedAt').textContent = button.getAttribute('data-created');
    });
</script>
</body>
</html>