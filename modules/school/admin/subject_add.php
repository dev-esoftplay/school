<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 
<div class="col-md-6">
	<?php 
		$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
		$form->edit->setSaveTool(true);

		$form->edit->addInput('header', 'header');
		$form->edit->input->header->setTitle('Add Course');

		$form->edit->addInput('course', 'selecttable');
		$form->edit->input->course->setTitle('course');
		$form->edit->input->course->setFieldName( 'course_id' );
		$form->edit->input->course->setReferenceTable('school_course');
		$form->edit->input->course->setReferenceField('name','id');
		$form->edit->input->course->setRequire();

		$form->edit->addInput('teacher','selecttable');
		$form->edit->input->teacher->setFieldName( 'teacher_id' );
		$form->edit->input->teacher->setTitle('Add teacher');
		$form->edit->input->teacher->addOption('Select Teacher', '');
		$form->edit->input->teacher->setReferenceTable('school_teacher');
		$form->edit->input->teacher->setReferenceField('name', 'id');
		$form->edit->input->teacher->setRequire();

		$form->edit->addInput('class', 'selecttable');
		$form->edit->input->class->setTitle('class');
		$form->edit->input->class->setFieldName( 'class_id' );
		$form->edit->input->class->setReferenceTable('school_class');
		$form->edit->input->class->setReferenceField('CONCAT_WS(" ",grade,label,major)','id');
		$form->edit->input->class->setRequire();

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
<div class="col-md-6">
	<form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validateForm()">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Course with Excel</h1>
			</div>
		  <div class="panel-body">
				<div class="form-group">
					<label for="">Field Course</label>
					<input type="text" name="course" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['course']) ? htmlspecialchars($_POST['course']) : ''; ?>">
				</div>	
				<div class="form-group">
					<label for="">Field Teacher</label>
					<input type="text" name="teacher" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['teacher']) ? htmlspecialchars($_POST['teacher']) : ''; ?>">
				</div>
				<div class="form-group">
					<label for="">Field Class</label>
					<input type="text" name="class" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['class']) ? htmlspecialchars($_POST['class']) : ''; ?>">
				</div>	

				<div class="form-group">
          <label for="fileInput">Upload Excel</label>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#preview-excel">Pilih FIle</button>

        <div class="modal" id="preview-excel" style="background-color: white;">
          <div class="modal-dialog" style="max-width: 1000px; width: 100%;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Preview Excel</h4>
              </div>

              <div class="modal-body">
                <label for="fileInput">Pilih File</label>
                <input id="fileInput" name="file" type="file">
                <div id="preview">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
		</div>
	</form>
</div>
<?php 
	if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) {
	  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
		unset($output[1]);

		$course  = isset($_POST['course']) ? $_POST['course'] : null;
		$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : null;
		$class   = isset($_POST['class']) ? $_POST['class'] : null;

	  foreach ($output as $key => $value) {

			if ((isset($value[$course]) || isset($value['B'])) && (isset($value[$teacher]) || isset($value['C'])) && (isset($value[$class]) || isset($value['D']))) {

		    $course_name = $db->getOne("SELECT `name` FROM `school_course` WHERE `name` = '" . ($value[$course] ?? $value['B']) . "' ");

		    if (!$course_name) {
		        $course_id = $db->Insert('school_course', array(
		            'name' => $value[$course] ?? $value['B']
		        ));
		        echo "Nama course berhasil ditambahkan\n";
		    } else {
					echo "course";
					$course_id  = $db->getOne("SELECT `id` FROM `school_course` WHERE `name` = '" . ($value[$course] ?? $value['B']) . "'");
					pr($course_id, $return = false);
		    }

		    $teacher_name = $db->getOne("SELECT `name` FROM `school_teacher` WHERE `name` = '" . ($value[$teacher] ?? $value['C']) . "'");

		    if (!$teacher_name) {
		        $teacher_id = $db->Insert('school_teacher', array(
		            'name' => $value[$teacher] ?? $value['C']
		        ));
		        echo "Nama guru berhasil ditambahkan\n";
		    } else {
					echo "teacher";
		      $teacher_id = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `name` = '" . ($value[$teacher] ?? $value['C']) . "'");
		      pr($teacher_id, $return = false);

		    }

		    if (isset($teacher_id) && $teacher_id !== null) {
	        $classes = explode(" ", $value[$class] ?? $value['D']);
	        $grade   = $classes[0];
	        $major   = $classes[1];
	        $label   = $classes[2];

	        $ct         = $db->getrow("SELECT * FROM `school_class` WHERE `teacher_id`='$teacher_id'");
	        $class_name = $db->getrow("SELECT * FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");

	        if (!$class_name && !$ct) {
	            $class_id = $db->Insert('school_class', array(
	                'teacher_id' => $teacher_id,
	                'grade'      => $grade,
	                'label'      => $label,
	                'major'      => $major,
	            ));
	            echo "Data Class berhasil ditambahkan\n";
	        } else {
	        	echo "class";
  		      $class_id   = $db->getOne("SELECT `id` FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");
  		      pr($class_id, $return = false);
	        }
		    }

				if (isset($teacher_id, $course_id, $class_id) && $teacher_id !== null && $course_id !== null && $class_id !== null) {

	        $s = $db->getrow("SELECT * FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");
	        if (!$s) {
	            $db->Insert('school_teacher_subject', array(
	                'teacher_id' => $teacher_id,
	                'course_id'  => $course_id,
	                'class_id'   => $class_id,
	            ));
	            echo "Data Subject berhasil ditambahkan\n";
	        } else {
	            echo "Data sudah ada di database\n";
	        }
		    }
			}
	  }
	}
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
  document.getElementById('fileInput').addEventListener('change', function(e) {
    var file = e.target.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, {
          type: 'array'
        });

        // Ambil data dari sheet pertama
        var sheetName = workbook.SheetNames[0];
        var sheet = workbook.Sheets[sheetName];

        // Convert data sheet ke array of objects
        var jsonData = XLSX.utils.sheet_to_json(sheet);

        // Tampilin preview dalam bentuk tabel di div dengan id 'preview'
        var html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr>';

        // Ambil nama kolom
        var columns = Object.keys(jsonData[0]);
        columns.forEach(function(column) {
          html += '<th>' + column + '</th>';
        });

        html += '</tr></thead><tbody>';

        // Isi data ke dalam tabel
        jsonData.forEach(function(row) {
          html += '<tr>';
          columns.forEach(function(column) {
            html += '<td>' + row[column] + '</td>';
          });
          html += '</tr>';
        });

        html += '</tbody></table>';

        // Tampilin tabel di div dengan id 'preview' dengan tambahan border
        document.getElementById('preview').innerHTML = html;
      };

      reader.readAsArrayBuffer(file);
    }
  });
</script>