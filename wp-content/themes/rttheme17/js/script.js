/*
    File Name: script.js
    by Tolga Can
    RT-Theme 17
*/

  
//remove no-js - javascript is enabled
jQuery(document).ready(function() {
	jQuery("html").removeClass("no-js"); 
});

//100% background
jQuery(window).load(function() {
	jQuery("#background").fullBg();
}); 

//rt drop down menu
jQuery(document).ready(function() { 
	   
     jQuery("#navigation ul").css({display: ""}); 
	
	jQuery("#navigation li").each(function()
	{
		jQuery(this).hover(function()
		{
		    var position = jQuery(this).position();
		    var width = jQuery(this).find("a:first-child").width();
		    
			jQuery(this).find('ul:first').stop().css({
			
				 height:"auto",
				 overflow:"hidden",
				 zIndex:"1000",
				 position:"absolute",
				 display:"none"
				 }).slideDown(200, function()
			{
			jQuery(this).css({
				 height:"auto",
				 overflow:"visible"
			}); 
		});
			  
		},
		    
		function()
		{	
			jQuery(this).find('ul:first').stop().slideUp(200, function()
			{	
				  jQuery(this).css({
				  display:"none",
				  overflow:"hidden"
				  });
			});
		});	
	});  

}); 
  
// Mobile Navigation for RT-Theme
jQuery(document).ready(function() {
	jQuery('#MobileMainNavigation').change(function() {	
		window.location.href = $(this +'option:selected').val();
	});
}); 
 

// Flex Slider and Helper Functions
jQuery(window).load(function() {
  jQuery('.slider-for-blog-posts').flexslider({
		animation: "fade",
		controlsContainer: ".flex-nav-container",
		smoothHeight: true,
		directionNav: true,
		controlNav:false, 
		prevText: "←", 
		nextText: "→" 
  });
}); 

jQuery(window).resize(function() { // description fix on window resize
	descFix();
});

//Photo Slider
jQuery(document).ready(function(){ 
    if (jQuery('.photo_gallery_cycle ul').length>0){
        jQuery(".photo_gallery_cycle ul").cycle({ 
            fx:     'fade', 
            timeout:  rttheme_slider_timeout,
            pager:  '.slider_buttons', 
            cleartype:  1,
            pause:           true,     // true to enable "pause on hover"
            pauseOnPagerHover: true,   // true to pause when hovering over pager link						
                pagerAnchorBuilder: function(idx) { 
                    return '<a href="#" title=""><img src="images/pixel.gif" width="8" heigth="8"></a>'; 
                }
        });
    }
});

// before
function onBefore(slider) {  
	if(slider.width()>920){
		jQuery('.flex-caption').animate({'bottom':'0px','opacity':'0'},0,'easeOutBack'); 
	}
	
}

// after  
function onAfter(slider) {
	if(slider.width()>920){
    	jQuery('.flex-caption').animate({'bottom':'40px','opacity':'1'},800,'easeOutBack'); 
	}
} 

// description fix
function descFix() {
	jQuery('.flex-caption').css({'bottom':'0','opacity':'1'});
}
   
 //RT Social Media Effect
(function($){
    $.fn.rt_social_media_effect = function(options) {
    var settings = $.extend({}, $.fn.rt_social_media_effect.defaults, options);
 
		// If the browser is IE 7-6
		var ua = jQuery.browser;
		if ( ua.msie && ua.version.slice(0,1) < 8 ) { // hide if before ie 8
			return false;
		}else{	
		
			var social_media_icon=$(this); 
		
			social_media_icon.each(function(){
				var the_name = jQuery(this).attr("title"); // get the name 		
				jQuery(this).append('<div class="social_tip">'+the_name+'</div> '); //create new div name		
			}); 
				
			//the effect   
			 if (ua.msie){
				jQuery("ul.social_media_icons li img").mouseover(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'0.7'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().show();
					}
				}).mouseout(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'1'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().hide();
					}
				});
			}else{
				jQuery("ul.social_media_icons li img").mouseover(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'0.7'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().animate({ 'opacity':'1','width':'show'}, 100, "easeIn");
					}
				}).mouseout(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'1'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().animate({ 'opacity':'0','width':'hide'}, 0);
					}
				});
			}
		}  
	}; 
})(jQuery);
jQuery(document).ready(function() {
    jQuery('#footer ul.social_media_icons li a, .social_media_top ul.social_media_icons li a').rt_social_media_effect();
});


