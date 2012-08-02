<?php
#-----------------------------------------
#	RT-Theme portfolio_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Portfolio Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(

	
				array(
					"name"			=> "_portf_no_detail",
					"title"			=> __("Remove links to post details",'rt_theme_admin'),
					"description"		=> __("You can remove the links to the detail page if you would like to use this item only in listing pages.",'rt_theme_admin'),
					"type"			=> "checkbox",
					"hr"				=> "true"
				),

				array(
					"name"			=> "_disable_lightbox",
					"title"			=> __("Disable lightbox in listing pages",'rt_theme_admin'),
					"description"		=> __("You can disable the lightbox for the media in portfolio listing pages and link it to the post detail page. Make sure that 'Remove links to post details' option is not active.",'rt_theme_admin'),
					"type"			=> "checkbox",
					"hr"				=> "true"
				),

				array(
					"name"			=> "_portfolio_desc",
					"title"			=> __("Short description for portfolio posts",'rt_theme_admin'),
					"description"		=> "",
					"type"			=> "textarea"
				),

  				array(
					"title"			 => __("PORTFOLIO MEDIA",'rt_theme_admin'), 
					"type"			 => "heading"
				),

				array(
					"title" 			=> __("Usage of Featured Images",'rt_theme_admin'), 
					"description"		=> __("You can upload unlimited images for each portfolio item by using <strong>\"".THEMENAME." Featured Images\"</strong> and decide how show to display them in single portfolio pages.",'rt_theme_admin'),
					"name"			=> "_featured_image_usage",
					"options" 		=>  array(
										"slider" 		=> "Display the featued images as a slide show", 
										"gallery" 	=> "Display the featuted images as a photo gallery"
									 ),
					"type" 			=> "select",				
					"hr"				=> "true"
				),


				array(
					"name"			=> "_portfolio_video",
					"title"			=> __("Portfolio Video",'rt_theme_admin'),
					"description"		=> __("Paste the url of a video from vimeo or youtube",'rt_theme_admin'),					
					"type"			=> "text",
					"hr"				=> "true",
				),

	
				array(
					"name"			=> "_portfolio_thumb_image",
					"title"			=> __("Alternate thumbnail image for the portfolio item",'rt_theme_admin'),
					"description"		=> __("If you want to use another image file for the thumbnails, you use this field.",'rt_theme_admin'),
					"type"			=> "upload"
				),

  				array(
					"title"			 => __("PROJECT NOTES",'rt_theme_admin'), 
					"type"			 => "heading"
				),

				array(
					"name"			=> "_project_info_title",
					"title"			=> __("Project Info Box Title",'rt_theme_admin'), 				
					"type"			=> "text",
					"defatult"		=> __("Project Notes",'rt_theme_admin'),
					"hr"				=> "true",
				),

				array(
					"name"			=> "_project_info",
					"title"			=> __("Key details about this project",'rt_theme_admin'),
					"description"		=> "",
					"type"			=> "textarea"
				) 


);

$settings  = array( 
	"name"		=> THEMENAME ." Portfolio Options",
	"scope"		=> "portfolio",
	"slug"		=> "portfolio_cutom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);