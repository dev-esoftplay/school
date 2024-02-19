<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
	if (isset($_POST)) {
    $selected_class   = isset($_POST['class_id']) ? $_POST['class_id'] : null;
    $selected_subject = isset($_POST['subject_id']) ? $_POST['subject_id'] : null;
    $selected_day     = isset($_POST['day']) ? $_POST['day'] : null;
    $clock_start      = isset($_POST['clock_start']) ? $_POST['clock_start'] : null;
    $clock_end        = isset($_POST['clock_end']) ? $_POST['clock_end'] : null;

	  if (!empty($_POST['day']) && !empty($_POST['clock_start']) && !empty($_POST['clock_end']) && !empty($_POST['subject_id'])) {
	  	$schedule_row = $db->getrow("SELECT * FROM `school_schedule` WHERE `subject_id` = $selected_subject AND `day` = $selected_day AND `clock_start` = '$clock_start' AND `clock_end` = '$clock_end'");
	  	if (!$schedule_row) {
		  	$schedule_insert = $db->Insert('school_schedule', array(
					'subject_id'  => $selected_subject,
					'day'         => $selected_day,
					'clock_start' => $clock_start,
					'clock_end'   => $clock_end
		  	));
	  	} else {
	  		echo "data jadwal sudah ada di database";
	  	}
	  }
	}

	if ($schedule_insert) {
    echo '<div class="alert alert-success" role="alert">';
    echo 'Insert Data Success';
    echo '</div>';
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
		    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
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
    function validate_native() {
	    var class_id = document.getElementById("class_id").value;
	    var day = document.getElementsByName("day")[0].value;
	    var clock_start = document.getElementsByName("clock_start")[0].value;
	    var clock_end = document.getElementsByName("clock_end")[0].value;
	    var subject_id = document.getElementById("subject_by_class").value;

	    if (class_id === "Select Class" || day === "Select Days" || clock_start === "" || clock_end === "" || subject_id === "Select Course") {
        alert("Please fill in all fields.");
        return false;
	    }

	    return true;
		}
	</script>
</div>

<div class="col-md-6">
	<form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validate_excel()">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Schedule with Excel</h1>
			</div>
		  <div class="panel-body">
				<div class="form-group">
					<label for="">Field day</label>
					<input type="text" name="day" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['day']) ? htmlspecialchars($_POST['day']) : ''; ?>">
				</div>
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
					<label for="">Field Clock</label>
					<input type="text" name="clock" class="form-control" id="" placeholder="Input field" value="<?php echo isset($_POST['clock']) ? htmlspecialchars($_POST['clock']) : ''; ?>">
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

<?php 
$datashown_course   = false;
$datashown_teacher  = false;
$datashown_class    = false;
$datashown_subject  = false;
$datashown_schedule = false;

if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
	unset($output[1]);

	$day     = isset($_POST['day']) ? $_POST['day'] : null;
	$course  = isset($_POST['course']) ? $_POST['course'] : null;
	$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : null;
	$class   = isset($_POST['class']) ? $_POST['class'] : null;
	$clock   = isset($_POST['clock']) ? $_POST['clock'] : null;

  foreach ($output as $key => $value) {

			if ((isset($value[$day]) || isset($value['B'])) &&
					(isset($value[$course])  || isset($value['C'])) &&
					(isset($value[$teacher]) || isset($value['D'])) &&
					(isset($value[$class])   || isset($value['E'])) &&
					(isset($value[$clock])   || isset($value['F']))) {

	    $course_name = $db->getOne("SELECT `name` FROM `school_course` WHERE `name` = '" . ($value[$course] ?? $value['C']) . "' ");

	    if (!$course_name) {
	        $course_id = $db->Insert('school_course', array(
	            'name' => $value[$course] ?? $value['B']
	        ));
	        echo "Nama course berhasil ditambahkan\n";
	    } else {
				$course_id  = $db->getOne("SELECT `id` FROM `school_course` WHERE `name` = '" . ($value[$course] ?? $value['C']) . "'");
				if (!$datashown_course) {
	        echo "Data course sudah ada di database\n";
	        $datashown_course = true; // Set variabel penanda
			  }
	    }

	    $teacher_name = $db->getOne("SELECT `name` FROM `school_teacher` WHERE `name` = '" . ($value[$teacher] ?? $value['D']) . "'");

	    if (!$teacher_name) {
        $teacher_id = $db->Insert('school_teacher', array(
          'name' => $value[$teacher] ?? $value['D']
        ));
        echo "Nama guru berhasil ditambahkan\n";
	    } else {
	      $teacher_id = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `name` = '" . ($value[$teacher] ?? $value['D']) . "'");
	      if (!$datashown_teacher) {
	        echo "Data teacher sudah ada di database\n";
	        $datashown_teacher = true; // Set variabel penanda
			 	}
	    }

	    if (isset($teacher_id) && $teacher_id !== null) {
        $classes = explode(" ", $value[$class] ?? $value['E']);
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
		      $class_id   = $db->getOne("SELECT `id` FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");
		       if (!$datashown_class) {
		        echo "Data class sudah ada di database\n";
		        $datashown_class = true; // Set variabel penanda
			    }
        }
	    }

			if (isset($teacher_id, $course_id, $class_id) && $teacher_id !== null && $course_id !== null && $class_id !== null) {
        $s = $db->getrow("SELECT * FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");
        if (!$s) {
          $subject_id = $db->Insert('school_teacher_subject', array(
            'teacher_id' => $teacher_id,
            'course_id'  => $course_id,
            'class_id'   => $class_id,
          ));
          echo "Data Subject berhasil ditambahkan\n";
        } else {
            $subject_id = $db->getone("SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");
          if (!$datashown_subject) {
		        echo "Data Subject sudah ada di database\n";
		        $datashown_subject = true; // Set variabel penanda
			    }
        }
	    }

	    if (isset($subject_id) && $subject_id !== null) {
	    	$days_num = ($value[$day] ?? $value['B']);
	    	$days_numeric = school_schedule_days_numeric($days_num);

		  	$clock_merge = explode(" - ", $value[$clock] ?? $value['F']);
				$clock_start = $clock_merge[0];
				$clock_end   = $clock_merge[1];

		  	$schedule = $db->getrow("SELECT * FROM `school_schedule` WHERE `subject_id` = $subject_id AND `day` = $days_numeric AND `clock_start` = '$clock_start' AND `clock_end` = '$clock_end'");

		  	if (!$schedule) {
			  	$schedule_id = $db->Insert('school_schedule', array(
						'subject_id'  => $subject_id,
						'day'         => $days_numeric,
						'clock_start' => $clock_start,
						'clock_end'   => $clock_end
			  	));
		  	} else {
  		    if (!$datashown_schedule) {
		        echo "Data schedule sudah ada di database\n";
		        $datashown_schedule = true; // Set variabel penanda
			    }
		  	}
		  }
		}
  }
}
