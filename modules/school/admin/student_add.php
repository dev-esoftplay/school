<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$fields = [
  'B' => 'nama_siswa',
  'C' => 'tanggal_lahir_siswa',
  'D' => 'nis',
  'E' => 'nomer_kk',
  'F' => 'alamat',
  'G' => 'nama_ayah',
  'H' => 'tanggal_lahir_ayah',
  'I' => 'nik_ayah',
  'J' => 'nomer_telepon_ayah',
  'K' => 'nama_ibu',
  'L' => 'tanggal_lahir_ibu',
  'M' => 'nik_ibu',
  'N' => 'nomer_telepon_ibu',
  'O' => 'nama_wali',
  'P' => 'tanggal_lahir_wali',
  'Q' => 'nik_wali',
  'R' => 'nomer_kk_wali',
  'S' => 'nomer_telepon_wali',
  'T' => 'alamat_wali',
];
$data_user = 0;
$data_siswa = 0;
if (isset($fields['D']) && !empty($_POST[$fields['D']])) 
{ 
  $data_siswa = $db->getrow("SELECT * FROM `school_student` WHERE `nis` = '{$_POST[$fields['D']]}'");
  $data_user = $db->getrow("SELECT * FROM `bbc_user` WHERE `username` = '{$_POST[$fields['D']]}'");
}
// pr(!$data_siswa,!$data_user, __FILE__.':'.__LINE__);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['manual']) && !empty($_POST[$fields['D']]) && !$data_siswa && !$data_user)  
{
  foreach ($fields as $field) 
  {
    $data[$field]       = isset($_POST[$field]) ? $_POST[$field] : null;
    $input_post[$field] = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
  }
  if (isset($data['nik_ayah']))
  {
    $data['nik_ayah'] = $data['nik_ayah'] ?? null;
  }
  if (isset($data['nik_ibu']))
  {
    $data['nik_ibu'] = $data['nik_ibu'] ?? null;
  }
  if (isset($data['nik_wali']))
  {
    $data['nik_wali'] = $data['nik_wali'] ?? null;
  }
  $data_siswa = 0;
  $data_ayah  = 0;
  $data_ibu   = 0;
  $data_wali  = 0;
  if (!empty($data['nik_ayah'])) 
  {
    $data_ayah    = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = {$data['nik_ayah']}");
  }
  if (!empty($data['nik_ibu'])) 
  {
    $data_ibu     = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = {$data['nik_ibu']}");
  }
  if (!empty($data['nik_wali'])) 
  {
    $data_wali    = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = {$data['nik_wali']}");
  }

  $data_siswa   = $db->getRow("SELECT * FROM `school_student` WHERE `nis` = {$data['nis']}");
  $name         = ['tanggal_lahir_siswa', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'tanggal_lahir_wali'];
  foreach ($name as $name) 
  {
    $rawDate          = $data[$name]; // Ambil tanggal lahir mentah
    $cleanedDate      = str_replace('-', '', $rawDate); // Hilangkan karakter "-"
    $password[$name]  = encode($cleanedDate); // Kodekan tanggal lahir yang telah dibersihkan
  }

  if ($data_ayah == 0 && !empty($data['nik_ayah']) && !empty($data['nama_ayah'])) // INSERT DATA AYAH
  {
    $ayah_user_id = $db->Insert('bbc_user', array(
      'password'  => $password['tanggal_lahir_ayah'],
      'username'  => $data['nik_ayah'],
      'group_ids' => '6'
    ));

    $ayah_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ayah_user_id,
      'name'    => $data['nama_ayah'],
      'birthday'=> $data['tanggal_lahir_ayah'],
      'phone'   => school_phone_replace($data['nomer_telepon_ayah']),
      'nik'     => $data['nik_ayah'],
      'nokk'    => $data['nomer_kk'],
      'address' => $data['alamat'],
    ));

    $db->insert('member', array(
      'user_id' => $ayah_user_id,
      'name'    => $data['nama_ayah']
    ));
    
    $db->insert('bbc_account', array(
      'user_id' => $ayah_user_id,
      'username'=> $data['nik_ayah'],
      'name'    => $data['nama_ayah']
    ));
  } else if ($data_ayah) 
  {
    $ayah_parent_id = $data_ayah['id'];
  }

  if ($data_ibu == 0 && !empty($data['nik_ibu']) && !empty($data['nama_ibu'])) // INSERT DATA IBU
  {
    $ibu_user_id = $db->Insert('bbc_user', array(
      'password'  => $password['tanggal_lahir_ibu'],
      'username'  => $data['nik_ibu'],
      'group_ids' => '6'
    ));
  
    $ibu_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ibu_user_id,
      'name'    => $data['nama_ibu'],
      'birthday'=> $data['tanggal_lahir_ibu'],
      'phone'   => school_phone_replace($data['nomer_telepon_ibu']),
      'nik'     => $data['nik_ibu'],
      'nokk'    => $data['nomer_kk'],
      'address' => $data['alamat'],
    ));

    $db->insert('member', array(
      'user_id' => $ibu_user_id,
      'name'    => $data['nama_ibu']
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $ibu_user_id,
      'username'=> $data['nik_ibu'],
      'name'    => $data['nama_ibu']
    ));
  } else if ($data_ibu) 
  {
    $ibu_parent_id = $data_ibu['id'];
  }  

  if ($data_wali) // INSERT DATA WALI
  {
    $wali_parent_id = $data_wali['id'];
  } else if ($data_wali == 0 && !empty($data['nama_wali']))
  {
    $wali_user_id = $db->Insert('bbc_user', array(
      'password'  => $password['tanggal_lahir_wali'],
      'username'  => $data['nik_wali'],
      'group_ids' => '6'
    ));
  
    $wali_parent_id = $db->Insert('school_parent', array(
      'user_id' => $wali_user_id,
      'name'    => $data['nama_wali'],
      'birthday'=> $data['tanggal_lahir_wali'],
      'phone'   => school_phone_replace($data['nomer_telepon_wali']),
      'nik'     => $data['nik_wali'],
      'nokk'    => $data['nomer_kk_wali'],
      'address' => $data['alamat_wali'],
    ));

    $db->insert('member', array(
      'user_id' => $wali_user_id,
      'name'    => $data['nama_wali']
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $wali_user_id,
      'username'=> $data['nik_wali'],
      'name'    => $data['nama_wali']
    ));
  }
  
  if ($data_siswa == 0) // INSERT DATA STUDENT
  {
    $student_user_id = $db->Insert('bbc_user', array(
      'password'  => $password['tanggal_lahir_siswa'],
      'username'  => $data['nis'],
      'group_ids' => '7'
    ));
  
    $student_id = $db->Insert('school_student', array(
      'user_id'         => $student_user_id,
      'parent_id_dad'   => $ayah_parent_id ?? null,
      'parent_id_mom'   => $ibu_parent_id  ?? null,
      'parent_id_guard' => $wali_parent_id ?? null,
      'name'            => $data['nama_siswa'],
      'birthday'        => $data['tanggal_lahir_siswa'],
      'nokk'            => $data['nomer_kk'],
      'address'         => $data['alamat'],
      'nis'             => $data['nis'],
    ));

    $db->insert('member', array(
      'user_id' => $student_user_id,
      'name'    => $data['nama_siswa']
    ));
  
    $db->insert('bbc_account', array(
      'user_id' => $student_user_id,
      'username'=> $data['nis'],
      'name'    => $data['nama_siswa']
    ));
  } 

  // INSERT PIVOT TABLE STUDENT && PARENT
  if ($data_wali) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $data_wali['id']
    ));
  } else if ($data_wali == 0 && !empty($data['nama_wali']))
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $wali_parent_id
    ));
  }

  if ($data_ayah) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $data_ayah['id']
    ));
  } else if ($data_ayah == 0 && !empty($data['nik_ayah']) && !empty($data['nama_ayah']))
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $ayah_parent_id
    ));
  }
  
  if ($data_ibu) 
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $data_ibu['id']
    ));
  } else if ($data_ibu == 0 && !empty($data['nik_ibu']) && !empty($data['nama_ibu']))
  {
    $db->Insert('school_student_parent', array(
      'student_id' => $student_id,
      'parent_id'  => $ibu_parent_id
    ));
  }
  echo '<div class="alert alert-success" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-ok-s ign" title="ok sign"></span> Sukses Tambah data.</div>';
}else if ($data_siswa > 0 && $data_user > 0 && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['manual'])) 
{
  echo '<div class="alert alert-danger" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-exclamation-sign" title="exclamation sign"></span>nis '. $_POST['nis'].' sudah ada</div>';
}

