<?php  include('../include/config.php'); include(APP_ROOT.'include/check-seller.php'); ?>
<?php
if(isset($_GET['act']) && $_GET['act'] == 'del')
{
	if(!empty($_GET['id']))
	{
		$photoconditions = array('seller'=>$_SESSION['seller']['id'],'id'=>base64_decode($_GET['id']));
		$photo = $common->getrecord('pr_photos','webfile,printfile',$photoconditions); 
		if(!empty($photo))
		{
			$common->deleterecords('pr_photos',$photoconditions);

			@unlink(APP_ROOT."uploads/photos/real/" . $photo->printfile);
			@unlink(APP_ROOT."uploads/photos/real/" . $photo->webfile);
			@unlink(APP_ROOT."uploads/photos/watermark/" . $photo->webfile);
			@unlink(APP_ROOT."uploads/photos/bigwatermark/" . $photo->webfile);
		}
		$msgs->add('s', 'Photo has been removed successfully.');	
		$common->redirect(APP_URL."seller/photos.php");
	}
	else
	{
		$msgs->add('e', 'Something wants wrong');	
		$common->redirect(APP_URL."seller/photos.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include(APP_ROOT.'include/head-other.php'); ?>
	<link rel="stylesheet" href="<?php echo APP_URL; ?>css/login.css">
</head>
<body style="background-color:#EBEBEB">
	<?php include(APP_ROOT.'include/header.php'); ?>
	<style>
	.line1{margin:0px 0px 0px 15px; padding:10px; color:#00A2B5; border-bottom:1px solid #00A2B5;}
	.line2{margin:0px 0px 0px 15px; padding:10px; color:#00A2B5;}
	</style>
	<div class="space_account"></div>
	<div style="height:2px; background-color:#ebebeb;"></div>
	<div style="height:20px;"></div>
	<div class="container">
	<div style="width:100%; margin:auto;">
	<div style="width:100%; margin:auto;">
	<?php
		if(!empty($_SESSION['flash_messages']))
		{	
			echo $msgs->display();
		}	
	?>
	</div>
	</div>
	<div class="col-md-3 no-pading" style="background-color:#fff; height:auto;margin:20px 0;">
		<?php include(APP_ROOT."include/seller-left.php") ?>
	</div>
	<div class="col-md-9 features features-right padding_account" style="margin:20px 0;">
		<div class="col-md-12 form-module" style="max-width: 100%;">
			<div>&nbsp;</div>
			<h2>All Photos</h2>
			<?php		
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 10;
			$startpoint = ($page * $limit) - $limit;					
			$conditions = " WHERE seller = '".$_SESSION['seller']['id']."' ";						
			$statement = "pr_photos" . $conditions;						
			$conditions .= " LIMIT {$startpoint} , {$limit}";	
			$photos = $common->getpagirecords('pr_photos','*',$conditions);

			if(!empty($photos))
			{
				foreach($photos as $photos)
				{
					$conditions = array('id'=>$photos->gallery);
					$gallery = $common->getrecord('pr_galleries','*',$conditions);
					?>
					<div class="col-md-8" style="padding:0px">
						<div class="col-md-3" style="padding:0px">
							<?php 
							if(isset($photos->webfile) && !empty($photos->webfile))
							{
								?><img src="<?php echo APP_URL; ?>uploads/photos/watermark/<?php echo $photos->webfile; ?>" style="height:50px;"><?php
							}
							else
							{
								?><img src="<?php echo APP_URL; ?>uploads/galleries/e9d82d70fd881fcc209395487d46b589.jpg" style="height:50px;"><?php
							}
							?>
							
						</div>
						<div class="col-md-9" style="padding:0px;">
							<div>
								<div style="width:100px; font-weight:bold; float:left">File Name</div><div style="font-weight:bold;">: <?php echo $photos->name; ?></div>
							</div>
							<div>
								<div><?php echo $gallery->name; ?> ( Gallery Name )</div>
							</div>
						</div>				
					</div>
					<div class="col-md-4" style="padding:0px;text-align:right;">
						<a href="<?php echo APP_URL; ?>seller/edit-photo.php?id=<?php echo base64_encode($photos->id); ?>"><i class="fa fa-edit" style="font-size: 20px;"></i></a> 
						<a href="<?php echo APP_URL; ?>seller/photos.php?id=<?php echo base64_encode($photos->id); ?>&act=del" onclick="return confirm('Are you sure to remove this Photo ?')"><i class="fa fa-remove" style="font-size: 20px;"></i></a>
					</div>
					<div style="clear: both; border-bottom: 1px solid rgb(204, 204, 204);">&nbsp;</div>
					<div style="clear: both;">&nbsp;</div>
					<?php
				}
			}
			else
			{
				?><h2>No record found.</h2><?php
			}
			?>
			
		</div>
		<div style="float:right">
			<?php echo $common->pagination($statement,$limit,$page); ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php include(APP_ROOT.'include/footer.php') ?>
<?php include(APP_ROOT.'include/foot.php') ?>
</body>
</html>
