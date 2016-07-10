<?php include('include/config.php'); 
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
				</div>
			</div>
		</div>
		<div class="container">
			<div style="text-align:center;"><img src="<?php echo APP_URL; ?>images/Not-Found-404-Orange.png" /></div>
		</div>
	</div>
</div>
<?php include('include/footer.php') ?>
<?php include('include/foot.php') ?>
</body>
</html>
