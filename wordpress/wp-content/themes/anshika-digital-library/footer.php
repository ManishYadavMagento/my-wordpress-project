<?php
/**
 * Footer template.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$settings = anshika_digital_library_get_global_settings();
$phone    = $settings['phone'];
$address  = $settings['address'];
$brand    = $settings['brand_name'];
?>
</main>

<footer class="adl-site-footer">
	<div class="adl-container adl-footer-grid">
		<div>
			<h2><?php echo esc_html($settings['footer_about_heading']); ?></h2>
			<p><?php echo esc_html($settings['footer_description']); ?></p>
		</div>

		<div>
			<h3><?php echo esc_html($settings['footer_links_heading']); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url(anshika_digital_library_get_page_url('about', home_url('/#about'))); ?>"><?php esc_html_e('About', 'anshika-digital-library'); ?></a></li>
				<li><a href="<?php echo esc_url(anshika_digital_library_get_page_url('facilities', home_url('/#facilities'))); ?>"><?php esc_html_e('Library Facilities', 'anshika-digital-library'); ?></a></li>
				<li><a href="<?php echo esc_url(anshika_digital_library_get_page_url('seat-plans', home_url('/#seat-plans'))); ?>"><?php esc_html_e('Seat Plans', 'anshika-digital-library'); ?></a></li>
				<li><a href="<?php echo esc_url(anshika_digital_library_get_page_url('contact', home_url('/#contact'))); ?>"><?php esc_html_e('Contact', 'anshika-digital-library'); ?></a></li>
			</ul>
		</div>

		<div>
			<h3><?php echo esc_html($settings['footer_facilities_heading']); ?></h3>
			<ul>
				<?php foreach ($settings['footer_facility_items'] as $facility_label) : ?>
					<?php if (! empty($facility_label)) : ?>
						<li><?php echo esc_html($facility_label); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>

		<div>
			<h3><?php echo esc_html($settings['footer_contact_heading']); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url('tel:' . preg_replace('/\D+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></li>
				<li><?php echo esc_html($address); ?></li>
				<li><a href="<?php echo esc_url($settings['whatsapp_link']); ?>" target="_blank" rel="noreferrer"><?php esc_html_e('WhatsApp Enquiry', 'anshika-digital-library'); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="adl-footer-bottom">
		<div class="adl-container">
			<p><?php echo esc_html(sprintf(__('Copyright %1$s %2$s. All rights reserved.', 'anshika-digital-library'), gmdate('Y'), $brand)); ?></p>
		</div>
	</div>
</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
