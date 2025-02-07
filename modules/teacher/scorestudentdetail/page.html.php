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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

    </style>
</head>

<body>
<<<<<<< HEAD
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="teacher/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="teacher/score">Input Nilai</a></li>
                <!-- <li class="breadcrumb-item"><a href="teacher/scoredetail?class_id=<?= $teacherClass['id'] ?>">Daftar Siswa</a></li> -->
                <li class="breadcrumb-item"><a href="teacher/scoredetail?class_id=1">Daftar Siswa</a></li> 
                <li class="breadcrumb-item breadcrumb-item-active" aria-current="page">Daftar Nilai</li>
            </ol>
        </nav>
        <h4>Daftar Nilai <?php echo $nama_siswa; ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr class='fs-5'>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
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
                        echo "<tr class='fs-5'>
                            <td class='text-center'>" . ($index + 1) . "</td>
                            <td>{$row['asli']}</td>
                            <td id='nilai-{$index}' class='text-center'>{$row['nilai']}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
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