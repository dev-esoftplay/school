<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$id = $_GET['id'];
$query = 'SELECT * FROM school_schedule WHERE id = '. $id .' LIMIT 1';

$result     = $db->getrow($query);
$subject_id = $result['subject_id'];
$days       = school_schedule_day();

$class_id_all     = $db->getAssoc('SELECT `id`, CONCAT_WS(" ",`grade`,`label`,`major`) FROM `school_class` WHERE 1');
$course_id        = $db->getone('SELECT `course_id` FROM `school_teacher_subject` WHERE `id` =  ' . $subject_id);
$class_id         = $db->getone('SELECT `class_id` FROM `school_teacher_subject` WHERE `id` =  ' . $subject_id);

$selected_class   = isset($_POST['class_id']) ? $_POST['class_id'] : $class_id;
$class_subject_id = $db->getAssoc('SELECT s.id, CONCAT_WS(" - ", c.name , t.name) FROM `school_teacher_subject` s JOIN `school_course` c ON s.course_id = c.id JOIN `school_teacher` t ON s.teacher_id = t.id WHERE class_id = ' . $selected_class);
if(isset($_POST['class_id']) && !isset($_POST['submit'])) {
  echo createOption($class_subject_id, $subject_id);
}
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$selected_subject = isset($_POST['subject_id']) ? $_POST['subject_id'] : null;
	$selected_day     = isset($_POST['day']) ? $_POST['day'] : null;
	$clock_start      = isset($_POST['clock_start']) ? $_POST['clock_start'] : null;
	$clock_end        = isset($_POST['clock_end']) ? $_POST['clock_end'] : null;

	$schedule_update = [];

	if (!empty($selected_subject)) {
		$schedule_update['subject_id'] = $selected_subject; 
	}

	if (!empty($selected_day)) {
		$schedule_update['day'] = $selected_day; 
	}

	if (!empty($clock_start)) {
		$schedule_update['clock_start'] = $clock_start; 
	}
	
	if (!empty($clock_end)) {
		$schedule_update['clock_end'] = $clock_end; 
	}

	$schedule_update_succeed = $db->update('school_schedule', $schedule_update, $id);

	if ($schedule_update_succeed) {
    echo '<div class="alert alert-success" role="alert">';
    echo 'Update Data Success';
    echo '</div>';
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
						<select name="class_id" id="class_id" class="form-control">
						<?php echo createOption($class_id_all, $selected_class);?>
						</select>
				</div>	
				<div class="form-group">
					<label for="">Days</label>
					<select name="day" id="day" class="form-control">
						<?php echo createOption($days, $result['day']);?> 
					</select>
				</div>
				<div class="form-group">
					<label for="">Clock Start</label>
					<input type="time" name="clock_start" class="form-control" id="" placeholder="Input " value="<?php echo $result['clock_start'] ?>">
				</div>			
				<div class="form-group">
					<label for="">Clock End</label>
					<input type="time" name="clock_end" class="form-control" id="" placeholder="Input " value="<?php echo $result['clock_end'] ?>">
				</div>	
				<div class="form-group">
					<label for="">Course</label>
					<select name="subject_id" id="subject_by_class" class="form-control" required="">
				    <?php echo createOption($class_subject_id, $subject_id) ?>
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
        $.ajax({
          type: 'POST',
          url: '#',
          data: { class_id: selected_class },
          success: function(response) {
            $('#subject_by_class').html(response);
          }
        });
      });
    });
	</script>
</div>