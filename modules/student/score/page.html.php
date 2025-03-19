<?php

use Google\Api\ResourceDescriptor\Style;

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('student.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            margin: 0 auto;
            background-color: #f4f4f4;
            overflow-x: hidden;
            display: flex;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        .main-content {
            flex: 1;
            padding: 15px;
            transition: margin-left 0.3s ease;
        }

        .dashboard {
            padding: 15px;
        }
        

        /* Breadcrumb Style */
        .breadcrumb {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 0px;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 2fr;
            gap: 20px;
        }

        /* Dashboard Section (Card) Styles */
        .dashboard-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard-section h2 {
            font-size: 1.4em;
            margin-top: 0px;
            color: #333;
        }

        .dashboard-section ul {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-section ul p:not(:last-child) {
            margin-bottom: 10px;
        }

        p {
            margin: 0;
            font-size: 1em;
            color: #666;
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
            background: linear-gradient(135deg, #3E7B27, #66BB6A);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            color: white;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar .menu-title {
            font-size: 1.5em;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: left;
            color: white;
        }

        .sidebar .menu-list {
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
            margin: 15px 0;
        }

        .sidebar .menu-list ul li a {
            text-decoration: none;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar .menu-list ul li a:hover,
        .sidebar .menu-list ul li a.active {
            background-color: rgba(220, 245, 203, 0.5);
            color: white;
        }

        .sidebar .logout-link a {
            background-color: #DC143C;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: bold;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout-link a:hover {
            background-color: #B80F0A;
        }

        .logout-link {
            margin-top: auto;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #E0F2E7;
            text-align: center;
        }

        /* Responsive Styles */
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
            }

            .sidebar.active {
                transform: translateX(-250px);
            }

            .overlay.active {
                display: block;
            }

            .dashboard-grid-2 {
                display: grid;
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <div class="menu-separator">
                <div class="menu-1">
                    <ul>
                        <li><a href="student/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="student/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-book"></i> Raport</a></li>
                        <li><a href="student/profile" onclick="redirectAndClose(event, 'profile.php')"><i class="fas fa-user"></i> Profil</a></li>
                    </ul>
                </div>
            </div>
            </div>
        <div class="logout-link">
            <a href="student/logout" onclick="redirectAndClose(event, 'logout.php')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <div class="main-content">
        <div class="dashboard">
            <div class="breadcrumb">Student E-Rapor</div>

            <div class="container-fluid p-0">
                <div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3">
                                <div class="d-flex align-items-center mb-2 mb-sm-0">
                                    <i class="bi bi-mortarboard-fill text-primary me-2 fs-4"></i>
                                    <h1 class="h3 mb-0 fs-4 fs-md-3">E-Raport Siswa</h1>
                                </div>
                                <div class="text-start text-sm-end">
                                    <p class="small text-muted mb-0">Semester <?= $semesterName ?></p>
                                    <p class="small text-muted mb-0">Tahun Ajaran 2023/2024</p>
                                </div>
                            </div>

                            <div class="bg-light p-3 rounded">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-field">
                                            <span class="info-icon"><i class="bi bi-person text-secondary"></i></span>
                                            <span class="text-muted small info-label">Nama:</span>
                                            <span class="ms-2 fw-medium"><?php echo htmlspecialchars($studentName); ?></span>
                                        </div>
                                        <div class="info-field">
                                            <span class="info-icon"><i class="bi bi-book text-secondary"></i></span>
                                            <span class="text-muted small info-label">Kelas:</span>
                                            <span class="ms-2 fw-medium"><?= $fullClassName ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-field">
                                            <span class="info-icon"><i class="bi bi-card-heading text-secondary"></i></span>
                                            <span class="text-muted small info-label">NISN:</span>
                                            <span class="ms-2 fw-medium"><?php echo htmlspecialchars($nisn); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="student/score/pdf" class="btn btn-danger" target="_blank">Ekspor ke PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-award text-primary me-2 fs-4"></i>
                                <h2 class="h4 mb-0">Nilai Akademik</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mata Pelajaran</th>
                                            <th>Nilai</th>
                                            <th>Grade</th>
                                            <th>Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($academicScores)) : ?>
                                            <?php foreach ($academicScores as $score) : ?>
                                                <tr>
                                                    <td class="fw-medium">
                                                        <?php
                                                        // Mapping untuk course_name dan singkatannya
                                                        $courseName = strtolower(trim($score['course_name']));

                                                        switch ($courseName) {
                                                            case 'pendidikan pancasila':
                                                                echo 'PPKN';
                                                                break;
                                                            case 'ilmu pengetahuan alam dan sosial':
                                                                echo 'IPAS';
                                                                break;
                                                            case 'pendidikan agama islam dan budi pekerti':
                                                                echo 'PAI';
                                                                break;
                                                            case 'pendidikan jasmani olahraga dan kesehatan':
                                                                echo 'PJOK';
                                                                break;
                                                            case 'teknologi informasi dan komunikasi':
                                                                echo 'TIK';
                                                                break;
                                                            default:
                                                                echo htmlspecialchars($score['course_name']);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($score['score']) ?></td>
                                                    <td class="fw-medium"><?= calculateGrade($score['score']) ?></td>
                                                    <td><?= htmlspecialchars($score['teacher_name']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">Tidak ada data nilai.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const hamburger = document.getElementById('hamburger');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');

                const activePage = window.location.pathname;
                const navLinks = document.querySelectorAll('.menu-list ul li a');

                navLinks.forEach(link => {
                    if (link.href.includes(${activePage})) {
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
            </script>
</body>

</html>