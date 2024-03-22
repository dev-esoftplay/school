<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$msg="";
if (isset($_POST['submit'])) {
	$clock_lesson = isset($_POST['clock_lesson']) ? $_POST['clock_lesson'] : ''; 
	$clock_start  = isset($_POST['clock_start']) ? $_POST['clock_start'] : ''; 
	$clock_end    = isset($_POST['clock_end']) ? $_POST['clock_end'] : ''; 
	$clock_data   = array(
		'clock_lesson' => $clock_lesson,
		'clock_start' => $clock_start,
		'clock_end' => $clock_end,
	);
	if (!empty($clock_lesson) &&!empty($clock_lesson) &&!empty($clock_lesson)) {
		$clock = $db->Insert('school_clock',$clock_data);
		$msg = msg('Data Berhasil Di Tambahakan','success');
	}
}

?>
<div class="col-md-6"> 
	<form action="" method="POST" role="form">	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Clock native</h1>
			</div>
			<div class="panel-body">
				<?php if (!empty($msg)) echo $msg; ?>
				<div class="form-group">
					<label for="">Clock lesson</label>
					<input type="text" name="clock_lesson" class="form-control" id="lesson_clock_lesson_modal" placeholder="Input " value="" required>
				</div>
				<div class="form-group">
					<label for="">Clock Start</label>
					<input type="time" name="clock_start" class="form-control" id="lesson_clock_start_modal" placeholder="Input " value="" required>
				</div>
				<div class="form-group">
					<label for="">Clock End</label>
					<input type="time" name="clock_end" class="form-control" id="lesson_clock_end_modal" placeholder="Input " value="" required>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>			
			</div>
		</div>
	</form>
</div>
