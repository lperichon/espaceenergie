<?php
# 
# rt-theme loop
#
global $args,$content_width,$paged;

add_filter('excerpt_more', 'no_excerpt_more'); 
 
//varialbles
$video_width 		= ($content_width 	=="960") ? 940 : 606; 
$video_height 		= ($content_width 	=="960") ? 500 : 380;
$image_width 		= ($content_width 	=="960") ? 940 : 606; 
$image_height		= ($content_width 	=="960") ? 500 : 380;

if ($args) $theQuery = query_posts($args);

//get page & post counts
$page_count = get_page_count();
$post_count = $page_count['post_count']; 
$postCount  = 0;

$hide_author = get_option(THEMESLUG.'_hide_author');
$hide_categories = get_option(THEMESLUG.'_hide_categories');
$hide_dates = get_option(THEMESLUG.'_hide_dates');
$hide_commnent_numbers = get_option(THEMESLUG.'_hide_commnent_numbers');
$show_small_dates= get_option(THEMESLUG.'_show_small_dates');
$date_format = get_option('rttheme_date_format');
if ( have_posts() ) : while ( have_posts() ) : the_post();
?> 


	<?php 
	#
	#	featured images
	#
	$rt_gallery_images 			= (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true ) : "";
	$rt_gallery_image_titles 	= (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true ) : "";
	$rt_gallery_image_descs 		= (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true ) : "";
	$fist_featured_image		= (is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
	$resize 					= (get_post_meta($post->ID, THEMESLUG.'blog_image_resize', true)) ? true : false;
	$is_old_post	 			= (get_post_meta($post->ID, THEMESLUG.'is_old_post', true)=="1") ? false : true; 
	$crop 					= (get_post_meta($post->ID, THEMESLUG.'blog_image_crop', true)) ? true : false; 
	$width 					= (get_post_meta($post->ID, THEMESLUG.'blog_image_width', true)) ? get_post_meta($post->ID, THEMESLUG.'blog_image_width', true) : $image_width;
	$meta_height 				= get_post_meta($post->ID, THEMESLUG.'blog_image_height', true);
	$height 					= (!$meta_height && !$crop) ? 10000 : (($meta_height && !$crop) ? $meta_height : ($meta_height && $crop) ? $meta_height : $image_height); 
	$img_position 				= (get_post_meta($post->ID, THEMESLUG.'featured_image_position', true)) ? get_post_meta($post->ID, THEMESLUG.'featured_image_position', true): "center";
	$post_class_img			= "featured_image_".$img_position;
	$featured_image_usage		= get_post_meta($post->ID, THEMESLUG .'_featured_image_usage', true);	
	$display_gallery_images		= get_post_meta($post->ID, THEMESLUG .'_display_gallery_images', true);		
	$post_format 				= !get_post_format() ? "post" : get_post_format();
	$photo_gallery_images_width	= (get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_width", true )) ? get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_width", true ) : 160;
	$photo_gallery_images_height	= (get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_height", true )) ? get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_height", true ) : 160;
	$imageURL 				= "";

	if($is_old_post && !$resize) $resize = true; //activate resizer for old posts
	
	//standart post types
	if($post_format == "post"){ 
		if($fist_featured_image && $resize) { // if resize is on
			$image = @vt_resize('', $fist_featured_image, $width, $height, $crop );
			$imageURL = $image["url"];
		}else{
			$imageURL = $fist_featured_image;
		}	 
	} 


	//gallery post types
	if($post_format == "gallery"){
			$imageURL = $fist_featured_image;
	}

	#
	#	post formats
	#	
	//post format images
	switch($post_format)
	{
		case 'gallery'; 	$post_format_image = "images.png";  	break;
		case 'aside'; 		$post_format_image = "post.png";  		break;
		case 'link'; 		$post_format_image = "link.png";  		break;
		case 'quote'; 		$post_format_image = "comment.png";  	break;
		case 'video'; 		$post_format_image = "video.png"; 		break;			
		default; 			$post_format_image = "post.png";  		break;
	}

	$post_format_image = THEMEURI.'/images/assets/icons/'.$post_format_image;
	?>
		
		<?php
		#
		#	link
		#
		if($post_format=="link"){
			$link 			= get_post_meta($post->ID, THEMESLUG.'post_format_link', true);
			$link_html  	= '<span class="post_url"><a href="'.$link.'" target="_new" title="'.get_the_title().'">'.$link.'</a></span>';
		}else{$link_html=false;}
		?>

			

		<!-- blog box-->
		<div id="post-<?php the_ID(); ?>" <?php post_class('box one blog loop blog_list box-shadow '.$post_class_img.''); ?>>
			
			<div class="blog-head-line <?php if($post_format=="link") echo "link";?> clearfix">	
	
				<?php if(!$hide_dates):?>
				<!-- post date -->
				<div class="date">
					<span class="day"><?php the_time("d") ?></span>
					<span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span> 
				</div>

				<div class="mobile-date"><?php the_time($date_format) ?></div>
				<!-- / end div .date -->
				<?php endif;?>
		 				
		 		<div class="post-title-holder">
					<!-- blog headline-->
					<h2><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
					<!-- / blog headline--> 

					<!-- post data -->
					<div class="post_data">
						
						<?php if($post_format=="link"):?>
							<?php echo $link_html;?>
						<?php else:?>
							<!-- post data -->
							<?php if($show_small_dates):?><span class="small_date"><?php the_time($date_format); ?></span><?php endif;?>
							<?php if(!$hide_author):?><span class="user margin-right20"><?php the_author_posts_link();?></span><?php endif;?>
							<?php if(!$hide_categories):?><span class="categories"><?php the_category(', ');?></span><?php endif;?>
							<?php if(!$hide_commnent_numbers):?>
							<span class="comment_link"><a href="<?php comments_link(); ?>" title="<?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?>" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a></span>
							<?php endif;?>
						<?php endif;?>

					</div><!-- / end div  .post_data -->

				</div><!-- / end div  .post-title-holder -->	 
			</div><!-- / end div  .blog-head-line -->	



			<?php
			#
			#	gallery
			#
			if($display_gallery_images == "same" && $post_format == "gallery"){
				//resize the photo 
				$gallery_crop			= (get_post_meta($post->ID, THEMESLUG.'gallery_images_crop', true)) ? true : false;
				$gallery_images_height	= get_post_meta($post->ID, THEMESLUG.'gallery_images_height', true);
				$gallery_w			= $image_width;  
				$gallery_h			= ($gallery_crop) ? $gallery_images_height:10000;
				$gallery_list			= "";			 								
  
				
				//slider option
				if(is_array($rt_gallery_images) && $featured_image_usage=="slider"){ 
 
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_image_resized 		 = vt_resize("" , trim($rt_gallery_images[$i]) ,$gallery_w, $gallery_h, $gallery_crop);
								$gallery_list				.= "<li>";
								$gallery_list				.= '<a href="'.get_permalink().'"><img src="'.$gallery_image_resized['url'].'" alt="'.$rt_gallery_image_titles[$i].'" /></a>';
								
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

				//gallery option 
				if(is_array($rt_gallery_images) && $featured_image_usage=="gallery"){  
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_list		.= '[image thumb_width="'.$photo_gallery_images_width.'" thumb_height="'.$photo_gallery_images_height.'" lightbox="true" custom_link="" title="'.$rt_gallery_image_titles[$i].'" caption="'.$rt_gallery_image_descs[$i].'"]'.$rt_gallery_images[$i].'[/image]'; 
						}  
					$gallery_list  =  '[photo_gallery]'.$gallery_list.'[/photo_gallery]'; 
					echo apply_filters('the_content',($gallery_list)); 

				}
			}
			?>

			<?php
			#
			#	Standart post featured image
			#	
			if (	$fist_featured_image &&  ($post_format == "post" 	|| ($display_gallery_images == "only_featured_image"  && $post_format == "gallery"))):?>
				<!-- blog image--> 
				    <a href="<?php echo get_permalink() ?>" title="<?php echo $rt_gallery_image_titles[0]; ?>" class="imgeffect link align<?php echo $img_position;?>">
					   <img src="<?php echo $imageURL;?>" class="featured_image" alt="<?php echo $rt_gallery_image_descs[0]; ?>" />
				    </a>  
				<!-- / blog image -->
				
				<?php if($img_position=="center"):?>
					<div class="space margin-t20"></div> 
				<?php endif;?> 
			<?php endif;?>		 

			<?php
			#
			#	video
			#
			$video_url = get_post_meta($post->ID, THEMESLUG.'video_url', true);
			if ($video_url){
				 
				if( strpos($video_url, 'youtube')  ) { //youtube
					echo '<iframe  width="100%" height="'.$video_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($video_url).'" frameborder="0" allowfullscreen></iframe>';
				}
				
				if( strpos($video_url, 'vimeo')  ) { //vimeo
					echo '<iframe  src="http://player.vimeo.com/video/'.find_tube_video_id($video_url).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="100%" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
				
				echo '<div class="space margin-t20"></div>';
			}
			?>

			<?php if(get_the_excerpt()):?>

				<?php if($post_format=="link"):?><div class="space margin-b20"></div><?php endif;?>
			<!-- blog text-->
				<?php
				if(!empty($post->post_content)): $link=' <a href="'. get_permalink($post->ID) . ' " class="read_more" >'.__('read more →','rt_theme').'</a>';endif;			    
				echo wpautop(do_shortcode(get_the_excerpt().$link));			
				?> 
			<!-- /blog text-->
			<?php endif;?>		


			<?php if($img_position!="center"):?><div class="space margin-t10"></div><?php endif;?>
 
			</div> <!-- / blog box-->	 
			
			<?php
			//add space until last item
			if(intval($post_count)-1 != $postCount++) echo '<div class="space margin-b30"></div>';
			?>
			
    
<?php endwhile; ?> 

		
<?php
//get page and post counts
$page_count=get_page_count();
?>

<?php if($page_count['page_count']>1 && $paged):?> 
	<div class="space margin-b30"></div>
	<!-- paging-->
	<div class="paging_wrapper clearfix">
		<ul class="paging">
			<?php get_pagination(); ?>
		</ul>
	</div>			
<?php endif;?>

<?php wp_reset_query();?>

<?php else: ?> 
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'rt_theme'); ?></p> 
<?php endif; ?>
