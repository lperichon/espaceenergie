<?php
#-----------------------------------------
#	RT-Theme functions.php
#	version: 1.0
#-----------------------------------------


// start user session
session_start();

# Check PHP Version
if (version_compare(PHP_VERSION, '5.0.0', '<')) {

	$PHP_version_error = '<div id="notice" class="error"><p><strong><h3>THEME ERROR!</h3>This theme requires PHP Version 5 or higher to run. Please upgrade your php version!</strong> <br />You can contact your hosting provider to upgrade PHP version of your website.</p> </div>';
	if(is_admin()){	
		add_action('admin_notices','errorfunction');
	}else{
		echo $PHP_version_error;
		die;
	}
	
	function errorfunction(){
		global $PHP_version_error;
		echo $PHP_version_error;
	}
	
	return false;
}

# Define Content Width
if ( ! isset( $content_width ) ) $content_width = 606;

# Load the theme
require_once (TEMPLATEPATH . '/rt-framework/classes/loading.php');
$rttheme = new RTTheme();
$rttheme->start(array('theme' => 'RT-THEME 17','slug' => 'rttheme','version' => '1.0'));
?>