<?php if (!defined('_VALID_BBC'))
  exit('No direct script access allowed');

/*==========================================
 * START EDIT
/*=========================================*/

$form = _lib('pea', 'school_parent');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id=' . $_GET['id'] : '');
$form->edit->setLanguage();

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Parent' : 'Add Parent');

$form->edit->addInput('name', 'text');
$form->edit->input->name->setTitle('nama');
$form->edit->input->name->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('birthday', 'text');
$form->edit->input->birthday->setTitle('tanggal lahir');
$form->edit->input->birthday->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('phone', 'text');
$form->edit->input->phone->setTitle('Nomor telepon');
$form->edit->input->phone->setRequire($require = 'any', $is_mandatory = 1);
if (!empty($_POST[$form->edit->input->phone->name])) {
  $_POST[$form->edit->input->phone->name] = school_phone_replace($_POST[$form->edit->input->phone->name]);
}
$form->edit->action();

$form->edit->addInput('nokk', 'text');
$form->edit->input->nokk->setTitle('no kk');
$form->edit->input->nokk->setRequire($require = 'any', $is_mandatory = 1);

$form->edit->addInput('nik', 'text');
$form->edit->input->nik->setTitle('nik');
$form->edit->input->nik->setRequire($require = 'any', $is_mandatory = 1);
$form->edit->action();

$child_info = $db->getAll('SELECT ss.`name`, ss.`id` AS student_id
                           FROM `school_student_parent` ssp 
                           INNER JOIN `school_student` ss 
                           ON ss.`id` = ssp.`student_id`
                           WHERE parent_id = ' . $_GET['id']);

foreach ($child_info as $key => $child) {
  $form->edit->addInput('nama_anak_' . ($key + 1), 'plaintext');
  $form->edit->input->{'nama_anak_' . ($key + 1)}->setTitle('Nama anak ' . ($key + 1));
  $form->edit->input->{'nama_anak_' . ($key + 1)}->setValue('<a href="' . $Bbc->mod['circuit'] . '.student_edit&id=' . $child['student_id'] . '&return=' . urlencode(seo_url()) . '">' . ($child['name'] ? $child['name'] : '---') . '</a>');
}

echo $form->edit->getForm();
