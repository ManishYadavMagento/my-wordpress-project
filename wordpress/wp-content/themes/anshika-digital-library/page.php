<?php
/**
 * Default page template.
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
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article <?php post_class('adl-page-card'); ?>>
					<header class="adl-page-header">
						<span class="adl-eyebrow"><?php esc_html_e('Page', 'anshika-digital-library'); ?></span>
						<h1><?php the_title(); ?></h1>
					</header>
					<div class="adl-page-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
