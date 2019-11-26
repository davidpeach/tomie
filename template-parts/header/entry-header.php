<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

$discussion = ! is_page() && tomie_can_show_post_thumbnail() ? tomie_get_discussion_data() : null; ?>

<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<?php
if ($blurb = get_field('blurb')) {
	echo "<p class='blurb has-large-font-size'>" . $blurb . "</p>";
}

if ( ! is_page() ) : ?>
<div class="entry-meta">
	<?php
	$tags_list = get_the_tag_list( '', __( ', ', 'tomie' ) );
	if ( $tags_list ) {
		printf(
			/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
			'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
			tomie_get_icon_svg( 'tag', 16 ),
			__( 'Tags:', 'tomie' ),
			$tags_list
		); // WPCS: XSS OK.
	}
	?>
	<?php #tomie_posted_by(); ?>
	<?php tomie_posted_on(); ?>
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			tomie_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php tomie_comment_count(); ?>
	</span>
	<?php
	// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'tomie' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . tomie_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	?>
</div><!-- .entry-meta -->
<?php endif; ?>
