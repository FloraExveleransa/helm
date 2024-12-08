<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .header h3 {
            font-size: 28px;
            margin: 0;
            color: #007bff;
        }
        .header p {
            font-size: 16px;
            color: #6c757d;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead {
            background: #007bff;
            color: #fff;
            font-size: 16px;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
        }
        .table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #218838;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        .icon {
            color: #007bff;
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3><i class="fas fa-sign-in-alt icon"></i> Riwayat Login</h3>
            <p class="text-subtitle">Berikut ini adalah riwayat login pengguna.</p>
        </div>

        <section class="section">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Activity</th>
                        <th>waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($activity as $login): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $login->nama_users ?></td>
                            <td><?= $login->activity ?></td>
                            <td><?= $login->timestamp ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
        </section>

       
    </div>
</body>
</html>
