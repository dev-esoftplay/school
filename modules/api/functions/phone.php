<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_phone_replace($phone)
{
  // Hapus semua karakter kecuali angka
  $phone = preg_replace('/[^0-9]/', '', $phone);

  // Jika nomor dimulai dengan "08", gantilah dengan "628"
  if (substr($phone, 0, 2) === '08') {
    $phone = '628' . substr($phone, 2);
  }

  return $phone;
}