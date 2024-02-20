<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (isset($_POST['submit'])) {
	$msg = [];
	if ($_POST['submit'] == 'submit_native') {
	  $selected_class   = isset($_POST['class_id']) ? $_POST['class_id'] : null;
	  $selected_subject = isset($_POST['subject_id']) ? $_POST['subject_id'] : null;
	  $selected_day     = isset($_POST['day']) ? $_POST['day'] : null;
	  $clock_start      = isset($_POST['clock_start']) ? $_POST['clock_start'] : null;
	  $clock_end        = isset($_POST['clock_end']) ? $_POST['clock_end'] : null;

	  if (!empty($_POST['day']) && !empty($_POST['clock_start']) && !empty($_POST['clock_end']) && !empty($_POST['subject_id'])) {
	  	$is_exist = $db->getrow("SELECT `id` FROM `school_schedule` WHERE `subject_id` = $selected_subject AND `day` = $selected_day AND `clock_start` = '$clock_start' AND `clock_end` = '$clock_end'");
	  	if (!$is_exist) {
		  	$schedule_id = $db->Insert('school_schedule', array(
					'subject_id'  => $selected_subject,
					'day'         => $selected_day,
					'clock_start' => $clock_start,
					'clock_end'   => $clock_end
		  	));
	  	} else {
	  		$msg = msg('data jadwal sudah ada di database');
	  	}
	  }
	  if ($schedule_id) {
			$msg = msg('Insert Data Success', 'success');
		}
	}

	if ($_POST['submit'] == 'submit_excel') {
		if (!empty($_FILES['file'])) {
		  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
			unset($output[1]);

		  foreach ($output as $key => $value) {
				if (isset($value['B']) && isset($value['C']) && isset($value['D']) && isset($value['E']) && isset($value['F'])) {

					$course_id  = $db->getOne("SELECT `id` FROM `school_course` WHERE `name` = '" . $value['B'] . "'");
		      $teacher_id = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `name` = '" . $value['C'] . "'");

					if ($value['D']) {
					  $class_parse = explode(" ", $value['D']);
			      if (count($class_parse) !== 3) {
			        $msg[] = msg('Invalid class name format ex. 10 RPL 1');
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
          if (!$course_id) {
            $msg_field[] = 'course';
          }
          if (!$teacher_id) {
            $msg_field[] = 'teacher';
          }
          if (!$class_id) {
            $msg_field[] = 'class';
          }
          if (!empty($msg_field)) {
          	$msg = msg(implode(', ',$msg_field).'. yang kamu masukan belum ada pada subject manapun, tambahakan subject di task subject');
          }

					/*yahalo*/

					if (isset($teacher_id) && isset($course_id) && isset($class_id)) {
            $subject_id = $db->getone("SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");
		        if (!$subject_id) {
		          $msg[] = msg('Data Subject Belum Ada');
		        }
			    }

			    if (isset($subject_id)) {
			    	$days_num = school_schedule_day_num($value['E']);

				  	$clock_merge = explode(" - ", $value['F']);
						$clock_start = $clock_merge[0];
						$clock_end   = $clock_merge[1];

				  	$is_exists = $db->getrow("SELECT `id` FROM `school_schedule` WHERE `subject_id` = $subject_id AND `day` = $days_num AND `clock_start` = '$clock_start' AND `clock_end` = '$clock_end'");

				  	if (!$is_exists) {
					  	$schedule_id = $db->Insert('school_schedule', array(
								'subject_id'  => $subject_id,
								'day'         => $days_num,
								'clock_start' => $clock_start,
								'clock_end'   => $clock_end
					  	));
							$msg = msg('Insert Jadwal Success', 'success');
				  	} else {
			        $msg = msg('Data schedule sudah ada di database');
				  	}
					}
				}
			}
		}
	}
}

$class_id = $db->getAssoc('SELECT `id`, CONCAT_WS(" ",`grade`,`label`,`major`) FROM `school_class` WHERE 1');

if(isset($_POST['class_id'])  && !isset($_POST['submit'])) {
  $selected_class = $_POST['class_id'];
	$class_subject_id = $db->getAssoc('SELECT s.id, CONCAT_WS(" - ", c.name , t.name) FROM `school_teacher_subject` s JOIN `school_course` c ON s.course_id = c.id JOIN `school_teacher` t ON s.teacher_id = t.id WHERE class_id = ' . $selected_class);
  echo createOption($class_subject_id);
}

?> 
<div class="col-md-6">
	<form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validate_native()">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Schedule native</h1>
			</div>
		  <div class="panel-body">
				<?php if (!empty($msg) && ($_POST['submit'] == 'submit_native')) echo $msg; ?>
				<div class="form-group">
					<label for="">Class</label>
					<select name="class_id" id="class_id" class="form-control">
						<option>Select Class</option>
						<?php echo createOption($class_id);?>
					</select>
				</div>	
				<div class="form-group">
					<label for="">Days</label>
					<select name="day" class="form-control">
						<option>Select Days</option>
						<?php echo createOption($days);?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Clock Start</label>
					<input type="time" name="clock_start" class="form-control" id="" placeholder="Input " value="">
				</div>			
				<div class="form-group">
					<label for="">Clock End</label>
					<input type="time" name="clock_end" class="form-control" id="" placeholder="Input " value="">
				</div>	
				<div class="form-group">
					<label for="">Course</label>
					<select name="subject_id" id="subject_by_class" class="form-control" required="" disabled>
						<option>Select Course</option>
					</select>
				</div>
		    <button type="submit" class="btn btn-primary" name="submit" value="submit_native">Submit</button>
		  </div>
		</div>
	</form>
	<script type="text/javascript">
	  _Bbc(function ($) {
      $('#class_id').change(function() {
        var selected_class = $(this).val();
        if(selected_class !== "Select Class") {
          $('#subject_by_class').prop('disabled', false);
          $.ajax({
	          type: 'POST',
	          url: '#',
	          data: { class_id: selected_class },
	          success: function(response) {
              $('#subject_by_class').html(response);
	          }
          });
        } else {
          $('#subject_by_class').prop('disabled', true);
          $('#subject_by_class').html('<option>Select Class First</option>');
        }
      });
    });
	</script>
</div>
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
	function validate_native() {
    var class_id    = document.getElementById("class_id").value;
    var day         = document.getElementsByName("day")[0].value;
    var clock_start = document.getElementsByName("clock_start")[0].value;
    var clock_end   = document.getElementsByName("clock_end")[0].value;
    var subject_id  = document.getElementById("subject_by_class").value;

    if (class_id === "Select Class" || day === "Select Days" || clock_start === "" || clock_end === "" || subject_id === "Select Course") {
      alert("Please fill in all fields.");
      return false;
    }
    return true;
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