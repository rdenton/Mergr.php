<?php

require_once 'css-shrink/shrinky.php';

mergr_register_plugin("filter", "css", "css_shrink");

function css_shrink($filter_data) {
	
	$shrinky = new shrinky_css($filter_data);
	$shrinky->shorten_colors();
	$shrinky->strip_whitespace();
	
	return $shrinky->result();
	
}

?>