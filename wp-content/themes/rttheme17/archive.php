<?php
/* 
* rt-theme archive 
*/

//site part
$sidebar   = get_option(THEMESLUG.'_sidebar_position_blog');
#
#	Content Width 
#
$content_width = ($sidebar=="full") ? 960 : 710; 

get_header();
$category = get_category_by_slug(get_query_var("category_name"));  
	
	//call sub page header
	get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

	//call the sub content holder 1st part
	sub_page_layout("subheader",$sidebar); 
	//call the posts 
	get_template_part( 'loop', 'archive' );


	//call the sub content holder 2nd part
	sub_page_layout("subfooter",$sidebar); 
?>
	<div class="space margin-b20"></div>
<?php
  get_footer(); 
?>