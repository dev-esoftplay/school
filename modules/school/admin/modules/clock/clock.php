<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_clock');
$form->initSearch();

$form->search->addInput('keyword', 'keyword');
$form->search->input->keyword->addSearchField('keyword,day,clock_start,clock_end');

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll($add_sql . ' ORDER BY id DESC', 'id');
$form->roll->setSaveTool(true);

$form->roll->addInput('clock_lesson', 'textarea');
$form->roll->input->clock_lesson->setTitle('Jam Pelajaran');
$form->roll->input->clock_lesson->setNl2br(false);

$form->roll->addInput('clock_start', 'textarea');
$form->roll->input->clock_start->setTitle('Jam Mulai');
$form->roll->input->clock_start->setNl2br(false);

$form->roll->addInput('clock_end', 'textarea');
$form->roll->input->clock_end->setTitle('Jam Akhir');
$form->roll->input->clock_end->setNl2br(false);

echo $form->roll->getForm();

include 'clock_add.php';