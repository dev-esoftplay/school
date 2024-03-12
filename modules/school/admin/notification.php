<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($_POST['message']) && !empty($_POST['title']) && isset($_POST['btn-notification'])) {
  $user_id_teacher   = $db->getcol('SELECT `user_id` FROM `school_teacher` WHERE 1');

  $title    = $_POST['title'];
  $message  = $_POST['message'];

  _func('alert');
  foreach ($user_id_teacher as $user_id) {
    alert_push(
      $user_id . '-' . '5',
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
