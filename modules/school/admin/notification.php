<?php if (!defined('_VALID_BBC'))
  exit('No direct script access allowed');

if (!empty($_POST['message']) && !empty($_POST['title']) && isset($_POST['btn-notification'])) {
  $teacher_id_all = $db->getcol('SELECT `id` FROM `school_teacher` WHERE 1');

  $title = $_POST['title'];
  $message = $_POST['message'];

  _func('alert');
  foreach ($teacher_id_all as $teacher_id) {
    alert_push(
      $teacher_id . '-' . '5',
      $title,
      $message,
      'teacher/notif',
      []
    );
  }
  echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" title="ok sign"></span>pengumuman berhasil dikirim</div>';
}

include tpl('notification.html.php'); //untuk mengincludekan file html
link_css(__DIR__ . '/css/notification.css'); //untuk memanggil file css
link_js(__DIR__ . '/js/notification.js');
