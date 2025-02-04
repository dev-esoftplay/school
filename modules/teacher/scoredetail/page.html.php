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
    <h1 class="fs-3">Kelas 1A</h1>
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
        <?php foreach ($dataSiswa as $siswa): ?>
          <tr>
            <td class="fs-5"><?= $siswa['no'] ?></td>
            <td class="fs-5"><?= $siswa['nama'] ?></td>
            <td class="fs-5"><?= $siswa['nis'] ?></td>
            <td>
              <div class="d-flex flex-column flex-md-row gap-2">
                <a href="teacher/scorestudentdetail" class="btn btn-primary btn-sm w-100 w-md-auto">Detail</a>
                <a href="teacher/inputnilai" class="btn btn-secondary btn-sm w-100 w-md-auto">Edit</a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>