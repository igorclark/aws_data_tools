<?
	require("AWSSDKforPHP/sdk.class.php");
	$s3 = new AmazonS3();

	$cfu = new CFUtilities();
	$buckets = $cfu->convert_response_to_array($s3->list_buckets());
	foreach($buckets['body']['Buckets']['Bucket'] as $bucket) {
		$bucketdate = strtotime($bucket['CreationDate']);
		$createdate = date("Y-m-d H:i:s", $bucketdate);
		print "Bucket: {$bucket['Name']} | Creation date: {$createdate}\n";
	}
?>
