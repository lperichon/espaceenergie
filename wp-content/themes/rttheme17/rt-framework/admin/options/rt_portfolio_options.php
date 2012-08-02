<?php

$options = array (


			array(
			"name"    => __("Info",'rt_theme_admin'),
			"desc"    => __('If you would like to have more control on how to display your portfolio items, customize "<a href="admin.php?page=rt_template_options">Default Portfolio Template</a>" or create a new one according your preferences. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Create Portfolio" steps.','rt_theme_admin'),
			"type"    => "info"),

			array(
					"name" => __("PORTFOLIO CATEGORIES",'rt_theme_admin'), 
					"type" => "heading"),				   			
			array(
					"name"    => __("Layout",'rt_theme_admin'),
					"desc"    => __("Select the layout of products list pages. i.e., box width for each portfoli item.",'rt_theme_admin'),
					"id"      => THEMESLUG."_portfolio_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ),
					"hr"      => true,					
					"default" => "3", 
					"type"    => "select"),
			
			array(
					"name"    => __("Amount of portfolio item per page",'rt_theme_admin'),
					"desc"    => __("How many item do you want to display per page?",'rt_theme_admin'),
					"id"      => THEMESLUG."_portf_pager",
					"min"     => "1",
					"max"     => "200",
					"default" => "9",
					"hr"      => true,
					"type"    => "rangeinput"
				),
	
			array(
					"name"    => __("OrderBy Parameter",'rt_theme_admin'),
					"desc"    => __("sort your portfolio item by this parameter",'rt_theme_admin'),
					"id"      => THEMESLUG."_portf_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
					"hr"      => true,
					"default" => "date",
					"type"    => "select"
				),
	
			array(
					"name"    => __("Order",'rt_theme_admin'),
					"desc"    => __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
					"id"      => THEMESLUG."_portf_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default" => "DESC",
					"hr"      => true,					
					"type"    => "select"
				),
			
			array(
					"name"    => __("Crop Portfolio Images.",'rt_theme_admin'),
					"id"      => THEMESLUG."_portfolio_image_crop",
					"desc"    => __("If you turn on the crop feature, the image will be cropped as the width and the height values.",'rt_theme_admin'),
					"default" => "on",
					"type"    => "checkbox"
				),
			
			array(
					"name" => __("COMMENTS",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Show Comments in Single Portfolio Pages",'rt_theme_admin'),
					"id"      => THEMESLUG."_portfolio_comments",
					"default" => "",
					"type"    => "checkbox"
				),

			array(
					"name" => __("POST NAVIGATION",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Show Previous / Next post navigation from single portfolio items",'rt_theme_admin'),
					"id"      => THEMESLUG."_hide_portfolio_navigation",
					"default" => "on",
					"type"    => "checkbox"
				),

			array(
					"name" => __("PERMALINKS",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Category Slug",'rt_theme_admin'),
					"desc"    => __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id"      => THEMESLUG."_portfolio_category_slug",
					"default" => "portfolios",
					"help"    => "true",
					"type"    => "text",
					"hr"      => "true"
				),

			array(
					"name"    => __("Single Portflio Slug",'rt_theme_admin'),
					"desc"    => __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id"      => THEMESLUG."_portfolio_single_slug",
					"help"    => "true",
					"default" => "portfolio",
					"type"    => "text"
				),

			array(
					"name" => __("SIDEBAR OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),
  
			array(
					"name"    => __("Default Sidebar Position for Portfolio",'rt_theme_admin'),
					"desc"    => __("Select a default sidebar position for portfolio related contents.",'rt_theme_admin'),
					"id"      => THEMESLUG."_sidebar_position_portfolio",
					"select"  => __("Select",'rt_theme_admin'),
					"options" =>  array(
									"right"   => 	"Content + Right Sidebar", 
									"left"    => 	"Content + Left Sidebar",
									"full"    => 	"Full Width - No Sidebar",
									),
					"hr"      => true,
					"type"    => "select"),				
		); 
?>