<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
function api_phone_replace($phone) {
    // Cek apakah nomor telepon diawali dengan "08"
    if (substr($phone, 0, 2) === '08') {
        // Jika ya, ganti dengan "628" dan sisa nomor setelah awalan
        return '628' . substr($phone, 2);
    } else {
        // Jika tidak, kembalikan nomor telepon tanpa perubahan
        return $phone;
    }
}