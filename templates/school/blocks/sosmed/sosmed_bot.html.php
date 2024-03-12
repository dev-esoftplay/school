<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 
 <div class="col-md-4">
	<div class="probootstrap-footer-widget">
		<h3><?php echo $block->title ?></h3>
		<p><?php echo $config['caption'] ?></p>
		<h3>Social</h3>
		<ul class="probootstrap-footer-social">
		<?php
			$search = $config;
			unset($config['template'], $config['search'], $config['caption']);
			foreach ($config as $key => $value) {
				?> 
				<li><a href="<?php echo $value ?>"><i class="icon-<?php echo $key ?>"></i></a></li>
				<?php		
			}
			$keys = array_keys($search);
			$search = end($keys);
			?>
		</ul>
	</div>
</div> <?php
$block->title = '';