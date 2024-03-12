<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
		<?php echo $sys->meta(); ?>
	</head>
  <body>
    
    <div class="probootstrap-page-wrapper">
      <!-- Fixed navbar -->
			<div class="probootstrap-header-top">
				<div class="container">
					<div class="row">
						<?php echo $sys->block_show('intro'); ?>
					</div>
				</div>
			</div>

			<nav class="navbar navbar-default probootstrap-navbar">
				<div class="container">
					<?php echo $sys->block_show('header'); ?>
				</div>
			</nav>
      <?php echo $sys->block_show('content_top'); ?>
			<?php echo trim($Bbc->content); ?>
      <?php echo $sys->block_show('content_bottom'); ?>
      <footer class="probootstrap-footer probootstrap-bg">
				<div class="container">
					<div class="row">
						<?php echo $sys->block_show('footer'); ?>
					</div>
				</div>
        <div class="probootstrap-copyright">
          <div class="container">
            <div class="row">
							<div class="col-md-8 text-left">
								<?php echo config('site', 'footer'); ?>
              </div>
              <div class="col-md-4 probootstrap-back-to-top">
								<p><a href="#" class="js-backtotop">Back to top <i class="icon-arrow-long-up"></i></a></p>
							</div>
            </div>
          </div>
        </div>
      </footer>

    </div>
		<script src="<?php echo _URL; ?>templates/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- END wrapper -->
		<?php 
			$sys->link_js($sys->template_url . 'js/scripts.min.js', false);
			$sys->link_js($sys->template_url . 'js/main.min.js', false);
			// $sys->link_js($sys->template_url . 'js/main.js', false);
		?>

  </body>
</html>