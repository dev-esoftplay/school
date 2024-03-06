<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<section class="probootstrap-section probootstrap-section-colored probootstrap-bg probootstrap-custom-heading probootstrap-tab-section" style="background-image: url(img/slider_2.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center section-heading probootstrap-animate">
				<h2 class="mb0"><?php echo $block->title ?></h2>
			</div>
		</div>
	</div>
	<div class="probootstrap-tab-style-1">
		<ul class="nav nav-tabs probootstrap-center probootstrap-tabs no-border">
			<!-- <?php
			foreach ($cat_results as $index => $cat) 
			{
				?>
				<li class="<?php echo $index == 0 ? 'active' : '' ?>">
					<a href="#highlights-tab<?php echo $index + 1 ?>" data-toggle="tab">
						<?php echo $cat['title'] ?>
					</a>
				</li>
				<?php
			}
			?> -->
			  <li class="active">
              <a data-toggle="tab" href="#featured-news">Featured News</a>
            </li>
            <li>
              <a data-toggle="tab" href="#upcoming-events">Upcoming Events</a>
            </li>
		</ul>
	</div>
</section>

<section class="probootstrap-section probootstrap-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="tab-content">
				<!-- <?php 
					foreach ($cat_results as $index => $cat) {
						?> 
						<div id="highlights-tab<?php echo $index + 1 ?>" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<div class="owl-carousel" id="owl<?php echo $index + 1 ?>">
										<?php 
											foreach ($cat['list'] as $key => $item) {
											?> 
											<div class="item">
												<a href="#" class="probootstrap-featured-news-box">
													<figure class="probootstrap-media">
														<img src="<?php echo content_src($item['image'],false,false) ?>" alt="Free Bootstrap Template by ProBootstrap.com" class="img-responsive">
													</figure>
													<div class="probootstrap-text">
														<h3><?php echo $item['title'] ?></h3>
														<p></p>
														<span class="probootstrap-date"><i class="icon-calendar"></i><?php echo content_date($item['created']) ?></span>
													</div>
												</a>
											</div>
											<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				?> -->

				<div id="featured-news" class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-12">
							<div class="owl-carousel" id="owl1">
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_3.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur
												adipisicing elit. Minima, ut.
											</p>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_1.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur
												adipisicing elit. Facilis, officia.
											</p>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_2.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur
												adipisicing elit. Sequi, dolores.
											</p>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_3.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur
												adipisicing elit. Iure, earum.
											</p>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
							</div>
						</div>
					</div>
					<!-- END row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<a href="#" class="btn btn-primary">View all news</a>
							</p>
						</div>
					</div>
				</div>
				<div id="upcoming-events" class="tab-pane fade">
					<div class="row">
						<div class="col-md-12">
							<div class="owl-carousel" id="owl2">
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_3.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
											<span class="probootstrap-location"
												><i class="icon-location2"></i>White Palace,
												Brooklyn, NYC</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_1.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
											<span class="probootstrap-location"
												><i class="icon-location2"></i>White Palace,
												Brooklyn, NYC</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_2.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
											<span class="probootstrap-location"
												><i class="icon-location2"></i>White Palace,
												Brooklyn, NYC</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
								<div class="item">
									<a href="#" class="probootstrap-featured-news-box">
										<figure class="probootstrap-media">
											<img
												src="img/img_sm_3.jpg"
												alt="Free Bootstrap Template by ProBootstrap.com"
												class="img-responsive"
											/>
										</figure>
										<div class="probootstrap-text">
											<h3>Tempora consectetur unde nisi</h3>
											<span class="probootstrap-date"
												><i class="icon-calendar"></i>July 9, 2017</span
											>
											<span class="probootstrap-location"
												><i class="icon-location2"></i>White Palace,
												Brooklyn, NYC</span
											>
										</div>
									</a>
								</div>
								<!-- END item -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<a href="#" class="btn btn-primary">View all events</a>
							</p>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</section>
