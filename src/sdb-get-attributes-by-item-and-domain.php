<?
	if(count($argv) < 3) {
		print("Tell me the item and domain keys.\n");
		exit(1);
	}

	require_once("aws_data_magic/aws_data_magic.inc.php");
	
	if($argc = 3) {
		$item_key	= $argv[1];
		$domain_key	= $argv[2];
	}

	$response = $sdbtool->get_attributes($domain_key, $item_key);
	if(!$response->isOK()) {
		print( ((string) $response->body->Error->Detail) . "\n" . ((string) $response->body->Error->Message) . "\n" );
		exit(1);
	}
	print_r($response->body);

?>
