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
    <title>Input Nilai</title>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Styles -->
    <style>
        /* General Styles */
        body {
            margin: 0;
            display: flex;
        }

        .main-content {
            flex: 1;
            padding: 15px;
            transition: margin-left 0.3s ease;
        }

        .breadcrumb {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 0px;
            background: none;
            font-size: min(3vw, 2vh, 18px);
        }

        .breadcrumb-item-dashboard {
            color: #4B5320;
            /* Warna Hijau Army */
            font-weight: bold;
            font-size: min(3vw, 2vh, 18px);
            text-decoration: none;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            font-size: min(3vw, 2vh, 18px);
            color: #4B5320;
            font-weight: 600;
            text-decoration: none;
        }

        .breadcrumb-item-dashboard:hover {
            color: #3E4C23;
            font-size: min(3vw, 2vh, 18px);
        }

        /* Hamburger Button */
        .hamburger {
            display: none;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        /* When sidebar is open, rotate the hamburger icon */
        .hamburger.open {
            transform: rotate(90deg);
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar .menu-title {
            font-size: 1.2em !important;
            margin-top: 5px;
            margin-bottom: 10px;
            color: #006400;
            font-weight: bold;
            text-align: left;
        }

        .sidebar .menu-list {
            /* Fixed typo by removing space */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar .menu-list ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu-list ul li {
            margin: 10px 0;
            color: #333;
        }

        /* Default styles for anchor links in the sidebar */
        .sidebar .menu-list ul li a {
            text-decoration: none;
            color: black;
            padding: 10px;
            border-radius: 5px;
            display: block;
        }

        /* Hover effect for the links */
        .sidebar .menu-list ul li a:hover {
            background-color: #d3f4d1;
            color: #3E7B27;
            text-decoration: none;
        }

        /* Active link (current page) style */
        .sidebar .menu-list ul li a.active {
            background-color: #d3f4d1;
            color: #3E7B27;
            font-weight: bold;
            text-decoration: none;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        .sidebar .logout-link a {
            color: red;
            background-color: transparent;
            padding: 12px 15px;
            border-radius: 5px;
            font-weight: bold;
            display: block;
        }

        .sidebar .logout-link a:hover {
            text-decoration: none;
            background-color: red;
            color: white;
        }

        .logout-link {
            margin-top: auto;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            body {
                display: block;
            }

            .hamburger {
                display: block;
            }

            .sidebar {
                position: fixed;
                right: -250px;
                transition: transform 0.3s ease;
                font-size: 1.2em !important;
            }

            .sidebar.active {
                transform: translateX(-250px);
            }

            .overlay.active {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                position: fixed;
                left: 0;
                transition: transform 0.3s ease;
                font-size: 1.4em !important;
            }

            .main-content {
                flex: 1;
                padding: 15px;
                transition: margin-left 0.3s ease;
            }
        }
    </style>
</head>

<body>
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    <!-- Hamburger Button  -->
    <button class="hamburger" id="hamburger">☰</button>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <div class="menu-separator">
                <div class="menu-1">
                    <ul>
                        <li><a href="teacher/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="teacher/class" onclick="redirectAndClose(event, 'class.php')"><i class="fas fa-chalkboard"></i> Kelas</a></li>
                        <li><a href="teacher/announcement" onclick="redirectAndClose(event, 'announcement.php')"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                        <li><a href="teacher/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-pencil-alt"></i> Input Nilai</a></li>
                        <li><a href="teacher/profile" onclick="redirectAndClose(event, 'profile.php')"><i class="fas fa-user"></i> Profil</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logout-link">
            <a href="teacher/logout" onclick="redirectAndClose(event, 'logout.php')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <div class="main-content">
        <!-- Content Area -->
        <div class="container mt-4">
            <!-- Breadcrumb for Title -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="teacher/dashboard" class="breadcrumb-item-dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active " aria-current="page">Input Nilai</li>
                </ol </nav>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Nilai Mapel</div>
                            <div class="card-body">
                                <p>Menampilkan data kelas & wali kelas</p>
                                <button class="btn btn-primary" id="showClassTable">Tampilkan Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">Bobot Nilai</div>
                            <div class="card-body">
                                <p>Atur bobot nilai untuk setiap kategori</p>
                                <button class="btn btn-success" id="showWeightTable">Tampilkan Bobot Nilai</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="classTableContainer" class="hidden container mt-2">
                    <h2 class="mb-4 fw-semibold fs-1">Daftar kelas yang diampu</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr class="fs-4">
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Siswa</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($teacherClass)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($teacherClass as $data) : ?>
                                    <tr>
                                        <td class="fs-5"><?= $no++ . '.' ?></td>
                                        <td class="fs-5">
                                            kelas <?= htmlspecialchars(str_replace(' ', '', "{$data['kelas']}{$data['label']}"), ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td class="fs-5"><?= $data['siswa'] ?> siswa</td>
                                        <td class="fs-5"><?= htmlspecialchars($data['wali_kelas']) ?></td>
                                        <td>
                                            <a href="teacher/scoredetail?class_id=<?= $data['id'] ?>" class="btn btn-primary btn-md">Lihat</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center fs-5">Tidak ada kelas yang diampu</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Bobot Nilai -->
                <div id="weightTableContainer" class="hidden container mt-2">
                    <div class="d-flex align-items-center">
                        <h3 class="mb-4 fw-semibold fs-1 me-3">Bobot Nilai Mata Pelajaran</h3>
                        <a href="teacher/inputweight/add" class="btn btn-success mb-3 ms-auto">Tambah Bobot Nilai</a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>id</th>
                                <th>Nama Kategori</th>
                                <th>Bobot (%)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($scoreWeights)) : ?>
                                <?php foreach ($scoreWeights as $weight) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($weight['id']) ?></td>
                                        <td><?= htmlspecialchars($weight['name']) ?></td>
                                        <td><?= $weight['weight'] ?>%</td>
                                        <td>
                                            <a href="teacher/inputweight?id=<?= $weight['id'] ?>" class="btn btn-primary btn-md">Edit</a>
                                            <button class="btn btn-danger btn-md delete-weight" data-id="<?= $weight['id'] ?>">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada bobot nilai yang diatur</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
        </div>
        <!-- Scripts -->
        <script>
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const activePage = window.location.pathname;
            const navLinks = document.querySelectorAll('.menu-list ul li a');

            navLinks.forEach(link => {
                if (link.href.includes(`${activePage}`)) {
                    link.classList.add('active');
                }
            });

            hamburger.addEventListener('click', () => {
                if (sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    hamburger.textContent = '☰';
                    hamburger.classList.remove('open');
                } else {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                    hamburger.textContent = '×';
                    hamburger.classList.add('open');
                }
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                hamburger.textContent = '☰';
                hamburger.classList.remove('open');
            });

            $(document).ready(function() {
                // Show class table by default when page loads
                $("#classTableContainer").removeClass("hidden");

                $("#showClassTable").click(function() {
                    console.log("Class Table Button Clicked");
                    $("#classTableContainer").removeClass("hidden");
                    $("#weightTableContainer").addClass("hidden");
                });

                $("#showWeightTable").click(function() {
                    console.log("Weight Table Button Clicked");
                    $("#weightTableContainer").removeClass("hidden");
                    $("#classTableContainer").addClass("hidden");
                });
            });

            $(document).on("click", ".delete-weight", function() {
                let weightId = $(this).data("id");

                if (confirm("Apakah Anda yakin ingin menghapus bobot nilai ini?")) {
                    $.ajax({
                        url: window.location.href,
                        type: "POST",
                        data: {
                            delete_id: weightId
                        },
                        success: function(response) {
                            alert(response);
                            location.reload();
                        },
                        error: function() {
                            alert("Gagal menghapus data. Coba lagi.");
                        },
                    });
                }
            });
        </script>
    </div>
</body>

</html>