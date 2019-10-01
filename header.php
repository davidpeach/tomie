<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentynineteen' ); ?></a>

		<?php
		$wrappingClasses = 'site-header';
		if (is_singular() && twentynineteen_can_show_post_thumbnail()) {
			$wrappingClasses = 'site-header featured-image';
		} elseif (is_tag() && $image = get_field('tag_image', 'post_tag_' . get_query_var('tag_id'))) {
			$wrappingClasses = 'site-header featured-image';
		} elseif (is_home()) {
			$wrappingClasses = 'site-header featured-image';
		}
		?>

		<header id="masthead" class="<?php echo $wrappingClasses; ?>">

			<div class="site-branding-container">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
			</div><!-- .site-branding-container -->

			<?php if ( is_singular() && twentynineteen_can_show_post_thumbnail() ) : ?>

				<div class="site-featured-image">
					<?php
						twentynineteen_post_thumbnail();
						the_post();
						$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;

						$classes = 'entry-header';
					if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
						$classes = 'entry-header has-discussion';
					}
					?>
					<div class="<?php echo $classes; ?>">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php elseif (is_tag() && $image = get_field('tag_image', 'post_tag_' . get_query_var('tag_id'))): ?>
				<div class="site-featured-image">
					<figure class="post-thumbnail">
						<img src="<?php echo $image; ?>" alt="">
					</figure>
					<div class="entry-header">
						<?php get_template_part( 'template-parts/header/entry', 'tag-header' ); ?>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php elseif(is_home()): ?>
				<div class="site-featured-image">
					<figure class="post-thumbnail">
						<img src="https://davidpeach.co.uk/wp-content/uploads/2019/05/The-Roadhouse-in-Twin-Peaks.jpg" alt="">
					</figure>
					<div class="entry-header">
						<h1 class="entry-title">Blog</h1>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php endif; ?>
		</header><!-- #masthead -->
	<div id="content" class="site-content">
