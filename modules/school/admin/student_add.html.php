<body>
  <h2 class="text-center"><?php echo lang('Form Siswa');?></h2>
  <form method="post" enctype="multipart/form-data" class="col-md-7 form-import-excel">
    <!-- ========================================== -->
    <!-- START STUDENT -->
    <!-- ========================================== -->
    <div class="form-group siswa">
      <label for="nama_siswa">Nama Siswa :</label>
      <input type="text" class="form-control" name="nama_siswa" <?php echo $input_post['nama_siswa'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="tanggal_lahir_siswa">Tanggal Lahir :</label>
      <input type="date" class="form-control" name="tanggal_lahir_siswa" <?php echo $input_post['tanggal_lahir_siswa'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="nis">NIS :</label>
      <input type="number" class="form-control" name="nis" <?php echo $input_post['nis'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="nomer_kk">Nomor KK :</label>
      <input type="number" class="form-control" name="nomer_kk" <?php echo $input_post['nomer_kk'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="alamat">Alamat :</label>
      <input type="text" class="form-control" name="alamat" <?php echo $input_post['alamat'] ?> required>
    </div>

    <div class="form-group">
      <input type="radio" name="MyRadio" value="orang tua" checked> orang tua <br>
      <input type="radio" name="MyRadio" value="wali"> wali
    </div>
    <!-- ========================================== -->
    <!-- START AYAH -->
    <!-- ========================================== -->
    <div class="form-group ayah">
      <label for="nama_ayah">Nama Ayah :</label>
      <input type="text" class="form-control" name="nama_ayah" <?php echo $input_post['nama_ayah'] ?> required>
    </div> 

    <div class="form-group ayah">
      <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah :</label>
      <input type="date" class="form-control" name="tanggal_lahir_ayah" <?php echo $input_post['tanggal_lahir_ayah'] ?> required>
    </div>

    <div class="form-group ayah">
      <label for="nik_ayah">NIK Ayah :</label>
      <input type="number" class="form-control" name="nik_ayah" <?php echo $input_post['nik_ayah'] ?> required>
    </div>

    <div class="form-group ayah">
      <label for="nomer_telepon_ayah">Nomor Telepon Ayah :</label>
      <input type="text" class="form-control" name="nomer_telepon_ayah" <?php echo $input_post['nomer_telepon_ayah'] ?> required>
    </div>

    <!-- ========================================== -->
    <!-- START IBU -->
    <!-- ========================================== -->

    <div class="form-group ibu">
      <label for="nama_ibu">Nama Ibu :</label>
      <input type="text" class="form-control" name="nama_ibu" <?php echo $input_post['nama_ibu'] ?> required>
    </div> 

    <div class="form-group ibu">
      <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu :</label>
      <input type="date" class="form-control" name="tanggal_lahir_ibu" <?php echo $input_post['tanggal_lahir_ibu'] ?> required>
    </div>

    <div class="form-group ibu">
      <label for="nik_ibu">NIK Ibu :</label>
      <input type="number" class="form-control" name="nik_ibu" <?php echo $input_post['nik_ibu'] ?> required>
    </div>

    <div class="form-group ibu">
      <label for="nomer_telepon_ibu">Nomor Telepon Ibu :</label>
      <input type="text" class="form-control" name="nomer_telepon_ibu" <?php echo $input_post['nomer_telepon_ibu'] ?> required>
    </div>

    <!-- ========================================== -->
    <!-- START WALI -->
    <!-- ========================================== -->

    <div class="form-group wali">
      <label for="nama_wali">Nama Wali :</label>
      <input type="text" class="form-control" name="nama_wali" <?php echo $input_post['nama_wali'] ?> required>
    </div> 

    <div class="form-group wali">
      <label for="tanggal_lahir_wali">Tanggal Lahir wali :</label>
      <input type="date" class="form-control" name="tanggal_lahir_wali" <?php echo $input_post['tanggal_lahir_wali'] ?> required>
    </div>

    <div class="form-group wali">
      <label for="nik_wali">NIK wali :</label>
      <input type="number" class="form-control" name="nik_wali" <?php echo $input_post['nik_wali'] ?> required>
    </div>

    <div class="form-group wali">
      <label for="nomer_kk_wali">Nomor KK wali :</label>
      <input type="number" class="form-control" name="nomer_kk_wali" <?php echo $input_post['nomer_kk_wali'] ?> required>
    </div>

    <div class="form-group wali">
      <label for="nomer_telepon_wali">Nomor Telepon wali :</label>
      <input type="text" class="form-control" name="nomer_telepon_wali" <?php echo $input_post['nomer_telepon_wali'] ?> required>
    </div>

    <div class="form-group wali">
      <label for="alamat_wali">Alamat wali :</label>
      <input type="text" class="form-control" name="alamat_wali" <?php echo $input_post['alamat_wali'] ?> required>
    </div>

    <div class="form-group">
      <button type="submit" name="manual" class="btn btn-primary col-md-12">Submit</button>
    </div>
  </form>
  <!-- import data with Excel -->
  <div class="col-md-4">
    <form method="POST" role="form" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">Add Student Parent with Excel</h1>
        </div>
        <div class="panel-body">
          <?php
          foreach ($fields as $fieldName) 
          {
            $label = ucwords(str_replace('_', ' ', $fieldName));
            echo '<div class="form-group">';
            echo '<label for="">' . 'Field ' . $label . '</label>';
            echo '<input type="text" name="' . $fieldName . '" class="form-control input-file" id="" placeholder="Input field" >';
            echo '</div>';
          }
          ?>
          <div class="form-group">
            <label for="fileInput">Pilih File</label>
            <input type="file" name="file" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary button-file col-md-11" name="import_excel" value="submit">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
    $(document).ready(function()
    {
      $("#error-span").show();
      $("input[name='MyRadio']").on('change', function() 
      {
        let value = $("input[name='MyRadio']:checked").val();

        // Clear the required attribute for all fields
        $(".form-group input").prop('required', false);

        // Set the required attribute based on the selected value
        if(value == "orang tua") {
          $(".wali input").prop('required', false);
          $(".ayah input, .ibu input").prop('required', true);
          $(".wali").hide();
          $(".ayah, .ibu").show();
        } else if(value == "wali") {
          $(".ayah input, .ibu input").prop('required', false);
          $(".wali input").prop('required', true);
          $(".wali").show();
          $(".ayah, .ibu").hide();
        }
      });

      // Set initial state based on the default selected radio button
      let initialValue = $("input[name='MyRadio']:checked").val();
      if (initialValue == "orang tua") 
      {
        $(".wali input").prop('required', false);
        $(".ayah input, .ibu input").prop('required', true);
        $(".wali").hide();
        $(".ayah, .ibu").show();
      } else if (initialValue == "wali") 
      {
        $(".ayah input, .ibu input").prop('required', false);
        $(".wali input").prop('required', true);
        $(".wali").show();
        $(".ayah, .ibu").hide();
      }
      $('input.input-file').on('input', function() {
        var inputValue = $(this).val();
        var uppercaseValue = inputValue.toUpperCase();
        $(this).val(uppercaseValue);
      });

      setTimeout(function () {
          $("#error-span").hide();
      }, 10000);
    });
  </script>
</body>