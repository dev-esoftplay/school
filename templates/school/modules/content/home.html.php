<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed'); 

$config = $output['config'];
$arr		= $output['data'];
?>
<section class="probootstrap-section probootstrap-section-colored">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-left section-heading probootstrap-animate">
				<h2><?php echo lang('Welcome to School of Excellence')?></h2>
			</div>
		</div>
	</div>
</section>
<section class="probootstrap-section">
	<?php 
	foreach ((array)$arr as $key => $data) 
	{
		$link = content_link($data['id'], $data['title']);
	?> 
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="probootstrap-flex-block">
					<div class="probootstrap-text probootstrap-animate">
						<?php 
							if ($config['tag'])
							{
								$r = content_category($data['id'], $config['tag_link']);
								echo '<div>'.implode(' ', $r).'</div>';
							}
							if ($config['title']) {
								echo ($config['title_link']) ? '<h3><a href="' . $link . '" title="' . $data['title'] . '">' . $data['title'] . '</a></h3>' : '<h3>' . $data['title'] . '</h3>';
							}
							if ($config['created']){
								echo ($config['created']) ? '<div class=" "><span><i class="icon-calendar2"></i>'.content_date($data['created']).'</span></div>' : '';
							} 
							if ($config['author'] )
							{
								?>
								<hr />
									<?php echo ($config['author']) ? '<div class=""><span>'.$data['created_by_alias'].'</span></div>' : '';?>
									<div class="clearfix"></div>
								<br>
								<?php
							}
						?>
						<p>
							<?php echo $data['content']; ?>
							<?php echo ($config['read_more']) ? '<a href="' . $link . '" class="readmore">' . lang('Read more') . '</a>' : ''; ?>
						</p>
						<?php 
							if(	$config['rating'] || $config['modified'] )
							{
								?>
									<?php
									if ($config['rating'])
									{
											echo rating($data['rating']);
									}
									if(empty($data['revised']))
									{
										$config['modified'] = 0;
									}
									if (!empty($config['modified']))
									{
										echo ($data['modified'])  ? '<div class=" "><span><i class="icon-calendar2"></i>'.content_date($data['modified']) . '</span></div>': '';
									}
									?>
								<br>
								<?php
							}
							echo (!empty($config['title_link'])) ? '<p><a href="' . $link . '" class="btn btn-primary">' . lang('Read more') . '</a></p>' : '';
						?>
					</div>
					<div class="probootstrap-image probootstrap-animate" style="background-image: url(img/slider_3.jpg)">
						<?php echo (!empty($config['thumbnail']) && !empty($data['image'])) ? content_src($data['image'], ' class="btn-video popup-vimeo" title="' . $data['title'] . '"') : ''; ?>
						<!-- <a href="https://youtu.be/gX9m-rCtSqc?si=97_bEn9R-ox-AcyT" class="btn-video popup-vimeo"><i class="icon-play3"></i></a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	} 
	?>
</section>