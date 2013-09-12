<?php

require_once 'lib/mergr.class.php';
require_once 'lib/plugins.php';

if ( $argc < 2 ) {
	print("No arguments provided.\n");
	exit;
}

if ( $argc == 2 ) {
	//First argument should be a directory.
	$mergr_function = "once-off";
	$mergr_directory = $argv[1];
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
		$mergr = new mergr($mergr_directory);
		$mergr->merge_css($mergr_directory);
		
		break;
	
}

?>
