<?php

class mergr {
	
	public function __construct($directory=null,$options) {
		
		$this->options = $options;
		
		//Make sure we have a directory to work with.
		if (! $directory) {
			print("No directory specified\n");
			exit;
		}
		
		//Check the directory exists.
		if (! file_exists($directory) || !is_dir($directory) ) {
			print("Directory specified doesn't exist.\n");
			exit;
		}
		
		//The directory exists.
		//Check if there is CSS to process.
		
		if ( file_exists($directory . "/css") && is_dir($directory . "/css") ) {
			//List CSS files to process.
			$this->css_process = $this->scandirectory($directory . "/css", ".css");
		}
		
		//Check if there is JS to process.
		
		if ( file_exists($directory . "/js") && is_dir($directory . "/js") ) {
			//List JS files to process.
			$this->js_process = $this->scandirectory($directory . "/js", ".js");
		}

		
	}
	
	protected function scandirectory($directory=null,$file_extension=".css") {
		
		if (! $directory ) {
			print("No directory specified in scandirectory(); function\n");
			exit;
		}
		
		$file_list = scandir($directory);
		if ( count($file_list) > 0 ) {
			
			$return_array = null;
			
			foreach($file_list as $file) {
				if ( file_exists($directory . "/" . $file) && !is_dir($directory . "/" . $file) ) {
					//Valid file.
					//Check for CSS extension.
					if ( substr($file, -strlen($file_extension)) == $file_extension && $file != "global.min" . $file_extension) {
						$return_array[] = $directory . "/" . $file;
					}
				}
			}
			
			return $return_array;
			
		} else {
			return false;
		}		
		
	}
	
	public function merge_css($directory) {
		
		if ( count($this->css_process) >= 1 ) {
			//Marge the CSS.
			
			$merge_buffer = null;
			$merge_count = 0;
			
			foreach($this->css_process as $file) {
				
				if ( $file != null ) {
					
					$file_data = null;
					
					$filesize = filesize($file);
					if ( $filesize > 0 ) {
					
						$fh = @fopen($file, "r");
						if ( $fh ) {
							$file_data = fread($fh, $filesize);
							fclose($fh);
						
							if ( $file_data ) {
								//Add to merge buffer.
								$merge_buffer .= $file_data;
								$merge_count++;
							}
						}
						
					}
					
				}
				
			}
			
			if (! $this->options['no-plugins'] ) {
				//Execute filter plugins.
				$merge_buffer = mergr_execute_plugins( "filter","css", $merge_buffer );
			}
			
			//Write the file.
			$fh = @fopen($directory . "/css/global.min.css", "w");
			if ( !$fh ) {
				print("Error: Couldn't write global.min.css merged file.\n");
				exit;
			}
			
			fwrite($fh, $merge_buffer);
			fclose($fh);
			
			print("Merged " . $merge_count . " files. Output has been saved to " . $directory . "/css/global.min.css\n");
			
			return true;
			
		} else {
			return false;
		}
		
	}
	
	protected function plugin_execute($operation, $type) {
		
		global $mergr_plugins;
		
	}
	
	public function watch() {
		
		//Is this the first time we've run watch()?
		if (! property_exists($this, "watchlist") ) {
			//Hasn't been run yet.
			$this->watchlist = null;
			foreach($this->css_process as $file) {
				$this->watchlist[] = array(
					"file" => $file,
					"hash" => hash_file("sha256", $file)
				);
			}
			return true;
		}
		
		$result = false;
		
		//Loop through each file in the watch list and calculate it's MD5 sum.
		
		for($i=0;$i<count($this->watchlist);$i++) {
			$current_hash = hash_file("sha256", $this->watchlist[$i]["file"]);
			if ( $current_hash != $this->watchlist[$i]["hash"] ) {
				//Files have changed.
				$result = true;
				$this->watchlist[$i]["hash"] = $current_hash;
			}
		}
		
		
		return $result;
		
	}
	
}

?>
