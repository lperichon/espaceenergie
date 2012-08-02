<?php
/* RT-Theme Shortcodes */ 


/*using shortcodes in widgets*/

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//shortcodes  
	 


/*
* ------------------------------------------------- *
*		Widget Caller
* ------------------------------------------------- *
*/
function rt_widget_caller($atts, $content = null){
//[widget_caller id="sidebarid_37036"]

 	//defaults
	extract(shortcode_atts(array(  
		"id" => ''
	), $atts));
	
     //check id
	if(!empty($id)){
	    dynamic_sidebar($id);
	}
	
	return $content;
 
}

add_shortcode('widget_caller', 'rt_widget_caller');

/*
* ------------------------------------------------- *
*		Fix shortcodes
* ------------------------------------------------- *
*/

function fixshortcode($content){

     //fix 
	//remove invalid p
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	
	//fix line shortcode
 	$content = preg_replace('#<p>\n<div class="line top #', '<div class="line top ', trim($content));
    $content = preg_replace('#<p>\n<div class="line"></div>\n</p>#', '<div class="line"></div>', trim($content)); 
    $content = preg_replace('#<p>\n<div class="line">#', '<div class="line">', trim($content));
    $content = preg_replace('#<p><div #', '<div ', trim($content));    
    $content = preg_replace('#</div></p> #', '</div>', trim($content));       
    $content = preg_replace('#→</a></p>#', '→</a>', trim($content));       

 
	return $content;
}
add_filter('the_content', 'fixshortcode', 99); 


/*
* ------------------------------------------------- *
*		TOOLTIP		
* ------------------------------------------------- *		
*/ 
function rt_tooltip( $atts, $content = null ) {

	//[tooltip text="" link="" target="" color="black"]content[/tooltip]
 
 	//defaults
	extract(shortcode_atts(array(  
		"text" 			=> '',
		"link"			=> '',
		"target" 			=> '',
		"color"			=> 'black'
	), $atts));
	
	$rt_tooltip	="";
	if($color =="black") $class="j_ttip2";
	if($color =="white") $class="j_ttip";
	
	if($link)		$rt_tooltip	.= '<a href="'.$link.'" target="'.$target.'" class="'.$class.' ttip" title="'.$text.'" >';
	if(!$link)	$rt_tooltip	.= '<span class="'.$class.' ttip" title="'.$text.'" >';
	
	
	$content = preg_replace('#<br />#', '', trim($content));
	
	$rt_tooltip	.= do_shortcode(fixshortcode($content));
	
	
	
	if(!$link)	$rt_tooltip	.= '</span>';	
	if($link)		$rt_tooltip	.= '</a>';
	
	return $rt_tooltip;
}

add_shortcode('tooltip', 'rt_tooltip'); 



/*
* ------------------------------------------------- *
*		SCROLL SLIDER		
* ------------------------------------------------- *		
*/ 
function rt_scroll_slider( $atts, $content = null ) {
	//[scroll_slider]
	$rt_scroll_slider='<div class="scrollable_border box-shadow"><div id="image_wrap" class="aligncenter"><img src="images/pixel.gif" class="aligncenter" /></div><div class="clear"></div><a class="prev browse _left"></a><div class="scrollable"><div class="items big_image">';
	$rt_scroll_slider .= do_shortcode(strip_tags($content));
	$rt_scroll_slider.='</div></div><a class="next browse _right"></a></div><div class="clear"></div>';
	return $rt_scroll_slider;
}

function rt_scroll_slider_lines( $atts, $content = null ) {
	//[scroll_image][/scroll_image]

	$photo=trim($content);
 
	//thumb width and height
	$thumb_width = "137";
	$thumb_height = "90";

	//big image width and height
	$big_width = "940";
	$big_height = "10000";

	// Resize Thumbnail Image
	if($photo) $image = @vt_resize( '', find_image_org_path($photo), $thumb_width, $thumb_height, 'true' );

	// Resize Big Image
	if($photo) $big_image = @vt_resize( '', find_image_org_path($photo), $big_width, $big_height, 'true' );
	
		 
	$rt_scroll_slider_lines ='<div>';
	$rt_scroll_slider_lines.='<img src="'. $image['url'] .'" alt="'. $big_image['url'] .'" />';
	$rt_scroll_slider_lines.='</div>'; 
	
	return $rt_scroll_slider_lines;
}	

