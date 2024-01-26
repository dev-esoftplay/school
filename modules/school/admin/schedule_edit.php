<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

  $id = $_GET['id'];
  pr($id, $return = false);
  
  $query = "SELECT * FROM school_schedule WHERE id = $id LIMIT 1";

  $result = $db->getAssoc($query);

  $days = school_schedule_day();

  if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
	{
		if (isset($_POST)) {
	    $selected_class   = isset($_POST['select_class_id']) ? $_POST['select_class_id'] : null;
	    $selected_subject = isset($_POST['select_subject_id']) ? $_POST['select_subject_id'] : null;
	    $days             = isset($_POST['add_days']) ? $_POST['add_days'] : null;
	    $clock_start      = isset($_POST['clock_start']) ? $_POST['clock_start'] : null;
	    $clock_end        = isset($_POST['clock_end']) ? $_POST['clock_end'] : null;

		  if (!empty($_POST['add_days']) && !empty($_POST['clock_start']) && !empty($_POST['clock_end']) && !empty($_POST['select_subject_id'])) {
		  	$schedule_row = $db->getrow("SELECT * FROM `school_schedule` WHERE `subject_id` = $selected_subject AND `day` = $days AND `clock_start` = '$clock_start' AND `clock_end` = '$clock_end'");
		  	if (!$schedule_row) {
			  	$schedule_id = $db->update('school_schedule', array(
						'subject_id'  => $selected_subject,
						'day'         => $days,
						'clock_start' => $clock_start,
						'clock_end'   => $clock_end
			  	), $id);
		  	} else {
		  		echo "data jadwal sudah ada di database";
		  	}
		  }
		}
	}
?> 

<div class="col-md-6">
	<form method="POST" role="form" enctype="multipart/form-data" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Edit Schedule native</h1>
			</div>
		  <div class="panel-body">
				<div class="form-group">
					<label for="">Class</label>
					<?php 	
					$subject_id = $result[$id]['subject_id'];
					$class_id = $db->getAssoc("SELECT `id`, CONCAT_WS(' ',`grade`,`label`,`major`) FROM `school_class` WHERE 1");
					$class_id_fromdb = $db->getone("SELECT `class_id` FROM school_teacher_subject WHERE id = $subject_id ");
					$course_id_fromdb = $db->getone("SELECT `course_id` FROM school_teacher_subject WHERE id = $subject_id ");
					?>
					<select name="select_class_id" id="select_class_id" class="form-control">
						<?php echo createOption($class_id, $class_id_fromdb); ?>
					</select>
				</div>	
				<div class="form-group">
					<label for="">Days</label>
					<select name="add_days" class="form-control">
						<?php echo createOption($days, $result[$id]['day']); ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Clock Start</label>
					<input type="time" name="clock_start" class="form-control" id="" placeholder="Input " value="<?php echo $result[$id]['clock_start'] ?>">
				</div>			
				<div class="form-group">
					<label for="">Clock End</label>
					<input type="time" name="clock_end" class="form-control" id="" placeholder="Input " value="<?php echo $result[$id]['clock_end'] ?>">
				</div>	
				<div class="form-group">
					<label for="">Course</label>
					<select name="select_subject_id" id="course_by_class" class="form-control" required="">
				    <?php 
							$course_id = $db->getAssoc("SELECT s.id, c.name  FROM school_teacher_subject s JOIN school_course c ON s.course_id = c.id WHERE class_id = $class_id_fromdb");
					    echo createOption($course_id, $course_id_fromdb);
				    ?>
					</select>
				</div>
		    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
		  </div>
		</div>
	</form>
	<script type="text/javascript">
	  _Bbc(function ($) {
      $('#select_class_id').change(function() {
        var selected_class = $(this).val();
        $.ajax({
          type: 'POST',
          url: '#',
          data: { select_class_id: selected_class },
          success: function(response) {
            $('#course_by_class').html(response);
          }
        });
      });
    });
	</script>
</div>
<?php 
	if(isset($_POST['select_class_id'])) {
    $selected_class = $_POST['select_class_id'];
    // $course_id = $db->getcol("SELECT course_id FROM school_teacher_subject WHERE class_id = $selected_class");

		// $name = $db->getAssoc("SELECT id , name from school_course WHERE id IN (" .implode(',', $course_id) .")");
		$subject_id_by_class = $db->getAssoc("SELECT s.id, c.name  FROM school_teacher_subject s JOIN school_course c ON s.course_id = c.id WHERE class_id = $selected_class");
    echo createOption($subject_id_by_class);
	} 

	// pr($course_id, $return = false);
?>