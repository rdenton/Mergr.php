<?php

require_once 'lib/mergr.class.php';
require_once 'lib/plugins.php';

if ( $argc < 2 ) {
	print("No arguments provided.\n");
	exit;
}

//Default function
$mergr_function = "once-off";

//Last argument should always be the directory.
$mergr_directory = $argv[$argc-1];

$mergr_options = array(
	"no-plugins" => false,
	"watch" => false
);

//Set command arguments.
for($i=1;$i<($argc-1);$i++) {
	if ( substr($argv[$i],0,2) == "--" ) {
		//Check if there is a value.
		$val = explode("=", $argv[$i]);
		if ( count($val) > 1 ) {
			$mergr_options[substr($val[0],2)] = $val[1];
		} else {
			$mergr_options[substr($argv[$i],2)] = true;
		}
	}
}


//Check options.
//Set function accordingly.
if ( $mergr_options['watch'] ) {
	$mergr_function = "watch";
	print "Mergr.php will watch " . $mergr_directory . " for changes\nPress CTRL + C to cancel\n";
}


//Browse for plugins.
mergr_find_plugins();

switch($mergr_function) {
	
	case "once-off":
		if ( $mergr_directory == null ) {
			print("No directory specified\n");
			exit;
		}
		
		//Do the merge.
		$mergr = new mergr($mergr_directory, $mergr_options);
		$mergr->merge_css($mergr_directory);
		
		break;
		
	case "watch":
		
		$mergr = new mergr($mergr_directory, $mergr_options);
		
		while (1) {
			
			if( $mergr->watch() ) {
				//Update files.
				print "Change detected. Re-merging.\n";
				$mergr->merge_css($mergr_directory);
			}			
			
			//Scan files every one minute.
			sleep(1);
			
		}
		
		break;
	
}

?>
