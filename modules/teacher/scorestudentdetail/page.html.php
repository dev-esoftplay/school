<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('teacher.php');
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
        /* Besarkan font hanya untuk desktop */
        @media (min-width: 768px) {
            body {
                font-size: 1.2rem; /* Besarkan font di desktop */
            }
            .fs-3 {
                font-size: 2.5rem; 
            }
            .table th, .table td {
                font-size: 1.8rem;
            }
            .col-no {
                width: 1%;
            }

            .col-nilai {
                width: 10%;
            }
        }

        /* Ukuran font untuk mobile dan tablet */
        @media (max-width: 767px) {
            .table th, .table td {
                font-size: 1.5rem; /* Ukuran font lebih kecil di perangkat kecil */
            }
        }
    </style>
</head>

<body>
    <div class="mx-md-5 mx-3 mt-4">
        <div class="header d-flex mb-4">
            <a href="teacher/scoredetail?class_id=<?= $class_id ?>" class="fs-3 text-decoration-none text-dark cursor-pointer">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h4 class="fs-3">Daftar Nilai - <?= htmlspecialchars($student_name) ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr class='fs-5'>
                        <th class="col-no">No</th>
                        <th>Mata Pelajaran</th>
                        <th class="col-nilai">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data) || array_sum(array_column($data, 'total_weighted_score')) == 0) : ?>
                        <tr>
                            <td colspan="3" class="text-center fs-5">Data nilai kosong</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $score) : ?>
                            <tr class="fs-5">
                                <td class="col-no"><?= $no++ ?>.</td>
                                <td>
                                    <?php
                                    $courseAbbreviations = [
                                        "Ilmu Pengetahuan Alam dan Sosial" => "IPAS",
                                        "Pendidikan Agama Islam dan Budi Pekerti" => "PAI",
                                        "Pendidikan Jasmani Olahraga dan Kesehatan" => "PJOK",
                                        "Teknologi Informasi dan Komunikasi" => "TIK"
                                    ];
                                    $courseName = htmlspecialchars($score['course_name']);
                                    if (array_key_exists($courseName, $courseAbbreviations)) {
                                        echo $courseAbbreviations[$courseName];
                                    } else {
                                        echo $courseName; 
                                    }
                                    ?>
                                </td>
                                <td id="nilai-<?= $score['course_id'] ?>" class="text-center col-nilai">
                                    <?= number_format($score['total_weighted_score'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
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
