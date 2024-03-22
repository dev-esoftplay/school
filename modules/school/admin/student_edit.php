<?php if (!defined('_VALID_BBC')) exit ('No direct script access allowed');

if (!empty ($_POST['download'])) {
  if ($_POST['download'] == 'attendance') {
   
    $student_id          = $_GET['id'];
    $students_attendance = array();
    $attendance_presence = $db->getall('SELECT `s`.`id`, `s`.`name`, `s`.`birthday`, `s`.`nis`, `s`.`address`, `sc`.`number` as nomer_absen, `s`.`nokk`, `a`.`presence`, COUNT(*) as `count`, CONCAT_WS(" ",`c`.`grade`, `c`.`major`, `c`.`label`) AS `class_name`,
                                        `pd`.`name` as `parent_dad`, `pm`.`name` as `parent_mom`, `pg`.`name` as `parent_guard`
                                        FROM `school_student` `s` 
                                        LEFT JOIN `school_attendance` `a` ON `s`.`id` = `a`.`student_id` 
                                        LEFT JOIN `school_student_class` `sc` ON `s`.`id` = `sc`.`student_id`
                                        LEFT JOIN `school_class` `c` ON `sc`.`class_id` = `c`.`id`
                                        LEFT JOIN `school_parent` `pd` ON `s`.`parent_id_dad` = `pd`.`id`
                                        LEFT JOIN `school_parent` `pm` ON `s`.`parent_id_mom` = `pm`.`id`
                                        LEFT JOIN `school_parent` `pg` ON `s`.`parent_id_guard` = `pg`.`id`
                                        WHERE `s`.`id` = 1 GROUP BY `s`.`id`, `a`.`presence`');
    foreach ($attendance_presence as $data) 
    {
      $student_id     = $data['id'];
      $student_name   = $data['name'];
      $birthday       = $data['birthday'];
      $nis            = $data['nis'];
      $address        = $data['address'];
      $nokk           = $data['nokk'];
      $presence       = $data['presence'];
      $count          = $data['count'];
      $class_name     = $data['class_name'];
      $parent_dad     = $data['parent_dad'];
      $parent_mom     = $data['parent_mom'];
      $parent_guard   = $data['parent_guard'];
      $nomer_absen    = $data['nomer_absen'];

      // Initialize attendance data for the student if not already initialized
      if (!isset($students_attendance[$student_id])) 
      {
        $students_attendance[$student_id] = array(
          'nomer absen'     => $nomer_absen,
          'student_name'    => $student_name,
          'birthday'        => $birthday,
          'nis'             => $nis,
          'address'         => $address,
          'nokk'            => $nokk,
          'class_name'      => $class_name,
          'hadir'           => 0,
          'sakit'           => 0,
          'ijin'            => 0,
          'tidak_hadir'     => 0,
          'nama ayah'       => $parent_dad ? $parent_dad : '-',
          'nama ibu'        => $parent_mom ? $parent_mom : '-',
          'nama wali'       => $parent_guard ? $parent_guard : '-'
        );
      }

      // Update attendance data for the student based on presence type
      switch ($presence) 
      {
        case 1:
          $students_attendance[$student_id]['hadir'] += $count;
          break;
        case 2:
          $students_attendance[$student_id]['sakit'] += $count;
          break;
        case 3:
          $students_attendance[$student_id]['ijin'] += $count;
          break;
        case 4:
          $students_attendance[$student_id]['tidak_hadir'] += $count;
          break;
      }
    }

    $download_data = array();
    foreach ($students_attendance as $student_data) 
    {
      $download_data[] = $student_data;
    }
    _func('download');
    download_excel('myfiles', $download_data, 'sheet 1');
  }
}


$form = _lib('pea', 'school_student');
$form->initEdit(!empty ($_GET['id']) ? 'WHERE id=' . $_GET['id'] : '');
$form->edit->setLanguage();

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty ($_GET['id']) ? 'Edit Student' : 'Add Student');

$form->edit->addInput('name', 'text');
$form->edit->input->name->setTitle('nama');
$form->edit->input->name->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('birthday', 'text');
$form->edit->input->birthday->setTitle('tanggal lahir');
$form->edit->input->birthday->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('nokk', 'text');
$form->edit->input->nokk->setTitle('nomer kk');
$form->edit->input->nokk->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('nis', 'text');
$form->edit->input->nis->setTitle('nis');
$form->edit->input->nis->setRequire($require = 'any', $is_mandatory = 1);
$form->edit->action();

$class_info = $db->getrow('SELECT `sc`.`id`, CONCAT_WS(" ", `sc`.`grade`, `sc`.`major`, `sc`.`label`) AS `class_name`
                           FROM `school_student_class` `ssc`
                           INNER JOIN `school_class` `sc` ON `ssc`.`class_id` = `sc`.`id`
                           WHERE `ssc`.`student_id` = ' . $_GET['id']);
$form->edit->addInput('class_name', 'plaintext');
$form->edit->input->class_name->setTitle('kelas');
$form->edit->input->class_name->setValue('<a href="' . $Bbc->mod['circuit'] . '.class_student&id=' . $class_info['id'] . '&return' . urlencode(seo_url()) . '">' . ($class_info['class_name'] ? $class_info['class_name'] : '---') . '</a>');

$parent_id = $db->getrow('SELECT `parent_id_dad`, `parent_id_mom`, `parent_id_guard` 
                          FROM `school_student` WHERE `id` = ' . $_GET['id']);
$parent_name = $db->getcol('SELECT `sp`.`name`
                            FROM `school_student` `ss`
                            INNER JOIN `school_parent` `sp` 
                            ON `ss`.`parent_id_dad` = `sp`.`id` 
                            OR `ss`.`parent_id_mom` = `sp`.`id` 
                            OR `ss`.`parent_id_guard` = `sp`.`id`
                            WHERE `ss`.`id` = ' . $_GET['id']);

$form->edit->addInput('nama_ayah', 'plaintext');
$form->edit->input->nama_ayah->setTitle('Nama Ayah');
$form->edit->input->nama_ayah->setValue('<a href="' . $Bbc->mod['circuit'] . '.parent_edit&id=' . $parent_id['parent_id_dad'] . '&return' . urlencode(seo_url()) . '">' . ($parent_name[0] ? $parent_name[0] : '---') . '</a>');

$form->edit->addInput('nama_ibu', 'plaintext');
$form->edit->input->nama_ibu->setTitle('Nama Ibu');
$form->edit->input->nama_ibu->setValue('<a href="' . $Bbc->mod['circuit'] . '.parent_edit&id=' . $parent_id['parent_id_dad'] . '&return' . urlencode(seo_url()) . '">' . ($parent_name[1] ? $parent_name[1] : '---') . '</a>');

$form->edit->addInput('nama_wali', 'plaintext');
$form->edit->input->nama_wali->setTitle('Nama Wali');
$form->edit->input->nama_wali->setValue('<a href="' . $Bbc->mod['circuit'] . '.parent_edit&id=' . $parent_id['parent_id_dad'] . '&return' . urlencode(seo_url()) . '">' . ($parent_name[2] ? $parent_name[2] : '---') . '</a>');

echo $form->edit->getForm();

?>
<form action="" method="POST" class="form" role="form">
  <button type="submit" name="download" value="attendance" class="btn btn-success col-md-12">
    download data dari siswa ini
  </button>
</form>
