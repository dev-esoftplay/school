<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
?>
<section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
				<h2><?php echo $block->title ?></h2>
				<!-- <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p> -->
			</div>
		</div>
		<!-- END row -->
		<?php 
		if (!empty($cat['list']) && is_array($cat['list'])) {
			$pieces = array_chunk($cat['list'], ceil(count($cat['list']) / 2));
			?> 
			<div class="row">
				<?php 
				foreach ($pieces as $chunk) {
				?> 
				<div class="col-md-6">
					<?php 
					foreach ($chunk as $data) {
						$edit_data = (content_posted_permission() && $user->id == $data['created_by']) ? 1 : 0;
						$link = content_link($data['id'], $data['title']);
						?> 
						<div class="probootstrap-service-2 probootstrap-animate">
							<div class="image">
								<div class="image-bg">
									<?php 
									$image = (!empty($config['thumbnail']) && !empty($data['image'])) ? '<img src="' . content_src($data['image'], false, false) . '" alt="Sample Article">' : '';
									$imagelink = (!empty($config['title_link']) ? "<a href=\"$link\">$image</a>" : "$image");
									echo (!empty($image)) ? $imagelink :  '';
									?>
								</div>
							</div>
							<div class="text">
									<?php
									if (!empty($config['created']) || !empty($config['tag'])) {
											$m = (empty($config['created'])) ? 0 : '';
											$r = content_category($data['id'], $config['tag_link']);
											echo (!empty($config['tag'])) ? '<span class="probootstrap-meta">' . implode('', $r) . '</span><br>' : '';
											?>
											<div class="clearfix"></div>
											<?php
									}
									if (!empty($config['title'])) {
										if (!empty($config['title_link'])) {
											?>
											<h3><a href="<?php echo $link; ?>" title="<?php echo $data['title']; ?>"><?php echo $data['title']; ?></a></h3>
										<?php
										} else {
											?>
											<h3><?php echo $data['title']; ?></h3>
											<?php
										}
									}
									if (!empty($config['created'])) {
										echo (!empty($config['created'])) ? '<span class="probootstrap-meta"><i class="icon-calendar2"></i> '.content_date($data['created']).'</span>' : '';
									}
									if ( !empty($config['author']) ) {
										echo ($config['author']) ? '<div class="time"><span class="text-muted"><i class="icon-person"></i> ' .$data['created_by_alias'] . '</span></div>' : '';
									}
									?>
									<p>
										<?php echo @$data[$config['intro']]; ?>
										<?php echo (!empty($config['read_more'])) ? '<a href="' . $link . '" class="readmore">' . lang('Read more') . '</a>' : ''; ?>
									</p>
									<?php
										if (!empty($config['rating'])) {
											echo rating($data['rating']). '<br>';
										}
									if (empty($data['revised'])) {
										$config['modified'] = 0;
									}
									if (!empty($config['modified']) || !empty($edit_data)) {
										if (!empty($edit_data)) {
									?>
											<div class="">
												<?php echo ($config['modified']) ? '<span class="text-muted"><i class="icon-pencil"></i> '. content_date($data['modified']) . '</span>' : ''; ?>
												<a href="<?php echo $Bbc->mod['circuit'] . '.posted_form&id=' . $data['id']; ?>" title="<?php echo lang('edit content'); ?>"><?php echo icon('edit'); ?></a>
											</div>
										<?php
										} else {
											echo ($config['modified']) ? '<div class="time"><span class="text-muted"><i class="icon-pencil"></i> '. content_date($data['modified']) . '</span></div>' : '';
										?>
											<div class="clearfix"></div>
										<?php
										}
									}
									if (!empty($config['title_link'])) {
									?>
									<p>
										<a class="btn btn-primary more " href="<?php echo $link ?>">
											<?php echo lang('Enroll now') ?>
										</a>
										<span class="enrolled-count"><?php echo $data['hits'] . lang(' students enrolled')?></span>
									</p>
									<?php
									}
									?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>
<?php 
$block->title = '';