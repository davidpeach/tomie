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
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tomie' ); ?></a>

		<?php
		$wrappingClasses = 'site-header';
		if (is_singular() && tomie_can_show_post_thumbnail()) {
			$wrappingClasses = 'site-header featured-image';
		} elseif (is_tag() && $image = get_field('tag_image', 'post_tag_' . get_query_var('tag_id'))) {
			$wrappingClasses = 'site-header featured-image';
		} elseif (is_home()) {
			$wrappingClasses = 'site-header featured-image';
		} elseif(is_post_type_archive('note') || is_category()) {
			$wrappingClasses = 'site-header featured-image';
		}
		?>

		<header id="masthead" class="<?php echo $wrappingClasses; ?>">

			<div class="site-branding-container">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
			</div><!-- .site-branding-container -->

			<?php if ( is_singular() && tomie_can_show_post_thumbnail() ) : ?>

				<div class="site-featured-image">
					<?php
						tomie_post_thumbnail();
						the_post();
						$discussion = ! is_page() && tomie_can_show_post_thumbnail() ? tomie_get_discussion_data() : null;

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
			<?php elseif(is_post_type_archive()): ?>
				<?php
				$postTypeObject = get_queried_object();

				switch ($postTypeObject->name) {
					case 'note':
						$image = 'https://davidpeach.co.uk/wp-content/uploads/2019/05/Rise-of-the-Tomb-Raider-Blood-Ties.jpg';
						$blurb = 'snippets and things I find cool';
						break;

					default:
						$image = 'https://davidpeach.co.uk/wp-content/uploads/2019/05/The-Roadhouse-in-Twin-Peaks.jpg';
						$blurb = '';
						break;
				}
				?>
				<div class="site-featured-image">
					<figure class="post-thumbnail">
						<img src="<?php echo $image; ?>" alt="">
					</figure>
					<div class="entry-header">
						<h1 class="entry-title"><?php echo single_term_title() || post_type_archive_title(); ?></h1>
						<p class="blurb has-large-font-size"><?php echo $blurb; ?></p>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php elseif(is_category()): ?>
				<div class="site-featured-image">
					<figure class="post-thumbnail">
						<?php
						$categories = get_the_category();
						$category_id = $categories[0]->cat_ID;
						$image = get_field('tag_image', 'category_' . $category_id);
						?>
						<img src="<?php echo $image; ?>" alt="">
					</figure>
					<div class="entry-header">
						<h1 class="entry-title"><?php echo single_term_title() || post_type_archive_title(); ?></h1>
						<?php if($blurb = get_field('blurb', 'category_' . $category_id)): ?>
						<p class="blurb has-large-font-size"><?php echo $blurb; ?></p>
						<?php endif; ?>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>

			<?php endif; ?>
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs">','</p>' );
			}
			?>
		</header><!-- #masthead -->
	<div id="content" class="site-content">
