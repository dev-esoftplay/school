<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

if (!empty($user->id)) {
    if ($user->group_id == 5) {
        redirect(_URL . 'teacher');
    } else if ($user->group_id == 7) {
        redirect(_URL . 'student');
    }
}
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php echo $sys->meta(); ?>
    <link rel="stylesheet" href="<?php echo _URL ?>templates/eraport-sdit/css/style.css" />
</head>

<body>
    <div>
        <div class="container-fluid main_container">
            <div class="content">
                <div class="content_main">
                    <?php echo trim($Bbc->content); ?>
                </div>
            </div>
        </div>

        <?php echo $sys->block_show('bottom'); ?>
        <div class="clearfix"></div>
        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>
    </div>


    <script src="<?php echo _URL; ?>templates/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>