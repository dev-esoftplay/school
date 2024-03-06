<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?> 
<style>
.probootstrap-navbar .navbar-brand {
	padding-top: 0 !important;
	padding-bottom: 0 !important;
	font-size: 30px;
	text-transform: uppercase;
	background: url(<?php echo _URL .$output['image'] ?>) no-repeat left 100% !important;
	top: 24px;
	position: relative;
	width: <?php echo $output['size'][0] ?>px;
	height: <?php echo $output['size'][1] ?>px;
	text-indent: -999999px;
	-webkit-transition: .2s all;
	transition: .2s all;
}
</style>
<div class="col-lg- col-md- col-sm-">
	<div class="navbar-header">
		<div class="btn-more js-btn-more visible-xs">
			<a href="#"><i class="icon-dots-three-vertical "></i></a>
		</div>
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php
		if (!empty($config['is_link'])) {
			?>
			<a href="<?php echo $output['link']; ?>" title="<?php echo $output['title']; ?>" class="navbar-brand" <?php echo $output['attribute']; ?>>
				<!-- <?php echo image($output['image'], $output['size'], 'alt="' . $output['title'] . '" title="' . $output['title'] . '" class="navbar-brand"'); ?> -->
			</a>
			<?php
			} else {
				echo image($output['image'], $output['size'], 'alt="' . $output['title'] . '" title="' . $output['title'] . '"' . $output['attribute']. ' class="navbar-brand"');
			}
		?> 
	</div>
</div>
<?php 
$block->title = '';