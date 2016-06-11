<?php
include("../include/config.php");
	unset($_SESSION['account']);
	$common->redirect(APP_URL."index.php");
?>