//RT Portfolio Effect
(function($){
    $.fn.rt_portfolio_effect = function(options) {
    var settings = $.extend({}, $.fn.rt_portfolio_effect.defaults, options);
 
			var portfolio_item=$(this);  
			 		
			portfolio_item.each(function(){
				var imageClass = jQuery(this).attr("class"); // get the class 
				var theImage = jQuery(this).html(); 		// save the image
				jQuery(this).find("img").addClass("active"); // mark image as active
				jQuery(this).append('<span class="imagemask">'+theImage+'<span class="icon-overlay"><span class="icon '+imageClass+'"></span></span></span>'); //create new image within span
			}); 
			jQuery('a.imgeffect .active').remove(); // remove duplicated images	
			
			//the effect
			portfolio_item.mouseover(function(){ 
				jQuery(this).find('span.icon-overlay').stop().animate({ opacity:"1"}, 300).find('.icon').stop().animate({ top:"50%"}, 300, "easeOutBack");  
		 
			}).mouseout(function(){
				jQuery(this).find('span.icon-overlay').stop().animate({ opacity:"0"}, 300);  
				jQuery(this).find('span.icon-overlay .icon').stop().animate({ top:"-60px"}, 300, "easeInBack");  
			});    			 
	}; 
})(jQuery);

jQuery(document).ready(function() {
    jQuery('a.imgeffect').rt_portfolio_effect();
});

//RT form field - text back function
jQuery(document).ready(function() {

var form_inputs=jQuery(".showtextback input[type='text'], .showtextback textarea");

	form_inputs.each(function(){
	
		jQuery(this).focus( function()
		{
			val = jQuery(this).val();
			if (jQuery(this).attr("alt") != "0"){
			    jQuery(this).attr("alt",jQuery(this).attr("value")); 
			    jQuery(this).attr("value","");
			}
		});
	
		jQuery(this).blur( function(){
			if (jQuery(this).attr("alt") != "0"){
				val = jQuery(this).val(); 
				if (val == '' || val == jQuery(this).attr("alt")){
				    jQuery(this).attr("value",jQuery(this).attr("alt"));
				}
			}
		});
	
		jQuery(this).keypress( function(){  
			jQuery(this).attr("alt","0");	    
		});                 
	});  
         
}); 


//Slide to top
jQuery(document).ready(function(){
    jQuery(".line span.top").click(function() {
        jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );
    });
});



//Carousel for product images
jQuery(document).ready(function() {
    if (jQuery('#product_thumbnails').length>0){
	   jQuery('#product_thumbnails').jcarousel({scroll: 1});
    }
}); 


// Tabs
jQuery(function() {// perform JavaScript after the document is scriptable.
    jQuery("ul.tabs").tabs("> .pane", {effect: 'fade'});
    
    jQuery(".accordion").tabs(".pane", {tabs: '.title', effect: 'slide'});
    jQuery(".scrollable").scrollable();


    jQuery(".items.big_image img").click(function() {
    
       // see if same thumb is being clicked
       if (jQuery(this).hasClass("active")) { return; }
    
       // calclulate large image's URL based on the thumbnail URL (flickr specific)
       var url = jQuery(this).attr("alt");
	 
    
       // get handle to element that wraps the image and make it semi-transparent
       var wrap = jQuery("#image_wrap").fadeTo("medium", 0.5);
    
       // the large image from www.flickr.com
       var img = new Image();
    
    
       // call this function after it's loaded
       img.onload = function() {
    
          // make wrapper fully visible
          wrap.fadeTo("fast", 1);
    
          // change the image
          wrap.find("img").attr("src", url);
    
       };
    
       // begin loading the image from www.flickr.com
       img.src = url;
    
       // activate item
       jQuery(".items img").removeClass("active");
       jQuery(this).addClass("active");
    
    // when page loads simulate a "click" on the first image
    }).filter(":first").click();

}); 
 
//rt accordions 
jQuery(function($){
    $(document).ready(function(){ 
     	$(".rt-toggle .toggle-content").hide(); 
		$(".rt-toggle .open .toggle-content").show();  
     	
     	$(".rt-toggle ol li .toggle-head").click(function(){ 
 
     		if($(this).parent("li").hasClass("open")){ 
	     		$(this).parent("li").removeClass("open").find(".toggle-content").stop().slideUp(300);  
     		}else{
	  	  		$(this).parents("ol").find("li.open").removeClass("open").find(".toggle-content").stop().slideUp(300);  
	  	  		$(this).parent("li").addClass("open").find(".toggle-content").stop().slideDown(300, "easeIn");	
	  	  	} 
	 	});
});  
}); 