add_shortcode('scroll_slider', 'rt_scroll_slider');
add_shortcode('scroll_image', 'rt_scroll_slider_lines');





/*
* ------------------------------------------------- *
*		PHOTO GALLERY		
* ------------------------------------------------- *		
*/ 
function rt_photo_gallery( $atts, $content = null ) {
	//[photo_gallery]
	$rt_photo_gallery='<div class="photo_gallery"><ul>';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='</ul><div class="clear"></div></div>';
	return $rt_photo_gallery;  
}

function rt_photo_gallery_lines( $atts, $content = null ) {
	//[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="photo title"]
	
	//defaults
	extract(shortcode_atts(array(  
		"thumb_width" 		=> '135',
		"thumb_height"		=> '135',
		"lightbox" 		=> 'true',
		"custom_link" 		=> '',
		"title"			=> '',
		"caption" 		=> '',
	), $atts)); 
	
	$rt_photo_gallery_lines ="";
	$photo=trim($content);

	//icon
	if ($lightbox!="true" && !empty($custom_link)) {
		$icon="link";
	} else {
		$icon="magnifier";
	}
	
	//width and height
	if($thumb_width=="")  $thumb_width = "135";
	if($thumb_height=="") $thumb_height = "135";
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', find_image_org_path($photo), $thumb_width, $thumb_height, 'true' );
	
	//lightbox = default is true
	if($lightbox != "false" ){ $lightbox='data-gal="prettyPhoto[rt_photo_gallery]"'; } else { $lightbox="";}
	
	//link - default is image 
	if (!$custom_link) $custom_link=trim($content);
	 
	$rt_photo_gallery_lines.='<li>';
	$rt_photo_gallery_lines.='<span class="frame">';
	$rt_photo_gallery_lines.='<a href="'.$custom_link.' " title="'.$title.'"  '.$lightbox.' class="imgeffect '.$icon.'">';
	$rt_photo_gallery_lines.='<img src="'. $image['url'] .'" alt="" />';
	$rt_photo_gallery_lines.='</a></span><span class="p_caption" style="width:'.$thumb_width.'px">'.$caption.'</span></li>'; 
	
	return $rt_photo_gallery_lines;
}	

add_shortcode('photo_gallery', 'rt_photo_gallery');
add_shortcode('image', 'rt_photo_gallery_lines');



