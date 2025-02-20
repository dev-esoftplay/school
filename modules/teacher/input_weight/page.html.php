<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Mengatur layout halaman
$sys->set_layout('teacher.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Bobot Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding: 15px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            font-size: 16px;
        }

        .alert {
            font-size: 14px;
            text-align: center;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><?= $id ? 'Edit' : 'Tambah' ?> Bobot Nilai</h2>

                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
                <?php elseif (isset($errorMessage)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($scoreWeight['name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Persentase Bobot (%)</label>
                        <input type="number" class="form-control" id="weight" name="weight" value="<?= htmlspecialchars($scoreWeight['weight'] ?? '') ?>" min="0" max="100" required>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $id ? 'Simpan' : 'Tambah' ?></button>
                    <a href="teacher/score" class="btn btn-outline-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>