//tool tips  
jQuery(document).ready(function(){
	jQuery('.j_ttip,.j_ttip2,.widget ul.social_media_icons li a').colorTip({color:'black'});
});

//validate contact form
jQuery(document).ready(function(){

	// show a simple loading indicator
	var loader = jQuery('<img src="'+rttheme_template_dir+'/images/loading.gif" alt="..." />')
			.appendTo(".loading");
			loader.hide();

	jQuery.validator.messages.required = "";

	jQuery(".validate_form").each(function(){ 	
			var result = jQuery(this).parents(".contact_form").find(".result");
		var v = jQuery(this).validate({
		      submitHandler: function(form) {
		              jQuery(form).ajaxSubmit({
		                      target: result,
						beforeSubmit:  function() {loader.show()},
						url: ajaxurl,
						data: { action: 'rt_ajax_contact_form' },
						success:   function() {loader.hide()}
		              });
		      }
		});
		});
 }); 


//pretty photo
jQuery(document).ready(function(){
	jQuery('a[data-gal]').each(function() {
	    jQuery(this).attr('rel', jQuery(this).data('gal'));
	});  	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',slideshow:false,overlay_gallery: false,social_tools:false,deeplinking:false});
}); 

  
//Fade effect for flickr
jQuery(window).load(function() {
     
	var flickrItems=jQuery(".flickr_thumbs img");
	
	flickrItems.mouseover(function(){
		
		flickrItems.each(function(){
		    jQuery(this).stop().animate({ opacity:"0.4"}, 300, "easeIn");
		});
		
		jQuery(this).stop().animate({ opacity:"1"}, 100, "easeIn");
		
	}).mouseout(function(){
		flickrItems.each(function(){
		    jQuery(this).stop().animate({ opacity:"1"}, 200, "easeIn");
		});
	});   
});  

//floating sidebars
jQuery(window).load(function(){
	var $window = jQuery(window);
	var $sidebar = jQuery(".sidebar");
	var $footer = jQuery(".footer");
	var $content = jQuery(".content");
	var $WPbar = jQuery("#wpadminbar").length;
	var $addHeigth = 0;
	if ($WPbar>0) $addHeigth = 28;

	if($sidebar.length>0){
		var sidebarTop = $sidebar.position().top;
		var sidebarHeight = $sidebar.height()+10;
		var contentHeight = $content.height(); 
		var footerTop = $footer.position().top;

		
		if(contentHeight>sidebarHeight){
			$window.scroll(function(event) {
				$sidebar.addClass('fixed');
				scrollTop = $window.scrollTop(),
				topPosition = Math.max(0, (sidebarTop) - scrollTop),
				topPosition = Math.min(topPosition, (footerTop - scrollTop) - sidebarHeight);
				$sidebar.css('top', topPosition+$addHeigth);
			});
		}
	}
}); 

//RT Fixed Rows  
(function($){
    $.fn.rt_fixed_rows = function(options) {
    var settings = $.extend({}, $.fn.rt_fixed_rows.defaults, options);
 	var fixed_rows = $(this);
	var rowID =	Math.ceil(Math.random()*2000);
 
		fixed_rows.each(function(){ 
			var current_row = jQuery(this);
			var max_box_height = 0;

			current_row.attr('id','fixedRow-'+rowID+''); 
			jQuery(this).find('.box').each(function(){	  

				if(jQuery(this).hasClass("one") == false && jQuery(this).hasClass("fullwidth") == false ){
					if(jQuery(this).height()	> max_box_height){
						max_box_height = jQuery(this).height();
					} 
				}
			});
			jQuery('div#fixedRow-'+rowID+' > .box').css({'min-height':max_box_height});

			rowID++;

		});  
	}; 
})(jQuery);

jQuery(window).load(function() { 
    jQuery('#container .fixed-row').rt_fixed_rows();
}); 


//RT footer position fix
jQuery(window).load(function() { 
  
	var bodyHeight = jQuery('#container').height();
	var footerDistance = ( jQuery(window).height() - bodyHeight ); 
	var footerHolder = jQuery('.footer_pos_fix');	
	var footerHeight = footerHolder.height();
	var newHeight = bodyHeight + footerDistance -40;

	if(footerDistance>1 && parseInt(jQuery(window).width())>920){ 
		jQuery('#container').css({"height":""+newHeight+"px"});
		footerHolder.css({"position":"absolute","bottom":"0","width":"100%"});
	} 
 });