/*
* ------------------------------------------------- *
*	Auto Thumbnails & Lightboxes	
* ------------------------------------------------- *		
*/ 
function rt_auto_thumb( $atts, $content = null ) {
	//[auto_thumb width="" height="" link="" lightbox="" align="" title="" alt="" iframe="" frame=""]
 
 	//defaults
	extract(shortcode_atts(array(  
		"width" 			=> '135',
		"height"			=> '135',
		"link" 			=> '',
		"lightbox" 		=> 'true',
		"align"			=> 'left',
		"title"			=> '',
		"alt"			=> '',
		"iframe"			=> 'false',
		"frame"			=> 'true',
		"crop"			=> 'true',
	), $atts));
	

	//width and height
	if($width=="")  $width = "135";
	if($height=="") $height = "135";
	
	//clear p and br tags
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	$content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
	$content = preg_replace('#^<br />$#', '', trim($content));	
     
     //random id
	$randomID = rand(100000, 1000000);
	
	//lightbox
	if($lightbox!="false") $lightbox='data-gal="prettyPhoto[rt_theme_thumb-'.$randomID.']"';
	
 	//if it's not a video
	if($link=="") $link=$content;
	
	/* icon */
	if (preg_match("/(png|jpg|gif)/",  trim($link) )) {
		$icon="magnifier";
	} elseif($lightbox=="false" && !empty($link)) {
		$icon="link";
	} else {
		$icon="play";
	}
    
     //frame
	if($frame=="true"){
		if($align=="left")		:  	$border_open='<span class="frame alignleft">';  				$border_close='</span>'; 		endif;
		if($align=="right")		: 	$border_open='<span class="frame alignright">';  				$border_close='</span>'; 		endif;
		if($align=="center")	:  	$border_open='<span class="aligncenter"><span class="frame">';  	$border_close='</span></span>'; 	endif;	
     }else{
		$border_open='<span style="box-shadow:none; border:0;padding:0;" class="frame align'.$align.'">';
		$border_close='</span>';
	}
	
	
	//iframe
	if ($iframe=='true') $iframe= '?iframe=true&amp;width=90%&amp;height=90%';  else  $iframe = '';	
	if (preg_match("/(mov|avi|swf|vimeo|youtube|screenr)/",  trim($link))): $iframe= ""; else: if($iframe && trim($link) ) $icon="link"; endif;
	
	
	//crop
	if($crop=="false") $height = 0;
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', trim(find_image_org_path($content)), $width, $height, $crop ); 
	
 
	//result
  
	if (trim($content)): 
	$rt_auto_thumb ='<a href="'.$link.''.$iframe.'" title="'.$title.'"  '.$lightbox.' class="imgeffect '.$icon.'"><img src="'.$image['url'].'" alt="'.$alt.'" /></a>';	
	else:
	$rt_auto_thumb ='<a href="'.$link.''.$iframe.'" title="'.trim($atts["title"]).'"  '.$lightbox.' >'.trim($atts["title"]).'</a>';
	endif;
     $rt_auto_thumb = $border_open . $rt_auto_thumb . $border_close;
 
	
	return $rt_auto_thumb;
}

add_shortcode('auto_thumb', 'rt_auto_thumb'); 


/*
* ------------------------------------------------- *
*		Contact Form Pages
* ------------------------------------------------- *
*/
function rt_shortcode_contact_form( $atts, $content = null ) {

$contact_form = "";
 
//dynamic class for the form
$dynamic_class="dynamic-class-".rand(100,1000000);

//are you human quiz
if(!isset($_SESSION['are_you_human'])){
	$_SESSION['are_you_human']="yes";
	$_SESSION['are_you_human_math1']=rand(1, 9);
	$_SESSION['are_you_human_math2']=rand(1, 99);
	$_SESSION['are_you_human_sum']=$_SESSION['are_you_human_math1'] + $_SESSION['are_you_human_math2'];
}

if(isset($atts['title'])) $contact_form.= '<div class="clear"></div><h3>'.$atts['title'].'</h3>';
if(isset($atts['text'])) $contact_form.= '<p><i class="decs_text">'.$atts['text'].'</i></p>';

if(isset($atts['email'])){

$hideEmail  = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(get_bloginfo('name')), $atts['email'], MCRYPT_MODE_CBC, md5(md5(get_bloginfo('name')))));

$contact_form= "".    
	'<!-- contact form -->'.
	'<div class="contact_form '.$dynamic_class.'">'.
	'<div class="clear"></div><div class="result"></div>'.	
	'	<form action="#" name="contact_form" class="validate_form" method="post">'.
	'		<ul>'.
	'			<li><label for="name">'.__('Your Name: (*)','rt_theme').'</label><input id="name" type="text" name="name" value="" class="required" /> </li>'.
	'			<li><label for="email">'.__('Your Email: (*)','rt_theme').'</label><input id="email" type="text" name="email" value="" class="required email"	 /> </li>'.
	//'			<li><label for="phone">'.__('Phone Number:','rt_theme').'</label><input id="phone" type="text" name="phone" value="" class="required" /> </li>'.
	//'			<li><label for="company_name">'.__('Company Name:','rt_theme').'</label><input id="company_name" type="text" name="company_name" value="" /> </li>'.
	//'			<li><label for="company_url">'.__('Company URL:','rt_theme').'</label><input id="company_url" type="text" name="company_url" value="" /> </li>'.
	'			<li><label for="message">'.__('Your message (*)','rt_theme').'</label><textarea  id="message" name="message" rows="8" cols="40"	class="required"></textarea></li>'.

	'			<li><label for="math">'.__('Are you human?','rt_theme').'</label>'.$_SESSION['are_you_human_math1'].' + '.$_SESSION['are_you_human_math2'].' = <input style="width:16px;" id="math" type="text" name="math" value="" class="required" /></li>'.
	'			<li>'.
	'			<input type="hidden" name="your_email" value="'.trim($hideEmail).'">'.
	'			<input type="hidden" name="dynamic_class" value="'.trim($dynamic_class).'">'.	
	'			<input type="submit" class="button" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>'.
	'		</ul>'.
	'	</form>'.
	'</div><div class="clear"></div>'.
	'<!-- /contact form -->'; 
}else{
	$contact_form="ERROR: This shortcode is not contains an email attribute!";
}

