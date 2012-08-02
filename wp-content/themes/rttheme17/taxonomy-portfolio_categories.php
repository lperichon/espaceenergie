<?php
# 
# rt-theme portfolio list
#

$taxonomy		= 'portfolio_categories';
$term_slug	= get_query_var('term');
$term 		= get_term_by( 'slug', $term_slug, $taxonomy, 'true', '' );
$term_id 		= $term->term_id; 

get_header();
 
#
# page layout - sidebar
#
$sidebar 	= 	get_option(THEMESLUG."_sidebar_position_portfolio");

#
# content width
#
$content_width = ($sidebar=="full") ? 960 : 710;

#
#	call sub page header
#
get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

#
#	call the sub content holder 1st part
#
sub_page_layout("subheader",$sidebar);
?>
 
 	<!-- page title --> 
	<?php if(!is_front_page()):?>
		<!-- page title -->
		<div class="box box-shadow one margin-b30">
		<div class="head_text nomargin">
			<div class="arrow"></div><!-- arrow -->
			<h2><?php echo $term->name;?></h2>
		</div>
		</div>
		<!-- /page title -->
	<?php endif;?>

		<?php if($term->description):?>
		<!-- Category Description -->
		<div class="box box-shadow one margin-b30 padding-b0">
		<?php  echo apply_filters('the_content',($term->description));?> 
		</div><div class="clear"></div>
		<?php endif;?>		

		<!-- Start Porfolio Items -->
		<?php
			//page
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			//taxonomy

			$args=array( 
				'post_status'=> 'publish',
				'orderby'=> get_option('rttheme_portf_list_orderby'),
				'order'=> get_option('rttheme_portf_list_order')
			);		
		?>
		<?php get_template_part( 'portfolio_loop', 'portfolio_categories' );?>
		<!-- End Porfolio Items -->
 		<div class="space margin-b30"></div> 
<?php
#
#	call the sub content holder 2nd part
#
sub_page_layout("subfooter",$sidebar); 

get_footer();
?>