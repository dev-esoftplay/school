<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$fields = [
  'nama_siswa',
  'nis',
  'nomer_kk',
  'alamat',
  'nama_ayah',
  'nik_ayah',
  'nomer_telepon_ayah',
  'nama_ibu',
  'nik_ibu',
  'nomer_telepon_ibu',
  'nama_wali',
  'nik_wali',
  'nomer_kk_wali',
  'nomer_telepon_wali',
  'alamat_wali',
];

$data_siswa = 0;
if (isset($fields[1]) && !empty($_POST[$fields[1]])) 
{ 
  $data_siswa = $db->getRow("SELECT * FROM `school_student` WHERE `nis` = '{$_POST[$fields[1]]}'");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['manual']) && !empty($_POST[$fields[1]]) && !$data_siswa)  
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
  $name         = ['nama_ayah', 'nama_wali', 'nama_ibu', 'nama_siswa'];

  foreach ($name as $name) 
  {
    $password[$name] = encode($data[$name]);
  }

  if ($data_ayah == 0 && !empty($data['nik_ayah']) && !empty($data['nama_ayah'])) // INSERT DATA AYAH
  {
    $ayah_user_id = $db->Insert('bbc_user', array(
      'password'  => $password['nama_ayah'],
      'username'  => $data['nik_ayah'],
      'group_ids' => '4'
    ));

    $ayah_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ayah_user_id,
      'name'    => $data['nama_ayah'],
      'phone'   => school_phone_replace($data['nomer_telepon_ayah']),
      'nik'     => $data['nik_ayah'],
      'nokk'    => $data['nomer_kk'],
      'address' => $data['alamat'],
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
      'password'  => $password['nama_ibu'],
      'username'  => $data['nik_ibu'],
      'group_ids' => '4'
    ));
  
    $ibu_parent_id = $db->Insert('school_parent', array(
      'user_id' => $ibu_user_id,
      'name'    => $data['nama_ibu'],
      'phone'   => school_phone_replace($data['nomer_telepon_ibu']),
      'nik'     => $data['nik_ibu'],
      'nokk'    => $data['nomer_kk'],
      'address' => $data['alamat'],
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
      'password'  => $password['nama_wali'],
      'username'  => $data['nik_wali'],
      'group_ids' => '4'
    ));
  
    $wali_parent_id = $db->Insert('school_parent', array(
      'user_id' => $wali_user_id,
      'name'    => $data['nama_wali'],
      'phone'   => school_phone_replace($data['nomer_telepon_wali']),
      'nik'     => $data['nik_wali'],
      'nokk'    => $data['nomer_kk_wali'],
      'address' => $data['alamat_wali'],
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
      'password'  => $password['nama_siswa'],
      'username'  => $data['nis'],
      'group_ids' => '4'
    ));
  
    $student_id = $db->Insert('school_student', array(
      'user_id'         => $student_user_id,
      'parent_id_dad'   => $ayah_parent_id ?? null,
      'parent_id_mom'   => $ibu_parent_id  ?? null,
      'parent_id_guard' => $wali_parent_id ?? null,
      'name'            => $data['nama_siswa'],
      'nokk'            => $data['nomer_kk'],
      'address'         => $data['alamat'],
      'nis'             => $data['nis'],
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
}else if ($data_siswa > 0 && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['manual'])) 
{
  echo '<span id="error-span" class="hide-span bg-danger text-center col-md-12">nis '. $_POST['nis'].' sudah ada</span>';
}

foreach ($fields as $name) 
{
  $input_post[$name]    = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : null;
  $insert_field[$name]  = isset($_POST[$name]) ? $_POST[$name] : null;
}

