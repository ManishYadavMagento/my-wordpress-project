<?php
/**
 * Template Name: Gallery Page
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$gallery_page = anshika_digital_library_get_gallery_page_data();
$gallery_items = $gallery_page['items'];

get_header();
?>

<?php get_template_part('template-parts/common/page-hero', null, $gallery_page['hero']); ?>

<section class="adl-section">
	<div class="adl-container">
		<div class="adl-gallery-grid adl-gallery-grid-wide">
			<?php foreach ($gallery_items as $item) : ?>
				<div class="adl-gallery-card" style="background-image: linear-gradient(180deg, rgba(8, 18, 37, 0.08), rgba(8, 18, 37, 0.8)), url('<?php echo esc_url($item['image']['url']); ?>');">
					<span><?php echo esc_html($item['title']); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
