<?php
#
#	check info bar
#

if(!is_front_page() && ( get_option('rttheme_breadcrumb_menus') || get_option(THEMESLUG.'_show_search') )){
	$info_bar = TRUE;
}else{$info_bar = FALSE;}



#
#	Header Background image and code space
#
global $logo_container;
$disable_header_image = @get_post_meta( $post->ID, THEMESLUG . "_disable_header_image", true ); //current content
$header_background_image = "";
$header_text = "";

if(!$disable_header_image){
	// meta values for current post
	$header_background_image = @get_post_meta( $post->ID, THEMESLUG . "_header_background_image", true );
	$header_text = @get_post_meta( $post->ID, THEMESLUG . "_header_text", true );
	
	// if meta values are blank use default options 
	if(!$header_background_image && !$header_text){
		$header_background_image = @get_option( THEMESLUG . "_header_background_image");
		$header_text = @get_option( THEMESLUG . "_header_text");
	}
}
?>
<?php if(trim($header_text) || $header_background_image):?>
<!-- sub page header-->	

<?php if($info_bar):?><div id="sub_page_header" class="content-<?php echo $post->ID;?>
	<?php if(!$logo_container) echo "no-logo-container";?>">
<?php else:?>
<div id="sub_page_header" style="margin-top:-30px;" class="content-<?php echo $post->ID;?> box-shadow  <?php if(!$logo_container) echo "no-logo-container";?>">
<?php endif;?>

		<?php if(trim($header_text))?><div class="header_overlay_text <?php if(!$header_background_image) echo "single";?>"><?php echo do_shortcode($header_text);?></div>
		<?php if($header_background_image)?><div class="image_holder"><img src="<?php echo $header_background_image;?>" alt=""></div> 
</div><!-- / end div #sub_page_header -->

<?php if(!$info_bar):?><div class="space margin-b30"></div><?php endif;?>

<?php endif;?>
 

<?php if($info_bar):?>
<!-- sub page header-->	
<div id="info_bar" class="box-shadow-inset"> 
	
	<!-- breadcrumb menu -->
	<?php rt_breadcrumb(); ?>
	<!-- / breadcrumb menu -->
	
	<?php if(get_option(THEMESLUG.'_show_search')):?>
	<!-- search -->
	<div class="search-bar">
		<form action="<?php echo wpml_get_home_url(); ?>/" method="get" class="showtextback">
			<fieldset>
				<input type="image" src="<?php echo THEMEURI; ?>/images/pixel.gif" class="searchsubmit" alt="<?php _e('Search','rt_theme');?>" />
				<input type="text" class="search_text showtextback" name="s" id="s" value="<?php _e('Search','rt_theme');?>" />							
			</fieldset>
		</form>
	</div>
	<!-- / search-->
	<?php endif;?>
	
		
</div><!-- / end div #sub_page_heaber -->
<div class="space margin-b30"></div> 
<?php endif;?>