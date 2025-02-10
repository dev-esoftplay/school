<?php
if (!defined('_VALID_BBC'))
  exit('No direct script access allowed');

// Mengatur layout halaman
$sys->set_layout('teacher.php');

// Mendefinisikan data siswa sebagai array multidimensi
$dataSiswa = [
  ['no' => 1, 'nama' => 'Arkyn the Root-digger', 'nis' => '92400'],
  ['no' => 2, 'nama' => 'Oddrun the Fierce', 'nis' => '98657'],
  ['no' => 3, 'nama' => 'Ragnor the Winter-survivor', 'nis' => '98657'],
  ['no' => 4, 'nama' => 'Askr the Fire-hearted', 'nis' => '98657',]
];

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
    <h1 class="fs-3">Kelas <?= htmlspecialchars($className); ?></h1>
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
              <td><?= $no++ . '.' ?></td>
              <td><?= htmlspecialchars($student['name']) ?></td>
              <td><?= htmlspecialchars($student['nis']) ?></td>
              <td>
                <a href="teacher/inputnilai" class="btn btn-warning btn-md">Edit</a>
                <!-- <a href="teacher/scorestudentdetail<?= $student['id'] ?>" class="btn btn-primary btn-md">Lihat</a> -->
                <a href="teacher/scorestudentdetail" class="btn btn-primary btn-md">Lihat</a>

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