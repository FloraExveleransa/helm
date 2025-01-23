

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengaturan & Peraturan Aplikasi Bel Sekolah</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles dasar untuk layout dashboard */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Container utama */
        .dashboard-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        /* Header */
        header {
            background-color: #2980b9;
            color: #fff;
            text-align: center;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 2.5rem;
            margin: 0;
            font-weight: 700;
        }

        /* Main Content */
        main {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            padding: 20px;
        }

        /* Section style */
        section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease-in-out;
        }

        section:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        section h2 {
            color: #2980b9;
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 5px;
        }

        section ul {
            list-style: none;
            padding: 0;
        }

        section li {
            font-size: 1rem;
            line-height: 1.6;
            padding-left: 20px;
            position: relative;
            margin-bottom: 15px;
        }

        section li:before {
            content: "•";
            color: #2980b9;
            font-size: 1.5rem;
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Important Note */
        .important-note {
            background-color: #fcf8e3;
            padding: 20px;
            border-left: 5px solid #f39c12;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 30px;
            border-radius: 5px;
            color: #f39c12;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #2980b9;
            color: white;
            border-radius: 5px;
            margin-top: 40px;
        }

        /* Button Custom Styles */
        .btn {
            padding: 15px;
            text-align: center;
            display: inline-block;
            font-size: 1rem;
            color: #fff;
            background-color: #2980b9;
            border-radius: 8px;
            text-decoration: none;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: #3498db;
        }

        .icon {
            font-size: 2rem;
            margin-right: 10px;
        }

        .btn-container {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 1fr;
        }

        /* Jadwal Terbaru */
        .schedule-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .schedule-card h3 {
            color: #2980b9;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .schedule-card p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .schedule-card .time {
            font-weight: bold;
            color: #3498db;
        }

        .schedule-card .repeat {
            font-style: italic;
            color: #f39c12;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            main {
                grid-template-columns: 1fr;
            }

            footer {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header>
            <h1>Dashboard Pengaturan & Peraturan Aplikasi Bel Sekolah</h1>
        </header>

        <!-- Konten Utama -->
        <main>
            <!-- Button Menu -->
            <section>
                <h2>Menu Utama</h2>
                <div class="btn-container">
                    <!-- Button ke View Schedules -->
                    <a href="schedules" class="btn">
                        <span class="icon"><i class="fas fa-calendar-check"></i></span> Lihat Jadwal Bel
                    </a>
                    <!-- Button ke View Users -->
                    <a href="users" class="btn">
                        <span class="icon"><i class="fas fa-users"></i></span> Daftar Pengguna
                    </a>
                    <!-- Button ke Edit Profile -->
                    <a href="pt" class="btn">
                        <span class="icon"><i class="fas fa-user-edit"></i></span> Edit Profil
                    </a>
                    <!-- Button ke History -->
                    <a href="activity" class="btn">
                        <span class="icon"><i class="fas fa-history"></i></span> Riwayat Login
                    </a>
                </div>
            </section>

            <!-- Add New Schedule -->
            <section>
                <h2>Tambah Jadwal Bel Terbaru</h2>
                <p>Tambahkan jadwal bel terbaru ke dalam sistem untuk memastikan jadwal bel sekolah berjalan lancar.</p>
                <a href="t_jadwal" class="btn">
                    <span class="icon"><i class="fas fa-plus-circle"></i></span> Tambah Jadwal
                </a>
            </section>

        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Bel Sekolah. Semua hak cipta dilindungi.</p>
        </footer>
    </div>

    <!-- Include Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

