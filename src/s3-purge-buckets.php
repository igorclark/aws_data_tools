<?
	require("AWSSDKforPHP/sdk.class.php");
	$s3 = new AmazonS3();

	$buckets = array("igorclark-entry-01", "igorclark-entry-02");

	$create = false;
	if($argc == 2 && $argv[1] == "create") {
		$create = true;
	}

	foreach($buckets as $bucket) {
		if($s3->if_bucket_exists($bucket)) {
			$s3->delete_bucket($bucket, true);
			print "Deleted S3 bucket $bucket.\n";
		}

		if(!$create) {
			continue;
		}

		$cbr = $s3->create_bucket($bucket, AmazonS3::REGION_US_W1);
		if(!$cbr->isOK()) {
			print "failed to create S3 bucket $bucket\n";
		}
	
		while(!$s3->if_bucket_exists($bucket)) {
			sleep(1);
		}
		print "Created S3 bucket $bucket.\n";
	}
	exit;
?>
