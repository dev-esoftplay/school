<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('blank');
?>

<main>
    <div class="error_container">
        <h2 class="text-center">Maaf, halaman ini tidak tersedia.</h2>
        <h4>
            <small>Link yang anda tuju mungkin rusak atau halaman mungkin sudah dihapus.
                <a href="<?php echo _URL ?>">
                    Kembali ke Halaman Dashboard
                </a>
            </small>
        </h4>
    </div>
</main>
