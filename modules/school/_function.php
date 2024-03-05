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

function school_schedule_days_numeric($namaHari) {
    $namaHari = strtolower($namaHari); // Pastikan nama hari dalam huruf kecil untuk kejelasan.
    $hariNumerik = [
        'senin' => 1,
        'selasa' => 2,
        'rabu' => 3,
        'kamis' => 4,
        'jumat' => 5,
        'sabtu' => 6,
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
