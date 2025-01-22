<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$id             = $_GET['id'];
$query          = 'SELECT * FROM school_schedule WHERE id = '. $id .' LIMIT 1';
$result         = $db->getrow($query);
$subject_id     = $result['subject_id'];
$days           = school_schedule_day();
$class_list     = $db->getAssoc('SELECT `id`, CONCAT_WS(" ",`grade`,`label`,`major`) FROM `school_class` WHERE 1');
$course_list    = $db->getAssoc('SELECT `id`, `name` FROM `school_course` WHERE 1');
$teacher_list   = $db->getAssoc('SELECT `id`, `name` FROM `school_teacher` WHERE 1');
$clock_lesson   = $db->getAssoc("SELECT CONCAT_WS('-',`clock_start`,`clock_end`), CONCAT(`clock_start`, '-', `clock_end`, ' (Jam Pelajaran ke ', `clock_lesson`, ')')   FROM `school_clock` WHERE 1");
$clock_keys     = array_keys($clock_lesson);
$clock_parse    = explode('-', reset($clock_keys));
$clock_merged   = implode('-', [$result['clock_start'], $result['clock_end']]);
$clock_data     = $db->getone('SELECT CONCAT_WS("-",`clock_start`,`clock_end`) FROM school_clock WHERE clock_start= \''.$result['clock_start'].'\' AND  clock_end= \''.$result['clock_end'].'\' ');
$subject_data   = $db->getrow('SELECT `class_id`,`course_id`,`teacher_id` FROM `school_teacher_subject` WHERE `id` =  ' . $subject_id);
$class_id       = isset($_POST['class_id']) ? $_POST['class_id'] : $subject_data['class_id'];
$course_id      = isset($_POST['course_id']) ? $_POST['course_id'] : $subject_data['course_id'];
$teacher_id     = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : $subject_data['teacher_id'];
$selected_day   = isset($_POST['day']) ? $_POST['day'] : $result['day'];
$selected_clock = !empty($clock_data) ? $clock_data : $clock_merged;
$clock_start    = isset($_POST['clock_start']) ? $_POST['clock_start'] : $result['clock_start'];
$clock_end      = isset($_POST['clock_end']) ? $_POST['clock_end'] : $result['clock_end'];

