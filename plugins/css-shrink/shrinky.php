<?php
/*
	The MIT License (MIT)

	Copyright (c) 2013 Richard Denton / eMarketeer Australia

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

class shrinky_css {
	
	function __construct($sCss) {
	
		$this->cssOrig = $sCss;
		$this->cssBuffer = $sCss;
		$this->cssOrigSize = strlen( $this->cssBuffer );
		
	}
	
	function shorten_colors() {
		
		//Find colors that can be shorted in the CSS.
		$aRegExMatch = null;
		$aQuedChanges = null;
		$iChangeCounter = 0;
		preg_match_all("/#(.*?)\;/", $this->cssBuffer, $aRegExMatch);
		preg_match_all("/#(.*?)\ /", $this->cssBuffer, $aRegExMatch);
		foreach( $aRegExMatch as $cMatch ) {
			//Check if shortenable.
			foreach( $cMatch as $match ) {
				if ( strlen($match) == 6 ) {
					
					$head = substr($match,0,3);
					$tail = substr($match,3);
					if ( $head == $tail ) {
						//This colour code can be shortened.
						$aQuedChanges[$iChangeCounter][0] = $match;
						$aQuedChanges[$iChangeCounter][1] = $head;
						$iChangeCounter++;
					}
					
				}
			}
		}
		
		if ( count($aQuedChanges) > 0 ) {
			//There's qued changes to write.
			
			foreach( $aQuedChanges as $aChange ) {
				
				$this->cssBuffer = str_replace("#".$aChange[0], "#".$aChange[1], $this->cssBuffer);
				
			}
			
		}
		
		//Pre-calculated shrinks.
		$this->cssBuffer = str_replace("#ff0000", "red", $this->cssBuffer);		
		$this->cssBuffer = str_replace("AliceBlue","#F0F8FF",$this->cssBuffer);
		$this->cssBuffer = str_replace("AntiqueWhite","#FAEBD7",$this->cssBuffer);
		$this->cssBuffer = str_replace("#00FFFF","Aqua",$this->cssBuffer);
		$this->cssBuffer = str_replace("Aquamarine","#7FFFD4",$this->cssBuffer);
		$this->cssBuffer = str_replace("#F0FFFF","Azure",$this->cssBuffer);
		$this->cssBuffer = str_replace("#F5F5DC","Beige",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFE4C4","Bisque",$this->cssBuffer);
		$this->cssBuffer = str_replace("#000000","Black",$this->cssBuffer);
		$this->cssBuffer = str_replace("BlanchedAlmond","#FFEBCD",$this->cssBuffer);
		$this->cssBuffer = str_replace("#0000FF","Blue",$this->cssBuffer);
		$this->cssBuffer = str_replace("BlueViolet","#8A2BE2",$this->cssBuffer);
		$this->cssBuffer = str_replace("#A52A2A","Brown",$this->cssBuffer);
		$this->cssBuffer = str_replace("BurlyWood","#DEB887",$this->cssBuffer);
		$this->cssBuffer = str_replace("CadetBlue","#5F9EA0",$this->cssBuffer);
		$this->cssBuffer = str_replace("Chartreuse","#7FFF00",$this->cssBuffer);
		$this->cssBuffer = str_replace("Chocolate","#D2691E",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF7F50","Coral",$this->cssBuffer);
		$this->cssBuffer = str_replace("CornflowerBlue","#6495ED",$this->cssBuffer);
		$this->cssBuffer = str_replace("Cornsilk","#FFF8DC",$this->cssBuffer);
		$this->cssBuffer = str_replace("#DC143C","Crimson",$this->cssBuffer);
		$this->cssBuffer = str_replace("#00FFFF","Cyan",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkBlue","#00008B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkCyan","#008B8B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkGoldenRod","#B8860B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkGray","#A9A9A9",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkGreen","#006400",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkKhaki","#BDB76B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkMagenta","#8B008B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkOliveGreen","#556B2F",$this->cssBuffer);
		$this->cssBuffer = str_replace("Darkorange","#FF8C00",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkOrchid","#9932CC",$this->cssBuffer);
		$this->cssBuffer = str_replace("#8B0000","DarkRed",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkSalmon","#E9967A",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkSeaGreen","#8FBC8F",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkSlateBlue","#483D8B",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkSlateGray","#2F4F4F",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkTurquoise","#00CED1",$this->cssBuffer);
		$this->cssBuffer = str_replace("DarkViolet","#9400D3",$this->cssBuffer);
		$this->cssBuffer = str_replace("DeepPink","#FF1493",$this->cssBuffer);
		$this->cssBuffer = str_replace("DeepSkyBlue","#00BFFF",$this->cssBuffer);
		$this->cssBuffer = str_replace("#696969","DimGray",$this->cssBuffer);
		$this->cssBuffer = str_replace("#696969","DimGrey",$this->cssBuffer);
		$this->cssBuffer = str_replace("DodgerBlue","#1E90FF",$this->cssBuffer);
		$this->cssBuffer = str_replace("FireBrick","#B22222",$this->cssBuffer);
		$this->cssBuffer = str_replace("FloralWhite","#FFFAF0",$this->cssBuffer);
		$this->cssBuffer = str_replace("ForestGreen","#228B22",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF00FF","Fuchsia",$this->cssBuffer);
		$this->cssBuffer = str_replace("Gainsboro","#DCDCDC",$this->cssBuffer);
		$this->cssBuffer = str_replace("GhostWhite","#F8F8FF",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFD700","Gold",$this->cssBuffer);
		$this->cssBuffer = str_replace("GoldenRod","#DAA520",$this->cssBuffer);
		$this->cssBuffer = str_replace("#808080","Gray",$this->cssBuffer);
		$this->cssBuffer = str_replace("#008000","Green",$this->cssBuffer);
		$this->cssBuffer = str_replace("GreenYellow","#ADFF2F",$this->cssBuffer);
		$this->cssBuffer = str_replace("HoneyDew","#F0FFF0",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF69B4","HotPink",$this->cssBuffer);
		$this->cssBuffer = str_replace("IndianRed","#CD5C5C",$this->cssBuffer);
		$this->cssBuffer = str_replace("#4B0082","Indigo",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFFFF0","Ivory",$this->cssBuffer);
		$this->cssBuffer = str_replace("#F0E68C","Khaki",$this->cssBuffer);
		$this->cssBuffer = str_replace("Lavender","#E6E6FA",$this->cssBuffer);
		$this->cssBuffer = str_replace("LavenderBlush","#FFF0F5",$this->cssBuffer);
		$this->cssBuffer = str_replace("LawnGreen","#7CFC00",$this->cssBuffer);
		$this->cssBuffer = str_replace("LemonChiffon","#FFFACD",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightBlue","#ADD8E6",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightCoral","#F08080",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightCyan","#E0FFFF",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightGoldenRodYellow","#FAFAD2",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightGray","#D3D3D3",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightGreen","#90EE90",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightPink","#FFB6C1",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightSalmon","#FFA07A",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightSeaGreen","#20B2AA",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightSkyBlue","#87CEFA",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightSlateGray","#778899",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightSteelBlue","#B0C4DE",$this->cssBuffer);
		$this->cssBuffer = str_replace("LightYellow","#FFFFE0",$this->cssBuffer);
		$this->cssBuffer = str_replace("#00FF00","Lime",$this->cssBuffer);
		$this->cssBuffer = str_replace("LimeGreen","#32CD32",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FAF0E6","Linen",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF00FF","Magenta",$this->cssBuffer);
		$this->cssBuffer = str_replace("#800000","Maroon",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumAquaMarine","#66CDAA",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumBlue","#0000CD",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumOrchid","#BA55D3",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumPurple","#9370DB",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumSeaGreen","#3CB371",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumSlateBlue","#7B68EE",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumSpringGreen","#00FA9A",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumTurquoise","#48D1CC",$this->cssBuffer);
		$this->cssBuffer = str_replace("MediumVioletRed","#C71585",$this->cssBuffer);
		$this->cssBuffer = str_replace("MidnightBlue","#191970",$this->cssBuffer);
		$this->cssBuffer = str_replace("MintCream","#F5FFFA",$this->cssBuffer);
		$this->cssBuffer = str_replace("MistyRose","#FFE4E1",$this->cssBuffer);
		$this->cssBuffer = str_replace("Moccasin","#FFE4B5",$this->cssBuffer);
		$this->cssBuffer = str_replace("NavajoWhite","#FFDEAD",$this->cssBuffer);
		$this->cssBuffer = str_replace("#000080","Navy",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FDF5E6","OldLace",$this->cssBuffer);
		$this->cssBuffer = str_replace("#808000","Olive",$this->cssBuffer);
		$this->cssBuffer = str_replace("OliveDrab","#6B8E23",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFA500","Orange",$this->cssBuffer);
		$this->cssBuffer = str_replace("OrangeRed","#FF4500",$this->cssBuffer);
		$this->cssBuffer = str_replace("#DA70D6","Orchid",$this->cssBuffer);
		$this->cssBuffer = str_replace("PaleGoldenRod","#EEE8AA",$this->cssBuffer);
		$this->cssBuffer = str_replace("PaleGreen","#98FB98",$this->cssBuffer);
		$this->cssBuffer = str_replace("PaleTurquoise","#AFEEEE",$this->cssBuffer);
		$this->cssBuffer = str_replace("PaleVioletRed","#DB7093",$this->cssBuffer);
		$this->cssBuffer = str_replace("PapayaWhip","#FFEFD5",$this->cssBuffer);
		$this->cssBuffer = str_replace("PeachPuff","#FFDAB9",$this->cssBuffer);
		$this->cssBuffer = str_replace("#CD853F","Peru",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFC0CB","Pink",$this->cssBuffer);
		$this->cssBuffer = str_replace("#DDA0DD","Plum",$this->cssBuffer);
		$this->cssBuffer = str_replace("PowderBlue","#B0E0E6",$this->cssBuffer);
		$this->cssBuffer = str_replace("#800080","Purple",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF0000","Red",$this->cssBuffer);
		$this->cssBuffer = str_replace("RosyBrown","#BC8F8F",$this->cssBuffer);
		$this->cssBuffer = str_replace("RoyalBlue","#4169E1",$this->cssBuffer);
		$this->cssBuffer = str_replace("SaddleBrown","#8B4513",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FA8072","Salmon",$this->cssBuffer);
		$this->cssBuffer = str_replace("SandyBrown","#F4A460",$this->cssBuffer);
		$this->cssBuffer = str_replace("SeaGreen","#2E8B57",$this->cssBuffer);
		$this->cssBuffer = str_replace("SeaShell","#FFF5EE",$this->cssBuffer);
		$this->cssBuffer = str_replace("#A0522D","Sienna",$this->cssBuffer);
		$this->cssBuffer = str_replace("#C0C0C0","Silver",$this->cssBuffer);
		$this->cssBuffer = str_replace("#87CEEB","SkyBlue",$this->cssBuffer);
		$this->cssBuffer = str_replace("SlateBlue","#6A5ACD",$this->cssBuffer);
		$this->cssBuffer = str_replace("SlateGray","#708090",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFFAFA","Snow",$this->cssBuffer);
		$this->cssBuffer = str_replace("SpringGreen","#00FF7F",$this->cssBuffer);
		$this->cssBuffer = str_replace("SteelBlue","#4682B4",$this->cssBuffer);
		$this->cssBuffer = str_replace("#D2B48C","Tan",$this->cssBuffer);
		$this->cssBuffer = str_replace("#008080","Teal",$this->cssBuffer);
		$this->cssBuffer = str_replace("#D8BFD8","Thistle",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FF6347","Tomato",$this->cssBuffer);
		$this->cssBuffer = str_replace("Turquoise","#40E0D0",$this->cssBuffer);
		$this->cssBuffer = str_replace("#EE82EE","Violet",$this->cssBuffer);
		$this->cssBuffer = str_replace("#F5DEB3","Wheat",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFFFFF","White",$this->cssBuffer);
		$this->cssBuffer = str_replace("WhiteSmoke","#F5F5F5",$this->cssBuffer);
		$this->cssBuffer = str_replace("#FFFF00","Yellow",$this->cssBuffer);
		$this->cssBuffer = str_replace("YellowGreen","#9ACD32",$this->cssBuffer);
		
		
	}
	
	function strip_whitespace() {
		
		//Strip comments.
		$this->cssBuffer = preg_replace("/\/\*(.*?)\*\//", null, $this->cssBuffer);
		
		//Safe whiteplace replacement.
		$this->cssBuffer = str_replace("	", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("      ", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("     ", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("    ", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("   ", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("  ", " ", $this->cssBuffer);
		$this->cssBuffer = str_replace("\r", null, $this->cssBuffer);
		$this->cssBuffer = str_replace("\n", null, $this->cssBuffer);
		$this->cssBuffer = str_replace(": ", ":", $this->cssBuffer);
		$this->cssBuffer = str_replace("; ", ";", $this->cssBuffer);
		$this->cssBuffer = str_replace(" {", "{", $this->cssBuffer);
		$this->cssBuffer = str_replace("{ ", "{", $this->cssBuffer);
		$this->cssBuffer = str_replace(" }", "}", $this->cssBuffer);
		$this->cssBuffer = str_replace("} ", "}", $this->cssBuffer);
		$this->cssBuffer = str_replace(", ", ",", $this->cssBuffer);
		$this->cssBuffer = str_replace(" ,", ",", $this->cssBuffer);
		$this->cssBuffer = str_replace(";}", "}", $this->cssBuffer);
		$this->cssBuffer = str_replace(":0%", ":0", $this->cssBuffer);
		$this->cssBuffer = str_replace(" 0%", " 0", $this->cssBuffer);
		$this->cssBuffer = str_replace(":0px", ":0", $this->cssBuffer);
		$this->cssBuffer = str_replace(" 0px", " 0", $this->cssBuffer);
		
	}
	
	function bytes_saved() {
		
		return strlen($this->cssOrig) - strlen($this->cssBuffer);
		
	}
	
	function result() {
		
		return $this->cssBuffer;
		
	}
}

?>