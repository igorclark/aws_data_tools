<?
	if(count($argv) < 2) {
		print("Tell me the item type for the domain(s) you want me to create.\n");
		exit(1);
	}

	$domain_type = $argv[1];
	$num_domains_to_create = 1;
	if(count($argv > 2)) {
		if(is_numeric($argv[2])) {
			$num_domains_to_create = $argv[2];
		}
	}

	$confirm = readline("Creating $num_domains_to_create domain(s) for item type $domain_type, correct? [Y/n]: ");
	if($confirm !== 'Y' && $confirm !== 'y') {
		print "OK, try again.\n";
		exit(1);
	}

	require_once("aws_data_magic/aws_data_magic.inc.php");
	$sdb = new SDBTool();

	$domains_to_create = SDBTool::create_padded_domain_names($domain_type, $num_domains_to_create);

	foreach($domains_to_create as $domain_to_create) {
		print "Creating domain $domain_to_create\n";
		$response	= $sdb->create_domain($domain_to_create);

		if(!$response->isOK()) {
			print( (string)$response->body->Error->Detail . "\n" . (string)$response->body->Error->Message . "\n" );
			exit(1);
		}

		print "Domain $domain_to_create created.\n";
	}
?>