// import data from excel
if (!empty($_FILES['file']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['import_excel'])) 
{ 
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
  {
    if(!empty($value[$insert_field['nama_siswa']]) && $data_siswa == 0) 
    {
    $data_ayah  = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_ayah']]}'");
    $data_ibu   = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_ibu']]}'");
    $data_wali  = $db->getRow("SELECT * FROM `school_parent` WHERE `nik` = '{$value[$insert_field['nik_wali']]}'");
    $data_ayah  = $data_ayah ?? 0;
    $data_ibu   = $data_ibu  ?? 0;
    $data_wali  = $data_wali ?? 0;
  
      $name = ['nama_ayah', 'nama_wali', 'nama_ibu', 'nama_siswa'];
      foreach ($name as  $name) 
      {
        $password[$name] = encode($value[$insert_field[$name]]);
      }
    
      if (!empty($value[$insert_field['nama_ayah']]) && $data_ayah == 0) // INSERT DATA AYAH
      {
        $ayah_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $password['nama_ayah'],
          'username'  => $value[$insert_field['nik_ayah']],
          'group_ids' => '4'
        ));

        $ayah_parent_id_file = $db->Insert('school_parent', array(
          'user_id' => $ayah_user_id_file,
          'name'    => $value[$insert_field['nama_ayah']],
          'nik'     => $value[$insert_field['nik_ayah']],
          'nokk'    => $value[$insert_field['nomer_kk']],
          'address' => $value[$insert_field['alamat']],
          'phone'   => school_phone_replace($value[$insert_field['nomer_telepon_ayah']]),
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
          'password'  => $password['nama_ibu'],
          'username'  => $value[$insert_field['nik_ibu']],
          'group_ids' => '4'
        ));

        $ibu_parent_id_file = $db->Insert('school_parent', array(
          'user_id' => $ibu_user_id_file,
          'name'    => $value[$insert_field['nama_ibu']],
          'nik'     => $value[$insert_field['nik_ibu']],
          'nokk'    => $value[$insert_field['nomer_kk']],
          'address' => $value[$insert_field['alamat']],
          'phone'   => school_phone_replace($value[$insert_field['nomer_telepon_ibu']]),
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
          'password'  => $password['nama_wali'],
          'username'  => $value[$insert_field['nik_wali']],
          'group_ids' => '4'
        ));
      
        $wali_parent_id_file = $db->Insert('school_parent', array(
          'user_id' => $wali_user_id_file,
          'name'    => $value[$insert_field['nama_wali']],
          'nik'     => $value[$insert_field['nik_wali']],
          'nokk'    => $value[$insert_field['nomer_kk_wali']],
          'address' => $value[$insert_field['alamat_wali']],
          'phone'   => $value[$insert_field['nomer_telepon_wali']],
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

      if (!empty($value[$insert_field['nama_siswa']])) // INSERT DATA STUDENT
      {
        $student_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $password['nama_siswa'],
          'username'  => $value[$insert_field['nis']],
          'group_ids' => '4'
        ));
      
        $student_id_file = $db->Insert('school_student', array(
          'user_id'         => $student_user_id_file,
          'parent_id_dad'   => $ayah_parent_id_file ?? null,
          'parent_id_mom'   => $ibu_parent_id_file  ?? null,
          'parent_id_guard' => $wali_parent_id_file ?? null,
          'name'            => $value[$insert_field['nama_siswa']],
          'nokk'            => $value[$insert_field['nomer_kk']],
          'address'         => $value[$insert_field['alamat']],
          'nis'             => $value[$insert_field['nis']],
        ));
      
        $db->insert('bbc_account', array(
          'user_id'   => $student_user_id_file,
          'username'  => $value[$insert_field['nis']],
          'name'      => $value[$insert_field['nama_siswa']],
        ));
      }

      // INSERT PIVOT TABLE STUDENT && PARENT
      if ($value[$insert_field['nama_wali']]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $wali_parent_id_file
        ));
      }

      if ($value[$insert_field['nama_ayah']]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $ayah_parent_id_file
        ));
      }

      if ($value[$insert_field['nama_ibu']]) 
      {
        $db->Insert('school_student_parent', array(
          'student_id' => $student_id_file,
          'parent_id'  => $ibu_parent_id_file
        ));
      }
    }
  }
}
link_css(__DIR__ . '/css/student_add.css'); //untuk memanggil file css
include tpl('student_add.html.php'); //untuk mengincludekan file html
