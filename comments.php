<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( post_password_required() ) {
	return;
}

$comments_number = get_comments_number();

$list_comments_args = array(
	'style'        => 'div',
	'callback'     => 'laborator_list_comments_open',
	'end-callback' => 'laborator_list_comments_close'
);

if ( have_comments() ) :
?>
<div class="comments-holder">
    <div class="container">
		<div class="section-title">
			<h2><?php echo sprintf( _n( '1 Comment', '%d Comments', $comments_number, 'kalium' ), $comments_number ); ?></h2>
			<p><?php $comments_number > 0 ? _e( 'Join the discussion and tell us your opinion.', 'kalium' ) : _e( 'Be the first to comment on this article.', 'kalium' ); ?></p>
		</div>


		<?php
		// Comments List
		wp_list_comments( $list_comments_args );

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

			echo '<div class="pagination-container">' . paginate_comments_links( array(
					'prev_text' => sprintf( __( '%s Previous', 'kalium' ), '<i class="flaticon-arrow427"></i>' ),
					'next_text' => sprintf( __( 'Next %s', 'kalium' ), '<i class="flaticon-arrow413"></i>' ),
					'type'      => 'list',
					'echo'		=> false
				) ) . '</div>';

		endif;
		?>


    </div>
</div>
<?php
endif;


// Closed Comments Notification
if ( ! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments') ):

	// To do..

endif;

// Comments Form
$form_args = array(
	'format' => 'html5',

	'title_reply' 			=> have_comments() ? __('Leave a reply', 'kalium') : __('Share your thoughts', 'kalium'),
	'title_reply_to' 		=> __('Reply to %s', 'kalium'),

	'comment_notes_before' 	=> '',
	'comment_notes_after' 	=> '',

	'label_submit'			=> __( 'Comment', 'kalium' ),
	'class_submit'			=> 'send',

	'comment_field'			=> '<div class="col-sm-12">
		<div class="form-group">
			<div class="placeholder ver-two">
				<label for="comment">' . __( 'Comment', 'kalium' ) . '</label>
			</div>
			<textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea>
		</div>
	</div>'
);

if ( comments_open() ) :

	?>
	<div class="leave-reply-holder">
	    <div class="container">
			<?php comment_form( $form_args ); ?>
		</div>
	</div>
	<?php

endif;