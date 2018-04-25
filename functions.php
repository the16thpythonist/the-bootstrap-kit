<?php

/** Remove the posted notification - it's not necessary for publications that 
  * all come with it's own date. 
  */  
function the_bootstrap_posted_on() {
}


/** Customize the comment display; remove author and date of the comments; 
  * The spacing of the comments is adjusted in style.css. 
  */
function the_bootstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' == $comment->comment_type OR 'trackback' == $comment->comment_type ) : ?>
	
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p class="row">
				<strong class="ping-label span1"><?php _e( 'Pingback:', 'the-bootstrap' ); ?></strong>
				<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
			</p>
	
	<?php else:
		$offset	=	$depth - 1;
		$span	=	7 - $offset; ?>
		
		<li  id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment row">
				<div class="comment-content span<?php echo $span; ?>">
					<?php
					comment_text();
					comment_reply_link( array_merge( $args, array(
						'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
						'depth'			=>	$depth,
						'max_depth'		=>	$args['max_depth']
					) ) ); ?>
				</div><!-- .comment-content -->
			</article><!-- #comment-<?php comment_ID(); ?> .comment -->
			
	<?php endif; // comment_type
}


/** Comment are only added by scripts; manual action is not activated, so the
  * indication is not necessary. Warning: The function in the parent class needs
  * to be removed before exection.
  */
function the_bootstrap_kit_comments_closed() {
	remove_action( 'comment_form_comments_closed', 'the_bootstrap_comments_closed' );
}
add_action( 'comment_form_comments_closed', 'the_bootstrap_kit_comments_closed', 5 );


/** Some unique expressions can be replaced in the html. 
  */
function start_modify_html() {

    ob_start();
}

function end_modify_html() {

    $html = ob_get_clean();
    $html = str_replace( 'thoughts on', 'citations of', $html );
    $html = str_replace( 'thought on', 'citation of', $html );
    $html = str_replace( 'Posted in', 'In categories', $html );
    $html = str_replace( ' Archives:', ':', $html ); 
    $html = str_replace( 'comments', 'citations', $html );
    echo $html;
}

add_action( 'wp_head', 'start_modify_html' );
add_action( 'wp_footer', 'end_modify_html' );


?>
