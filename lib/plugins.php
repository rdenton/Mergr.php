<?php

$mergr_plugins = array();

function mergr_find_plugins() {
	
	//Scan the /plugins directory.
	$files = scandir("plugins/");
	foreach( $files as $file ) {
		
		if ( $file != "." && $file != ".." && substr($file,-4) == ".php" ) {
			
			//Plugin found.
			//Include the plugin.
			include "plugins/" . $file;
			
		}
		
	}
	
}

function mergr_register_plugin($function_type,$function_file_type,$function_name) {
	
	global $mergr_plugins;
	
	$mergr_plugins[] = array(
		"function_type" => $function_type,
		"file_type" => $function_file_type,
		"function_name" => $function_name
	);
	
}

function mergr_execute_plugins($function_type,$file_type,$function_data=null) {
	
	global $mergr_plugins;
	
	foreach ($mergr_plugins as $plugin) {
		
		if ( $plugin['function_type'] == $function_type && $plugin['file_type'] == $file_type ) {
			//Execute the plugin.
			if ( function_exists($plugin['function_name']) ) { 
				if (! $function_data ) {
					$function_data = call_user_func($plugin['function_name']);
				} else {
					$function_data = call_user_func($plugin['function_name'], $function_data);
				}
			}
		}
		
	}
	
	return $function_data;
	
}

?>