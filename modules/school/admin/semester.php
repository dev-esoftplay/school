<?php if (!defined('_VALID_BBC'))
  exit ('No direct script access allowed');
if (isset ($_POST['semester'])) {
  if ($_POST['semester'] == 'download') {
    $students_attendance = array();
    $attendance_presence = $db->getall('SELECT s.`id`, s.`name`, s.`birthday`, s.`nis`, s.`address`, s.`nokk`, a.`presence`, COUNT(*) as `count` 
                                          FROM `school_student` s 
                                          LEFT JOIN `school_attendance` a 
                                          ON s.`id` = a.`student_id` 
                                          WHERE 1 GROUP BY s.`id`, a.`presence`');
    $q = 'SELECT `id` as `no`, 
            `teacher_id` as `teacher_name`,
            `course_id` as `course_name`,
            `class_id` as `class_name`,
            `total_present`, `total_s`, `total_i`, `total_a` 
            FROM `school_attendance_report`
            WHERE 1
            ORDER BY `id` ASC';

    $r = $db->getAll($q);

    if (!empty ($r) && !empty ($attendance_presence)) {
      foreach ($attendance_presence as $data) {
        $student_id = $data['id'];
        $studenet_name = $data['name'];
        $birthday = $data['birthday'];
        $nis = $data['nis'];
        $address = $data['address'];
        $nokk = $data['nokk'];
        $presence = $data['presence'];
        $count = $data['count'];

        // Initialize attendance data for the student if not already initialized
        if (!isset ($students_attendance[$student_id])) {
          $students_attendance[$student_id] = array(
            'student_id' => $student_id,
            'student_name' => $studenet_name,
            'birthday' => $birthday,
            'nis' => $nis,
            'address' => $address,
            'nokk' => $nokk,
            'hadir' => 0,
            'sakit' => 0,
            'ijin' => 0,
            'tidak_hadir' => 0
          );
        }

        // Update attendance data for the student based on presence type
        switch ($presence) {
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

      $attend = array(
        'sheet' => array()
      );
      foreach ($students_attendance as $student_data) {
        $attend['sheet'][] = $student_data; // Removed the array wrapping around $student_data
      }
      $array_pertama_attend = array_keys($attend['sheet'][0]);
      array_unshift($attend['sheet'], $array_pertama_attend);
      $attend_report = array(
        'sheet' => array(),
      );

      foreach ($r as $k => &$val) {
        $item = array(
          'no' => $k + 1,
          'guru' => (!empty ($val['teacher_name'])) ? $db->getone('SELECT `name` FROM `school_teacher` WHERE `id`=' . $val['teacher_name']) : '',
          'mapel' => (!empty ($val['course_name'])) ? $db->getOne('SELECT `name` FROM `school_course` WHERE `id`=' . $val['course_name']) : '',
          'kelas' => (!empty ($val['class_name'])) ? $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $val['class_name']) : '',
          'hadir' => $val['total_present'],
          'sakit' => $val['total_s'],
          'ijin' => $val['total_i'],
          'alpha' => $val['total_a'],
        );
        $attend_report['sheet'][] = $item;
      }

      $array_pertama = array_keys($attend_report['sheet'][0]);
      array_unshift($attend_report['sheet'], $array_pertama);
      $date = date('Y/m/d/H/');
      $excel = _lib('excel');
      $excel->create($attend_report)->save(_ROOT . 'images/cache/uploads/temp/attend_report.xlsx');
      $excel->create($attend)->save(_ROOT . 'images/cache/uploads/temp/attend.xlsx');
      $zip = _class('zip');
      $zip->read_file(_ROOT . 'images/cache/uploads/temp/attend_report.xlsx');
      $zip->read_file(_ROOT . 'images/cache/uploads/temp/attend.xlsx');
      $zip->download('backup_semester.zip');
    } else {
      echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
    }
  }
}

if (!empty ($_POST['delete'])) 
{
  if ($_POST['delete'] == 'remove') 
  {
    $tables   = ['school_attendance', 'school_attendance_report', 'school_class', 'school_clock', 'school_course', 'school_parent', 'school_schedule', 'school_student', 'school_student_class', 'school_student_parent', 'school_teacher', 'school_teacher_subject'];
    $deleted  = false;

    foreach ($tables as $table) 
    {
      $countQuery = 'SELECT COUNT(*) FROM `' . $table . '`';
      $count      = $db->getOne($countQuery);

      if ($count > 0) 
      {
        $db->Execute('DELETE FROM `' . $table . '`');
        $deleted = true;
      }
    }

    if ($deleted) 
    {
      echo msg('semua data sudah berhasil dihapus', 'success');
    } else 
    {
      echo msg('Tidak ada data yang dihapus.', 'danger');
    }
  }
}

$tables_data_show = ['school_student', 'school_parent', 'school_teacher', 'school_schedule', 'school_course', 'school_class', 'school_attendance', 'school_attendance_report'];
$counts = [];

foreach ($tables_data_show as $table) 
{
  $query          = $db->getOne('SELECT COUNT(*) FROM `' . $table . '`');
  $counts[$table] = $query;
}

?>
<div class="col-md-6">
  <form action="" method="POST" class="form" role="form">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Semester Baru</h3>
      </div>
      <div class="panel-body">
        <div class="help-block">
          Unduh Data Semester
        </div>
      </div>
      <div class="panel-footer col-md-12" style="display: flex; justify-content: space-between;">
        <button type="submit" name="semester" value="download" class="btn btn-default col-md-6">
          <?php echo icon('fa-file-excel-o') ?> Backup Data
        </button>
      </div>
    </div>
  </form>
</div>

<div class="col-md-6">
  <form action="" method="POST" class="form" role="form">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">DATA YANG AKAN DI HAPUS</h3>
      </div>
      <div class="panel-body">
        <div class="help-block">
          <li>student
            <?php echo $counts['school_student']; ?>
          </li>
          <li>parent
            <?php echo $counts['school_parent']; ?>
          </li>
          <li>teacher
            <?php echo $counts['school_teacher']; ?>
          </li>
          <li>schedule
            <?php echo $counts['school_schedule']; ?>
          </li>
          <li>course
            <?php echo $counts['school_course']; ?>
          </li>
          <li>class
            <?php echo $counts['school_class']; ?>
          </li>
          <li>attendance
            <?php echo $counts['school_attendance']; ?>
          </li>
          <li>attendance report
            <?php echo $counts['school_attendance_report']; ?>
          </li>
        </div>
      </div>
      <div class="panel-footer col-md-12" style="display: flex; justify-content: space-between;">
        <button type="submit" name="delete" value="remove" class="btn btn-danger col-md-12"
          onclick="if (confirm('Are you sure you want to delete this data?')) { return true; } else { return false; }">
          <span class="glyphicon glyphicon-trash"></span>
          Hapus Semua Data
        </button>
      </div>
    </div>
  </form>
</div>