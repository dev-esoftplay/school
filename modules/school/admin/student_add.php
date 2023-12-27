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

  .input-file {
    text-transform: uppercase; 
  }
  .button-file{
    margin:20px;
  }
</style>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
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
  <form method="post" enctype="multipart/form-data" class="col-md-7">
    <!-- ========================================== -->
    <!-- START STUDENT -->
    <!-- ========================================== -->
    <div class="form-group siswa">
      <label for="nama_siswa">Nama Siswa :</label>
      <input type="text" class="form-control" name="nama_siswa" <?php echo isset($_POST['nama_siswa']) ? htmlspecialchars($_POST['nama_siswa']) : ''; ?> required>
    </div>

    <div class="form-group siswa">
      <label for="nis">NIS :</label>
      <input type="number" class="form-control" name="nis" <?php echo isset($_POST['nis']) ? htmlspecialchars($_POST['nis']) : ''; ?> required>
    </div>

    <div class="form-group siswa">
      <label for="nomer_kk">Nomor KK :</label>
      <input type="number" class="form-control" name="nomer_kk" <?php echo isset($_POST['nomer_kk']) ? htmlspecialchars($_POST['nomer_kk']) : ''; ?> required>
    </div>

    <div class="form-group siswa">
      <label for="alamat">Alamat :</label>
      <input type="text" class="form-control" name="alamat" <?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?> required>
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
  <!-- import data with Excel -->
  <div class="col-md-4">
    <form method="POST" role="form" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">Add Student Parent with Excel</h1>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label for="">Field Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nama_siswa']) ? htmlspecialchars($_POST['nama_siswa']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nis</label>
            <input type="text" name="nis" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nis']) ? htmlspecialchars($_POST['nis']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nomer KK</label>
            <input type="text" name="nokk" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nokk']) ? htmlspecialchars($_POST['nokk']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Alamat</label>
            <input type="text" name="alamat" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="">Field Nama Ayah</label>
            <input type="text" name="nama_ayah" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nama_ayah']) ? htmlspecialchars($_POST['nama_ayah']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nik Ayah</label>
            <input type="text" name="nik_ayah" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nik_ayah']) ? htmlspecialchars($_POST['nik_ayah']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nomer Telepon Ayah</label>
            <input type="text" name="nomer_telepon_ayah" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nomer_telepon_ayah']) ? htmlspecialchars($_POST['nomer_telepon_ayah']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nama Ibu</label>
            <input type="text" name="nama_ibu" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nama_ibu']) ? htmlspecialchars($_POST['nama_ibu']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="">Field Nik Ibu</label>
            <input type="text" name="nik_ibu" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nik_ibu']) ? htmlspecialchars($_POST['nik_ibu']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nomer Telepon Ibu</label>
            <input type="text" name="nomer_telepon_ibu" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nomer_telepon_ibu']) ? htmlspecialchars($_POST['nomer_telepon_ibu']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nama Wali</label>
            <input type="text" name="nama_wali" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nama_wali']) ? htmlspecialchars($_POST['nama_wali']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nik Wali</label>
            <input type="text" name="nik_wali" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nik_wali']) ? htmlspecialchars($_POST['nik_wali']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nomer KK Wali</label>
            <input type="text" name="nokk_wali" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nokk_wali']) ? htmlspecialchars($_POST['nokk_wali']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="">Field Nomer Telepon Wali</label>
            <input type="text" name="nomer_telepon_wali" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['nomer_telepon_wali']) ? htmlspecialchars($_POST['nomer_telepon_wali']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="">Field Alamat Wali</label>
            <input type="text" name="alamat_wali" class="form-control input-file" id="" placeholder="Input field" value="<?php echo isset($_POST['alamat_wali']) ? htmlspecialchars($_POST['alamat_wali']) : ''; ?>">
          </div>	
          <div class="form-group">
            <label for="fileInput">Pilih File</label>
            <input type="file" name="file" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary button-file col-md-11" name="submit" value="submit">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <?php 
  $data = array('params' => '');
	if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) 
  {
	  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
		unset($output[1]);
		$nama_siswa   = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : null;
		$nis          = isset($_POST['nis']) ? $_POST['nis'] : null;
		$nokk         = isset($_POST['nokk']) ? $_POST['nokk'] : null;
		$alamat       = isset($_POST['alamat']) ? $_POST['alamat'] : null;
		$nama_ayah    = isset($_POST['nama_ayah']) ? $_POST['nama_ayah'] : null;
		$nik_ayah     = isset($_POST['nik_ayah']) ? $_POST['nik_ayah'] : null;
		$no_hp_ayah   = isset($_POST['nomer_telepon_ayah']) ? $_POST['nomer_telepon_ayah'] : null;
		$nama_ibu     = isset($_POST['nama_ibu']) ? $_POST['nama_ibu'] : null;
		$nik_ibu      = isset($_POST['nik_ibu']) ? $_POST['nik_ibu'] : null;
		$no_hp_ibu    = isset($_POST['nomer_telepon_ibu']) ? $_POST['nomer_telepon_ibu'] : null;
		$nama_wali    = isset($_POST['nama_wali']) ? $_POST['nama_wali'] : null;
		$nik_wali     = isset($_POST['nik_wali']) ? $_POST['nik_wali'] : null;
		$nokk_wali    = isset($_POST['nokk_wali']) ? $_POST['nokk_wali'] : null;
		$no_hp_wali   = isset($_POST['nomer_telepon_wali']) ? $_POST['nomer_telepon_wali'] : null;
		$alamat_wali  = isset($_POST['alamat_wali']) ? $_POST['alamat_wali'] : null;


	  foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
    {
      if ($value[$nama_ayah] !== null) // INSERT DATA AYAH
      {
        $ayah_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $value[$nama_ayah],
          'username'  => $value[$nik_ayah],
          'group_ids' => '4'
        ));

        $ayah_parent_id_file = $db->Insert('school_parent', array(
          'name'    => $value[$nama_ayah],
          'user_id' => $ayah_user_id_file,
          'nik'     => $value[$nik_ayah],
          'nokk'    => $value[$nokk],
          'address' => $value[$alamat],
          'phone'   => $value[$no_hp_ayah]
        ));

        $db->insert('bbc_account', array(
          'user_id' => $ayah_user_id_file,
          'username'=> $value[$nik_ayah],
          'name'    => $value[$nama_ayah]
        ));
      }

      if ($value[$nama_ibu] !== null) // INSERT DATA IBU
      {
        $ibu_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $value[$nama_ibu],
          'username'  => $value[$nik_ibu],
          'group_ids' => '4'
        ));

        $ibu_parent_id_file = $db->Insert('school_parent', array(
          'name'    => $value[$nama_ibu],
          'user_id' => $ibu_user_id_file,
          'nik'     => $value[$nik_ibu],
          'nokk'    => $value[$nokk],
          'address' => $value[$alamat],
          'phone'   => $value[$no_hp_ibu],
        ));
        
        $db->insert('bbc_account', array(
          'user_id' => $ibu_user_id_file,
          'username'=> $value[$nik_ibu],
          'name'    => $value[$nama_ibu],
        ));
      }

      if ($value[$nama_wali] !== null) // INSERT DATA WALI
      {
        $wali_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $value[$nama_wali],
          'username'  => $value[$nik_wali],
          'group_ids' => '4'
        ));
      
        $wali_parent_id_file = $db->Insert('school_parent', array(
          'name'    => $value[$nama_wali],
          'user_id' => $wali_user_id_file,
          'nik'     => $value[$nik_wali],
          'nokk'    => $value[$nokk_wali],
          'address' => $value[$alamat_wali],
          'phone'   => $value[$no_hp_wali],
        ));
      
        $db->insert('bbc_account', array(
          'user_id' => $wali_user_id_file,
          'username'=> $value[$nik_wali],
          'name'    => $value[$nama_wali],
        ));
      }

      if ($value[$nama_siswa]) // INSERT DATA STUDENT
      {
        $student_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $value[$nama_siswa],
          'username'  => $value[$nis],
          'group_ids' => '4'
        ));
      
        $student_id_file = $db->Insert('school_student', array(
          'user_id'         => $student_user_id_file,
          'parent_id_dad'   => $ayah_parent_id_file ?? null,
          'parent_id_mom'   => $ibu_parent_id_file ?? null,
          'parent_id_guard' => $wali_parent_id_file ?? null,
          'name'            => $value[$nama_siswa],
          'nokk'            => $value[$nokk],
          'address'         => $value[$alamat],
          'nis'             => $value[$nis],
        ));
      
        $db->insert('bbc_account', array(
          'user_id' => $student_user_id_file,
          'username'=> $value[$nis],
          'name'    => $value[$nama_siswa]
        ));
      }

    // INSERT PIVOT TABLE STUDENT && PARENT
    if ($value[$nama_wali]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $wali_parent_id_file
        ));
      }

      if ($value[$nama_ayah]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $ayah_parent_id_file
        ));
      }

      if ($value[$nama_ibu]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $ibu_parent_id_file
        ));
      }
    }
	}
  ?>
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