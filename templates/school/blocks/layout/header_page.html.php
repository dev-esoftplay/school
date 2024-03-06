<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
?>
<section class="probootstrap-section probootstrap-section-colored">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-left section-heading probootstrap-animate">
				<h2><?php echo $block->title ? lang($block->title) : lang($config['caption']) ?></h2>
			</div>
		</div>
	</div>
</section>
<?php 
$block->title = '';