$msg = [];
if (isset($_POST['submit'])) {
	$is_exists = $db->getrow("SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = $teacher_id AND `course_id` = $course_id AND `class_id` = $class_id");
	if ($is_exists) {
		$subject_id = $is_exists['id']; 
	} else {
		$subject_id = $db->Insert('school_teacher_subject', array(
      'teacher_id' => $teacher_id,
      'course_id'  => $course_id,
      'class_id'   => $class_id,
    ));
	}
	$schedule_update = [];
	if (!empty($subject_id)) {
		$schedule_update['subject_id'] = $subject_id; 
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
		$msg = msg('Update Success', 'success');
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
		  	<?php if (!empty($msg)) echo $msg; ?>
				<div class="form-group">
					<label for="">Kelas</label>
						<select name="class_id" id="class_id" class="form-control">
						<?php echo createOption($class_list, $class_id);?>
						</select>
				</div>	
				<div class="form-group">
					<label for="">Mata Pelajaran</label>
						<select name="course_id" id="course_id" class="form-control">
						<?php echo createOption($course_list, $course_id);?>
						</select>
				</div>	
				<div class="form-group">
					<label for="">Guru</label>
						<select name="teacher_id" id="teacher_id" class="form-control">
						<?php echo createOption($teacher_list, $teacher_id);?>
						</select>
				</div>	
				<div class="form-group">
					<label for="">Days</label>
					<select name="day" id="day" class="form-control">
						<?php echo createOption($days, $selected_day);?> 
					</select>
				</div>
				<div class="form-group">
					<label for="">Jam Pelajaran</label>
					<select class="form-control" name="clock_lesson" id="clock_lesson" >
						<option>Select Lesson Hour</option>
						<?php echo createOption($clock_lesson, $selected_clock); ?>
					</select>
					<p>
						<span id="clock_show"></span> Untuk mencustom jam pelajaran bisa klik <span><a href="#clock_modal" id="open_modal">disini</a></span>,
						untuk Menambahkan Jam Pelajaran kamu bisa ke task <span><a href="<?php echo site_url($Bbc->mod['circuit'].'.clock', $add_URL = true); ?>">clock</a></span>
					</p>
				</div>
				<div class="modal" id="clock_modal" style="background-color: white;">
					<div class="modal-dialog" style="max-width: 1000px; width: 100%;">
						<div class="modal-content">
					    <span class="close" id="close_modal">&times;</span>
							<div class="modal-header">
								<h4 class="modal-title">Change Clock</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="">Clock Start</label>
									<input type="time" name="clock_start" class="form-control" id="lesson_clock_start_modal" placeholder="Input " value="" required>
								</div>
								<div class="form-group">
									<label for="">Clock End</label>
									<input type="time" name="clock_end" class="form-control" id="lesson_clock_end_modal" placeholder="Input " value="" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="clock_start" class="form-control" id="lesson_clock_start" placeholder="Input" value="<?php echo $clock_start ?>" required readonly>
				</div>
				<div class="form-group">
					<input type="hidden" name="clock_end" class="form-control" id="lesson_clock_end" placeholder="Input" value="<?php echo $clock_end ?>" required readonly>
				</div>
		    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
		  </div>
		</div>
	</form>
	<script type="text/javascript">
	  _Bbc(function ($) {
      // $('#class_id').change(function() {
      //   var class_id = $(this).val();
      //   $.ajax({
      //     type: 'POST',
      //     url: '#',
      //     data: { class_id: class_id },
      //     success: function(response) {
      //       $('#subject_by_class').html(response);
      //     }
      //   });
      // });
      var clock_start = $('#lesson_clock_start').val();
      var clock_end   = $('#lesson_clock_end').val();
      if (clock_start && clock_end) {
      	$('#clock_show').text(clock_start + '-' + clock_end);		 
			  var option_html = '<option value="' + clock_start + '-' + clock_end + '">' + clock_start + '-' + clock_end + ' Jam Custom</option>';
		    $('#clock_lesson').append(option_html).val(clock_start + '-' + clock_end);
        $('#lesson_clock_start_modal').val(clock_start);
        $('#lesson_clock_end_modal').val(clock_end);
      }
      var clock_value = $('#clock_lesson').val();
      if(clock_value !== $('#clock_lesson option:first').val()){
				var times = clock_value.split('-');
				var clock_start = times[0];
				var clock_end = times[1];
        $('#clock_show').html(clock_value);
        $('#lesson_clock_start').val(clock_start);
        $('#lesson_clock_end').val(clock_end);
        $('#lesson_clock_start_modal').val(clock_start);
        $('#lesson_clock_end_modal').val(clock_end);
		  }
      $('#clock_lesson').change(function() {
				localStorage.setItem('selected', this.value);
				var selected = localStorage.getItem('selected');
				if (selected == $('#clock_lesson option:first').val()) {
			    $('#clock_show').html('');
			    $('#lesson_clock_start').val('');
			    $('#lesson_clock_end').val('');
			    $('#lesson_clock_start_modal').val('');
			    $('#lesson_clock_end_modal').val('');
			  }
      	if(selected !== $('#clock_lesson option:first').val()){
					var clock_parse = localStorage.getItem('selected');
					var times = clock_parse.split('-');
					var clock_start = times[0];
					var clock_end = times[1];
	        $('#clock_show').html(selected);
	        $('#lesson_clock_start').val(clock_start);
	        $('#lesson_clock_end').val(clock_end);
	        $('#lesson_clock_start_modal').val(clock_start);
	        $('#lesson_clock_end_modal').val(clock_end);
		    }
	    });
	    $('#lesson_clock_start_modal, #lesson_clock_end_modal').change(function() {
        var fieldName = $(this).attr('id');
        console.log(fieldName);
        var fieldValue = $(this).val();
        localStorage.setItem(fieldName, fieldValue);
			  var startValue = $('#lesson_clock_start_modal').val();
        var endValue = $('#lesson_clock_end_modal').val();
        $('#clock_show').text(startValue + '-' + endValue);		 
			  var option_html = '<option value="' + startValue + '-' + endValue + '">' + startValue + '-' + endValue + ' Jam Custom</option>';
		    $('#clock_lesson').append(option_html).val(startValue + '-' + endValue);;   
		    $('#lesson_clock_start').val(startValue);
        $('#lesson_clock_end').val(endValue);
	    });

	    var modal = document.getElementById('clock_modal');
			var openBtn = document.getElementById("open_modal");
			var closeBtn = document.getElementById("close_modal");

			openBtn.onclick = function() {
			  modal.style.display = "block";
			}

			closeBtn.onclick = function() {
			  modal.style.display = "none";
			}

			window.onclick = function(event) {
			  if (event.target == modal) {
			    modal.style.display = "none";
			  }
			}

    });
	</script>
</div>