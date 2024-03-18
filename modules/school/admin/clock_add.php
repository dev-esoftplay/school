<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

echo '<div class="col-md-6">';
	$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
	$form->edit->setSaveTool(true);

	$form->edit->addInput('header', 'header');
	$form->edit->input->header->setTitle('Add Subject');

	$form->edit->addInput('clock_lesson', 'text');
	$form->edit->input->clock_lesson->setTitle('Jam Pelajaran');

	$form->edit->addInput('clock_start', 'datetime');
	$form->edit->input->clock_start->setTitle('Jam Mulai');
	$form->edit->input->clock_start->setParam(array(
	'autoclose'       => true,
	'format'          => 'hh:ii',
	'start-view'      => 0,
	'today-btn'       => false,
	'today-highlight' => false
	));

	$form->edit->addInput('clock_end', 'datetime');
	$form->edit->input->clock_end->setTitle('Jam Akhir');
	$form->edit->input->clock_end->setParam(array(
	'autoclose'       => true,
	'format'          => 'hh:ii',
	'start-view'      => 0,
	'today-btn'       => false,
	'today-highlight' => false
	));


	echo $form->edit->getForm();
echo '</div>';