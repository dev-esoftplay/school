<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 
  <div class="col-md-4">
		<div class="probootstrap-footer-widget">
			<h3><?php echo $block->title ?></h3>
			<ul class="probootstrap-contact-info">
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
						<li><i class="icon-<?php echo $key ?>"></i> <span><?php echo $value ?></span></li>
						
						<?php
					}
				?>
			</ul>
		</div>
	</div>
<?php
$block->title = '';