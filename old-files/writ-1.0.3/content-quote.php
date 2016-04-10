<?php
/**
 * Quote Post Format.
 *
 * @package Writ
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( '' != get_the_title() ) : // Avoid printing empty markup if there's no title ?>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content( the_title( '<span class="screen-reader-text">', '</span>', false) . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'writ' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'writ' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php writ_post_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'writ' ), '<span class="edit-link">', '</span>' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'writ' ), __( '1 Comment', 'writ' ), __( '% Comments', 'writ' ) ); ?></span>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
			<?php writ_categories_tags(); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->
