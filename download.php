<?php
include('include/config.php');
if(isset($_POST['downloadwebfile']))
{
	$condition = array('id'=>$_POST['id']);
	$downloadfile = $common->getrecord('pr_photos','*',$condition);

	$downloadf = $downloadfile->webfile;
	$file = APP_ROOT."uploads/photos/real/$downloadf";
/*
	$aws = S3Client::factory(array(
		'credentials' => [
			'key'    => 'AKIAJSP57LI6NF4NDFFQ',
			'secret' => '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'
		],
		'region' => 'eu-west-1',
		'version' => 'latest'
	));

	$bucket = $aws->s3->bucket('photorunner.web');
	$object = $bucket->object($download);
*/

// Access resource attributes


	echo $object['LastModified'];

// Call resource methods to take action


	$object->delete();

	$bucket->delete();




	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($file).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    exit;
	}

}
?>
