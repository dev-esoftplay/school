<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (isset($_POST['submit'])) {
	$msg = [];
	if (!empty($_FILES['file']) && ($_POST['submit'] == 'submit_excel')) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
	unset($output[1]);

	  foreach ($output as $key => $value) {
			if ( isset($value['B']) &&  isset($value['C']) &&  isset($value['D'])) {

		    $course_id = $db->getOne("SELECT `id` FROM `school_course` WHERE `name` = '" . $value['B'] . "' ");
		    $teacher_id = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `name` = '" . $value['C'] . "'");

		    if ($value['D']) {
				  $class_parse = explode(" ", $value['D']);
		      if (count($class_parse) !== 3) {
		        $msg[] = msg('Invalid class name format ex. 10 RPL 1' , 'warning');
		      }

	        $grade = $class_parse[0];
	        if (!is_numeric($grade)) {
	          $msg[] = msg('Grade must be an integer');
	        } else {
	          $major = $class_parse[1];
	          $label = $class_parse[2];

	          $class_id = $db->getOne("SELECT `id` FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");
	        }
				}

				$msg_field = [];
	      if (!$teacher_id) {
	        $msg_field[] = 'teacher';
	      }
	      if (!$class_id) {
	        $msg_field[] = 'class';
	      }
	      if (!empty($msg_field)) {
	      	$fields = implode(', ',$msg_field);
	      	$msg = msg($fields .'. yang kamu masukan belum ada pada data manapun, tambahakan data di task '. $fields); 	
	      }

		    if (!$course_id) {
	        $course_id = $db->Insert('school_course', array(
            'name' => $value['B']
	        ));
	        $msg =  msg('Nama course berhasil ditambahkan', 'success');
		    } else {
					$course_id  = $db->getOne("SELECT `id` FROM `school_course` WHERE `name` = '" . $value['B'] . "'");
		    }

				if (isset($teacher_id) && isset($course_id) && isset($class_id)) {
	        $is_exists = $db->getrow("SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");
	        if ($is_exists) {
	          $msg = msg('Data sudah ada di database');
	        }
	        if (!$is_exists) {
	          $subject_id = $db->Insert('school_teacher_subject', array(
	            'teacher_id' => $teacher_id,
	            'course_id'  => $course_id,
	            'class_id'   => $class_id,
	          ));
	          $msg = msg('Data Subject berhasil ditambahkan', 'success');
	        } 
	        // else {
	          // $msg = msg('Data sudah ada di database');
	        // }
		    }
			}
	  }
	}
}

echo '<div class="col-md-6">';
	$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
	$form->edit->setSaveTool(true);

	$form->edit->addInput('header', 'header');
	$form->edit->input->header->setTitle('Add Subject');

	$form->edit->addInput('course', 'selecttable');
	$form->edit->input->course->setTitle('course');
	$form->edit->input->course->setFieldName( 'course_id' );
	$form->edit->input->course->addOption('Select Course', '');
	$form->edit->input->course->setReferenceTable('school_course');
	$form->edit->input->course->setReferenceField('name','id');
	$form->edit->input->course->setRequire();

	$form->edit->addInput('teacher','selecttable');
	$form->edit->input->teacher->setTitle('teacher');
	$form->edit->input->teacher->setFieldName( 'teacher_id' );
	$form->edit->input->teacher->addOption('Select Teacher', '');
	$form->edit->input->teacher->setReferenceTable('school_teacher');
	$form->edit->input->teacher->setReferenceField('name', 'id');
	$form->edit->input->teacher->setRequire();

	$form->edit->addInput('class', 'selecttable');
	$form->edit->input->class->setTitle('class');
	$form->edit->input->class->setFieldName( 'class_id' );
	$form->edit->input->class->addOption('Select Class', '');
	$form->edit->input->class->setReferenceTable('school_class');
	$form->edit->input->class->setReferenceField('CONCAT_WS(" ",grade,label,major)','id');
	$form->edit->input->class->setRequire();

	echo $form->edit->getForm();
echo '</div>';

?>
<div class="col-md-6">
	<form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validate_excel()">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Add Subject with Excel</h3>
			</div>
			<div class="panel-body">
				<?php if (!empty($msg) && ($_POST['submit'] == 'submit_excel')) echo $msg; ?>
        <div class="help-block">
          Upload File Excel
        </div>
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
									<button type="submit" class="btn btn-primary" name="submit" value="submit_excel">Submit</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
      <div class="panel-footer">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#preview-excel">Pilih FIle</button>
      </div>
		</div>
	</form>
</div>
<div class="col-md-6">
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

<script>
  function validate_excel() {
    var fileInput = document.querySelector('input[type="file"]');
    if (fileInput.files.length === 0) {
      alert("Masukkan file terlebih dahulu");
      return false;
    }
  }
</script>

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