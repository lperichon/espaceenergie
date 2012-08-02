<?php /* based on twentyten comment template*/ ?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'rt_theme' ); ?></p>
		</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

			<h6 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'rt_theme' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h6>
			
<div class="line"></div><!-- line -->			
			
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rt_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rt_theme' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments(  					
                                array(
                                'walker'            => null,
                                'max_depth'         => 4,
                                'style'             => 'ul',
                                'callback'          => "rt_comments", 
                                'type'              => 'all',  
                                'avatar_size'       => 48,
                                )
					); 
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rt_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rt_theme' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

		<?php if ( ! comments_open() ) :?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'rt_theme' ); ?></p>
		<?php endif; // end ! comments_open() ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
?> 
			
<?php endif; // end have_comments() ?>




 
<?php if ($post->comment_status == 'open') : ?>
           
     
		<div id="respond">
          <div class="clear"></div>
          
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('Log in','rt_theme'); ?></a> <?php _e('to post a comment.','rt_theme'); ?></p>
		<?php else:?>
		
		<?php if ( get_comments_number() > 0) : // Are there comments to navigate through? ?>
		<br /><div class="line"><span class="top">[<?php _e( 'top', 'rt_theme' ); ?>]</span></div>
		<?php endif;?>
		
          <div class="respond-cont">
		<h5 id="reply-title"><?php _e('Leave a Reply','rt_theme');?></h5>
		
		
		
		<div class="clear"></div>
          
			

				<!-- form -->
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="showtextback">
				<fieldset>

	<!-- textarea -->
					<div class="message">
						<ul>
						<li>
								<textarea tabindex="4" class="comment_textarea" rows="10" id="comment" name="comment"><?php _e('Comment','rt_theme');?> *</textarea>					
						</li>
						
						<li>
								<!-- submit button -->
								<input type="submit" value="<?php _e('Submit','rt_theme');?>" tabindex="5" id="submit" class="button comment_submit" name="submit"/>
								
								<!-- cancel reply -->
								<span class="cancel-reply"><?php cancel_comment_reply_link(__("Cancel Reply",'rt_theme')); ?></span> 								
						</li>
						</ul>
					</div>
					
					
					<?php if ( $user_ID ) : ?>
					<div class="text-boxes">
						<p><?php _e('Logged in as','rt_theme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
						<a href="<?php echo wp_logout_url(get_permalink()); ?>" title=""><?php _e('Log out','rt_theme'); ?> &raquo;</a></p>
					</div>	
					<?php else : ?>
                
			 					
					<!-- text fields -->
					<div class="text-boxes">
						<ul>
						<li><input type="text" tabindex="1"  value="<?php _e('Name','rt_theme');?> *" id="author" class="comment_input" name="author"/></li>
						<li><input type="text" tabindex="2"  value="<?php _e('Email (will not be published)','rt_theme');?>  *" id="email-author" class="comment_input" name="email"/></li>
						<li><input type="text" tabindex="3" value="<?php _e('Website','rt_theme');?>" id="url" class="comment_input last" name="url"/></li>
						</ul>
					</div>
					
					<?php endif; ?>
					
				
				
					
				</fieldset>
				
				<p>
				<?php 
				comment_id_fields();
				do_action('comment_form', $post->ID);
				?></p>
				
				</form>
				<!-- /form -->	
								
				
          </div>  
            
		<?php endif;?>
		</div><!-- #respond -->
<?php endif; ?>


</div><!-- #comments -->