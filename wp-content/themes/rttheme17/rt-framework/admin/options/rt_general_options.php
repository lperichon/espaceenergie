<?php

$options = array (


	array(
	"name"      => __("Custom Favicon",'rt_theme_admin'),
	"desc"      => __("You can put url of an ico image that will represent your website's favicon (16px x 16px) ",'rt_theme_admin'),
	"id"        => THEMESLUG."_favicon_url",
	"type"      => "text"),	   


	
	array(
	"name"      => __("SIDEBAR POSITION",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Default Sidebar Position for Sub Pages",'rt_theme_admin'),
	"desc"      => __("Select the position of the sidebar.",'rt_theme_admin'),
	"id"        => THEMESLUG."_sidebar_position",
	"options"   =>  array(
	"right"     => "Right", 
	"left"      => "Left",
	),
	"default"   => "right",
	"type"      => "select"),	
	
	
	array(
	"name"      => __("GOOGLE ANALYTICS",'rt_theme_admin'), 
	"type"      => "heading"), 
	
	array(
	"name"      => __("Analytics Code",'rt_theme_admin'),
	"desc"      => __("Paste your full google analytics code or any other tracking code that needs to be placed in the footer of html body.",'rt_theme_admin'),
	"id"        => THEMESLUG."_google_analytics",
	"type"      => "textarea",				
	),

	array(
	"name"      => __("PAGE COMMENTS",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Allow comments on pages",'rt_theme_admin'),
	"desc"      => __("Turn ON this option if you would like to allow comments on regular pages. Make sure 'Allow Comments' box is also checked for individual pages. ",'rt_theme_admin'),				
	"id"        => THEMESLUG."_allow_page_comments",
	"type"      => "checkbox"
	), 			

	array(
	"name"      => __("UPDATE NOTIFICATIONS",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Close Update Notifications",'rt_theme_admin'),
	"desc"      => __("Turn OFF this option if you don't want to be informed about theme updates.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_update_notifications",
	"type"      => "checkbox",
	"default"	=> "on"
	),
	
	array(
	"name"      => __("WPML PLUGIN",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Show Flags",'rt_theme_admin'),
	"desc"      => __("Show language flags of WPML plugin on top of the page.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_show_flags",
	"default"   => "checked",
	"type"      => "checkbox",
	),

	array(
	"name"      => __("FREE CODE SPACES",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __("You can place your codes by using the fields below. The input will not be formatted!" ,'rt_theme_admin'),
		"type" => "info",
	),

	array(
	"name"      => __("Space for before &lt;/head&gt;",'rt_theme_admin'),
	"id"        => THEMESLUG."_space_for_head",
	"type"      => "textarea",				
	),

	array(
	"name"      => __("Space for before &lt;/body&gt;",'rt_theme_admin'),
	"id"        => THEMESLUG."_space_for_footer",
	"type"      => "textarea",				
	),

); 
?>