<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

$discussion = ! is_page() && tomie_can_show_post_thumbnail() ? tomie_get_discussion_data() : null;

$term = get_queried_object();
?>
<h1 class="entry-title">
	<?php single_tag_title( 'Tag: '); ?>
</h1>
<?php
if ($blurb = get_field('blurb', $term)) {
	echo "<p class='blurb has-large-font-size'>" . $blurb . "</p>";
}
