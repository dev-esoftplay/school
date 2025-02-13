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
</head>

<body>
    <div class="container mt-4">
        <div class="header d-flex mb-4">
            <a href="teacher/scoredetail?class_id=<?= intval($_GET['class_id']) ?>"
                class="btn btn-link text-dark d-flex align-items-center text-decoration-none" style="font-size: 15px;">
                <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Kembali
            </a>
        </div>
        <h4 class="fs-3">Daftar Nilai - <?= htmlspecialchars($student_name) ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr class="fs-5">
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
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
                                <td><?= $no++ ?>.</td>
                                <td><?= htmlspecialchars($score['course_name']) ?></td>
                                <td id="nilai-<?= $score['course_id'] ?>" class="text-center">
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