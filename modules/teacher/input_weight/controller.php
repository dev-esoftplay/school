<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Memastikan pengguna aktif
$userExist = $db->getOne("SELECT COUNT(*) FROM `bbc_user` WHERE `id` = $user->id AND `active` = 1");

if ($userExist != 1) {
    user_logout($user->id);
    redirect(_URL);
}

if (empty($user->id)) {
    redirect(_URL);
}

// Mendapatkan ID guru berdasarkan user_id
$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = $user->id");

// Mengambil ID dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID valid, ambil data bobot nilai berdasarkan ID
$scoreWeight = null;
if ($id) {
    $scoreWeight = $db->getRow("SELECT id, name, weight FROM school_score_cat WHERE id = $id");
}

// Menangani proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $weight = isset($_POST['weight']) ? (int)$_POST['weight'] : 0;

    // Validasi input
    if (!empty($name) && $weight >= 0 && $weight <= 100) {
        if ($id > 0) {
            // Update existing record
            $sql = "UPDATE school_score_cat SET name = '$name', weight = $weight WHERE id = $id";
            $result = $db->execute($sql, [$name, $weight, $id]);

            // Mengecek apakah update berhasil
            if ($result) {
                $successMessage = "Berhasil memperbarui bobot nilai!";
                redirect('teacher/score');
                exit();
            } else {
                $errorMessage = "Gagal memperbarui bobot nilai!";
            }
        } else {
            // Insert new record if no ID is present (add new)
            $sql = "INSERT INTO school_score_cat (name, weight) VALUES ('$name', $weight)";
            $result = $db->execute($sql, [$name, $weight]);

            if ($result) {
                $successMessage = "Bobot nilai berhasil ditambahkan!";
                redirect('teacher/score');
                exit();
            } else {
                $errorMessage = "Gagal menambahkan bobot nilai!";
            }
        }
    } else {
        // Tampilkan pesan error jika validasi gagal
        $errorMessage = "Nama dan bobot nilai harus valid!";
    }
}

// Tampilkan halaman
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

// Include the page template
include tpl('page.html.php');
?>
