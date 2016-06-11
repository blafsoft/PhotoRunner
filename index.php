<?php include('include/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
<div class="banner" style="background: url(../uploads/<?php echo $home->image2; ?>) no-repeat 0px 0px;background-size:cover;
-webkit-background-size: cover;
-o-background-size: cover;
-ms-background-size: cover;
-moz-background-size: cover;
min-height: 475px;">
	<div class="container">
		<div  id="top" class="callbacks_container">
			<ul class="rslides" id="slider3">
				<li>
					<div class="banner-info">
						<div id="custom-search-input">
							<form  action="photos.php"  method="get" style="width:100%">
								<div class="input-group col-md-12">
									<input type="text" class="  search-query form-control" placeholder="Find the perfect Photos,vector and more...." style="color:#333; height:50px;" required="required" name="searchinput"/>
									<span class="input-group-btn">
										<button class="btn btn-danger" type="submit" style="padding: 14px 22px;" name="search">
											<span class=" glyphicon glyphicon-search"></span>
										</button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-12" style="text-align:center; padding:0px;">
						<a href="<?php echo APP_URL; ?>log-in.php"><img src="images/login.png" style="width:200px;" ></a>
						<a href="<?php echo APP_URL; ?>registration.php"><img src="images/reg.png" style="width:200px;"></a>
					</div>
				</li>
			</ul>
		</div>
		<div class="slide_bgg">
			<p><?php echo html_entity_decode($home->bannerheading); ?>
				<?php /*<a href="#">
					<span class="label label-default" style="float:right;background:#333;line-height:31px;">Read More</span>
				</a>*/ ?>
			</p>
		</div>
	</div>
</div>
<!-- //banner -->
<!-- our facilities -->
<div class="facilities">
	<div class="container">
		<h3 class="tittle">"<?php echo html_entity_decode($home->facilitiesheading); ?>"</h3> 	
		<div class="col-md-8 no-pading">
			<div class="view view-seventh" >
				<a href="photos.php" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image3; ?>" alt="" style="min-height:240px;max-height:240px;" >
					<div class="mask">
						<h4>PHOTORUNNER</h4>
						<p><?php echo html_entity_decode($home->firstdescription); ?></p>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="photos.php" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image4; ?>" alt="" style="min-height:240px;max-height:240px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
						<p><?php echo html_entity_decode($home->seconddescription); ?></p>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="photos.php" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image5; ?>" alt="" style="min-height:240px;max-height:240px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
						<p><?php echo html_entity_decode($home->thirddescription); ?></p>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="photos.php" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image6; ?>" alt="" style="min-height:240px;max-height:240px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
						<p><?php echo html_entity_decode($home->fourthdescription); ?></p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-4 no-pading">
			<div class="view view-seventh" style="width:100%">
				<a href="photos.php" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image7; ?>" alt=""style="min-height:520px;max-height:520px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
						<p><?php echo html_entity_decode($home->fifthdescription); ?></p>                        
					</div>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //our facilities -->
<!-- banner-bottom -->
<div class="banner-bottom">
	<div class="container">
		<h2 class="tittle">Register for Selling Photos</h2> 
		<div class="bottom-grids">
			<div class="col-md-3  bottom-grid">
				<div class="bottom-text" >
					<img src="uploads/<?php echo $home->image8; ?>">
				</div>
				<div class="bottom-spa"></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<img src="uploads/<?php echo $home->image9; ?>">
				</div>
				<div class="bottom-spa"></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<img src="uploads/<?php echo $home->image10; ?>">
				</div>
				<div class="bottom-spa"></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<img src="uploads/<?php echo $home->image11; ?>">
				</div>
				<div class="bottom-spa"></div>
			</div>
		<div class="clearfix"></div>
		</div>
	</div>
</div>
<div class="features">
	<div class="container">
		<div class="col-md-6 no-pading">
			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image12; ?>" alt="" style="min-height:150px;max-height:150px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image13; ?>" alt="" style="min-height:150px;max-height:150px;" >
					<div class="mask">
						<h4>PHOTORUNNER</h4>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image14; ?>" alt="" style="min-height:150px;max-height:150px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
					</div>
				</a>
			</div>
			<div class="view view-seventh">
				<a href="" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="uploads/<?php echo $home->image15; ?>" alt="" style="min-height:150px;max-height:150px;">
					<div class="mask">
						<h4>PHOTORUNNER</h4>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-6 features-right ">
			<?php echo html_entity_decode($home->companydescription); ?>
			<h4 class="log_bg" style="color:#fff"><center>Meet March's Signature Artist</center></h4>
		</div>
	<div class="clearfix"></div>
	</div>
</div>
	<?php include('include/footer.php') ?>
	<?php include('include/foot.php') ?>
</body>
</html>
