<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('blank');

if (empty($user->id)) {
    redirect(_URL);
}
?>

<main>
    <div class="error_container">
        <h2 class="text-center">Akses Ditolak</h2>
        <h4>
            <small>
                Anda tidak memiliki izin untuk mengakses halaman ini.
                <a href="<?php echo _URL ?>error/logout">Kembali ke Halaman Login</a>
            </small>
        </h4>
    </div>
</main>
