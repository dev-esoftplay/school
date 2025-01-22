<!DOCTYPE html>
<html lang="en">
<head><?php echo $sys->meta(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo _URL ?>templates/eraport-sdit/css/blank.css"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php echo trim($Bbc->content); ?>
<script type="text/javascript"> if (_URL.indexOf(window.location.protocol) == -1)
        window.location.href = window.location.href.replace(window.location.protocol, (window.location.protocol == 'https:') ? 'http:' : 'https:');</script>
<script src="<?php echo _URL; ?>templates/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>