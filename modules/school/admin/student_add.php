<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>

<style>
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
</style>
<body>
<?php
$data = array('params' => '');
if (!empty($_FILES['file'])) 
{
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
  {
    if ($value['E'] !== null) // INSERT DATA AYAH
    {
      $ayah_user_id_file = $db->Insert('bbc_user', array(
        'password'  => $value['E'],
        'username'  => $value['F'],
        'group_ids' => '4'
      ));

      $ayah_parent_id_file = $db->Insert('school_parent', array(
        'name'    => $value['E'],
        'user_id' => $ayah_user_id_file,
        'nik'     => $value['F'],
        'nokk'    => $value['D'],
        'address' => $value['C'],
        'phone'   => $value['G']
      ));

      $db->insert('bbc_account', array(
        'user_id' => $ayah_user_id_file,
        'username'=> $value['F'],
        'name'    => $value['E']
      ));
    }

    if ($value['H'] !== null) // INSERT DATA IBU
    {
      $ibu_user_id_file = $db->Insert('bbc_user', array(
        'password'  => $value['H'],
        'username'  => $value['I'],
        'group_ids' => '4'
      ));

      $ibu_parent_id_file = $db->Insert('school_parent', array(
        'name'    => $value['H'],
        'user_id' => $ibu_user_id_file,
        'nik'     => $value['I'],
        'nokk'    => $value['D'],
        'address' => $value['C'],
        'phone'   => $value['J'],
      ));
      
      $db->insert('bbc_account', array(
        'user_id' => $ibu_user_id_file,
        'username'=> $value['I'],
        'name'    => $value['H'],
      ));
    }

    if ($value['K'] !== null) // INSERT DATA WALI
    {
      $wali_user_id_file = $db->Insert('bbc_user', array(
        'password'  => $value['K'],
        'username'  => $value['L'],
        'group_ids' => '4'
      ));
    
      $wali_parent_id_file = $db->Insert('school_parent', array(
        'name'    => $value['K'],
        'user_id' => $wali_user_id_file,
        'nik'     => $value['L'],
        'nokk'    => $value['M'],
        'address' => $value['O'],
        'phone'   => $value['N'],
      ));
    
      $db->insert('bbc_account', array(
        'user_id' => $wali_user_id_file,
        'username'=> $value['L'],
        'name'    => $value['K'],
      ));
    }

    if ($value['A']) // INSERT DATA STUDENT
    {
      $student_user_id_file = $db->Insert('bbc_user', array(
        'password'  => $value['A'],
        'username'  => $value['B'],
        'group_ids' => '4'
      ));
    
      $student_id_file = $db->Insert('school_student', array(
        'user_id'         => $student_user_id_file,
        'parent_id_dad'   => $ayah_parent_id_file ?? null,
        'parent_id_mom'   => $ibu_parent_id_file ?? null,
        'parent_id_guard' => $wali_parent_id_file ?? null,
        'name'            => $value['A'],
        'nokk'            => $value['D'],
        'address'         => $value['C'],
        'nis'             => $value['B'],
      ));
    
      $db->insert('bbc_account', array(
        'user_id' => $student_user_id_file,
        'username'=> $value['B'],
        'name'    => $value['A']
      ));
    }

  // INSERT PIVOT TABLE STUDENT && PARENT
  if ($value['K']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id_file,
        'parent_id'  => $wali_parent_id_file
      ));
    }

    if ($value['E']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id_file,
        'parent_id'  => $ayah_parent_id_file
      ));
    }

    if ($value['H']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id_file,
        'parent_id'  => $ibu_parent_id_file
      ));
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
  // if (isset($_POST['MyRadio'])) {
  //   $valueRadio = $_POST['MyRadio'];
  //   echo $valueRadio. 'hellooooo';
  // } else {
  //   echo "Radio button not selected";
  // }

  $phone_ayah     = isset($_POST['nomer_telepon_ayah']) ? $_POST['nomer_telepon_ayah'] : null;
  $phone_wali     = isset($_POST['nomer_telepon_wali']) ? $_POST['nomer_telepon_wali'] : null;
  $phone_ibu      = isset($_POST['nomer_telepon_ibu']) ? $_POST['nomer_telepon_ibu'] : null;
  $nomer_kk_wali  = isset($_POST['nomer_kk_wali']) ? $_POST['nomer_kk_wali'] : null;
  $alamat_wali    = isset($_POST['alamat_wali']) ? $_POST['alamat_wali'] : null;
  $nama_siswa     = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : null;
  $nama_ayah      = isset($_POST['nama_ayah']) ? $_POST['nama_ayah'] : null;
  $nama_wali      = isset($_POST['nama_wali']) ? $_POST['nama_wali'] : null;
  $nama_ibu       = isset($_POST['nama_ibu']) ? $_POST['nama_ibu'] : null;
  $nomer_kk       = isset($_POST['nomer_kk']) ? $_POST['nomer_kk'] : null;
  $nik_ayah       = isset($_POST['nik_ayah']) ? $_POST['nik_ayah'] : null;
  $nik_wali       = isset($_POST['nik_wali']) ? $_POST['nik_wali'] : null;
  $nik_ibu        = isset($_POST['nik_ibu']) ? $_POST['nik_ibu'] : null;
  $alamat         = isset($_POST['alamat']) ? $_POST['alamat'] : null;
  $nis            = isset($_POST['nis']) ? $_POST['nis'] : null;

  if ($nama_ayah) // INSERT DATA AYAH
  {
    $ayah_user_id = $db->Insert('bbc_user', array(
      'password'  => $nama_ayah,
      'username'  => $nik_ayah,
      'group_ids' => '4'
    ));

    $ayah_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ayah_user_id,
      'name'    => $nama_ayah,
      'phone'   => $phone_ayah,
      'nik'     => $nik_ayah,
      'nokk'    => $nomer_kk,
      'address' => $alamat,
    ));
    
    $db->insert('bbc_account', array(
      'user_id' => $ayah_user_id,
      'username'=> $nik_ayah,
      'name'    => $nama_ayah
    ));
  }

  if ($nama_ibu) // INSERT DATA IBU 
  {
    $ibu_user_id = $db->Insert('bbc_user', array(
      'password'  => $nama_ibu,
      'username'  => $nik_ibu,
      'group_ids' => '4'
    ));
  
    $ibu_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ibu_user_id,
      'name'    => $nama_ibu,
      'phone'   => $phone_ibu,
      'nik'     => $nik_ibu,
      'nokk'    => $nomer_kk,
      'address' => $alamat,
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $ibu_user_id,
      'username'=> $nik_ibu,
      'name'    => $nama_ibu
    ));
  }

  if ($nama_wali) // INSERT DATA WALI
  {
    $wali_user_id = $db->Insert('bbc_user', array(
      'password'  => $nama_wali,
      'username'  => $nik_wali,
      'group_ids' => '4'
    ));
  
    $wali_parent_id = $db->Insert('school_parent', array(
      'user_id' => $wali_user_id,
      'name'    => $nama_wali,
      'phone'   => $phone_wali,
      'nik'     => $nik_wali,
      'nokk'    => $nomer_kk_wali,
      'address' => $alamat_wali,
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $wali_user_id,
      'username'=> $nik_wali,
      'name'    => $nama_wali
    ));
  }
  
  if ($nama_siswa) // INSERT DATA STUDENT
  {
    $student_user_id = $db->Insert('bbc_user', array(
      'password'  => $nama_siswa,
      'username'  => $nis,
      'group_ids' => '4'
    ));
  
    $student_id = $db->Insert('school_student', array(
      'user_id'         => $student_user_id,
      'parent_id_dad'   => $ayah_parent_id ?? null,
      'parent_id_mom'   => $ibu_parent_id ?? null,
      'parent_id_guard' => $wali_parent_id ?? null,
      'name'            => $nama_siswa,
      'nokk'            => $nomer_kk,
      'address'         => $alamat,
      'nis'             => $nis,
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $student_user_id,
      'username'=> $nis,
      'name'    => $nama_siswa
    ));
  }

  // INSERT PIVOT TABLE STUDENT && PARENT
  if ($nama_wali) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $wali_parent_id
    ));
  }

  if ($nama_ayah) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $ayah_parent_id
    ));
  }

  if ($nama_ibu) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $ibu_parent_id
    ));
  }
}
?>
  <h2 class="text-center">Form Siswa</h2>
  <form method="post" enctype="multipart/form-data">
    <!-- ========================================== -->
    <!-- START STUDENT -->
    <!-- ========================================== -->
    <div class="form-group siswa">
      <label for="nama_siswa">Nama Siswa :</label>
      <input type="text" class="form-control" name="nama_siswa" required>
    </div>

    <div class="form-group siswa">
      <label for="nis">NIS :</label>
      <input type="number" class="form-control" name="nis" required>
    </div>

    <div class="form-group siswa">
      <label for="nomer_kk">Nomor KK :</label>
      <input type="number" class="form-control" name="nomer_kk" required>
    </div>

    <div class="form-group siswa">
      <label for="alamat">Alamat :</label>
      <input type="text" class="form-control" name="alamat" required>
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
      <input type="text" class="form-control" name="nama_ayah" required>
    </div> 

    <div class="form-group ayah">
      <label for="nik_ayah">NIK Ayah :</label>
      <input type="number" class="form-control" name="nik_ayah" required>
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
      <label for="nik_ibu">NIK Ibu :</label>
      <input type="number" class="form-control" name="nik_ibu" required>
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

    <div class="form-group wali">
      <label for="alamat_wali">Alamat wali :</label>
      <input type="text" class="form-control" name="alamat_wali" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary col-md-12">Submit</button>
    </div>
  </form>
  <form method="POST" enctype="multipart/form-data" class="form-import-excel">
    <div class="form-group">
      <h3><?php echo lang('Tambah Data Siswa Dan Orang Tua');?></h3>
      <div class="wrap-text" style="padding: 0px 10px;">
        <label for="fileInput"><?php echo lang('Pilih File');?></label>
        <input type="file" name="file">
      </div>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit" style="width: 400px; margin: 10px 20px;">Submit</button>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
  $(document).ready(function()
  {
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
  });
</script>


</body>

</html>