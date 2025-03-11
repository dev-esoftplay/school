<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('student.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Rapor Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .personal-info p {
            margin: 5px 0;
            font-size: 1em;
            color: #666;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            color: #333;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Rapor Siswa</h1>
        <div class="row">
            <div class="col-md-6 personal-info">
                <p><strong>Nama Peserta Didik:</strong> John Doe</p>
                <p><strong>Nomor Induk/NISN:</strong> 123456789</p>
                <p><strong>Sekolah:</strong> SDIT Eraport</p>
            </div>
            <div class="col-md-6 personal-info">
                <p><strong>Alamat:</strong> Jalan Raya No. 10</p>
                <p><strong>Kelas:</strong> 6A</p>
                <p><strong>Tahun Ajaran:</strong> 2023/2024</p>
            </div>
        </div>

        <!-- Tabel Nilai -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Matematika</td>
                    <td>85</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Bahasa Indonesia</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>IPA</td>
                    <td>88</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>IPS</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>PKN</td>
                    <td>87</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5. 2/js/bootstrap.min.js"></script>
</body>
</html>