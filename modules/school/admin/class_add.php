<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 
<div class="col-md-4">
	<?php 
		$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
		$form->edit->setSaveTool(true);

		$form->edit->addInput('header', 'header');
		$form->edit->input->header->setTitle('Add Class');

		$form->edit->addInput( 'grade', 'text' );
		$form->edit->input->grade->setFieldName( 'grade' );
		$form->edit->input->grade->setRequire();


		$form->edit->addInput( 'label', 'text' );
		$form->edit->input->label->setFieldName( 'label' );
		$form->edit->input->label->setRequire();


		$form->edit->addInput( 'major', 'text' );
		$form->edit->input->major->setFieldName( 'major' );
		$form->edit->input->major->setRequire();

		$form->edit->addInput('teacher','selecttable');
		$form->edit->input->teacher->setFieldName( 'teacher_id' );
		$form->edit->input->teacher->setTitle('Add teacher');
		$form->edit->input->teacher->addOption('Select Teacher', '');
		$form->edit->input->teacher->setReferenceTable('school_teacher');
		$form->edit->input->teacher->setReferenceField('name', 'id');
		$form->edit->input->teacher->setRequire();

		// $form->edit->input->teacher->setReferenceNested();

		echo $form->edit->getForm();
	 ?>
</div>
<div class="col-md-4">
	<form method="POST" role="form" enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Class with Excel</h1>
			</div>
		  <div class="panel-body">
				<div class="form-group">
					<label for="">Field Grade</label>
					<input type="text" name="grade" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['grade']) ? htmlspecialchars($_POST['grade']) : ''; ?>">
				</div>	
				<div class="form-group">
					<label for="">Field Label</label>
					<input type="text" name="label" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['label']) ? htmlspecialchars($_POST['label']) : ''; ?>">
				</div>	
				<div class="form-group">
					<label for="">Field Major</label>
					<input type="text" name="major" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['major']) ? htmlspecialchars($_POST['major']) : ''; ?>">
				</div>	
				<div class="form-group">
					<label for="">Field Teacher</label>
					<input type="text" name="teacher" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['teacher']) ? htmlspecialchars($_POST['teacher']) : ''; ?>">
				</div>
				<div class="form-group">
		      <label for="fileInput">Pilih File</label>
		      <input type="file" name="file" class="form-control">
				</div>
			    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
		  </div>
		</div>
	</form>
</div>
<?php 
	if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) {
	  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
		unset($output[1]);
		$grade   = isset($_POST['grade']) ? $_POST['grade'] : null;
		$label   = isset($_POST['label']) ? $_POST['label'] : null;
		$major   = isset($_POST['major']) ? $_POST['major'] : null;
		$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : null;

		pr($grade, $return = false);

	  foreach ($output as $key => $value) {
			$teacher_name  = $db->getOne("SELECT name FROM school_teacher WHERE name = '$value[$teacher]'");

			if (!$teacher_name) {
		  	$db->Insert('school_teacher' , array(
		      'name' => $value[$teacher]
		    ));
		    echo "nama guru berhasil ditambahakan";
			}

			$teacher_id  = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `name` = '$value[$teacher]'");

	  	$ct = $db->getrow("SELECT *  FROM `school_class` WHERE `teacher_id`='$teacher_id'");

	  	$c = $db->getrow("SELECT `grade`, `label`, `major` FROM `school_class` WHERE `grade` = $value[$grade] AND `label` = '$value[$label]' AND `major` = '$value[$major]'");

	  	if (!$ct && !$c) {
		  	$db->Insert('school_class', array(
			    'teacher_id' => $teacher_id,
	        'grade'      => $value[$grade],
	        'label'      => $value[$label],
	        'major'      => $value[$major],
	      ));    
	      echo "data berhasil di tambah";
	  	}
	  	if ($c) {
	  		echo "data terduplikasi";
	  	}
	  }
	}
