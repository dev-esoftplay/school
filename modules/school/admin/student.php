<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$show_list = true;
if (!empty($_GET['id']) && !empty($_GET['act']))
{
  $id = intval($_GET['id']);
  switch ($_GET['act'])
  {
    case 'approve':
      include 'approval_withdraw-'.$_GET['act'].'.php';
      break;
  }
  if (!empty($_GET['is_ajax']))
  {
    die();
  }else{
    $sys->nav_add('Event '.ucwords($_GET['act']));
    $show_list = false;
  }
}

if (!empty($_POST['template']))
{
  if ($_POST['template'] == 'download')
  {
    $r = array(
      array(
        'No'                  => '',
        'Nama Siswa'          => '',
        'Tanggal Lahir Siswa' => '',
        'Nis'                 => '',
        'Nomer KK'            => '',
        'Alamat'              => '',
        'Nama Ayah'           => '',
        'Tanggal Lahir Ayah'  => '',
        'Nik Ayah'            => '',
        'Nomer Telepon Ayah'  => '',
        'Nama Ibu'            => '',
        'Tanggal Lahir Ibu'   => '',
        'Nik Ibu'             => '',
        'Nomer Telepon Ibu'   => '',
        'Nama Wali'           => '',
        'Tanggal Lahir Wali'  => '',
        'Nik Wali'            => '',
        'Nomer KK Wali'       => '',
        'Nomer Telepon Wali'  => '',
        'Alamat Wali'         => '',
      )
    );
    if (!empty($r))
    {
      _func('download');
      download_excel('Template '.date('Y-m-d').' '.rand(0, 999), $r);
    }else{
      echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
    }
  }
}

if ($show_list)
{

$form = _lib('pea', 'school_student');
$form->initSearch();

$form->search->addInput('publish','select');
$form->search->input->publish->addOption('All Status', '');
$form->search->input->publish->addOption('Published', '1');
$form->search->input->publish->addOption('Not Published', '0');

?>
<a href="<?php echo site_url('school/student_add')?>">
  <button type="button" class="btn btn-info" style="margin: 0px 0px 20px 10px ">Tambahkan Siswa</button>
</a>
<?php

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('name, nokk, nis', false); //true = fulltext in database field

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
$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.student_edit');
$form->roll->addInput('user_id', 'sqlplaintext');

$form->roll->addInput('nis', 'text');
$form->roll->input->nis->setTitle('nis');   
$form->roll->input->nis->setPlainText(true);
$form->roll->input->nis->setDisplayColumn(true); 

$form->roll->addReport('excel');
$form->roll->action();
echo $form->roll->getForm();
}

?> 
<div class="col-md-4 col-sm-4 col-xs-4">
  <form action="" method="POST" class="form" role="form">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Template Excel</h3>
      </div>
      <div class="panel-body">
        <div class="help-block">
          Unduh Template Excel
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" name="template" value="download" class="btn btn-default"><?php echo icon('fa-file-excel-o') ?> Download Template</button>
      </div>
    </div>
  </form>
</div>
