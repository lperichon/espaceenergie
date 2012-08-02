<?php
/* 
* rt-theme slider
*/
global $slides, $rttheme_slider_height, $crop_slider_images, $resize_slider_images,$slider_effect,$slider_timeout,$slider_buttons,$group_id,$sidebar,$this_item_layout,$rttheme_slider_width,$boxNumber,$logo_container;

#
#	uniqueness
#
$slider_unique_name 	= $group_id."_slider";
$slider_buttons_name 	= $group_id."_slider_buttons";

#
#	slider heights
#
 
$css 		= ($boxNumber != 1) ? 'style="top:0px !important;margin:0 auto !important;"' : "";
$theme_uri 	= THEMEURI;

echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */
 
		// Flex Slider and Helper Functions
		jQuery(window).load(function() {
		  jQuery('#$slider_unique_name').flexslider({
			   animation: "fade",
			   slideshowSpeed:$slider_timeout*1000,
			   controlsContainer: ".flex-nav-container",
			   smoothHeight: true,
			   directionNav: false,
			   after: onAfter,
			   before: onBefore
		  });
		});

	/* ]]> */	
	</script>
SCRIPT;
?>


<!-- slider area -->	
<div class="slider_area box-shadow  <?php if(!$logo_container) echo "no-logo-container";?>" <?php echo $css;?>>
	<div class="slider"> 

		<div class="flex-container">
		  <div class="flexslider" id="<?php echo $slider_unique_name;?>">
		    <ul class="slides">


				<?php
				query_posts($slides); 

				$slider_image_width		= ($resize_slider_images) ? ($sidebar=="full" ) ? 940 : 668 : 100000; //kwicks max slide width
				$slider_image_height	= ($resize_slider_images && $crop_slider_images) ? $rttheme_slider_height : 100000; 		
				$background_images		= "";
				
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				
				$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
				$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
				$title = get_the_title();
				$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
				$thumb = get_post_thumbnail_id(); 
				$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );		  
				?>
				


			      <li>
	    			
	    			<!-- slide image -->
					<img src="<?php echo $image["url"];?>" alt="<?php echo $title; ?>" />
					<!-- /slide image -->

			        <?php if($hide_title_and_text):?>
			        <div class="flex-caption">
			        	<div class="desc-background">
				        	<h3>
	 							<?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
									<?php echo $title; ?>
							    <?php if($custom_link):?></a><?php endif;?>
				        	</h3>
						    <!-- slide text -->
						    <?php echo $slide_text; ?>
			        	</div>
			        </div>
			        <?php endif;?> 

		      </li> 
		      <?php endwhile;endif;?> 
		    </ul>
		  </div>
		</div> 

		<?php if($slider_buttons):?>
			<!-- slider buttons -->
			<div class="flex-nav-container"></div>
		<?php endif;?>

	</div>
</div><!-- / end div #slider_area -->  
<?php wp_reset_query();?> 