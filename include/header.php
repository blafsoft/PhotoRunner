<?php
	$conditions = array();
	$home = $common->getrecord('pr_home','*',$conditions);	
?>
<div class="header">
	<div class="header_toping">
		<div class="container">
			<div class="col-md-6">
				<a href="skype:<?php echo html_entity_decode($home->number); ?>?chat" style="color:#333;">
				<i class="fa fa-skype"></i> 
				<?php echo html_entity_decode($home->number); ?> 
				</a>

				<span class="evlop"><i class="fa  fa-envelope"></i>
				<?php echo html_entity_decode($home->email); ?><span>
			</div>
			<?php $cart = !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
			<div class="col-md-6" class="mediaa_soc" style="padding-right:0px">
				<ul class="media_socila">
					<?php if(!empty($_SESSION['guast']['email'])) { ?>
					<li style="font-weight:bold;font-size: 15px;font-weight: bold;"><a href="<?php echo APP_URL; ?>success.php" style="color:#333;text-decoration:none;">My Purchase List</a></li>

					<li style=""><a href="<?php echo APP_URL; ?>guast-payment.php" style="color:#333;text-decoration:none;font-weight:bold;font-size: 16px;font-weight: bold; background-color:#4bc1f0; padding-left:20px; padding-right:20px; padding-top:8px; padding-bottom:8px; margin-right:10px; border-radius:3px;"><img src="<?php echo APP_URL; ?>images/2772.png" style="max-width:20px"><img src="images/2772.png" style="max-width:100%"> ( <?php echo $cart;?> )</a></li>
					<?php }else{ ?>
					<li style=""><a href="<?php echo APP_URL; ?>payment.php" style="color:#333;text-decoration:none;font-weight:bold;font-size: 16px;font-weight: bold; background-color:#4bc1f0; padding-left:20px; padding-right:20px; padding-top:8px; padding-bottom:8px; margin-right:10px; border-radius:3px;"><img src="<?php echo APP_URL; ?>images/2772.png" style="max-width:20px"> ( <?php echo $cart;?> )</a></li>
					<?php } ?>
				<?php				
				$conditions =array('status'=>'1');						
				$social = $common->getrecords('pr_social','*',$conditions);
				if(!empty($social))
				{
					$startpoint = empty($startpoint) ? 0 : $startpoint;
					$k=$startpoint+1;
					foreach($social as $social)
					{
					?>
				<li><a href="<?php echo $social->url ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $social->name ?>"><i class="fa fa-<?php echo $social->icon ?>"></i></a></li>
					<?php
					}
				}
				?>
				</ul>
			</div>
		</div>
	</div>
	<div style="clear:both"></div>
	<div class="container">
		<div class="header-nav">
			<nav class="navbar navbar-default"  id="">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div style="padding-top:8px;"><img src="<?php echo APP_URL; ?>uploads/<?php echo $home->image1; ?>" style="max-width:100%"></div>
<div class="width_logo_bottom"><?php echo substr("$home->logotext",0,100); ?></div>
				</div>
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav" style="padding-top:8px;">
						<li style="text-align:center; color:#000;"><a class="hvr-overline-from-center button2 active" href="<?php echo APP_URL; ?>index.php" style="color:#000;">Home</a></li>
						<li style="text-align:center; color:#000;"><a class="hvr-overline-from-center button2"style="color:#000;" href="<?php echo APP_URL; ?>photos.php">Photos</a></li>
						<li style="text-align:center; color:#000;"><a class="hvr-overline-from-center button2"style="color:#000;" href="<?php echo APP_URL; ?>galleries.php">Galleries</a></li>
						<li style="text-align:center; color:#000;"><a class="hvr-overline-from-center button2"style="color:#000;" href="<?php echo APP_URL; ?>about-us.php">About Us</a></li>
						<li style="text-align:center; color:#000;"><a class="hvr-overline-from-center button2"style="color:#000;" href="<?php echo APP_URL; ?>photographers.php">Photographers</a></li>
						<?php
						if(!empty($_SESSION['seller']['id']))
						{
							?>
							<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>seller/index.php">My Account</a></li>
							<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>seller/logout.php">Log Out</a></li>
							<?php
						}
						else
						{
							if(!empty($_SESSION['account']['id']))
							{
								?>
								<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>buyer/account.php">My Account</a></li>
								<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>buyer/logout.php">Log Out</a></li>
								<?php
							}
							else
							{
								?>
								<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>join-us.php">Join</a></li>
								<li><a class="hvr-overline-from-center button2 log_bg" href="<?php echo APP_URL; ?>log-in.php">Log in</a></li>
								<?php
							}
						}
						?>
					</ul>
				</div>
			</nav>
			<div class="amamamamamamam">
				<form id="search" action="photos.php" method="get">
					<div id="label"><label for="search-terms" id="search-label">search</label></div>
					<div id="input"><input type="text" name="search_terms" id="search-terms" placeholder="Find the perfect Photos,vector and more...." required="required"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo APP_URL; ?>js/classie.js"></script>
<script src="<?php echo APP_URL; ?>js/search.js"></script>