foreach ($fields as $name) 
{
  $input_post[$name]    = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : null;
  $insert_field[$name]  = isset($_POST[$name]) ? $_POST[$name] : null;
}

    $msg = '';
// import data from excel
if (!empty($_FILES['file']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['import_excel'])) 
{ 
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
  {
    $data_siswa = $db->getrow("SELECT * FROM `school_student` WHERE `nis` = '{$value[$insert_field['nis']]}'");
    $data_user_people = [];
    $data_user_people[] = $value[$insert_field['nis']]; 
    $data_user_people[] = $value[$insert_field['nik_ayah']]; 
    $data_user_people[] = $value[$insert_field['nik_ibu']]; 
    $data_user_people[] = $value[$insert_field['nik_wali']];  
    $data_user_people[] = $value[$insert_field['nomer_telepon_ayah']]; 
    $data_user_people[] = $value[$insert_field['nomer_telepon_ibu']]; 
    $data_user_people[] = $value[$insert_field['nomer_telepon_wali']]; 
    $data_user_id = $db->getone("SELECT `id` FROM `bbc_user` WHERE `username` = '{$value[$insert_field['nis']]}'");
    $data_siswa   = $data_siswa ?? 0;
    $data_user_id = $data_user_id ?? 0;

    // pr($data_user_id == 0 ,$data_siswa == 0, __FILE__.':'.__LINE__);die();
    if(!empty($value[$insert_field['nama_siswa']]) && $data_siswa == 0 && $data_user_id == 0) 
    {
      $data_ayah = $db->getrow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_ayah']]}'");
      $data_ibu  = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_ibu']]}'");
      $data_wali = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_wali']]}'");
      $data_ayah = $data_ayah ?? 0;
      $data_ibu  = $data_ibu  ?? 0;
      $data_wali = $data_wali ?? 0;
      $name      = ['tanggal_lahir_siswa', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'tanggal_lahir_wali'];

      foreach ($name as $name) 
      {
        $rawDate          = $value[$insert_field[$name]]; // Ambil tanggal lahir mentah
        $cleanedDate      = str_replace('-', '', $rawDate); // Hilangkan karakter "-"
        $password[$name]  = encode($cleanedDate); // Kodekan tanggal lahir yang telah dibersihkan
      }
    
      if (!empty($value[$insert_field['nama_ayah']]) && $data_ayah == 0) // INSERT DATA AYAH
      {
          $ayah_user_id_file = $db->Insert('bbc_user', array(
            'password'  => $password['tanggal_lahir_ayah'],
            'username'  => $value[$insert_field['nik_ayah']],
            'group_ids' => '6'
          ));

          $ayah_parent_id_file = $db->Insert('school_parent', array(
            'user_id' => $ayah_user_id_file,
            'name'    => $value[$insert_field['nama_ayah']],
            'birthday'=> $value[$insert_field['tanggal_lahir_ayah']],
            'nik'     => $value[$insert_field['nik_ayah']],
            'nokk'    => $value[$insert_field['nomer_kk']],
            'address' => $value[$insert_field['alamat']],
            'phone'   => school_phone_replace($value[$insert_field['nomer_telepon_ayah']]),
          ));

          $db->insert('member', array(
            'user_id' => $ayah_user_id_file,
            'name'    => $value[$insert_field['nama_ayah']],
          ));

          $db->insert('bbc_account', array(
            'user_id' => $ayah_user_id_file,
            'username'=> $value[$insert_field['nik_ayah']],
            'name'    => $value[$insert_field['nama_ayah']],
          ));
      } else if ($data_ayah > 0) 
      {
        $ayah_parent_id_file = $data_ayah['id'];
      } else if (empty($value[$insert_field['nama_ayah']])) 
      {
        $ayah_parent_id_file = 0;
      }

      if (!empty($value[$insert_field['nama_ibu']]) && $data_ibu == 0) // INSERT DATA IBU
      {
          $ibu_user_id_file = $db->Insert('bbc_user', array(
            'password'  => $password['tanggal_lahir_ibu'],
            'username'  => $value[$insert_field['nik_ibu']],
            'group_ids' => '6'
          ));

          $ibu_parent_id_file = $db->Insert('school_parent', array(
            'user_id' => $ibu_user_id_file,
            'name'    => $value[$insert_field['nama_ibu']],
            'birthday'=> $value[$insert_field['tanggal_lahir_ibu']],
            'nik'     => $value[$insert_field['nik_ibu']],
            'nokk'    => $value[$insert_field['nomer_kk']],
            'address' => $value[$insert_field['alamat']],
            'phone'   => school_phone_replace($value[$insert_field['nomer_telepon_ibu']]),
          ));

          $db->insert('member', array(
            'user_id' => $ibu_user_id_file,
            'name'    => $value[$insert_field['nama_ibu']],
          ));

          $db->insert('bbc_account', array(
            'user_id' => $ibu_user_id_file,
            'username'=> $value[$insert_field['nik_ibu']],
            'name'    => $value[$insert_field['nama_ibu']],
          ));
        
      } else if ($data_ibu > 0) 
      {
        $ibu_parent_id_file = $data_ibu['id'];
      } else if (empty($value[$insert_field['nama_ibu']])) 
      {
        $ibu_parent_id_file = 0;
      }

      if (!empty($value[$insert_field['nama_wali']]) && $data_wali == 0) // INSERT DATA WALI
      {
          $wali_user_id_file = $db->Insert('bbc_user', array(
            'password'  => $password['tanggal_lahir_wali'],
            'username'  => $value[$insert_field['nik_wali']],
            'group_ids' => '6'
          ));
        
          $wali_parent_id_file = $db->Insert('school_parent', array(
            'user_id' => $wali_user_id_file,
            'name'    => $value[$insert_field['nama_wali']],
            'birthday'=> $value[$insert_field['tanggal_lahir_wali']],
            'nik'     => $value[$insert_field['nik_wali']],
            'nokk'    => $value[$insert_field['nomer_kk_wali']],
            'address' => $value[$insert_field['alamat_wali']],
            'phone'   => school_phone_replace($value[$insert_field['nomer_telepon_wali']]),
          ));

          $db->insert('member', array(
            'user_id' => $wali_user_id_file,
            'name'    => $value[$insert_field['nama_wali']],
          ));
        
          $db->insert('bbc_account', array(
            'user_id' => $wali_user_id_file,
            'username'=> $value[$insert_field['nik_wali']],
            'name'    => $value[$insert_field['nama_wali']],
          ));
      } else if ($data_wali > 0) 
      {
        $wali_parent_id_file = $data_wali['id'];
      } else if (empty($value[$insert_field['nama_wali']])) 
      {
        $wali_parent_id_file = 0;
      }

      // pr($data_siswa, __FILE__.':'.__LINE__);die();

      if (!empty($value[$insert_field['nama_siswa']]) && $data_siswa == 0) // INSERT DATA STUDENT
      {
          $student_user_id_file = $db->Insert('bbc_user', array(
            'password'  => $password['tanggal_lahir_siswa'],
            'username'  => $value[$insert_field['nis']],
            'group_ids' => '7'
          ));
        
          $student_id_file = $db->Insert('school_student', array(
            'user_id'         => $student_user_id_file,
            'parent_id_dad'   => $ayah_parent_id_file ?? null,
            'parent_id_mom'   => $ibu_parent_id_file  ?? null,
            'parent_id_guard' => $wali_parent_id_file ?? null,
            'name'            => $value[$insert_field['nama_siswa']],
            'birthday'        => $value[$insert_field['tanggal_lahir_siswa']],
            'nokk'            => $value[$insert_field['nomer_kk']],
            'address'         => $value[$insert_field['alamat']],
            'nis'             => $value[$insert_field['nis']],
          ));

          $db->insert('member', array(
            'user_id' => $student_user_id_file,
            'name'    => $value[$insert_field['nama_siswa']],
          ));
        
          $db->insert('bbc_account', array(
            'user_id'   => $student_user_id_file,
            'username'  => $value[$insert_field['nis']],
            'name'      => $value[$insert_field['nama_siswa']],
          ));
      }

      // INSERT PIVOT TABLE STUDENT && PARENT
      if (isset($student_id_file) && isset($wali_parent_id_file) && isset($ayah_parent_id_file) && isset($ibu_parent_id_file)) {
        if ($value[$insert_field['nama_wali']] && $value[$insert_field['nik_wali']]) 
        {
          $db->Insert('school_student_parent', array(
            'student_id' => $student_id_file,
            'parent_id'  => $wali_parent_id_file
          ));
        }

        if ($value[$insert_field['nama_ayah']] && $value[$insert_field['nik_ayah']]) 
        {
          $db->Insert('school_student_parent', array(
            'student_id' => $student_id_file,
            'parent_id'  => $ayah_parent_id_file
          ));
        }

        if ($value[$insert_field['nama_ibu']] && $value[$insert_field['nik_ibu']]) 
        {
          $db->Insert('school_student_parent', array(
            'student_id' => $student_id_file,
            'parent_id'  => $ibu_parent_id_file
          ));
        }
      }
      $msg = msg('Data berhasil ditambah', 'success');
    }else{
      $msg = msg('Data sudah ada di database', 'danger');
    }
  }
  echo $msg;
  // echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-s ign" title="ok sign"></span> Sukses Tambah data.</div>';
}
if (!empty($_POST['template'])) {
  if ($_POST['template'] == 'download') {
    $r = array(
      array(
        'No' => '',
        'Nama Siswa' => '',
        'Tanggal Lahir Siswa' => '',
        'Nis' => '',
        'Nomer KK' => '',
        'Alamat' => '',
        'Nama Ayah' => '',
        'Tanggal Lahir Ayah' => '',
        'Nik Ayah' => '',
        'Nomer Telepon Ayah' => '',
        'Nama Ibu' => '',
        'Tanggal Lahir Ibu' => '',
        'Nik Ibu' => '',
        'Nomer Telepon Ibu' => '',
        'Nama Wali' => '',
        'Tanggal Lahir Wali' => '',
        'Nik Wali' => '',
        'Nomer KK Wali' => '',
        'Nomer Telepon Wali' => '',
        'Alamat Wali' => '',
      )
    );
    if (!empty($r)) {
      _func('download');
      download_excel('Template ' . date('Y-m-d') . ' ' . rand(0, 999), $r);
    } else {
      echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
    }
  }
}
link_css(__DIR__ . '/css/student_add.css'); //untuk memanggil file css
include tpl('student_add.html.php'); //untuk mengincludekan file html

