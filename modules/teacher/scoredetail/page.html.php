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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Daftar Siswa</title>
    <style>

      .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        justify-content: space-between;
        background-color: #fff;
        padding: 20px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      .header .back-btn {
        font-size: 18px;
        color: #333;
        text-decoration: none;
      }

      .header .back-btn i {
        margin-right: 5px;
      }

      .header h1 {
        font-size: 18px;
        margin: 0;
        color: #333;
        flex-grow: 1;
        text-align: right;
      }

      .header .menu-btn {
        font-size: 20px;
        color: #333;
        background: none;
        border: none;
        cursor: pointer;
      }      
    </style>
  </head>
  <body>
    <!-- Header -->
    <div class="header">
      <a href="teacher/score" onclick="redirectAndClose(event, 'score.php')" class="back-btn" ><i class="fas fa-arrow-left"></i> Kembali</a>
      <h1>Kelas 1A</h1>
    </div>
    <div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data statis, bisa diganti dengan data dinamis -->
            <tr>
            <td class="text-center">1</td>
            <td>Arkyn the Root-digger</td>
            <td>92400</td>
            <td><a href="teacher/scorestudentdetail"" class="btn btn-primary btn-sm">Edit</a></td>
          </tr>
          <tr>
            <td class="text-center">2</td>
            <td>Oddrun the Fierce</td>
            <td>98657</td>
            <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
          </tr>
          <tr>
            <td class="text-center">3</td>
            <td>Ragnor the Winter-survivor</td>
            <td>98657</td>
            <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
          </tr>
          <tr>
            <td class="text-center">4</td>
            <td>Askr the Fire-hearted</td>
            <td>98657</td>
            <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
          </tr>
            <!-- Tambahkan data dinamis di sini -->
        </tbody>
    </table>
    </div>
  </body>
</html>
