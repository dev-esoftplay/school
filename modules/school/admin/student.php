<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');





$form = _lib('pea', 'school_student');
$form->initSearch();

?>
<a href="<?php echo site_url('school/student_add') ?>">
  <button type="button" class="btn btn-info" style="margin: 0px 0px 20px 10px ">Tambahkan Siswa</button>
</a>
<?php

$form->search->addInput('keyword', 'keyword');
$form->search->input->keyword->addSearchField('name, user_id, nis', false); //true = fulltext in database field

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll("$add_sql ORDER BY `id` DESC", 'id');
$form->roll->setSaveTool(false);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput('name', 'sqllinks');
$form->roll->input->name->setTitle('nama');
$form->roll->input->name->setLinks($Bbc->mod['circuit'] . '.student_edit');

$form->roll->addInput('user_id', 'sqlplaintext');
$form->roll->input->user_id->setDisplayColumn(true);

$form->roll->addInput('nis', 'text');
$form->roll->input->nis->setTitle('nis');
$form->roll->input->nis->setPlainText(true);
$form->roll->input->nis->setDisplayColumn(true);

$form->roll->addReport('excel');
$form->roll->action();
echo $form->roll->getForm();

