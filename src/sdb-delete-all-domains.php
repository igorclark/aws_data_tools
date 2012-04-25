<?
	$confirm = readline("Are you sure you want to delete *all* your SDB domains? [Y/n]: ");
	if($confirm !== "Y" && $confirm !== "y") {
		print "Didn't think so.\n";
		exit(1);
	}

	require_once("aws_data_magic/aws_data_magic.inc.php");

	$sdb = new SDBTool();
	$domains = $sdb->get_domain_list();

	// Success?
	$domain_count	= count($domains);
	if($domain_count == 0) {
		print "0 domains to delete.\n";
		exit(0);
	}

	print "$domain_count domain" . ($domain_count != 1 ? "s" : "") . " to delete:\n";

	for($x=0;$x<$domain_count;$x++) {
		print "- Deleting " . $domains[$x] . " ...";
		$response = $sdb->delete_domain($domains[$x]);
		if(!$response->isOK()) {
			print "\n\t- Error deleting " . $domains[$x] . ":\n\t";
			print( ((string) $response->body->Error->Detail) . "\n\t" . ((string) $response->body->Error->Message) . "\n" );
		}
		else {
			print " done.\n";
		}
	}

	print "Confirming all domains deleted ..";
	do {
		$domains = $sdb->get_domain_list();
		print ".";
	} while (count($domains) !== 0);

	print " done.\n";
?>
