<?php

class mergr {
	
	public function __construct($directory=null) {
		
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
			$this->css_process = $this->scandirectory($directory . "/css");
		}
		
		//Check if there is JS to process.
		
		if ( file_exists($directory . "/js") && is_dir($directory . "/js") ) {
			//List JS files to process.
			$this->js_process = $this->scandirectory($directory . "/js");
		}

		
	}
	
	protected function scandirectory($directory=null) {
		
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
					if ( substr($file, -4) == ".css" && $file != "style.min.css") {
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
			
			//This is where CSS should be minified if there is any.
			
			//Write the file.
			$fh = @fopen($directory . "/css/style.min.css", "w");
			if ( !$fh ) {
				print("Error: Couldn't write style.min.css merged file.\n");
				exit;
			}
			
			fwrite($fh, $merge_buffer);
			fclose($fh);
			
			print("Merged " . $merge_count . " files. Output has been saved to " . $directory . "/css/style.min.css\n");
			
			return true;
			
		} else {
			return false;
		}
		
	}
	
}

?>
