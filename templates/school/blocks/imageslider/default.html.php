<?php if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');
?> 
<section class="flexslider">
	<ul class="slides">
<?php
$count = count($output['images']);
if ($count > 0)
{
  foreach ($output['images'] as $key => $dt)
	{
		$cls = $key ? '' : ' active';
		?> 
		<li style="background-image: url(<?php echo $dt['image']; ?>)" class="overlay">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="probootstrap-slider-text text-center">
							<h1 class="probootstrap-heading probootstrap-animate"><?php echo $dt['title']; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</li>
		<?php
	}
}
?> 
	</ul>
</section>
<?php 
$block->title = '';