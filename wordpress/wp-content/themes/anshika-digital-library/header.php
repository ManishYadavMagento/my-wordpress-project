<?php
/**
 * Header template.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$settings      = anshika_digital_library_get_global_settings();
$phone         = $settings['phone'];
$call_link     = 'tel:' . preg_replace('/\D+/', '', $phone);
$whatsapp_link = $settings['whatsapp_link'];
$brand_name    = $settings['brand_name'];
$tagline       = $settings['tagline'];
$call_label    = $settings['header_call_label'];
$default_logo  = get_template_directory_uri() . '/assets/images/logo.png';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Anshika Digital Library in Ghazipur offers AC study zone, Wi-Fi, CCTV, separate seating, comfortable reading space, and enquiry for library seats.">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e('Skip to content', 'anshika-digital-library'); ?></a>

<header class="adl-site-header" id="top">
	<div class="adl-topbar">
		<div class="adl-container adl-container-wide adl-topbar-inner">
			<p><?php echo wp_kses_post(anshika_digital_library_get_icon('location')); ?><span><?php echo esc_html(anshika_digital_library_get_option('address')); ?></span></p>
			<p><?php echo wp_kses_post(anshika_digital_library_get_icon('phone')); ?><span><?php echo esc_html($phone); ?></span></p>
		</div>
	</div>

	<div class="adl-navbar-wrap" data-sticky-header>
		<div class="adl-container adl-container-wide adl-navbar">
			<div class="adl-branding">
				<?php if (has_custom_logo()) : ?>
					<div class="adl-logo-mark"><?php the_custom_logo(); ?></div>
					<div class="adl-brand-copy">
						<a class="adl-site-title" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($brand_name); ?></a>
						<p class="adl-site-tagline"><?php echo esc_html($tagline); ?></p>
					</div>
				<?php else : ?>
					<a class="adl-brand-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr($brand_name); ?>">
						<img class="adl-brand-logo-image" src="<?php echo esc_url($default_logo); ?>" alt="<?php echo esc_attr($brand_name); ?>">
					</a>
				<?php endif; ?>
			</div>

			<nav class="adl-main-navigation" aria-label="<?php esc_attr_e('Primary Menu', 'anshika-digital-library'); ?>">
				<?php anshika_digital_library_render_primary_menu(); ?>
			</nav>

			<div class="adl-nav-actions">
				<a class="adl-call-button" href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($call_label); ?></a>
				<button class="adl-menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" data-nav-toggle>
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</div>

		<?php anshika_digital_library_render_mobile_menu(); ?>
	</div>

	<div class="adl-mobile-cta">
		<a href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($call_label); ?></a>
		<a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer"><?php esc_html_e('WhatsApp Enquiry', 'anshika-digital-library'); ?></a>
	</div>
</header>

<main id="content" class="adl-site-main">
