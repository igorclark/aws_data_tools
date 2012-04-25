<?
require_once("aws_data_magic/aws_data_magic.inc.php");

$sdb = new SDBTool();
$domains = $sdb->get_domain_list();

// Success?
$domain_count	= count($domains);
print "$domain_count domain" . ($domain_count != 1 ? "s" : "") . ($domain_count == 0 ? "." : ":") . "\n";
for($x=0;$x<$domain_count;$x++) {
	print "- " . $domains[$x] . "\n";
}
?>
