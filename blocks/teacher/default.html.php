<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?> 

      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2><?php echo $block->title ?></h2>
              <!-- <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p> -->
            </div>
          </div>
          <!-- END row -->

          <div class="row">
						<?php 
						
						foreach ($output['data'] as $key => $value) {
							?> 
							<div class="col-md-3 col-sm-6">
								<div class="probootstrap-teacher text-center probootstrap-animate">
									<?php 
										if(!empty($output['config']['avatar']))
										{
											?> 
											<figure class="media">
												<img class="media-object" src="<?php echo $value['image']; ?>" />
											</figure>
											<?php
										}
									?>
									<div class="text">
										<h3><?php echo $value['name'];?></h3>
										<p><?php echo $value['position'];?></p>
										<!-- <ul class="probootstrap-footer-social">
											<li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
											<li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
											<li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
											<li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
										</ul> -->
									</div>
								</div>
							</div>
							<!-- <div class="clearfix"></div> -->
							<?php
						}
						?>
          </div>

        </div>
      </section>
<?php 
$block->title = '';