<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

/* START DELETE TEMP FOLDER */
_func('path');
$path_old      = date('Y/m/d/', strtotime("-2 days"));
$path_old_list = path_list_r(_ROOT.'images/uploads/temp/');

if (!empty($path_old_list) AND is_array($path_old_list)) {
	foreach ($path_old_list as $year => $years)
	{
		foreach ($years as $month => $months)
		{
			foreach ($months as $date => $dates)
			{
				$path_delete = $year.'/'.$month.'/'.$date.'/';
				if ($path_old >= $path_delete)
				{
					path_delete(_ROOT.'images/uploads/temp/'.$path_delete);
				}
			}
			if (date('Y/m/') > $year.'/'.$month.'/')
			{
				path_delete(_ROOT.'images/uploads/temp/'.$year.'/'.$month);
			}
		}
		if (date('Y/') > $year.'/')
		{
			path_delete(_ROOT.'images/uploads/temp/'.$year);
		}
	}
}
/* END DELETE TEMP FOLDER */

$imagef = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
if (empty($_FILES['image'])) {
	return api_no(lang('Silahkan upload image dengan extensi %s', implode(', ', array_map(function( $row ){ return '.'.$row; }, $imagef))));
}

$imagetype = array('image/jpeg', 'image/bmp', 'image/png', 'image/gif');
if (!in_array($_FILES['image']['type'], $imagetype)) {
	return api_no(lang('Silahkan upload image dengan extensi %s', implode(', ', array_map(function( $row ){ return '.'.$row; }, $imagef))));
}

$img  = _class('images');
$date = date('Y/m/d/H/');
$img->setPath(_ROOT . 'images/uploads/temp/'.$date);
$name = $img->upload($_FILES['image']);

if (empty($name)) {
	return api_no(lang('Terjadi kesalahan saat upload gambar. Mohon coba kembali beberapa saat lagi.'));
}

$image = _URL.'images/uploads/temp/'.$date.$name;
api_ok($image);
