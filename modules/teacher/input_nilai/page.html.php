<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Mengatur layout halaman
$sys->set_layout('teacher.php');

// Array nilai default untuk setiap mata pelajaran
$nilaiSiswa = [
    'matematika' => 90,
    'ipa' => 80,
    'ips' => null,
    'bahasa_inggris' => null,
    'pendidikan_agama' => null,
    'ppkn' => null,
    'seni_budaya' => null,
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Mata Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="header d-flex align-items-center p-3">
        <a href="teacher/scoredetail?class_id=1" class="btn btn-link text-dark d-flex align-items-center text-decoration-none" style="font-size: 15px;">
            <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Kembali
        </a>
    </div>

    <div class="p-4">
        <h1 class="mb-4">Masukkan Nilai Najwa Alexander</h1>
        <form id="scoreForm">
         <?php foreach ($nilaiSiswa as $mapel => $nilai): ?>
            <div class="mb-4">
            <label for="<?= $mapel ?>" class="form-label fs-5"><?= ucfirst(str_replace('_', ' ', $mapel)) ?></label>
            <input type="number" class="form-control form-control-lg" id="<?= $mapel ?>" name="<?= $mapel ?>" 
                   placeholder="Masukkan nilai" max="100" value="<?= isset($nilai) ? $nilai : '' ?>" />
            </div>
         <?php endforeach; ?>
        <button type="submit" class="btn btn-primary btn-lg w-100">Simpan</button>
    </form>

    </div>

    <div id="popupModal" class="modal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda sudah yakin nilai yang anda input sudah benar? Jika sudah yakin, silakan pilih lanjut untuk menyimpan nilai yang anda masukkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.reload();">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('scoreForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dari pengiriman langsung
            var popupModal = new bootstrap.Modal(document.getElementById('popupModal'));
            popupModal.show();
        });
    </script>
</body>
</html>
