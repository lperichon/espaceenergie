<?php
#-----------------------------------------
#	RT-Theme post_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Post Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(

	array(
		"title" 			=> __("Featured Image Position",'rt_theme_admin'), 
		"name"			=> "featured_image_position",
		"options" 		=>  array(
							"center" 		=> "Stand alone", 
							"left" 		=> "Left aligned",
							"right" 		=> "Right aligned",
						 ),
		"select" 			=> __("Select",'rt_theme_admin'),
		"type" 			=> "select"
	), 


	array(
		"title" 			=> __("RESIZE AND CROP",'rt_theme_admin'),
		"type" 			=> "heading"
	),


	array(
		"title" 			=> __("Resize Featured Images",'rt_theme_admin'),
		"name"			=> "blog_image_resize",
		"description" 		=> __("Your featured image will be resized for the content. You can control the resize process with the features below.",'rt_theme_admin'),
		"default" 		=> "on",
		"hr" 			=> "true",
		"type" 			=> "checkbox"
	),
	
	array(
		"title" 			=> __("Featured Image Width",'rt_theme_admin'),
		"name" 			=> "blog_image_width",
		"description" 		=> __("The feautured image will be resized to fit the content area if the the resize feature is ON. You can set a maximum width value for the image or leave as \"0\" to use default values.",'rt_theme_admin'),
		"hr" 			=> "true",
		"min"			=> "0",
		"max"			=> "924",
		"default"			=> "0",
		"type" 			=> "rangeinput"
	),

	array(
		"title" 			=> __("Featured Image Heght",'rt_theme_admin'),
		"name" 			=> "blog_image_height",
		"description" 		=> __("You can change set a maximum height value for the featured image. As default the height value is not defined (0) and the image height will be automatically scaled. ",'rt_theme_admin'),
		"hr" 			=> "true",
		"min"			=> "0",
		"max"			=> "700",
		"default"			=> "0",
		"type" 			=> "rangeinput"
	),
	 
	array(
		"title" 			=> __("Crop Featured Images.",'rt_theme_admin'),
		"name"			=> "blog_image_crop",
		"description" 		=> __('If you turn on the crop feature, the image will be cropped as the width and the height values. "Resize Featured Images" must be ON!','rt_theme_admin'),
		"default" 		=> "on",
		"hr" 			=> "true",
		"type" 			=> "checkbox"
	),
 
	array(
		"title" 			=> __("Use Same Settings for Single Post Page",'rt_theme_admin'),
		"name"			=> "featured_image_in_single_post_page",
		"description" 		=> __('As default, the featured image will be displayed with 100% width but you can use the same settings above to customize it.','rt_theme_admin'),
		"default" 		=> "on",
		"hr" 			=> "true",
		"type" 			=> "checkbox"
	),

	
	//hidden value
	array(
		"name"			=> "is_old_post",  
		"type"			=> "hidden",
		"statical_value"	=> "1"
	),		
	 
);

$settings  = array( 
	"name"		=> THEMENAME ." Standart Post Format Options",
	"scope"		=> array('post'),
	"slug"		=> "rt_standart_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);

 

$customFields = array(
 
	array(
		"title" 			=> __("Video Url for Video format posts",'rt_theme_admin'), 
		"name"			=> "video_url",
		"description" 		=> __("paste a video URL from YouTube or Vimeo. Select the Video options from the list on the \"Format\" box to use this feature.",'rt_theme_admin'),
		"type" 			=> "text"
	),
 
);

$settings  = array( 
	"name"		=> __(THEMENAME ." Video Post Format Options",'rt_theme_admin'),
	"scope"		=> array('post'),
	"slug"		=> "rt_video_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);






$customFields = array(
  
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
		"title" 			=> __("Displaying Gallery Images in Listing Pages",'rt_theme_admin'), 
		"name"			=> "_display_gallery_images",
		"options" 		=>  array(							
							"same" 					=> "Display the gallery same as single post page", 							
							"only_featured_image" 		=> "Display only first image as featured image",
							"no_image" 				=> "Don't display gallery in listing pages", 
						 ),
		"type" 			=> "select"	
	),

	array(
		"title" 			=> __("SLIDESHOW OPTIONS",'rt_theme_admin'),
		"type" 			=> "heading"
	),

	array(
		"title" 			=> __("Crop Images in the Slideshow",'rt_theme_admin'),
		"name" 			=> "gallery_images_crop",
		"default" 		=> "on",
		"hr" 			=> "true",
		"hr"				=> true,
		"type" 			=> "checkbox"
	),
			
	array(
		"title" 			=> __("Maximum Image Heght",'rt_theme_admin'),
		"name" 			=> "gallery_images_height",
		"description"		=> __('You can use this option if the "Crop Gallery Images" feature is on','rt_theme_admin'),
		"min"			=>"60",
		"max"			=>"400",
		"default"			=>"300",
		"type" 			=> "rangeinput"
	), 

	array(
		"title" 			=> __("PHOTO GALLERY OPTIONS",'rt_theme_admin'),
		"type" 			=> "heading"
	),

	array(
		"title" 			=> __("Image Width",'rt_theme_admin'),
		"name" 			=> "photo_gallery_images_width",
		"description"		=> __('You can use this option if the "Crop Gallery Images" feature is on','rt_theme_admin'),
		"min"			=>"60",
		"max"			=>"1000",
		"default"			=>"160",
		"type" 			=> "rangeinput"
	),

	array(
		"title" 			=> __("Image Heght",'rt_theme_admin'),
		"name" 			=> "photo_gallery_images_height",
		"description"		=> __('You can use this option if the "Crop Gallery Images" feature is on','rt_theme_admin'),
		"min"			=>"60",
		"max"			=>"1000",
		"default"			=>"160",
		"type" 			=> "rangeinput"
	), 
 
);

$settings  = array( 
	"name"		=> THEMENAME ." Gallery Post Format Options",
	"scope"		=> array('post'),
	"slug"		=> "rt_gallery_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);
 


$customFields = array(
   
	
	array(
		"name"			=> "post_format_link",
		"title"			=> __("URL",'rt_theme_admin'),
		"description"		=> __("Write an URL for the link post type.",'rt_theme_admin'),
		"type"			=> "text" 
	),	 

	 
);

$settings  = array( 
	"name"		=> THEMENAME ." Link Post Format Options",
	"scope"		=> array('post'),
	"slug"		=> "rt_link_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);
?>