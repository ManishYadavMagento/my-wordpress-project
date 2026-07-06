<?php
/**
 * Template Name: Contact Page
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$settings      = anshika_digital_library_get_global_settings();
$contact_page  = anshika_digital_library_get_contact_page_data();
$phone         = $settings['phone'];
$call_link     = 'tel:' . preg_replace('/\D+/', '', $phone);
$whatsapp_link = $settings['whatsapp_link'];
$address       = $settings['address'];

get_header();
?>

<?php get_template_part('template-parts/common/page-hero', null, $contact_page['hero']); ?>

<section class="adl-section adl-section-dark">
	<div class="adl-container adl-contact-grid">
		<div class="adl-contact-stack">
			<div class="adl-contact-card">
				<span class="adl-eyebrow"><?php echo esc_html($contact_page['contact_card']['eyebrow']); ?></span>
				<h2><?php echo esc_html($contact_page['contact_card']['title']); ?></h2>
				<ul class="adl-contact-list">
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('location')); ?><span><?php echo esc_html($address); ?></span></li>
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('phone')); ?><a href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($phone); ?></a></li>
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('message')); ?><a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer"><?php esc_html_e('WhatsApp Enquiry', 'anshika-digital-library'); ?></a></li>
				</ul>
				<div class="adl-hero-actions">
					<a class="adl-button adl-button-primary" href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($contact_page['contact_card']['call_button']); ?></a>
					<a class="adl-button adl-button-secondary" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer"><?php echo esc_html($contact_page['contact_card']['whatsapp_button']); ?></a>
				</div>
			</div>

			<div class="adl-map-placeholder">
				<h3><?php echo esc_html($contact_page['map']['title']); ?></h3>
				<?php if (! empty($contact_page['map']['embed'])) : ?>
					<div class="adl-page-content"><?php echo wp_kses_post($contact_page['map']['embed']); ?></div>
				<?php else : ?>
					<p><?php echo esc_html($contact_page['map']['description']); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="adl-contact-form-shell">
			<div class="adl-contact-form-header">
				<span class="adl-eyebrow"><?php echo esc_html($contact_page['form']['eyebrow']); ?></span>
				<h2><?php echo esc_html($contact_page['form']['title']); ?></h2>
			</div>
			<?php anshika_digital_library_render_contact_form(); ?>
		</div>
	</div>
</section>

<?php
get_footer();
