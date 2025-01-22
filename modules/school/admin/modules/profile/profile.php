<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea',  'school');
$form->initEdit('WHERE `id` = 1');

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle('Edit Profile Sekolah');

$form->edit->addInput('npsn', 'text');
$form->edit->input->npsn->setTitle('Nomor Pokok Sekolah Nasional (NPSN)');
$form->edit->input->npsn->setRequire($is_input_require = 'number', $is_mandatory = 1);

$form->edit->addInput('nss', 'text');
$form->edit->input->nss->setTitle('Nomor Statistik Sekolah (NSS)');
$form->edit->input->nss->setRequire($is_input_require = 'number', $is_mandatory = 1);

$form->edit->addInput('name', 'text');
$form->edit->input->name->setTitle('Nama Sekolah');
$form->edit->input->name->setRequire($is_input_require = 'text', $is_mandatory = 1);

$form->edit->addInput('address', 'text');
$form->edit->input->address->setTitle('Alamat Sekolah');
$form->edit->input->address->setRequire($is_input_require = 'text', $is_mandatory = 1);

// $form->edit->addInput('image', 'file');
// $form->edit->input->image->setTitle('Title');
// $form->edit->input->image->setAllowedExtension(array('jpg', 'jpeg', 'png', 'webp'));
// $form->edit->input->image->setThumbnail(120, $prefix = 'thumb', $is_dir = true);

$form->edit->addInput('email', 'text');
$form->edit->input->email->setTitle('Email Sekolah');
$form->edit->input->email->setRequire($is_input_require = 'email', $is_mandatory = 1);

$form->edit->addInput('phone', 'text');
$form->edit->input->phone->setTitle('Nomor Telepon Sekolah');
$form->edit->input->phone->setRequire($is_input_require = 'phone', $is_mandatory = 1);

$form->edit->action();
echo $form->edit->getForm();
