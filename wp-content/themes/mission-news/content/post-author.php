<?php if ( get_theme_mod( 'author_box_posts' ) == 'no' ) return; ?>
<div class="post-author">
	<?php if ( get_theme_mod( 'author_avatar_posts' ) != 'no' ) : ?>
	<div class="avatar-container">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 78, '', get_the_author() ); ?>
	</div>
	<?php endif; ?>
	<div>
		<div class="author"><?php the_author(); ?></div>
		<p><?php the_author_meta('description'); ?></p>
	</div>
</div>