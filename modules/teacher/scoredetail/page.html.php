<?php
if (!defined('_VALID_BBC'))
  exit('No direct script access allowed');

// Mengatur layout halaman
$sys->set_layout('teacher.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Daftar Siswa</title>
  <style>
  </style>
</head>

<body>
  <!-- Header -->
  <div class="header d-flex align-items-center justify-content-between bg-white p-3 px-4 mb-4 shadow-sm">
    <a href="teacher/score" onclick="redirectAndClose(event, 'score.php')" class="fs-3 text-decoration-none text-dark cursor-pointer"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h1 class="fs-3">
      Kelas <?= htmlspecialchars(str_replace(' ', '', $className . $labelClass), ENT_QUOTES, 'UTF-8') ?>
    </h1>
  </div>
  <div class="container mt-4">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr class="fs-5">
          <th>No</th>
          <th>Nama</th>
          <th>NIS</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($students)) : ?>
          <?php $no = 1; ?>
          <?php foreach ($students as $student) : ?>
            <tr>
              <td class="fs-5"><?= $no++ . '.' ?></td>
              <td class="fs-5"><?= htmlspecialchars($student['name']) ?></td>
              <td class="fs-5"><?= htmlspecialchars($student['nis']) ?></td>
              <td>
                <a href="teacher/inputnilai" class="btn btn-warning btn-md">Edit</a>
                <a href="teacher/scorestudentdetail/?student_id=<?= $student['student_id'] ?>&class_id=<?= $class_id ?>" class="btn btn-primary btn-md">Lihat</a>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="4" class="text-center">Tidak ada siswa dalam kelas ini.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>