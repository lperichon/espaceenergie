<?php
# 
# rt-theme single portfolio page
#

//taxonomy
$taxonomy = 'portfolio_categories';

//page link
$link_page=get_permalink(get_option('rttheme_portf_page'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat		= get_term_link($taxitem->slug,$taxonomy);
		$term_slug 	= $taxitem->slug;
		$term_id 		= $taxitem->term_id;    
		}
	$i++;
	}
} 

// portfolio crop image
$crop 	= 	get_option(THEMESLUG.'_portfolio_image_crop');

// page layout - sidebar
$sidebar 	= 	(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : get_option(THEMESLUG."_sidebar_position_portfolio");

//varialbles
$video_width 		= ($content_width 	=="960") ? 940 : 606; 
$video_height 		= ($content_width 	=="960") ? 500 : 380;

get_header();
 
//call sub page header
get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

//call the sub content holder 1st part
sub_page_layout("subheader",$sidebar);

?>
<div class="box portfolio one box-shadow <?php if($emptyContent=="true") echo "margin-b30"; ?>">
	<!-- page title --> 
	<?php if(!is_front_page() && !is_blog_page()):?>
		<!-- page title -->
		<div class="head_text <?php if(@$emptyContent=="true") echo "nomargin"; ?>">
			<div class="arrow"></div><!-- arrow -->
			<h2><?php the_title(); ?></h2>
		</div>
		<!-- /page title -->
	<?php endif;?>
 
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
				<?php 
				
				// Values
				$title 					=	get_the_title();
				$video 					=	get_post_meta($post->ID, 'rttheme_portfolio_video', true);
				$video_thumbnail 		=	get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true); 
				$desc 					=	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
				$permalink	 			=	get_permalink();
				$remove_link	 		= 	get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
				$custom_thumb			= 	get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);
				$project_info			= 	get_post_meta($post->ID, 'rttheme_project_info', true);
				$featured_image_usage	= 	get_post_meta($post->ID, 'rttheme_featured_image_usage', true);	

				//project key details to add before sidebar
				if(trim($project_info)){
					$before_sidebar		 = '<div class="box first box-shadow box_layout widget project_notes">';
					$before_sidebar		.= '<div class="head_text nomargin"><div class="arrow"></div><h4>';
					$before_sidebar		.= get_post_meta($post->ID, 'rttheme_project_info_title', true);;
					$before_sidebar		.= '</h4><div class="space margin-b10"></div></div>';
					$before_sidebar 		.=  apply_filters('the_content',(str_replace("<ul", '<ul class="check"', $project_info)));
					$before_sidebar		.= '</div>';
				}else{$before_sidebar="";}

				//next and previous links
				if(get_option(THEMESLUG.'_hide_portfolio_navigation')){
	
					$prev = mod_get_adjacent_post(true,true,'', 'portfolio_categories','date');
					$next = mod_get_adjacent_post(true,false,'', 'portfolio_categories','date');
					$prev_post_link_url 	= ($prev) ? get_permalink( $prev->ID ) : "";
					$next_post_link_url 	= ($next) ? get_permalink( $next->ID ) : "";

					$next_post_link	 	= ($next_post_link_url) ? '<a href="'.$next_post_link_url.'" title="" class="p_next"><span>'.__( 'Next →', 'rt_theme').'</span></a>' : false ;
					$prev_post_link	 	= ($prev_post_link_url) ? '<a href="'.$prev_post_link_url.'" title="" class="p_prev"><span>'.__( '← Previous', 'rt_theme').'</span></a>': false ;				 
					$add_class			= ($prev_post_link==false) ? "single" : ""; // if previous link is empty add class to fix white border
					$before_sidebar		.= ($next_post_link || $prev_post_link) ? '<div class="post-navigations  margin-b20 '.$add_class.'">'.$prev_post_link. '' .$next_post_link.'</div>' : "";
				}

				$crop = ($crop) ? true : false;

				$w=($sidebar=="full") ? 940 :606;				 
				$h= ($crop) ? 400 : 10000;
				
				// Resize Portfolio Image
				if($image) $image_thumb = @vt_resize( '', $image, $w, $h, $crop);
				
				// Resize Video Image
				if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, 999, '' );
				
				
				// Getting image type
				if ($video) {
					$button="play";
					$media_link= $video;
				} else {
					$media_link= $image;
					$button="magnifier";
				}
				?>

				<?php if (($image || $video_thumbnail || $custom_thumb) && !$video):?>
				<!-- portfolio image -->  
					<?php if($media_link):?><a href="<?php echo $media_link;?>" title="<?php echo $title; ?>" data-gal="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>
						
						<?php if($custom_thumb)://auto resize not active?>
						    <img src="<?php echo $custom_thumb;?>" alt="<?php echo $title; ?>" class="portfolio_image" />
						<?php elseif($video_thumbnail):?>
						    <img src="<?php echo $video_thumbnail["url"];?>" alt="<?php echo $title;?>" class="portfolio_image" />	    
						<?php else:?>
						    <img src="<?php echo $image_thumb["url"];?>" alt="<?php echo $title;?>" class="portfolio_image" />
						<?php endif;?>
		
					<?php if($media_link):?></a><?php endif;?> 
				<div class="space margin-t20"></div>
				<!-- / portfolio image -->		
				<?php endif;?>

				<?php
				#
				#	gallery
				# 
				$rt_gallery_images 			= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
				$rt_gallery_image_titles 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
				$rt_gallery_image_descs 		= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );
				$gallery_list = "";

				if(is_array($rt_gallery_images) && $featured_image_usage=="slider"){ 
 
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_image_resized 		 = vt_resize("" , trim($rt_gallery_images[$i]) , $w, 100000, false);
								$gallery_list				.= "<li>";
								$gallery_list				.= '<a class="imgeffect magnifier" href="'.$rt_gallery_images[$i].'"  data-gal="prettyPhoto[rt_theme_portfolio]"><img src="'.$gallery_image_resized['url'].'" alt="'.$rt_gallery_image_titles[$i].'" /></a>';
								
								if($rt_gallery_image_titles[$i] || $rt_gallery_image_descs[$i]){
									$gallery_list			.= '<div class="flex-caption"><div class="desc-background">';
									if($rt_gallery_image_titles[$i])	$gallery_list			.= '<h5>'.$rt_gallery_image_titles[$i].'</h5>';
									if($rt_gallery_image_descs[$i])	$gallery_list			.= '<p>'.$rt_gallery_image_descs[$i].'</p>';
									$gallery_list			.= '</div></div></li>';								
								}
						} 
			 
					echo '<div class="flex-container post_gallery"><div class="flexslider slider-for-blog-posts"><ul class="slides">'.$gallery_list.'</ul></div></div> ';  
					echo '<div class="space margin-t20"></div>';
				}

 
				if(is_array($rt_gallery_images) && $featured_image_usage=="gallery"){ 
 
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_list		.= '[image thumb_width="160" thumb_height="160" lightbox="true" custom_link="" title="'.$rt_gallery_image_titles[$i].'" caption="'.$rt_gallery_image_descs[$i].'"]'.$rt_gallery_images[$i].'[/image]'; 
						} 
			 
 
					$gallery_list  =  '[photo_gallery]'.$gallery_list.'[/photo_gallery]';
 
					echo apply_filters('the_content',($gallery_list)); 

				}
				?>
				
				
			<?php
			if ($video){
				 
				if( strpos($media_link, 'youtube')  ) { //youtube
					echo '<iframe  width="100%" height="'.$video_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($media_link).'" frameborder="0" allowfullscreen></iframe>';
				}
				
				if( strpos($media_link, 'vimeo')  ) { //vimeo
					echo '<iframe  src="http://player.vimeo.com/video/'.find_tube_video_id($media_link).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="100%" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
				
				echo '<div class="space margin-t20"></div>';
			}
			?>
							
		 
			<?php the_content(); ?>
				
			<?php endwhile;?>
			
			<?php
					if($sidebar=="full"){
						echo $before_sidebar;
					}
			?>
		
			<div class="clear"></div> 

			 
			
			<?php  
			 if(get_option( THEMESLUG.'_portfolio_comments') && comments_open()):?>
				<div class='entry commententry'>
					<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
				    <?php comments_template(); ?>
				</div>
			<?php endif;?>
		  
			<?php else: ?>
				<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
			<?php endif; ?>
 </div>
<div class="space margin-b30"></div>
<?php
//call the sub content holder 2nd part
sub_page_layout("subfooter",$sidebar);

get_footer();
?> 