<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Aktivitas</title>
    <!-- Tambahkan CSS yang sesuai -->
</head>
<body>
    <div class="container">
        <h2>Riwayat Aktivitas Pengguna</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Aktivitas</th>
                    <th>Waktu</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($aktivitas as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['nama_user'] ?></td>
                        <td><?= $item['action'] ?></td>
                        <td><?= $item['action_time'] ?></td>
                        <td><?= $item['details'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
