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
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['manual']))  
  {

    // $data = [];
    
    foreach ($fields as $index =>$field) 
    {
      $data[$field]       = isset($_POST[$field]) ? $_POST[$field] : null;
      $input_post[$field] = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
    }

    $name = ['nama_ayah', 'nama_wali', 'nama_ibu', 'nama_siswa'];
    foreach ($name as $index => $name) 
    {
      $password[$name] = encode($data[$name]);
    }
    // foreach ($insert_field as $index => $name) 
    // {
    //  if (isset($_POST[$name])) 
    //  {
    //    unset($_POST[$name]);
    //  }
    // } 
    if ($data['nama_ayah']) // INSERT DATA AYAH
    {
      $ayah_user_id = $db->Insert('bbc_user', array(
        'password'  => $password['nama_ayah'],
        'username'  => $data['nik_ayah'],
        'group_ids' => '4'
      ));

      $ayah_parent_id = $db->Insert('school_parent', array(
        'user_id' => $ayah_user_id,
        'name'    => $data['nama_ayah'],
        'phone'   => $data['nomer_telepon_ayah'],
        'nik'     => $data['nik_ayah'],
        'nokk'    => $data['nomer_kk'],
        'address' => $data['alamat'],
      ));
      
      $db->insert('bbc_account', array(
        'user_id' => $ayah_user_id,
        'username'=> $data['nik_ayah'],
        'name'    => $data['nama_ayah']
      ));
    }

    if ($data['nama_ibu']) // INSERT DATA IBU 
    {
      $ibu_user_id = $db->Insert('bbc_user', array(
        'password'  => $password['nama_ibu'],
        'username'  => $data['nik_ibu'],
        'group_ids' => '4'
      ));
    
      $ibu_parent_id = $db->Insert('school_parent', array(
        'user_id' => $ibu_user_id,
        'name'    => $data['nama_ibu'],
        'phone'   => $data['nomer_telepon_ibu'],
        'nik'     => $data['nik_ibu'],
        'nokk'    => $data['nomer_kk'],
        'address' => $data['alamat'],
      ));
    
      $db->insert('bbc_account', array(
        'user_id' => $ibu_user_id,
        'username'=> $data['nik_ibu'],
        'name'    => $data['nama_ibu']
      ));
    }

    if ($data['nama_wali']) // INSERT DATA WALI
    {
      $wali_user_id = $db->Insert('bbc_user', array(
        'password'  => $password['nama_wali'],
        'username'  => $data['nik_wali'],
        'group_ids' => '4'
      ));
    
      $wali_parent_id = $db->Insert('school_parent', array(
        'user_id' => $wali_user_id,
        'name'    => $data['nama_wali'],
        'phone'   => $data['nomer_telepon_wali'],
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
    
    if ($data['nama_siswa']) // INSERT DATA STUDENT
    {
      $student_user_id = $db->Insert('bbc_user', array(
        'password'  => $password['nama_siswa'],
        'username'  => $data['nis'],
        'group_ids' => '4'
      ));
    
      $student_id = $db->Insert('school_student', array(
        'user_id'         => $student_user_id,
        'parent_id_dad'   => $ayah_parent_id ?? null,
        'parent_id_mom'   => $ibu_parent_id ?? null,
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
    if ($data['nama_wali']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id,
        'parent_id'  => $wali_parent_id
      ));
    }

    if ($data['nama_ayah']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id,
        'parent_id'  => $ayah_parent_id
      ));
    }

    if ($data['nama_ibu']) 
    {
      $db->Insert('school_student_parent', array(
        'student_id' => $student_id,
        'parent_id'  => $ibu_parent_id
      ));
    }
  }

  

  foreach ($fields as $name) 
  {
    $input_post[$name]    = isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : null;
    $insert_field[$name]  = isset($_POST[$name]) ? $_POST[$name] : null;
  }

  ?>
  <?php 
  if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))&& isset($_POST['import-excel'])) 
  { 
    
    $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
    unset($output[1]);
    foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
    {
      $name = ['nama_ayah', 'nama_wali', 'nama_ibu', 'nama_siswa'];
      foreach ($name as $index => $name) 
      {
        $password[$name] = encode($value[$insert_field[$name]]);
      }
      if ($value[$insert_field['nama_ayah']] !== null) // INSERT DATA AYAH
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
          'phone'   => $value[$insert_field['nomer_telepon_ayah']],
        ));

        $db->insert('bbc_account', array(
          'user_id' => $ayah_user_id_file,
          'username'=> $value[$insert_field['nik_ayah']],
          'name'    => $value[$insert_field['nama_ayah']],
        ));
      }

      if ($value[$insert_field['nama_ibu']] !== null) // INSERT DATA IBU
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
          'phone'   => $value[$insert_field['nomer_telepon_ibu']],
        ));
        
        $db->insert('bbc_account', array(
          'user_id' => $ibu_user_id_file,
          'username'=> $value[$insert_field['nik_ibu']],
          'name'    => $value[$insert_field['nama_ibu']],
        ));
      }

      if ($value[$insert_field['nama_wali']] !== null) // INSERT DATA WALI
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
      }

      if ($value[$insert_field['nama_siswa']]) // INSERT DATA STUDENT
      {
        $student_user_id_file = $db->Insert('bbc_user', array(
          'password'  => $password['nama_siswa'],
          'username'  => $value[$insert_field['nis']],
          'group_ids' => '4'
        ));

        pr($value);
      
        $student_id_file = $db->Insert('school_student', array(
          'user_id'         => $student_user_id_file,
          'parent_id_dad'   => $ayah_parent_id_file ?? null,
          'parent_id_mom'   => $ibu_parent_id_file ?? null,
          'parent_id_guard' => $wali_parent_id_file ?? null,
          'name'            => $value[$insert_field['nama_siswa']],
          'nokk'            => $value[$insert_field['nomer_kk']],
          'address'         => $value[$insert_field['alamat']],
          'nis'             => $value[$insert_field['nis']],
        ));
      
        $db->insert('bbc_account', array(
          'user_id' => $student_user_id_file,
          'username'=> $value[$insert_field['nis']],
          'name'    => $value[$insert_field['nama_siswa']],
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
  link_css(__DIR__ . '/css/style.css'); //untuk memanggil file css
  include tpl('student_add.html.php'); //untuk mengincludekan file html
