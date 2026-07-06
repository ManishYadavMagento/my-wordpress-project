<?php
/**
 * Front page template.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$settings        = anshika_digital_library_get_global_settings();
$homepage        = anshika_digital_library_get_homepage_data();
$facilities_page = anshika_digital_library_get_facilities_page_data();
$seat_plans_page = anshika_digital_library_get_seat_plans_page_data();
$gallery_page_data = anshika_digital_library_get_gallery_page_data();
$phone           = $settings['phone'];
$call_link       = 'tel:' . preg_replace('/\D+/', '', $phone);
$whatsapp_link   = $settings['whatsapp_link'];
$address         = $settings['address'];
$hero            = $homepage['hero'];
$why_choose_us   = $homepage['why_choose']['items'];
$facilities      = $homepage['facilities_preview_items'];
$seat_plans      = $seat_plans_page['plans'];
$courses         = $homepage['optional_courses']['items'];
$gallery_items   = array_slice($gallery_page_data['items'], 0, 4);
$about_page_url  = anshika_digital_library_get_page_url('about', home_url('/#about'));
$gallery_page    = anshika_digital_library_get_page_url('gallery', home_url('/#gallery'));
$plans_page      = anshika_digital_library_get_page_url('seat-plans', home_url('/#seat-plans'));
$contact_page    = anshika_digital_library_get_page_url('contact', home_url('/#contact'));
$facilities_page_url = anshika_digital_library_get_page_url('facilities', home_url('/#facilities'));
?>

<section class="adl-hero-slider" id="home" data-slider>
	<div class="adl-slider-track" data-slider-track>
		<section class="adl-hero adl-slide is-active" data-slide>

			<!-- FULL WIDTH IMAGE -->
			<div class="adl-hero-bg">
				<?php
				echo wp_kses_post(
					anshika_digital_library_get_image_html(
						$hero['image'],
						'full',
						array(
							'class' => 'adl-hero-main-image',
							'alt'   => $hero['image']['alt'],
						)
					)
				);
				?>
			</div>

			<!-- CONTENT RIGHT SIDE -->
			<div class="adl-container adl-container-wide">
				<div class="adl-hero-inner adl-hero-content-wrap">

					<div class="adl-hero-copy adl-hero-copy-right">
						<span class="adl-eyebrow">
							<?php echo esc_html($hero['eyebrow']); ?>
						</span>

						<h1><?php echo esc_html($hero['title']); ?></h1>

						<p class="adl-hero-subtitle">
							<?php echo esc_html($hero['subtitle']); ?>
						</p>

						<div class="adl-hero-actions">
							<a class="adl-button adl-button-primary" href="<?php echo esc_url($call_link); ?>">
								<?php echo esc_html($hero['call_label']); ?>
							</a>

							<a class="adl-button adl-button-secondary" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer">
								<?php echo esc_html($hero['whatsapp_label']); ?>
							</a>

							<a class="adl-button adl-button-light" href="<?php echo esc_url($facilities_page_url); ?>">
								<?php echo esc_html($hero['facilities_label']); ?>
							</a>
						</div>

						<div class="adl-contact-pill">
							<strong><?php echo esc_html($hero['mobile_label']); ?></strong>
							<span><?php echo esc_html($phone); ?></span>
						</div>

						<ul class="adl-hero-highlights">
							<?php foreach ($hero['highlights'] as $highlight) : ?>
								<?php if (! empty($highlight)) : ?>
									<li><?php echo esc_html($highlight); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>

				</div>
			</div>

		</section>
	</div>
</section>

<section class="adl-trust-strip">
	<div class="adl-container adl-trust-grid">
		<?php foreach ($homepage['trust_items'] as $trust_item) : ?>
			<article class="adl-trust-card">
				<div class="adl-icon-badge"><?php echo wp_kses_post(anshika_digital_library_get_icon($trust_item['icon'])); ?></div>
				<div>
					<h2><?php echo esc_html($trust_item['title']); ?></h2>
					<p><?php echo esc_html($trust_item['description']); ?></p>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="adl-section" id="about">
	<div class="adl-container adl-about-grid">
		<div class="adl-section-heading">
			<span class="adl-eyebrow"><?php echo esc_html($homepage['about_preview']['eyebrow']); ?></span>
			<h2><?php echo esc_html($homepage['about_preview']['title']); ?></h2>
			<p><?php echo esc_html($homepage['about_preview']['description']); ?></p>
		</div>

		<div class="adl-about-card">
			<p><?php echo esc_html($homepage['about_preview']['card_description']); ?></p>
			<ul class="adl-check-list">
				<?php foreach ($homepage['about_preview']['card_points'] as $point) : ?>
					<?php if (! empty($point)) : ?>
						<li><?php echo esc_html($point); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<a class="adl-text-link" href="<?php echo esc_url($about_page_url); ?>"><?php echo esc_html($homepage['about_preview']['link_label']); ?></a>
		</div>
	</div>
</section>

<section class="adl-section adl-section-soft">
	<div class="adl-container">
		<div class="adl-section-heading adl-section-heading-center">
			<span class="adl-eyebrow"><?php echo esc_html($homepage['why_choose']['eyebrow']); ?></span>
			<h2><?php echo esc_html($homepage['why_choose']['title']); ?></h2>
			<?php if (! empty($homepage['why_choose']['description'])) : ?>
				<p><?php echo esc_html($homepage['why_choose']['description']); ?></p>
			<?php endif; ?>
		</div>

		<div class="adl-card-grid adl-card-grid-3">
			<?php foreach ($why_choose_us as $item) : ?>
				<article class="adl-info-card">
					<div class="adl-icon-badge"><?php echo wp_kses_post(anshika_digital_library_get_icon($item['icon'])); ?></div>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['description']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="adl-section adl-section-dark" id="facilities">
	<div class="adl-container">
		<div class="adl-section-heading adl-section-heading-center">
			<span class="adl-eyebrow"><?php echo esc_html($homepage['facilities_intro']['eyebrow']); ?></span>
			<h2><?php echo esc_html($homepage['facilities_intro']['title']); ?></h2>
			<p><?php echo esc_html($homepage['facilities_intro']['description']); ?></p>
		</div>

		<div class="adl-card-grid adl-card-grid-3">
			<?php foreach (array_slice($facilities, 0, 6) as $facility) : ?>
				<article class="adl-feature-card">
					<div class="adl-icon-badge"><?php echo wp_kses_post(anshika_digital_library_get_icon($facility['icon'])); ?></div>
					<h3><?php echo esc_html($facility['title']); ?></h3>
					<p><?php echo esc_html($facility['description']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="adl-section-cta">
			<a class="adl-button adl-button-light" href="<?php echo esc_url($facilities_page_url); ?>"><?php echo esc_html($homepage['facilities_intro']['button_label']); ?></a>
		</div>
	</div>
</section>

<section class="adl-section" id="seat-plans">
	<div class="adl-container">
		<div class="adl-section-heading adl-section-heading-center">
			<span class="adl-eyebrow"><?php esc_html_e('Seat Plans', 'anshika-digital-library'); ?></span>
			<h2><?php esc_html_e('Flexible seat options for different study routines.', 'anshika-digital-library'); ?></h2>
			<p><?php esc_html_e('Choose a plan based on your daily schedule, study goals, and preferred level of consistency.', 'anshika-digital-library'); ?></p>
		</div>

		<div class="adl-plan-grid">
			<?php foreach ($seat_plans as $plan) : ?>
				<?php
				$plan_features = array_filter(
					array(
						$plan['feature_1'] ?? '',
						$plan['feature_2'] ?? '',
						$plan['feature_3'] ?? '',
					)
				);
				$plan_link = ! empty($plan['button_link']) ? $plan['button_link'] : $contact_page;
				$plan_button_label = ! empty($plan['button_label']) ? $plan['button_label'] : __('Enquire Now', 'anshika-digital-library');
				?>
				<article class="adl-plan-card<?php echo $plan['featured'] ? ' is-featured' : ''; ?>">
					<?php if ($plan['featured']) : ?>
						<span class="adl-plan-badge"><?php esc_html_e('Most Popular', 'anshika-digital-library'); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html($plan['name']); ?></h3>
					<div class="adl-plan-price"><?php echo esc_html($plan['price']); ?></div>
					<p><?php echo esc_html($plan['description']); ?></p>
					<ul class="adl-plan-features">
						<?php foreach ($plan_features as $feature) : ?>
							<li><?php echo esc_html($feature); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="adl-button adl-button-outline" href="<?php echo esc_url($plan_link); ?>"><?php echo esc_html($plan_button_label); ?></a>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="adl-section-cta">
			<a class="adl-text-link" href="<?php echo esc_url($plans_page); ?>"><?php esc_html_e('View complete seat plans page', 'anshika-digital-library'); ?></a>
		</div>
	</div>
</section>

<section class="adl-section adl-section-soft" id="gallery">
	<div class="adl-container">
		<div class="adl-section-heading adl-section-heading-center">
			<span class="adl-eyebrow"><?php esc_html_e('Gallery', 'anshika-digital-library'); ?></span>
			<h2><?php esc_html_e('A clean, modern library atmosphere.', 'anshika-digital-library'); ?></h2>
			<p><?php esc_html_e('Library photos will be updated soon.', 'anshika-digital-library'); ?></p>
		</div>

		<div class="adl-gallery-grid">
			<?php foreach ($gallery_items as $item) : ?>
				<div class="adl-gallery-card" style="background-image: linear-gradient(180deg, rgba(8, 18, 37, 0.1), rgba(8, 18, 37, 0.78)), url('<?php echo esc_url($item['image']['url'] ?? ''); ?>');">
					<span><?php echo esc_html($item['title']); ?></span>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="adl-section-cta">
			<a class="adl-text-link" href="<?php echo esc_url($gallery_page); ?>"><?php esc_html_e('Open gallery page', 'anshika-digital-library'); ?></a>
		</div>
	</div>
</section>

<section class="adl-section">
	<div class="adl-container adl-optional-grid">
		<div class="adl-section-heading">
			<span class="adl-eyebrow"><?php echo esc_html($homepage['optional_courses']['eyebrow']); ?></span>
			<h2><?php echo esc_html($homepage['optional_courses']['title']); ?></h2>
			<p><?php echo esc_html($homepage['optional_courses']['description']); ?></p>
		</div>

		<div class="adl-course-cloud">
			<?php foreach ($courses as $course) : ?>
				<span><?php echo esc_html($course); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="adl-section adl-section-dark" id="contact">
	<div class="adl-container adl-contact-grid">
		<div class="adl-contact-stack">
			<div class="adl-contact-card">
				<span class="adl-eyebrow"><?php echo esc_html($homepage['contact_section']['eyebrow']); ?></span>
				<h2><?php echo esc_html($homepage['contact_section']['title']); ?></h2>
				<ul class="adl-contact-list">
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('location')); ?><span><?php echo esc_html($address); ?></span></li>
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('phone')); ?><a href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($phone); ?></a></li>
					<li><?php echo wp_kses_post(anshika_digital_library_get_icon('message')); ?><a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer"><?php esc_html_e('WhatsApp Enquiry', 'anshika-digital-library'); ?></a></li>
				</ul>
				<div class="adl-hero-actions">
					<a class="adl-button adl-button-primary" href="<?php echo esc_url($call_link); ?>"><?php echo esc_html($homepage['contact_section']['call_button']); ?></a>
					<a class="adl-button adl-button-secondary" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noreferrer"><?php echo esc_html($homepage['contact_section']['whatsapp_button']); ?></a>
				</div>
			</div>

			<div class="adl-map-placeholder">
				<h3><?php echo esc_html($homepage['contact_section']['map_title']); ?></h3>
				<p><?php echo esc_html($homepage['contact_section']['map_description']); ?></p>
			</div>
		</div>

		<div class="adl-contact-form-shell">
			<div class="adl-contact-form-header">
				<span class="adl-eyebrow"><?php echo esc_html($homepage['contact_section']['form_eyebrow']); ?></span>
				<h2><?php echo esc_html($homepage['contact_section']['form_title']); ?></h2>
			</div>
			<?php anshika_digital_library_render_contact_form(); ?>
		</div>
	</div>
</section>

<?php
get_footer();
