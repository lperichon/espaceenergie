<?php
#-----------------------------------------
#	RT-Theme common_functions.php
#	version: 1.0
#-----------------------------------------

#
# find vimeo and youtube id from url
#
function find_tube_video_id($url){
	$tubeID="";

	if( strpos($url, 'youtube')  ) {	
		$tubeID=parse_url($url, PHP_URL_QUERY);			
		$tubeID=str_replace("/", "", $tubeID);
		$v= preg_split('/&|=/', $tubeID);
		$tubeID = $v[1];
	}
	
	if( strpos($url, 'vimeo')  ) {
		$tubeID=parse_url($url, PHP_URL_PATH);			
		$tubeID=str_replace("/", "", $tubeID);	
	}	

	return $tubeID;
}