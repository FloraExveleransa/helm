<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Surat masuk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .store-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .store-info p {
            margin: 5px 0;
        }

        .separator {
            border-top: 2px solid #333;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .export-buttons {
            text-align: center;
            margin: 20px auto;
        }

        .export-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .export-btn:hover {
            background-color: #45a049;
        }

        .back-btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #1976D2;
        }

        .no-print {
            display: block;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="store-info">
            <p>Mitra Dagang Utama</p>
            <p>Komplek Citra Buana Centre Park 1 Blok CC No. 5</p>
            <p>Kampung Seraya, Kepulauan Riau 29432 29444</p>
            <p>Nomor Telepon: 085268187779</p>
        </div>
        <div class="separator"></div>
        <h1>Data Surat Masuk</h1>
        <table id="print-table">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Surat </th>
                  <th>Nomor Surat </th>
                  <th>Tanggal Pembuatan Surat</th>
                  <th>Tanggal Batas Kirim</th>
                  <th>Pengirim</th>
                  <th>Penerima</th>
                  <th>Perihal Surat </th>
                  <th>Dokumen</th>
                  <th>Status Terlambat</th>
                  <th>Keterangan Terlambat</th>
                  <th>Created at</th>
                   <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($manda)): ?>
                    <?php $no = 1; foreach($manda as $flora): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $flora['jenis_surat'] ?></td>
                        <td><?= $flora['no_surat'] ?></td>
                        <td><?= $flora['tanggal_surat'] ?></td>
                        <td><?= $flora['tanggal_batas'] ?></td>
                        <td><?= $flora['pengirim'] ?></td>
                        <td><?= $flora['penerima'] ?></td>
                        <td><?= $flora['perihal'] ?></td>
                        <td><?= $flora['file_path'] ?></td>
                        <td><?= $flora['status_terlambat'] ?></td>
                        <td><?= $flora['keterangan_terlambat'] ?></td>
                        <td><?= $flora['created_at'] ?></td>
                        <td><?= $flora['updated_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada data surat masuk</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="export-buttons no-print">
            <button id="print-btn" class="export-btn">Print</button>
            <button id="excel-btn" class="export-btn">Export to Excel</button>
            <button id="pdf-btn" class="export-btn">Export to PDF</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.17/jspdf.plugin.autotable.min.js"></script>
    <script>
        document.getElementById('print-btn').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('excel-btn').addEventListener('click', function() {
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(document.querySelector('#print-table'));
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            XLSX.writeFile(wb, "data.xlsx");
        });
 document.getElementById('pdf-btn').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add company logo
        doc.addImage('public/images/logo.png', 'PNG', 10, 10, 50, 20, undefined, 'FAST');
        doc.setTextColor(255, 255, 255); // Set text color to white for contrast
        doc.setFontSize(16);
        doc.text("Mitra Dagang Utama", 70, 15);
        doc.setFontSize(12);
        doc.text("Komplek Citra Buana Centre Park 1 Blok CC No. 5", 70, 20);
        doc.text("Kampung Seraya, Kepulauan Riau 29432 29444", 70, 25);
        doc.text("Nomor Telepon: 085268187779", 70, 30);

        // Add separator line
        doc.setLineWidth(0.5);
        doc.line(10, 35, 200, 35);

        // Add table title
        doc.setFontSize(14);
        doc.text("Data Surat masuk", 10, 40);

        // Generate table
        doc.autoTable({
            startY: 45,
            html: '#print-table',
            headStyles: { fillColor: '#4CAF50', textColor: 'white' },
            bodyStyles: { fontSize: 10 },
            margin: { left: 10, right: 10 },
            theme: 'striped',
            styles: { cellPadding: 5 }
        });

        // Save the PDF
        doc.save("data.pdf");
    });
        document.getElementById('pdf-btn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Add store details
            doc.setFontSize(16);
            doc.text("Mitra Dagang Utama", 10, 10);
            doc.setFontSize(12);
            doc.text("Komplek Citra Buana Centre Park 1 Blok CC No. 5", 10, 15);
            doc.text("Kampung Seraya, Kepulauan Riau 29432 29444", 10, 20);
            doc.text("Nomor Telepon: 085268187779", 10, 25);
            
            // Add separator line
            doc.setLineWidth(0.5);
            doc.line(10, 30, 200, 30);

            // Add table title
            doc.setFontSize(14);
            doc.text("Data Surat Keluar", 10, 35);

            // Generate table
            doc.autoTable({
                startY: 40,
                html: '#print-table',
                headStyles: { fillColor: '#4CAF50', textColor: 'white' },
                bodyStyles: { fontSize: 10 }
            });

            // Save the PDF
            doc.save("data.pdf");
        });
    </script>
</body>
</html>
