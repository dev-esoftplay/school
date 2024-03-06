<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 

			<section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial" style="background-image: url(img/slider_4.jpg);">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2><?php echo $block->title ?></h2>
              <!-- <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p> -->
            </div>
          </div>
          <!-- END row -->
          <div class="row">
            <div class="col-md-12 probootstrap-animate">
              <div class="owl-carousel owl-carousel-testimony owl-carousel-fullwidth">
								<?php 
								foreach ($output['data'] as $data )
								{
									?> 
									<div class="item">
	
										<div class="probootstrap-testimony-wrap text-center">
											<figure>
											<?php 
											if(!empty($output['config']['avatar']) && preg_match('~ src="(.*?)"~', $sys->avatar($data['email']), $match))
											{
												?>
													<img class="" src="<?php echo $match[1]; ?>" />
												<?php
											}
											?>		
											</figure>
											<blockquote class="quote"><?php echo $data['message'];?><cite class="author"> — <span><?php echo $data['name'];?></span></cite></blockquote>
										</div>
	
									</div>
									<?php
								}
								?>
              </div>
            </div>
          </div>
          <!-- END row -->
        </div>
      </section>
<?php 
$block->title = '';