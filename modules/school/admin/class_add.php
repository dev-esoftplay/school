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

	echo $form->edit->getForm();
	?>
</div>
<script>
  function validateForm() {
    var fileInput = document.querySelector('input[type="file"]');
    if (fileInput.files.length === 0) {
      alert("Masukkan file terlebih dahulu");
      return false;
    }
  }
</script>
<div class="col-md-4">
	<form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validateForm()">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Class with Excel</h1>
			</div>
		  <div class="panel-body">
				<div class="form-group">
					<label for="">Field class</label>
					<input type="text" name="class" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['class']) ? $_POST['class'] : ''; ?>">
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

		$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : null ;
		$class   = isset($_POST['class']) ? $_POST['class'] : null ;

	  foreach ($output as $key => $value) {

			if ((isset($value[$teacher]) || isset($value['C'])) && (isset($value[$class]) || isset($value['B']))) {

		    $teacher_name = $db->getOne("SELECT `name` FROM `school_teacher` WHERE `name` = '" . ($value[$teacher] ?? $value['C']) . "'");
		    if (!$teacher_name) {
	        $teacher_id = $db->Insert('school_teacher', array(
	            'name' => $value[$teacher] ?? $value['C']
	        ));
	        echo "Nama guru berhasil ditambahkan\n";
		    }

		    if (isset($teacher_id) && $teacher_id !== null) {
	        $classes = explode(" ", $value[$class] ?? $value['B']);
	        $grade   = $classes[0];
	        $major   = $classes[1];
	        $label   = $classes[2];

	        $ct         = $db->getrow("SELECT *  FROM `school_class` WHERE `teacher_id`='$teacher_id'");
	        $class_name = $db->getrow("SELECT *  FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");

	        if (!$class_name && !$ct) {
            $db->Insert('school_class', array(
                'teacher_id' => $teacher_id,
                'grade'      => $grade,
                'label'      => $label,
                'major'      => $major,
            ));
            echo "Data berhasil ditambah\n";
	        } else {
            echo "Data sudah ada di database\n>";
	        }
		    }
			}
	  }
	}
