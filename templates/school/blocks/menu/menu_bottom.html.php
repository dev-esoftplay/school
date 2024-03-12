<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

_func('school');
?> 
<div class="col-md-3 col-md-push-1">
	<div class="probootstrap-footer-widget">
		<h3><?php echo $block->title ?></h3>
		<?php echo school_menu_vertical($menus); ?>
	</div>
</div>
<?php 
$block->title = '';