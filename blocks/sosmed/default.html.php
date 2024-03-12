<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<div class="probootstrap-search" id="probootstrap-search">
	<a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
	<form action="#">
		<input type="search" name="s" id="search" placeholder="<?php echo $config['search'] ?>">
	</form>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
	<ul>
		<?php
			$search = $config;
			unset($config['template'], $config['search']);
			foreach ($config as $key => $value) {
				switch ($key) {
					case 'facebook':
						$key = $key . '2';
						break;
					case 'instagram':
						$key = $key . '2';
						break;
					default:
						$key;
				}
				?> 
				<li><a href="<?php echo $value ?>"><i class="icon-<?php echo $key ?>"></i></a></li>
				<?php		
			}
			$keys = array_keys($search);
			$search = end($keys);
			?>
		<li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i class="icon-<?php echo $search;?>"></i></a></li>
	</ul>
</div>
<?php
$block->title = ' ';