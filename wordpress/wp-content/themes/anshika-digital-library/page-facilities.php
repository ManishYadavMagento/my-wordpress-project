<?php
/**
 * Template Name: Facilities Page
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$facilities_page = anshika_digital_library_get_facilities_page_data();
$facilities      = $facilities_page['items'];

get_header();
?>

<?php get_template_part('template-parts/common/page-hero', null, $facilities_page['hero']); ?>

<section class="adl-section">
	<div class="adl-container">
		<div class="adl-card-grid adl-card-grid-3">
			<?php foreach ($facilities as $facility) : ?>
				<article class="adl-info-card">
					<div class="adl-icon-badge"><?php echo wp_kses_post(anshika_digital_library_get_icon($facility['icon'])); ?></div>
					<h3><?php echo esc_html($facility['title']); ?></h3>
					<p><?php echo esc_html($facility['description']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
