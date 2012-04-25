<?
	if(count($argv) < 2) {
		print("Tell me the domain to delete.\n");
		exit(1);
	}

	require_once("aws_data_magic/aws_data_magic.inc.php");
	$sdb = new SDBTool();

	if($argc == 2) {
		$domain_to_delete = $argv[1];
	}

	$response = $sdb->delete_domain($domain_to_delete);

	if(!$response->isOK()) {
		print( ((string) $response->body->Error->Detail) . "\n" . ((string) $response->body->Error->Message) . "\n" );
		exit(1);
	}
	
	print "Domain $domain_to_delete deleted.\n";
?>
