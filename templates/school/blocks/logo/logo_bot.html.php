<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
?>
<section class="probootstrap-cta">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="probootstrap-animate" data-animate-effect="fadeInRight"><?php echo $block->title ?></h2>
				<?php 
				
					if (!empty($config['is_link'])) {
			?>
			<a class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft" role="button" href="<?php echo $output['link']; ?>" title="<?php echo $output['title']; ?>" class="navbar-brand" <?php echo $output['attribute']; ?>>
					<?php echo $output['title']; ?>
			</a>
			<?php
			} else {
				echo $output['title'];
			}
		?> 
			</div>
		</div>
	</div>
</section>

<?php 
 $block->title = '';