return $contact_form;
}
add_shortcode('contact_form', 'rt_shortcode_contact_form');


/*
* ------------------------------------------------- *
*		Image Slider
* ------------------------------------------------- *
*/
    	


function rt_shortcode_slider( $atts, $content = null ) {
	//[slider][/slider]

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	
 	$content = wpautop(do_shortcode($content));
	$content = fixshortcode($content);
	
	return '<div class="flex-container post_gallery"><div class="flexslider slider-for-blog-posts"><ul class="slides">' . trim($content) . '</ul></div></div><div class="space margin-t20"></div>';
}

function rt_shortcode_slider_slides( $atts, $content = null ) {
 	//[slide image_width="" image_height="" link="" alt_text="" auto_resize=""]

	//defaults
	extract(shortcode_atts(array(  
		"image_width" => '628',
		"image_height" => '300',
		"link" => '',
		"alt_text" => '',
		"title" => '',
		"auto_resize" => 'true'	   
	), $atts));

	//width and height
	if($image_width=="")  $image_width = "628";
	if($image_height=="") $image_height = "300";

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));		
 
	if($link){
		$link1='<a href="'.$link.'">';
		$link2='</a>';
	}
		
	$slide='<li>';	
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', find_image_org_path($content), $image_width, $image_height, 'true' );
	
	if($auto_resize=="true"){
	$slide.=$link1.'<img src="'.$image['url'].'" alt="'.$alt_text.'" />'.$link2;
	}else{
	$slide.=$link1.'<img src="'.trim($content).'"  alt="'.$alt_text.'" />'.$link2;
	}


	if($alt_text || $title){
		$slide			.= '<div class="flex-caption"><div class="desc-background">';
		if($title)	$slide	.= '<h5>'.$title.'</h5>';
		if($alt_text)	$slide	.= '<p>'.$alt_text.'</p>';
		$slide			.= '</div></div></li>';								
	}

	$slide.='</li>';
	
	return $slide;
}


add_shortcode('slider', 'rt_shortcode_slider');
add_shortcode('slide', 'rt_shortcode_slider_slides');
 

/*
* ------------------------------------------------- *
*		Tabular Content
* ------------------------------------------------- *
*/

function rt_shortcode_tabs( $atts, $content = null ) {
	//[tabs tab1="" tab2="" tab3=""][/tabs]
 
	//fix shortcode
	$content = wpautop(do_shortcode($content));	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 
	
	$tabs = ""; 
	for($i=1;$i<10;$i++){
	    $tab_name = isset($atts['tab'.$i]) ? $atts['tab'.$i] : "";
	    if($tab_name){
		   $tabs .=   '<li><a href="#">'.$tab_name.'</a></li>';
	    }
	}

	return '<div class="box full"><div class="taps_wrap"><ul class="tabs">'.$tabs.'</ul>'.wpautop(do_shortcode($content)).'</div></div>';
}

function rt_shortcode_tab( $atts, $content = null ) {
	//[tab][/tab] 
	
	//fix shortcode
     $content = wpautop(do_shortcode($content));	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return ' <div class="pane">' . $content . '</div>';
}

