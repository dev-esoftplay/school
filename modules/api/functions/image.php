<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

/**
 * save image
 * */
function api_image_save($image='', $img_path='', $insert_id=0, $table='', $field='image', $ref='', $thumb='', $thumb_size=0)
{
	global $db;
	$tmp_path  = 'images/uploads/';
	$sql_where = !empty($ref) ? $ref.'='.$insert_id : '`id`='.$insert_id;
	$img_old   = $db->getOne("SELECT $field FROM $table WHERE $sql_where");
	// HAPUS FILE YANG TIDAK DIPOST
	if (!empty($img_old))
	{
		if (_URL.$img_path.$img_old != $image)
		{
			$move_img[] = _ROOT.$img_path.$img_old;
			if (!empty($thumb)) {
				$move_img[] = _ROOT.$img_path.$thumb.'_'.$img_old;
			}
		}else{
			$old_images = $img_old;
		}
	}

	// INSERT BARU
	$images_dir = preg_replace('~^'.preg_quote(_URL, '~').'~s', _ROOT, $image);
	if (preg_match('~^(.*?)([^/]+)$~is', $images_dir, $match))
	{
		$images = $match[2];
		if (preg_match('~'.$tmp_path.'~', $images_dir))
		{
			$move_img[] = array($images_dir, _ROOT.$img_path.$images);
		}else{
			$images = @$old_images;
		}
	}

	if (!empty($images))
	{
		$q = $db->Update($table, array($field => $images), $sql_where);
		if (!empty($q))
		{
			if (!empty($move_img))
			{
				_func('path', 'create', _ROOT.$img_path);
				foreach ($move_img as $img)
				{
					if (is_array($img))
					{
						_class('images')->rename($img[0], $img[1]);

						if (!empty($thumb))
						{
							if (preg_match('~^(.*?)([^/]+)$~is', $img[1], $match))
							{
								$images = $match[2];
								api_image_resize($img_path, $images, $thumb.'_'.$images, $thumb_size);
							}
						}
					}else{
						_class('images')->delete($img);
					}
				}
			}
			return true;
		}else{
			return false;
		}
	}
}


/**
 * resize image
 * */
function api_image_resize($image_path='', $image_src='', $image_des='', $resize='150')
{
	if (!preg_match('~^'._ROOT.'~is', $image_path)) $image_path = _ROOT.$image_path;
	$img = _class('images');
  $img->setpath($image_path);
  $images = $img->copying($image_path, $image_des, $image_src);
  if ($images)
  {
	  $img->setimages($images);
	  $img->resize($resize);
  }

  return $images;
}


/**
 * konversi data image agar bisa dibuka lewat url
 * @return url image
 * */
function api_image_url($image='', $id=0, $modules='', $is_thumb=0)
{
	if (empty($image)) {
		return '';
	}

	$img = '';
	$p   = !empty($id) ? 'images/modules/'.$modules.'/'.intval($id).'/' : 'images/modules/'.$modules.'/';
	if (!empty($is_thumb)) {
  	$image = $is_thumb.'_'.$image;
	}

	$p .= $image;
	return _URL.$p;
}

