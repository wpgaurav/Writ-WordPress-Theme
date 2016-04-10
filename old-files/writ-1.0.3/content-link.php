<?php
/**
 * Link Post Format.
 *
 * @package Writ
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php echo esc_url( writ_get_link_url() ); ?>"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'writ' ) ); ?>
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
		<?php endif; // is_single ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
