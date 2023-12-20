<?php if (!defined('_VALID_BBC'))
  exit('No direct script access allowed'); ?>
<style>
  body {
    font-family: sans-serif;
  }

  .form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    width: 100%;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
    margin: 40px 0px;
    color: white;
  }

  .form-group {
    margin-bottom: 10px;
    padding: 0px 20px;
  }

  label {
    font-weight: bold;
  }

  textarea {
    resize: none;
  }
</style>

<body>
  <h2 class="text-center">Form Siswa</h2>
  <form action="proses_form.php" method="post">
    <!-- ========================================== -->
    <!-- START STUDENT -->
    <!-- ========================================== -->
    <div class="form-group siswa">
      <label for="nama_siswa">Nama Siswa :</label>
      <input type="text" class="form-control" name="nama_siswa" required>
    </div>

    <div class="form-group siswa">
      <label for="email">Email :</label>
      <input type="email" class="form-control" name="email" required>
    </div>

    <div class="form-group siswa">
      <label for="nis">NIS :</label>
      <input type="number" class="form-control" name="nis" required>
    </div>

    <div class="form-group siswa">
      <label for="nomer_kk">Nomor KK :</label>
      <input type="number" class="form-control" name="nomer_kk" required>
    </div>

    <div class="form-group">
      <label for="orang_tua_wali">Orang Tua atau Wali:</label>
      <select name="orang_tua_wali" id="orang_tua_wali">
        <option value="orang_tua">pilih</option>
        <option value="orang_tua">Orang Tua</option>
        <option value="wali">Wali</option>
      </select>
    </div>

    <!-- ========================================== -->
    <!-- START AYAH -->
    <!-- ========================================== -->

    <div class="form-group ayah">
      <label for="nama_ayah">Nama Ayah :</label>
      <input type="text" class="form-control" name="nama_ayah" required>
    </div>

    <div class="form-group ayah">
      <label for="email_ayah">Email Ayah :</label>
      <input type="email" class="form-control" name="email_ayah" required>
    </div>

    <div class="form-group ayah">
      <label for="nik_ayah">NIK Ayah :</label>
      <input type="number" class="form-control" name="nik_ayah" required>
    </div>

    <div class="form-group ayah">
      <label for="nomer_kk_ayah">Nomor KK Ayah :</label>
      <input type="number" class="form-control" name="nomer_kk_ayah" required>
    </div>

    <div class="form-group ayah">
      <label for="nomer_telepon_ayah">Nomor Telepon Ayah :</label>
      <input type="text" class="form-control" name="nomer_telepon_ayah" required>
    </div>

    <!-- ========================================== -->
    <!-- START IBU -->
    <!-- ========================================== -->

    <div class="form-group ibu">
      <label for="nama_ibu">Nama Ibu :</label>
      <input type="text" class="form-control" name="nama_ibu" required>
    </div>

    <div class="form-group ibu">
      <label for="email_ibu">Email Ibu :</label>
      <input type="email" class="form-control" name="email_ibu" required>
    </div>

    <div class="form-group ibu">
      <label for="nik_ibu">NIK Ibu :</label>
      <input type="number" class="form-control" name="nik_ibu" required>
    </div>

    <div class="form-group ibu">
      <label for="nomer_kk_ibu">Nomor KK Ibu :</label>
      <input type="number" class="form-control" name="nomer_kk_ibu" required>
    </div>

    <div class="form-group ibu">
      <label for="nomer_telepon_ibu">Nomor Telepon Ibu :</label>
      <input type="text" class="form-control" name="nomer_telepon_ibu" required>
    </div>

    <!-- ========================================== -->
    <!-- START WALI -->
    <!-- ========================================== -->

    <div class="form-group wali">
      <label for="nama_wali">Nama Wali :</label>
      <input type="text" class="form-control" name="nama_wali" required>
    </div>

    <div class="form-group wali">
      <label for="email_wali">Email Wali :</label>
      <input type="email" class="form-control" name="email_wali" required>
    </div>

    <div class="form-group wali">
      <label for="nik_wali">NIK wali :</label>
      <input type="number" class="form-control" name="nik_wali" required>
    </div>

    <div class="form-group wali">
      <label for="nomer_kk_wali">Nomor KK wali :</label>
      <input type="number" class="form-control" name="nomer_kk_wali" required>
    </div>

    <div class="form-group wali">
      <label for="nomer_telepon_wali">Nomor Telepon wali :</label>
      <input type="text" class="form-control" name="nomer_telepon_wali" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary col-md-12">Submit</button>
    </div>

  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
    $(document).ready(function(){
      $(".wali, .ayah, .ibu").hide();

  // Atur event change untuk select "orang_tua_wali".
  $("#orang_tua_wali").change(function() {
    // Ambil nilai yang dipilih pada select.
    var selectedOption = $(this).val();

    // Show elemen yang sesuai dengan pilihan.
    if (selectedOption === "orang_tua") {
      $(".ayah, .ibu").show();
      $(".wali").hide();
    } else if (selectedOption === "wali") {
      $(".ayah, .ibu").hide();
      $(".wali").show();
    }
  });

  // Atur event submit form.
  $("form").submit(function() {
    // Validasi jika orang tua/wali belum dipilih.
    if ($("#orang_tua_wali").val() === "") {
      alert("Harap pilih Orang Tua atau Wali terlebih dahulu!");
      return false; // batalkan submit form
    }

    // // Validasi jika orang tua dipilih maka semua field ayah dan ibu harus diisi.
    // if ($("#orang_tua_wali").val() === "orang_tua") {
    //   if ($(".ayah input").filter(":required").is(":invalid") || 
    //       $(".ibu input").filter(":required").is(":invalid")) {
    //     alert("Semua field orang tua harus diisi!");
    //     return false; // batalkan submit form
    //   }
    // }

    // // Validasi jika wali dipilih maka field nama wali dan email wali harus diisi.
    // if ($("#orang_tua_wali").val() === "wali") {
    //   if ($(".wali input").filter(":required").is(":invalid")) {
    //     alert("Nama dan email wali harus diisi!");
    //     return false; // batalkan submit form
    //   }
    // }

    // Submit form jika semua validasi terpenuhi.
    return true;
  });
    })
    
  </script>

</body>

</html>