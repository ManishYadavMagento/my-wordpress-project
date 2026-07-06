<?php
/**
 * Main index template.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<section class="adl-page-shell">
	<div class="adl-container">
		<header class="adl-page-header">
			<span class="adl-eyebrow"><?php esc_html_e('Latest Updates', 'anshika-digital-library'); ?></span>
			<h1><?php esc_html_e('Library news and posts', 'anshika-digital-library'); ?></h1>
		</header>

		<div class="adl-post-list">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('adl-post-card'); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="adl-post-meta"><?php echo esc_html(get_the_date()); ?></div>
						<div class="adl-post-excerpt"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="adl-post-card">
					<h2><?php esc_html_e('No posts found', 'anshika-digital-library'); ?></h2>
					<p><?php esc_html_e('You can publish updates or blog posts from the WordPress admin area later.', 'anshika-digital-library'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
