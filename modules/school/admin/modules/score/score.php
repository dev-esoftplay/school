<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

//buat mantau aja
$form = _lib('pea', 'school_score_cat');
$form->initRoll('WHERE 1 ORDER BY name ASC');

$form->roll->addInput('header', 'header');
$form->roll->input->header->setTitle('Daftar Score Category');

$form->roll->addInput('name', 'text');
$form->roll->input->name->setTitle('Nama Tugas');

$form->roll->addInput('weight', 'text');
$form->roll->input->weight->setTitle('Bobot Tugas');

$form->roll->action();
echo $form->roll->getForm();
?>

<div class="col-md-6">
    <?php

    $form = _lib('pea', 'school_score_cat');
    $form->initAdd();

    $form->add->addInput('header', 'header');
    $form->add->input->header->setTitle('Add Score Category');

    $form->add->addInput('name', 'text');
    $form->add->input->name->setTitle('Nama Tugas');
    $form->add->input->name->setRequire('text', 1);

    $form->add->addInput('weight', 'text');
    $form->add->input->weight->setTitle('Bobot Tugas');
    $form->add->input->weight->setRequire('number', 1);

    $form->add->action();

    $form->add->setSuccessSaveMessage('<script type="text/javascript"> (function() {window.addEventListener(\'load\', function() {setTimeout(function() {window.location.href = window.location.href; }, 0); }, false); })(); </script>');

    echo $form->add->getForm();

    ?>
</div>