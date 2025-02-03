<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('teacher.php');
$nama_siswa = "Arkyn the Root-digger";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nilai Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-size: min(10px, 2vh, 18px);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            gap: 1px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-item a {
            color: #4B5320;
            font-weight: 600;
            text-decoration: none;
            font-size: min(3vw, 2vh, 18px);
        }

        .breadcrumb-item a:hover {
            color: #3E4C23;
            text-decoration: underline;
        }

        .breadcrumb-item-active {
            color: grey;
            font-weight: 600;
            font-size: min(3vw, 2vh, 18px);
            text-decoration: none;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            font-size: min(3vw, 2vh, 18px);
            color: #4B5320;
            font-weight: 600;
        }


        .table-responsive {
            margin-top: 10px;
        }

        .table th,
        .table td {
            font-size: clamp(10px, 1.5vw, 18px);
            justify-content: center;
            justify-items: center;
        }

        .btn {
            padding: 10px 12px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="teacher/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="teacher/score">Input Nilai</a></li>
                <li class="breadcrumb-item"><a href="teacher/scoredetail">Daftar Siswa</a></li>
                <li class="breadcrumb-item breadcrumb-item-active" aria-current="page">Daftar Nilai</li>
            </ol>
        </nav>
        <h4>Daftar Nilai <?php echo $nama_siswa; ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $mapel = [
                        ["nama" => "PAI", "asli" => "Pendidikan Agama Islam", "nilai" => 85],
                        ["nama" => "PPKn", "asli" => "Pendidikan Pancasila", "nilai" => 90],
                        ["nama" => "B.Indo", "asli" => "Bahasa Indonesia", "nilai" => 88],
                        ["nama" => "B.Ing", "asli" => "Bahasa Inggris", "nilai" => 87],
                        ["nama" => "B.Jawa", "asli" => "Bahasa Jawa", "nilai" => 75],
                        ["nama" => "MTK", "asli" => "Matematika", "nilai" => 80],
                        ["nama" => "IPAS", "asli" => "Ilmu Pengetahuan Alam & Sosial", "nilai" => 78],
                        ["nama" => "SB", "asli" => "Seni Budaya", "nilai" => 85],
                        ["nama" => "PJOK", "asli" => "Pendidikan Jasmani Olahraga & Kesehatan", "nilai" => 82],
                        ["nama" => "B.Arab", "asli" => "Bahasa Arab", "nilai" => 80],
                        ["nama" => "TIK", "asli" => "Teknologi Informasi & Komunikasi", "nilai" => 83],
                    ];

                    foreach ($mapel as $index => $row) {
                        echo "<tr>
                            <td>" . ($index + 1) . "</td>
                            <td>{$row['asli']}</td>
                            <td id='nilai-{$index}'>{$row['nilai']}</td>
                            <td><button class='btn btn-primary btn-sm' onclick='editNilai({$index})'>Ubah</button></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editNilai(id) {
            let nilai = document.getElementById("nilai-" + id);
            let newValue = prompt("Masukkan nilai baru:", nilai.innerText);
            if (newValue !== null && !isNaN(newValue) && newValue !== "") {
                nilai.innerText = newValue;
            }
        }

        function adjustFontSize() {
            let container = document.querySelector(".container");
            let fontSize = Math.min(container.clientWidth * 0.02, container.clientHeight * 0.04);
            document.body.style.fontSize = fontSize + "px";
        }

        window.onload = adjustFontSize;
        window.onresize = adjustFontSize;
    </script>
</body>

</html>