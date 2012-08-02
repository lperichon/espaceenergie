<?php
#-----------------------------------------
#	RT-Theme slider_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Slider Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(


			array(
				"name"			=> "slide_text",
				"title"			=> __("Slide Text",'rt_theme_admin'),
				"type"			=> "textarea"
			),

			array(
				"name"			=> "custom_link", 
				"title"			=> __("Custom Link",'rt_theme_admin'),
				"type"			=> "text" 
			),

			array(
				"name"			=> "hide_titles",
				"title"			=> __("Title and Texts",'rt_theme_admin'), 
				"description"		=> "You can turn off the right side text and title area",
				"type"			=> "checkbox",
				"default"			=> "checked"
			),
			  
);

$settings  = array( 
	"name"		=> THEMENAME ." Slider Options",
	"scope"		=> "slider",
	"slug"		=> "rt_slider_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);