<!DOCTYPE html>
<html lang="en">
	<head><?php echo $sys->meta();?>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php echo trim($Bbc->content);?>
		<script src="<?php echo _URL;?>templates/admin/bootstrap/js/bootstrap.min.js"></script>
		<?php
		echo $sys->block_show('debug');
		?>
	</body>
</html>
