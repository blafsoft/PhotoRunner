<?php include('include/config.php'); 


if(!empty($_GET['email']))
{
	if(empty($_SESSION['account']['id']))
	{
		$_SESSION['guast']['email'] = $_GET['email'];
	}
}
if(!empty($_GET['email']))
{
	$_SESSION['app']['url'] = APP_FULL_URL;
}

if(isset($_POST['open']))
{
	$id = $_POST['gallery1'];	
	$conditions = array('id'=>$id, 'password'=>$_POST['password']);
	$check = $common->getrecord('pr_galleries','*',$conditions);

	$id2 = base64_encode($id);
	if(!empty($check))	
	{
		$_SESSION['gallery']['id'] = $id;
		$common->redirect(APP_FULL_URL);
	}
	else
	{
		$common->add('e', 'Password not matched.');	
		$common->redirect(APP_FULL_URL);
	}
}

elseif(isset($_GET['gallery']))
{
	if(isset($_GET['gallery']) && isset($_GET['lock']))
	{
		$gallery = base64_decode($_GET['gallery']);
		$conditions = array('gallery'=>$gallery, 'status'=>'1');
		$photo1 = $common->getrecords('pr_photos','*',$conditions) ;
	}
	else
	{
		$gallery = base64_decode($_GET['gallery']);
		$conditions = array('gallery'=>$gallery, 'status'=>'1');
		$photo = $common->getrecords('pr_photos','*',$conditions) ;
	}
}
elseif(isset($_GET['search']))
{
	$conditions = array('name'=>$_GET['searchinput'], 'status'=>'1');
	$photo = $common->getsearch('pr_photos','*',$conditions) ;
}
else
{
	$conditions = array('status'=>'1');
	$photo = $common->getrecords('pr_photos','*',$conditions) ;
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('include/head-other.php'); ?>
	<link rel="stylesheet" type="text/css" href="efacts/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="efacts/demo.css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,600' rel='stylesheet' type='text/css'>
	<script src="efacts/custom.js" type="text/javascript"></script>
	<link href="http://www.jqueryscript.net/css/top.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="pagination/style.css" />
	<link href="http://www.jqueryscript.net/css/top.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="pagination/css/jPages.css">
	<script src="pagination/js/jPages.js"></script>
	<script>
	$(function(){
		$("div.holder").jPages({
		containerID  : "itemContainer",
		perPage      : 16,
		startPage    : 1,
		startRange   : 1,
		midRange     : 2,
		endRange     : 1
		});

		});
	</script>
</head>
<body>
<?php include('include/header.php'); ?>
<div style="background-color:#f2f2f2">
	<div class="banner-bottom" style="background-color:#f2f2f2">
		<div class="container">
			<div class="banner-info space_for_photo">
				<div id="custom-search-input">
					<form  action=""  method="get" style="width:100%">
						<div class="input-group col-md-12" style="padding:0px;">
							<input type="text" class="search-query form-control " placeholder="Find the perfect Photos,vector and more...." style="color:#333; border-radius:0px; height:60px; " required="required" name="searchinput"/>
							<span class="input-group-btn">
								<button class="btn btn-danger" type="submit" style="padding: 19px 22px !important; border-radius:0px;" name="search">
									<span class=" glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
			<div style="height:20px;"></div>
			<div class="blog-section">
			<div class="blog-posts">
			<div class="blog-top" id="itemContainer">
			<?php
			if(!empty($photo))
			{
				foreach($photo as $photo)
				{
					$conditions = array('id'=>$photo->gallery);
					$gallery = $common->getrecord('pr_galleries','*',$conditions);
					if(empty($gallery->password))
					{
						$checkk = '1';
						?>
						<div class="photo_width_photos1">
							<div class="photo_width_photos">
								<div class="bottom-grids" style="margin-top:0px;">
									<div class="demo-3" style="margin-top:12px;">
										<div class="freshdesignweb"> 
											<article class="border c-two" style="background-image:url(uploads/photos/watermark/<?php echo $photo->webfile; ?>); background-size: 100% 260px; background-repeat: no-repeat; padding: 0px;">
												<div style="opacity: 0;" class="fdw-background">
													<?php if(!empty($_SESSION['account']['id'])) {

													$fav_prom2 = $_SESSION['account']['id'];
													$fav_prom = array('photo' => $photo->id,'member'=>$fav_prom2);
													$fav_prom1 = $common->getrecord('pr_favourite','*',$fav_prom);
													$ruff = count($fav_prom1);
													?>
													<a href="#" class="love" id="<?php echo $photo->id; ?>">
													<?php 
													if($ruff >= 1)
													{
													?>
														<i class="chnge fa fa-heart merced" style="font-size:20px; color:#ed4e6e; padding:5px;"></i>
													<?php
													}
													else
													{
													?>
														<i class="chnge fa fa-heart-o merced"  style="font-size:20px; color:#ed4e6e; padding:5px;"></i>
													<?php
													}
													?>
													<?php }else{ ?>
													<a href="<?php echo APP_URL; ?>log-in.php"><i class="chnge fa fa-heart-o merced"  style="font-size:20px; color:#ed4e6e; padding:5px;"></i></a>
													<?php } ?>




													<h4 style="width:90%; margin:auto;"><a href="view-photo.php?view=<?php echo base64_encode($photo->id); ?>" style="color:#fff;"><?php echo $photo->name; ?></a></h4>
													<a href="view-photo.php?view=<?php echo base64_encode($photo->id); ?>" ><h4 class="log_bg" style="color:#fff; width:50%; background-color:#ed4e6e; margin-left:auto; margin-right:auto; margin-top:15px; border-radius:0px;"><center>Click</center></h4></a>


												</div>
											</article>
										</div>
									</div>
									<div style="clear:both"></div>
									<?php 
									if($photo->webfileprice == '0.00')
									{
										?>
										<div style="font-weight:bold; padding-left:15px; margin:7px;">Free File $0.00 USD</div>
										<?php
									}
									else
									{
										?>
										<div style="font-weight:bold; padding-left:15px; margin:7px;">Premium File $<?php echo $photo->webfileprice; ?> USD</div>
										<?php
									}
									?>
								</div>	
							</div>
						</div>

						<?php
					}
				}
				
			}
			elseif(!empty($photo1))
			{
				if(!empty($_SESSION['gallery']) && $_SESSION['gallery']['id'] == $gallery)
				{
					$_SESSION['guast']['email'] = $_GET['email'];
					foreach($photo1 as $photo1)
					{
					$checkk = '1';
					$conditions = array('id'=>$photo1->gallery);
					$gallery = $common->getrecord('pr_galleries','*',$conditions);
					if(!empty($gallery->password))
					{
					$checkk = 1;
						?>
						<div class="photo_width_photos1">
							<div class="photo_width_photos">
								<div class="bottom-grids" style="margin-top:0px;">
									<div class="demo-3" style="margin-top:12px;">
										<div class="freshdesignweb"> 
											<article class="border c-two" style="background-image:url(uploads/photos/watermark/<?php echo $photo1->webfile; ?>); background-size: 100% 260px; background-repeat: no-repeat; padding: 0px;">
												<div style="opacity: 0;" class="fdw-background">
													<?php if(!empty($_SESSION['account']['id'])) {

													$fav_prom2 = $_SESSION['account']['id'];
													$fav_prom = array('photo' => $photo1->id,'member'=>$fav_prom2);
													$fav_prom1 = $common->getrecord('pr_favourite','*',$fav_prom);
													$ruff = count($fav_prom1);
													?>
													<a href="#" class="love" id="<?php echo $photo1->id; ?>">
													<?php 
													if($ruff >= 1)
													{
													?>
														<i class="chnge fa fa-heart merced" style="font-size:20px; color:#ed4e6e; padding:5px;"></i>
													<?php
													}
													else
													{
													?>
														<i class="chnge fa fa-heart-o merced"  style="font-size:20px; color:#ed4e6e; padding:5px;"></i>
													<?php
													}
													?>
													<?php }else{ ?>
													<a href="<?php echo APP_URL; ?>log-in.php"><i class="chnge fa fa-heart-o merced"  style="font-size:20px; color:#ed4e6e; padding:5px;"></i></a>
													<?php } ?>




													<h4 style="width:90%; margin:auto;"><a href="view-photo.php?view=<?php echo base64_encode($photo1->id); ?>" style="color:#fff;"><?php echo $photo1->name; ?></a></h4>
													<a href="view-photo.php?view=<?php echo base64_encode($photo1->id); ?>" ><h4 class="log_bg" style="color:#fff; width:50%; background-color:#ed4e6e; margin-left:auto; margin-right:auto; margin-top:15px; border-radius:0px;"><center>Click</center></h4></a>

												</div>
											</article>
										</div>
									</div>
									<div style="clear:both"></div>
									<?php 
									if($photo1->webfileprice == '0.00')
									{
										?>
										<div style="font-weight:bold; padding-left:15px; margin:7px;">Free File $0.00 USD</div>
										<?php
									}
									else
									{
										?>
										<div style="font-weight:bold; padding-left:15px; margin:7px;">Premium File $<?php echo $photo1->webfileprice; ?> USD</div>
										<?php
									}
									?>
								</div>	
							</div>
						</div>
						<?php
						}
					}
				}
				else
				{
					$checkk = 1;
					?>
					<div class="container">
						<div style="width:50%; margin:auto;">
							<?php
								if(!empty($_SESSION['flash_messages']))
								{	
									echo $msgs->display();
								}	
							?>
						</div>
						<div style="width:50%; margin:auto;">
						<form action="" method="post" enctype='multipart/form-data' style="height: auto;">
							<div style="font-weight:bold; padding-bottom:5px;">To unlock gallery Enter secure password</div>
							<div style="margin-bottom:5px;">
								<input type="password" placeholder="Password" name="password" id="password" required="required" style="width:100%; border-radius:0px; border:1px solid #00A2B5; height:40px; padding-left:10px;">
							</div>
							<input type="hidden" name="gallery1" value="<?php echo $gallery; ?>" >
							<button type="submit" style="" name="open" class="btn btn-primary" >Submit</button>
						</form>
						</div>
					</div>
					<?php
				}
			}
			else
			{
				$checkk = 1;
				?>
				<div style="width:100%">
					<div style="margin:auto; width:12%;"><img src="images/no-record.png" style="width:100%"/></div>
					<div style="font-size:18px; font-weight:bold; text-align:center">Not Found any Result</div>
				</div>
				<?php
			}
			?>
			<?php
				if(empty($checkk))
				{
				?>
					<div style="width:100%">
						<div style="margin:auto; width:12%;"><img src="images/no-record.png" style="width:100%"/></div>
						<div style="font-size:18px; font-weight:bold; text-align:center">Not Found any Result</div>
					</div>
				<?php
				}
			?>
			</div></div</div>
			<div style="clear:both"></div>
			<div style="text-align:center; margin-top:30px;">
				<div class="blog-pagimation">
					<div class="holder"></div>
				</div>
			</div>
			</div>
		</div>
		<div style="clear:both; height:40px;"></div>
	</div>
</div>
<?php include('include/footer.php') ?>
<?php include('include/foot.php') ?>
</body>
</html>
<script type="text/javascript">
$(function() {
	$(".love").click(function()
	{
		var id = $(this).attr("id");	
		var dataString = 'id='+ id ;
		var parent = $(this);
		$(this).fadeOut(300);
		$.ajax({
			type: "GET",
			url: "favourite_product_ajax.php",
			data: dataString,
			success: function(html)
			{
				var divs = html.split('@=@');
				parent.html(divs[0]);
				parent.fadeIn(300);
				 $( '#show_stared132' ).html( divs[1] );
				$(this).removeClass('love');
			}
		});
		return false;
	});
});
</script>

