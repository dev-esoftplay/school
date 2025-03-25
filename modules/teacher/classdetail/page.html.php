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
    body {
      background-color: #f8f9fa;
    }

    .custom-blue {
      background-color: #0056b3 !important;
      color: white;
    }

    .header {
      background-color: white;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table-container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table {
      width: 100%;
      min-width: 600px;
    }

    .table tbody tr:hover {
      background-color: #f1f1f1;
    }

    .btn-back {
      color: black;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .btn-back:hover {
      color: #0856aa;
    }

    /* Mengurangi padding di dalam tabel untuk mendekatkan kolom */
    .table th, .table td {
      padding: 8px 10px; /* Menyesuaikan padding agar lebih rapat */
    }

    /* Media query for desktop */
    @media (min-width: 768px) {
      /* Decrease width of specific columns on desktop */
      .col-no {
        width: 1%; 
      }

      .col-nis {
        width: 15%; 
      }

      .table th, .table td {
        font-size: 1.8rem; 
      }
    }

    /* Responsive Tabel */
    @media (max-width: 768px) {
      .table-container {
        padding: 10px;
      }

      .table {
        font-size: 14px;
      }

      .table th, .table td {
        font-size: 1.4rem; 
      }

      .header h1 {
        font-size: 1.5rem;
      }

      .btn-back {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>

  <div class="header d-flex align-items-center justify-content-between p-3 px-4 mb-4">
    <a href="teacher/class" onclick="redirectAndClose(event, 'score.php')" class="btn-back text-decoration-none">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <h1 class="fs-3">
      Kelas <?= htmlspecialchars(($className ?? 'Tidak Ada') . ' ' . ($labelClass ?? ''), ENT_QUOTES, 'UTF-8') ?>
    </h1>
  </div>

  <div class="container mt-4">
    <div class="table-container">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="custom-blue">
            <tr class="fs-5">
              <th class="col-no">No</th>
              <th>Nama</th>
              <th class="col-nis">NIS</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($students)) : ?>
              <?php $no = 1; ?>
              <?php foreach ($students as $student) : ?>
                <tr>
                  <td class="col-no"><?= $no++ ?></td>
                  <td> <?= htmlspecialchars($student['name']) ?></td>
                  <td class="col-nis"><?= htmlspecialchars($student['nis']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="3" class="text-center">Tidak ada siswa dalam kelas ini.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>
