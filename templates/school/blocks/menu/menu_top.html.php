<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
_func('school');
?> 
<div class="col-lg-9 col-md-9 col-sm-9">
	<div class="collapse navbar-collapse" id="navbar-collapse">
		<?php 
		$r = explode(' ', $config['submenu']);
		$y = @$r[0]=='top' ? 'top' : '';
		$x = @$r[1]=='left' ? 'left' : '';
		echo school_menu_top($menus, $y, $x);
		?>
	</div>
</div>
<?php 
$block->title = '';
