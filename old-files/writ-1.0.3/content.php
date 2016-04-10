<?php
/**
 * @package Writ
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; // if is_single ?>
	</header><!-- .entry-header -->

	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="entry-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .entry-thumbnail -->
	<?php endif; ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( the_title( '<span class="screen-reader-text">', '</span>', false) . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'writ' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'writ' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php writ_post_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'writ' ), '<span class="edit-link">', '</span>' ); ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'writ' ), __( '1 Comment', 'writ' ), __( '% Comments', 'writ' ) ); ?></span>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() && is_single() ) : // Hide category and tag text for pages on Search ?>
			<?php writ_categories_tags(); ?>
		<?php endif; // End if 'post' == get_post_type() ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
