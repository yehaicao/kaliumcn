<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( $blog_post_date || $blog_category ) :
?>
<div class="details">
	<?php if ( $blog_post_date ) : ?>
	<div class="date">
		<i class="icon icon-basic-calendar"></i><?php the_time( apply_filters( 'kalium_single_post_date_format', 'd F Y' ) ); ?>
	</div>
	<?php endif; ?>
	
	<?php if ( $blog_category ) : ?>
	<div class="category">
		<i class="icon icon-basic-folder-multiple"></i>
		<?php the_category( ', ' ); ?>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>