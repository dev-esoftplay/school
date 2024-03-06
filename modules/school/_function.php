<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

//penulisan nama function school_{nama task kamu}_{nama yang fungsi}
function school_schedule_day($day_id='none')
{
	$r = array(
		1 => 'Senin',
		2 => 'Selasa',
		3 => 'Rabu',
		4 => 'Kamis',
		5 => 'Jumat',
		6 => 'Sabtu',
		7 => 'Ahad',
		);
	if (is_numeric($day_id))
	{
		return !empty($r[$day_id]) ? $r[$day_id] : $r[1];
	}else{
		return $r;
	}
}

function school_schedule_day_num($namaHari) {
  $namaHari = strtolower($namaHari); // Pastikan nama hari dalam huruf kecil untuk kejelasan.
  $hariNumerik = [
    'senin'  => 1,
    'selasa' => 2,
    'rabu'   => 3,
    'kamis'  => 4,
    'jumat'  => 5,
    'sabtu'  => 6,
    'minggu' => 7,
  ];

  return $hariNumerik[$namaHari] ?? null; // Mengembalikan nilai numerik atau null jika tidak ditemukan.
}

function school_phone_replace($phone) 
{
	// Hapus semua karakter kecuali angka
	$phone = preg_replace('/[^0-9]/', '', $phone);

	// Jika nomor dimulai dengan "08", gantilah dengan "628"
	if (substr($phone, 0, 2) === '08') {
		$phone = '628' . substr($phone, 2);
	}

	return $phone;
}

function school_menu_top($menus, $y = '', $x = '', $level = -1) 
{
	$output = '';
	if (!empty($menus))
	{
		$highlight = menu_parent_ids(@$_GET['menu_id'], $menus);
		if ($level == -1)
		{
			$output = call_user_func(__FUNCTION__, menu_parse($menus), $y,$x,++$level);
		}else
		if (empty($level))
		{
			$cls = !empty($y) ? ' nav-'.$y : '';
			$cls.= !empty($x) ? ' nav-'.$x : '';
			$out = '';
			foreach ($menus as $menu)
			{
				$sub = call_user_func(__FUNCTION__, $menu['child'], $y,$x,++$level);
				if (!empty($sub))
				{
					$act = in_array($menu['id'], $highlight) ? ' active' : '';
					$out .= '<li class="dropdown'.$act.'"><a role="button" data-toggle="dropdown" tabindex="-1" href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a>'.$sub.'</li>';
				}else{
					$act = in_array($menu['id'], $highlight) ? ' class="active"' : '';
					$out.= '<li'.$act.'><a href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a></li>';
				}
			}
			$output = '<ul class="nav navbar-nav navbar-right'.$cls.'">'.$out.'</ul>';
		}else {
			$out = '';
			foreach ($menus as $menu)
			{
				$sub = call_user_func(__FUNCTION__, $menu['child'], $y,$x,++$level);
				if (!empty($sub))
				{
					$act = in_array($menu['id'], $highlight) ? ' active' : '';
					$out .= '<li class="dropdown-submenu'.$act.'"><a tabindex="-1" href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a>'.$sub.'</li>';
				}else{
					$act = in_array($menu['id'], $highlight) ? ' class="active"' : '';
					$out.= '<li'.$act.'><a href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a></li>';
				}
			}
			$output = '<ul class="dropdown-menu" role="menu">'.$out.'</ul>';
		}
	}
	return $output;
}

function school_menu_vertical($menus, $level = -1, $id='')
{
	$output = '';
	if (!empty($menus))
	{
		$highlight = menu_parent_ids(@$_GET['menu_id'], $menus);
		if ($level == -1)
		{
			$output = call_user_func(__FUNCTION__, menu_parse($menus), ++$level);
		}else
		if (empty($level))
		{
			global $Bbc;
			if (empty($Bbc))
			{
				$Bbc = new stdClass;
			}
			if (empty($Bbc->menu_vertical))
			{
				$Bbc->menu_vertical = 1;
			}else{
				$Bbc->menu_vertical++;
			}
			$id = 'menu_v'.$Bbc->menu_vertical;
			$out = '';
			foreach ($menus as $menu)
			{
				$sub = call_user_func(__FUNCTION__, $menu['child'], ++$level, $id);
				$act = in_array($menu['id'], $highlight) ? ' active' : '';
				$alt = trim(strip_tags($menu['title']));
				if (!empty($sub))
				{
					$out .= '<li><a href="#'.$id.$level.'" class="'.$act.'" data-toggle="collapse" data-parent="#'.$id.'" title="'.$alt.'">'.$menu['title'].' <span class="caret down"></span></a></li>';
					$out .= $sub;
				}else{
					$out .= '<li><a href="'.$menu['link'].'" class="'.$act.'" data-parent="#'.$id.'" title="'.$alt.'">'.$menu['title'].'</a></li>';
				}
			}
			$output = '<ul id="'.$id.'">'.$out.'</ul>';
		}else {
			$id .= $level;
			$out = '';
			$in  = '';
			foreach ($menus as $menu)
			{
				$sub = call_user_func(__FUNCTION__, $menu['child'], ++$level, $id);
				$act = in_array($menu['id'], $highlight) ? ' active' : '';
				$alt = trim(strip_tags($menu['title']));
				if ($act)
				{
					$in = ' in';
				}
				if (!empty($sub))
				{
					$out .= '<li><a href="#'.$id.$level.'" class="'.$act.'" data-toggle="collapse" data-parent="#'.$id.'" title="'.$alt.'">'.$menu['title'].' <span class="caret down"></span></a></li>';
					$out .= $sub;
				}else{
					$out .= '<li><a href="'.$menu['link'].'" class="'.$act.'" data-parent="#'.$id.'" title="'.$alt.'">'.$menu['title'].'</a></li>';
				}
			}
			$output = '<ul id="'.$id.'" class="collapse'.$in.' list-group-submenu">'.$out.'</ul>';
		}
	}
	return $output;
}