add_shortcode('tabs', 'rt_shortcode_tabs');
add_shortcode('tab', 'rt_shortcode_tab');



/*
* ------------------------------------------------- *
*		Accordions
* ------------------------------------------------- *
*/

function rt_shortcode_accordion( $atts, $content = null ) {
	//[accordion align=""][/accordion]
	 global $accordion_number_count,$accordion_numbers,$accordion_first_open;

	//defaults
	extract(shortcode_atts(array(  
		"numbers" => 'false',
		"align" => '',
		"first_one_open" => 'false', 
	), $atts));
	
	
	//global variables
	$accordion_number_count= 1;
	$accordion_numbers = ($numbers=="true") ? "true" : "";
	$accordion_first_open = ($first_one_open=="true") ? "true" : "";
	
	//align 
	if($align) $align =  'small _'.$align;
	
	//fix shortcode
	$content = wpautop(do_shortcode($content));	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));  

	$accordion_holder  ="";
	$accordion_holder .='<div class="rt-toggle '.$align.'';
	$accordion_holder .= ($accordion_numbers) ? "" : " no-numbers";
	$accordion_holder .='"><ol>'.wpautop(do_shortcode($content)).'</ol></div>'; 
	return $accordion_holder;
}

function rt_shortcode_accordion_panel( $atts, $content = null ) {
	//[pane title=""][/pane]
	global $accordion_number_count,$accordion_numbers,$accordion_first_open;

	$pane_title=$atts['title'];
	 
	//fix shortcode
	$content = wpautop(do_shortcode($content));	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	$panes  = ""; 
	$panes .= ($accordion_first_open &&  $accordion_number_count==1) ? '<li class="open">': '<li>'; 
	$panes .= '<div class="toggle-head">';
	if($accordion_numbers) $panes .= '<div class="toggle-number">'.$accordion_number_count++.'</div>';
	$panes .= '<div class="toggle-title">'.$pane_title.'</div>';
	$panes .= '</div>'; 
	$panes .= '<div class="toggle-content">';
	$panes .= $content; 
	$panes .= '</div>';
	$panes .= '</li>';

	//Reset the number if numbers are false
	if(!$accordion_numbers) $accordion_number_count=0;

	return $panes;
}

add_shortcode('accordion', 'rt_shortcode_accordion');
add_shortcode('pane', 'rt_shortcode_accordion_panel');


/*
* ------------------------------------------------- *
*		SOCIAL MEDIA		
* ------------------------------------------------- *		
*/ 
function rt_social_media( $atts, $content = null ) {
 
	global $social_media_icons;
	$social_media_output ='';								
	foreach ($social_media_icons as $key => $value){
		
		if($value=="email_icon"){//e-mail icon link 
			$link = 'mailto:'.str_replace("mailto:", "", get_option( THEMESLUG.'_'.$value ));
		}else{
			$link = get_option( THEMESLUG.'_'.$value );
		}
		
		//all icons
		if(get_option( THEMESLUG.'_'.$value )){
			$social_media_output .= '<li>';
			$social_media_output .= '<a target="_blank" href="'. $link .'" title="'.str_replace(" ", "&nbsp;", $key).'">';
			$social_media_output .= '<img src="'.THEMEURI.'/images/assets/social_media/icon-'.$value.'.png" alt="" />';
			$social_media_output .= '</a>';
			$social_media_output .= '</li>';
		}
	}

	if($social_media_output){
		return  '<ul class="social_media_icons">'.$social_media_output.'</ul>';
	}
}
add_shortcode('rt_social_media_icons', 'rt_social_media');

/*
* ------------------------------------------------- *
*		show shortcode 
* ------------------------------------------------- *
*/

function rt_shortcode_show_shortcode( $atts, $content = null ) {
 
	//convert html [] spacial chars  

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	$content = preg_replace('#\[\/braket_close\]#', "[/show_shortcode]",trim($content));
	
	return '<code>' . htmlspecialchars($content) . '</code>';
}

add_shortcode('show_shortcode', 'rt_shortcode_show_shortcode'); 
 
?>