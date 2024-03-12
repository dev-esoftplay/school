<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
	<?php 
	unset($config['template']);
		foreach ($config as $key => $value) {
			switch ($key) {
				case 'location':
					$key = $key . '2';
					break;
				case 'phone':
					$key = $key . '2';
					break;
				default:
					$key;
			}
			?> 
			<span><i class="icon-<?php echo $key ?>"></i><?php echo $value ?></span>
			
			<?php
		}
		?>
</div>
<?php
$block->title = ' ';