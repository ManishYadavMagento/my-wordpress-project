<?php
/**
 * Template Name: About Page
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$about_page = anshika_digital_library_get_about_page_data();

get_header();
?>

<?php get_template_part('template-parts/common/page-hero', null, $about_page['hero']); ?>

<section class="adl-section">
	<div class="adl-container adl-about-grid">
		<div class="adl-about-card">
			<h2><?php echo esc_html($about_page['left_card']['title']); ?></h2>
			<p><?php echo esc_html($about_page['left_card']['description']); ?></p>
			<ul class="adl-check-list">
				<?php foreach ($about_page['left_card']['points'] as $point) : ?>
					<?php if (! empty($point)) : ?>
						<li><?php echo esc_html($point); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="adl-about-card">
			<h2><?php echo esc_html($about_page['right_card']['title']); ?></h2>
			<p><?php echo esc_html($about_page['right_card']['paragraph_1']); ?></p>
			<p><?php echo esc_html($about_page['right_card']['paragraph_2']); ?></p>
			<a class="adl-button adl-button-primary" href="<?php echo esc_url($about_page['right_card']['button_link']); ?>"><?php echo esc_html($about_page['right_card']['button_label']); ?></a>
		</div>
	</div>
</section>

<?php
get_footer();
