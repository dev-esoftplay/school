<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_attendance_report');
$form->initSearch();

$form->search->addInput('teacher_id','selecttable');
$form->search->input->teacher_id->setTitle('Search by teacher');
$form->search->input->teacher_id->addOption('Select teacher', '');
$form->search->input->teacher_id->setReferenceTable('school_teacher');
$form->search->input->teacher_id->setReferenceField('name', 'id');

$form->search->addInput('course_id','selecttable');
$form->search->input->course_id->setTitle('Search by course');
$form->search->input->course_id->addOption('Select course', '');
$form->search->input->course_id->setReferenceTable('school_course');
$form->search->input->course_id->setReferenceField('name', 'id');

$form->search->addInput('class_id','selecttable');
$form->search->input->class_id->setTitle('Search by Class');
$form->search->input->class_id->addOption('Select Class', '');
$form->search->input->class_id->setReferenceTable('school_class');
$form->search->input->class_id->setReferenceField('CONCAT_WS(" ",grade,major,label)', 'id');

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('total_present,total_s,total_i,total_a,date_day,date_week,date_month,date_year');

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );

$form->roll->setSaveTool(true);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput('teacher_id', 'selecttable');
$form->roll->input->teacher_id->setTitle('teacher');
$form->roll->input->teacher_id->setFieldName( 'teacher_id' );
$form->roll->input->teacher_id->setReferenceTable('school_teacher');
$form->roll->input->teacher_id->setReferenceField('name','id');
$form->roll->input->teacher_id->setPlaintext(true);
$form->roll->input->teacher_id->setDisplayColumn(true);
$form->roll->input->teacher_id->textTip='';

$form->roll->addInput('course_id', 'selecttable');
$form->roll->input->course_id->setTitle('course');
$form->roll->input->course_id->setFieldName( 'course_id' );
$form->roll->input->course_id->setReferenceTable('school_course');
$form->roll->input->course_id->setReferenceField('name','id');
$form->roll->input->course_id->setPlaintext(true);
$form->roll->input->course_id->setDisplayColumn(true);
$form->roll->input->course_id->textTip='';

$form->roll->addInput('class_id', 'selecttable');
$form->roll->input->class_id->setTitle('class');
$form->roll->input->class_id->setFieldName( 'class_id' );
$form->roll->input->class_id->setReferenceTable('school_class');
$form->roll->input->class_id->setReferenceField('CONCAT_WS(" ",grade,major,label)','id');
$form->roll->input->class_id->setPlaintext(true);
$form->roll->input->class_id->setDisplayColumn(true);
$form->roll->input->class_id->textTip='';

$form->roll->addInput('status', 'sqlplaintext');
$form->roll->input->status->setTitle('Status');
$form->roll->input->status->setDisplayColumn(true);

$form->roll->addInput('total_present', 'sqlplaintext');
$form->roll->input->total_present->setTitle('Total Present');
$form->roll->input->total_present->setDisplayColumn(true);

$form->roll->addInput('total_s', 'sqlplaintext');
$form->roll->input->total_s->setTitle('Total Sick');
$form->roll->input->total_s->setDisplayColumn(true);

$form->roll->addInput('total_i', 'sqlplaintext');
$form->roll->input->total_i->setTitle('Total Permission');
$form->roll->input->total_i->setDisplayColumn(true);

$form->roll->addInput('total_a', 'sqlplaintext');
$form->roll->input->total_a->setTitle('Total Alpha');
$form->roll->input->total_a->setDisplayColumn(true);

$form->roll->addInput('date_day', 'sqlplaintext');
$form->roll->input->date_day->setTitle('Day');
$form->roll->input->date_day->setDisplayColumn(false);

$form->roll->addInput('date_week', 'sqlplaintext');
$form->roll->input->date_week->setTitle('Week');
$form->roll->input->date_week->setDisplayColumn(false);

$form->roll->addInput('date_month', 'sqlplaintext');
$form->roll->input->date_month->setTitle('Month');
$form->roll->input->date_month->setDisplayColumn(false);

$form->roll->addInput('date_year', 'sqlplaintext');
$form->roll->input->date_year->setTitle('Year');
$form->roll->input->date_year->setDisplayColumn(false);

$form->roll->addReport('excel');

$form->roll->action();
echo $form->roll->getForm();

if (!empty($_POST['semester']))
{
	if ($_POST['semester'] == 'download')
	{                
		$q_attend = 'SELECT `id` as `no`, 
					`teacher_id` as `teacher_name`,
					`course_id` as `course_name`,
					`class_id` as `class_name`,
					`total_present`, `total_s`, `total_i`, `total_a` 
					FROM `school_attendance_report`
					WHERE 1
					ORDER BY `id` ASC';
		$attend = $db->getAll($q_attend);
		$q_class = 'SELECT `id` as `no`, 
					CONCAT_WS(" ",grade,label,major) AS `class_name`, `teacher_id`, COUNT(id) as total_student 
					FROM `school_class`
					WHERE 1
					ORDER BY `id` ASC';
		$class = $db->getAll($q_class);

		if (!empty($attend))
		{
			foreach ($attend as $k => &$val) {
				$val['no']    = $k+1;
				$val['guru']  = (!empty($val['teacher_name'])) ? $db->getone('SELECT `name` FROM `school_teacher` WHERE `id`=' . $val['teacher_name']) : '';
				$val['mapel'] = (!empty($val['course_name'])) ?$db->getOne('SELECT `name` FROM `school_course` WHERE `id`=' . $val['course_name']) : '';
				$val['kelas'] = (!empty($val['class_name'])) ?$db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $val['class_name']) : '';
				$val['hadir'] = $val['total_present'];
				$val['sakit'] = $val['total_s'];
				$val['ijin']  = $val['total_i'];
				$val['alpha'] = $val['total_a'];
        unset($val['teacher_name'],$val['course_name'],$val['class_name'],$val['total_present'], $val['total_s'], $val['total_i'], $val['total_a']);
			}
			_func('download');
			$data = array($attend,$class);
			download_excel('semester '.date('Y-m-d').' '.rand(0, 999), $data);
		}else{
			echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
		}
		
		// if (!empty($class))
		// {
		// 	foreach ($class as $k => &$val) {
		// 		$val['no']    = $k+1;
		// 		$val['kelas'] = (!empty($val['class_name'])) ? $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $val['class_name']) : '';
		// 		$val['guru']  = (!empty($val['teacher_id'])) ? $db->getone('SELECT `name` FROM `school_teacher` WHERE `id`=' . $val['teacher_id']) : '';
		// 		$val['total'] = $val['total_student'];
    //     unset($val['teacher_id'],$val['class_name'],$val['total_student']);
		// 	}
		// 	_func('download');
		// 	download_excel('class '.date('Y-m-d').' '.rand(0, 999), $class);
		// }else{
		// 	echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
		// }
	}
}

?> 

<!-- <div class="col-md-6">
	<form action="" method="POST" class="form" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Semester Baru</h3>
			</div>
			<div class="panel-body">
				<div class="help-block">
					Unduh Data Semester
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" name="semester" value="download" class="btn btn-default"><?php echo icon('fa-file-excel-o') ?> Backup Data</button>
			</div>
		</div>
	</form>
</div> -->