<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?>

 <div class="col-md-3 col-md-push-1">
	<div class="probootstrap-footer-widget">
		<h3><?php echo $block->title ?></h3>
		<ul>
		<?php 		
		foreach($r AS $dt)
		{
			$title = $config['show'] ? image($Bbc->mod['dir'].$dt['image']) : '';
			if(empty($title)) $title = $dt['title'];
			?>
			<li>
				<a href="<?php echo $dt['link'];?>" title="<?php echo $dt['title'];?>" class="" target="_blank">
					<?php echo $title;?>
				</a>
			</li>
			<?php
		}
		?>
		</ul>
	</div>
</div>