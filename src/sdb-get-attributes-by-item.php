<?
	if(count($argv) < 2) {
		print("Tell me the item key.\n");
		exit(1);
	}

	require_once("aws_data_magic/aws_data_magic.inc.php");
	$aws_data_tool = new AWSDataTool()
	
	if($argc = 2) {
		$item_key	= $argv[1];
	}

	try {
		print_r($aws_data_tool->sdbtool->retrieve_igorclark_entry($item_key));
	}
	catch(Exception $e) {
		print $e->getMessage();
	}

?>
