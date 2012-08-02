<?php
#
# RT-Theme Twitter Widget
#

class Twitter_Widget extends WP_Widget {

	function Twitter_Widget() {
		$opts =array(
					'classname' 	=> 'widget_twitter',
					'description' 	=> __( 'Displays your Twitter feeds', 'rt_theme_admin' )
				);

		$this-> WP_Widget('rt-twitter', '['. THEMENAME.']   '.__('Twitter', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		$title			=	apply_filters('widget_title', $instance['title']) ;		 
		$twitter_username 	=	$instance['twitter_username'];
		$show_tweets 		=	empty($instance['show_tweets']) ? 3 : $instance['show_tweets'];
		$randomID			=	'tweets-'.rand(10000, 1000000);
		
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
	 
		echo '<div id="'.$randomID.'">';
		echo '<script type="text/javascript">jQuery("#'.$randomID.'").tweet({ count: '.$show_tweets.',count: '.$show_tweets.', username: "'.$twitter_username.'", loading_text: "..." });</script> ';
		echo '</div>'; 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']			= strip_tags($new_instance['title']); 
		$instance['twitter_username']	= strip_tags($new_instance['twitter_username']);
		$instance['show_tweets']		= strip_tags($new_instance['show_tweets']);
		return $instance;
	}

	function form( $instance ) {
		$title 			= 	isset($instance['title']) ? esc_attr($instance['title']) : '';
		$twitter_username 	=	isset($instance['twitter_username']) ? esc_attr($instance['twitter_username']) : '';
		$show_tweets 		=	Is_Numeric(@$instance['show_tweets']) ? absint(@$instance['show_tweets']) : 3; 
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo empty($title) ? __('Twitter Feeds','rt_theme') : $title; ?>" /></p>
	
		<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter Username:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" /></p>
	
		<p><label for="<?php echo $this->get_field_id('show_tweets'); ?>"><?php _e('Tweet Number:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('show_tweets'); ?>" name="<?php echo $this->get_field_name('show_tweets'); ?>" type="text" value="<?php echo empty($show_tweets) ? 3 : $show_tweets; ?>" /></p>
		
<?php } } ?>