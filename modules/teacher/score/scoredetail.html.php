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
    /* Default font size for the table */
    .table th, .table td {
      font-size: 1rem; /* Default font size for mobile/tablet */
    }

    /* Media query for desktop */
    @media (min-width: 768px) {
      /* Decrease width of specific columns on desktop */
      .col-no {
        width: 1%; /* Column No */
      }

      .col-nis {
        width: 15%; /* Column NIS */
      }

      .col-aksi {
        width: 10%; /* Column Aksi */
      }

      .table th, .table td {
        font-size: 1.8rem; /* Larger font for desktop */
      }

      /* Increase size of buttons on desktop */
      .btn-responsive {
        font-size: 1.25rem;
        padding: 0.75rem 1.25rem;
      }
    }

    /* Media query for mobile version */
    @media (max-width: 767px) {
      /* Increase font size for mobile */
      .table th, .table td {
        font-size: 1.4rem; /* Larger font for mobile */
      }

      /* Add horizontal margin */
      .container {
        margin-left: 1rem;
        margin-right: 1rem;
      }

      /* Adjust button size for mobile */
      .btn-responsive {
        font-size: 1rem; /* Smaller font size for mobile */
        padding: 0.5rem 1rem; /* Less padding for mobile */
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <div class="mx-md-5 mx-2">
    <div class="header d-flex align-items-center justify-content-between bg-white px-4 mt-md-5 mb-md-5">
      <a href="teacher/score" onclick="redirectAndClose(event, 'score.php')" class="fs-2 text-decoration-none text-dark cursor-pointer">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
      <h1 class="fs-2">
        Kelas <?= htmlspecialchars(str_replace(' ', '', $className . $labelClass), ENT_QUOTES, 'UTF-8') ?>
      </h1>
    </div>
    <div class="mt-4">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr class="fs-5">
            <th class="col-no">No</th>
            <th>Nama</th>
            <th class="col-nis">NIS</th>
            <th class="col-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($students)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($students as $student) : ?>
              <tr>
                <td class="col-no"><?= $no++ . '.' ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td class="col-nis"><?= htmlspecialchars($student['nis']) ?></td>
                <td class="col-aksi">
                  <!-- Combined Button with responsive size -->
                  <a href="teacher/inputnilai?student_id=<?= $student['student_id'] ?>&class_id=<?= $class_id ?>" class="btn btn-warning btn-lg btn-responsive">Edit</a>
                  <a href="teacher/scorestudentdetail/?student_id=<?= $student['student_id'] ?>&class_id=<?= $class_id ?>" class="btn btn-primary btn-lg btn-responsive">Lihat</a>
                </td>
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
  </div>
</body>

</html>
