<?php
/**
 * Theme functions for Anshika Digital Library.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

define('ANSHIKA_DIGITAL_LIBRARY_VERSION', '1.0.2');

require_once get_template_directory() . '/inc/theme-dynamic.php';
require_once get_template_directory() . '/inc/acf-fields.php';

function anshika_digital_library_asset_version($relative_path) {
	$file_path = get_template_directory() . $relative_path;

	if (file_exists($file_path)) {
		return (string) filemtime($file_path);
	}

	return ANSHIKA_DIGITAL_LIBRARY_VERSION;
}

function anshika_digital_library_brand_name() {
	$settings = function_exists('anshika_digital_library_get_global_settings') ? anshika_digital_library_get_global_settings() : array();

	if (! empty($settings['brand_name'])) {
		return $settings['brand_name'];
	}

	return 'Anshika Digital Library';
}

function anshika_digital_library_tagline() {
	$settings = function_exists('anshika_digital_library_get_global_settings') ? anshika_digital_library_get_global_settings() : array();

	if (! empty($settings['tagline'])) {
		return $settings['tagline'];
	}

	return __('AC study zone, reading hall, and peaceful digital library in Ghazipur.', 'anshika-digital-library');
}

function anshika_digital_library_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 80,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'anshika-digital-library'),
		)
	);
}
add_action('after_setup_theme', 'anshika_digital_library_setup');

function anshika_digital_library_enqueue_assets() {
	wp_enqueue_style(
		'anshika-digital-library-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'anshika-digital-library-style',
		get_stylesheet_uri(),
		array(),
		anshika_digital_library_asset_version('/style.css')
	);
	wp_enqueue_style(
		'anshika-digital-library-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array('anshika-digital-library-fonts', 'anshika-digital-library-style'),
		anshika_digital_library_asset_version('/assets/css/main.css')
	);

	wp_enqueue_script(
		'anshika-digital-library-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		anshika_digital_library_asset_version('/assets/js/main.js'),
		true
	);
}
add_action('wp_enqueue_scripts', 'anshika_digital_library_enqueue_assets');

function anshika_digital_library_default_options() {
	return array(
		'phone'               => '7704064507',
		'address'             => 'Nawapura Petrol Pump ke bagal me, Ghazipur',
		'whatsapp_link'       => 'https://wa.me/917704064507',
		'contact_form_code'   => '[contact-form-7 id="123" title="Library Enquiry Form"]',
		'daily_pass_price'    => 'Contact for Price',
		'monthly_seat_price'  => 'Contact for Price',
		'reserved_seat_price' => 'Contact for Price',
	);
}

function anshika_digital_library_get_option($key) {
	if (function_exists('anshika_digital_library_get_global_option')) {
		$global_value = anshika_digital_library_get_global_option($key);

		if (null !== $global_value && '' !== $global_value) {
			return $global_value;
		}
	}

	$defaults = anshika_digital_library_default_options();
	$fallback = isset($defaults[ $key ]) ? $defaults[ $key ] : '';
	$value    = get_theme_mod('anshika_' . $key, $fallback);

	return is_string($value) ? trim($value) : $value;
}

function anshika_digital_library_get_page_path($key) {
	$paths = array(
		'home'       => '',
		'about'      => 'about',
		'facilities' => 'library-facilities',
		'seat-plans' => 'seat-plans',
		'gallery'    => 'gallery',
		'contact'    => 'contact',
	);

	return isset($paths[ $key ]) ? $paths[ $key ] : '';
}

function anshika_digital_library_get_page_url($key, $fallback = '') {
	$path = anshika_digital_library_get_page_path($key);

	if ('home' === $key || '' === $path) {
		return home_url('/');
	}

	$page = get_page_by_path($path, OBJECT, 'page');

	if ($page instanceof WP_Post) {
		return get_permalink($page);
	}

	return $fallback ? $fallback : home_url('/' . $path . '/');
}

function anshika_digital_library_get_library_image_uri() {
	return get_template_directory_uri() . '/assets/images/library-study-space.png';
}

function anshika_digital_library_get_hero_slides() {
	$image_uri = anshika_digital_library_get_library_image_uri();

	return array(
		array(
			'eyebrow'   => __('Premium Digital Library in Ghazipur', 'anshika-digital-library'),
			'title'     => __('Anshika Digital Library', 'anshika-digital-library'),
			'subtitle'  => __('AC Study Zone, Wi-Fi, CCTV, Separate Seating और Comfortable Study Environment के साथ Ghazipur में premium digital library.', 'anshika-digital-library'),
			'highlight' => __('Admissions Open', 'anshika-digital-library'),
			'note'      => __('Seat enquiry, admission guidance, and monthly plan support available now.', 'anshika-digital-library'),
			'image'     => $image_uri,
			'image_alt' => __('Study hall view of Anshika Digital Library', 'anshika-digital-library'),
		),
	);
}

function anshika_digital_library_get_why_choose_us() {
	return array(
		array(
			'icon'        => 'book',
			'title'       => 'Peaceful Study Environment',
			'description' => 'Competitive exam preparation, self-study, aur long focused sessions ke liye calm and distraction-free setup.',
		),
		array(
			'icon'        => 'snow',
			'title'       => 'AC Reading Hall',
			'description' => 'Temperature-controlled hall jahan students long hours tak better focus ke saath padh sakein.',
		),
		array(
			'icon'        => 'wifi',
			'title'       => 'Wi-Fi Enabled',
			'description' => 'Online tests, PDFs, research, aur digital study support ke liye reliable internet access.',
		),
		array(
			'icon'        => 'shield',
			'title'       => 'CCTV Security',
			'description' => 'Disciplined, monitored, aur secure environment jo students ko confidence ke saath study karne deta hai.',
		),
		array(
			'icon'        => 'group',
			'title'       => 'Separate Seating',
			'description' => 'Boys and girls ke liye organized seating arrangement for comfort and discipline.',
		),
		array(
			'icon'        => 'quiet',
			'title'       => 'Clean & Disciplined Space',
			'description' => 'Neat, well-maintained, and structured study zone that supports consistency every day.',
		),
	);
}

function anshika_digital_library_get_facilities() {
	return array(
		array(
			'icon'        => 'snow',
			'title'       => 'Full AC Zone',
			'description' => 'Comfortable temperature-controlled study hall for long and productive reading sessions.',
		),
		array(
			'icon'        => 'wifi',
			'title'       => 'High-Speed Wi-Fi',
			'description' => 'Fast internet for online classes, PDFs, mock tests, and digital study support.',
		),
		array(
			'icon'        => 'cctv',
			'title'       => 'CCTV Monitoring',
			'description' => 'Secure and disciplined study environment with regular monitoring.',
		),
		array(
			'icon'        => 'group',
			'title'       => 'Boys/Girls Separate Seating',
			'description' => 'Organized seating arrangement for comfort, discipline, and smooth daily study.',
		),
		array(
			'icon'        => 'water',
			'title'       => 'Drinking Water',
			'description' => 'Clean drinking water facility available inside the study space.',
		),
		array(
			'icon'        => 'print',
			'title'       => 'PDF Printout',
			'description' => 'Quick print support for notes, PDFs, forms, and study documents.',
		),
		array(
			'icon'        => 'print',
			'title'       => 'Free Admit Card Print',
			'description' => 'Helpful admit card print support for students during exam season.',
		),
		array(
			'icon'        => 'desk',
			'title'       => 'Comfortable Desk & Chair',
			'description' => 'Ergonomic study setup designed for long sitting hours and better focus.',
		),
		array(
			'icon'        => 'test',
			'title'       => 'Weekly CBT / OMR Test',
			'description' => 'Practice-oriented weekly support for exam preparation and progress checking.',
		),
		array(
			'icon'        => 'quiet',
			'title'       => 'Quiet Study Zone',
			'description' => 'Low-distraction atmosphere made for concentration and serious self-study.',
		),
		array(
			'icon'        => 'shield',
			'title'       => 'Clean Environment',
			'description' => 'Hygienic, neat, and disciplined surroundings to keep study sessions comfortable.',
		),
		array(
			'icon'        => 'star',
			'title'       => 'Power Backup',
			'description' => 'Placeholder support for uninterrupted study environment when required.',
		),
	);
}

function anshika_digital_library_get_seat_plans() {
	return array(
		array(
			'name'        => 'Daily Pass',
			'price'       => anshika_digital_library_get_option('daily_pass_price'),
			'description' => 'Short-term study visitors aur trial study sessions ke liye flexible access.',
			'features'    => array('Flexible daily access', 'Quiet study zone', 'Wi-Fi support'),
			'featured'    => false,
		),
		array(
			'name'        => 'Monthly Seat',
			'price'       => anshika_digital_library_get_option('monthly_seat_price'),
			'description' => 'Regular students ke liye monthly structured study routine and disciplined daily environment.',
			'features'    => array('Consistent monthly access', 'AC reading hall', 'Best for regular students'),
			'featured'    => true,
		),
		array(
			'name'        => 'Reserved Seat',
			'price'       => anshika_digital_library_get_option('reserved_seat_price'),
			'description' => 'Dedicated seat preference ke saath more stable study experience for serious learners.',
			'features'    => array('Dedicated seat preference', 'Long-hour comfort', 'Priority enquiry support'),
			'featured'    => false,
		),
	);
}

function anshika_digital_library_get_courses() {
	return array('DCA', 'ADCA', 'CCC', 'O Level', 'Typing Hindi/English', 'Tally', 'Advance Excel', 'Basic Computer Course');
}

function anshika_digital_library_get_gallery_items() {
	$image_uri = anshika_digital_library_get_library_image_uri();

	return array(
		array(
			'title' => 'Reading Hall View',
			'image' => $image_uri,
			'alt'   => __('Reading hall seating at Anshika Digital Library', 'anshika-digital-library'),
		),
		array(
			'title' => 'Student Seating Area',
			'image' => $image_uri,
			'alt'   => __('Student seating area inside the library', 'anshika-digital-library'),
		),
		array(
			'title' => 'AC Study Zone',
			'image' => $image_uri,
			'alt'   => __('Air-conditioned study zone at the library', 'anshika-digital-library'),
		),
		array(
			'title' => 'Focused Self-Study Corner',
			'image' => $image_uri,
			'alt'   => __('Quiet self-study corner in the library', 'anshika-digital-library'),
		),
		array(
			'title' => 'Seat Layout Preview',
			'image' => $image_uri,
			'alt'   => __('Numbered study seats inside the library', 'anshika-digital-library'),
		),
		array(
			'title' => 'Library Interior View',
			'image' => $image_uri,
			'alt'   => __('Interior view of Anshika Digital Library', 'anshika-digital-library'),
		),
	);
}

function anshika_digital_library_get_contact_form_shortcode() {
	return anshika_digital_library_get_option('contact_form_code');
}

function anshika_digital_library_customize_register($wp_customize) {
	$wp_customize->add_section(
		'anshika_contact_section',
		array(
			'title'       => __('Library Contact Details', 'anshika-digital-library'),
			'description' => __('Update the phone number, address, WhatsApp link, and form shortcode used across the homepage.', 'anshika-digital-library'),
			'priority'    => 30,
		)
	);

	$contact_fields = array(
		'phone'             => __('Phone Number', 'anshika-digital-library'),
		'address'           => __('Address', 'anshika-digital-library'),
		'whatsapp_link'     => __('WhatsApp Link', 'anshika-digital-library'),
		'contact_form_code' => __('Contact Form Shortcode', 'anshika-digital-library'),
	);

	foreach ($contact_fields as $field => $label) {
		$sanitize_callback = 'sanitize_text_field';

		if ('whatsapp_link' === $field) {
			$sanitize_callback = 'esc_url_raw';
		} elseif ('contact_form_code' === $field) {
			$sanitize_callback = 'wp_kses_post';
		}

		$wp_customize->add_setting(
			'anshika_' . $field,
			array(
				'default'           => anshika_digital_library_default_options()[ $field ],
				'sanitize_callback' => $sanitize_callback,
			)
		);

		$wp_customize->add_control(
			'anshika_' . $field,
			array(
				'label'   => $label,
				'section' => 'anshika_contact_section',
				'type'    => 'contact_form_code' === $field ? 'textarea' : 'text',
			)
		);
	}

	$wp_customize->add_section(
		'anshika_seat_plans_section',
		array(
			'title'       => __('Seat Plan Prices', 'anshika-digital-library'),
			'description' => __('Customize the pricing text shown in the seat plans section.', 'anshika-digital-library'),
			'priority'    => 31,
		)
	);

	$price_fields = array(
		'daily_pass_price'    => __('Daily Pass Price', 'anshika-digital-library'),
		'monthly_seat_price'  => __('Monthly Seat Price', 'anshika-digital-library'),
		'reserved_seat_price' => __('Reserved Seat Price', 'anshika-digital-library'),
	);

	foreach ($price_fields as $field => $label) {
		$wp_customize->add_setting(
			'anshika_' . $field,
			array(
				'default'           => anshika_digital_library_default_options()[ $field ],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'anshika_' . $field,
			array(
				'label'   => $label,
				'section' => 'anshika_seat_plans_section',
				'type'    => 'text',
			)
		);
	}
}
add_action('customize_register', 'anshika_digital_library_customize_register');

function anshika_digital_library_get_fallback_menu_items() {
	return array(
		array(
			'label' => __('Home', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('home'),
		),
		array(
			'label' => __('About', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('about', home_url('/#about')),
		),
		array(
			'label' => __('Library Facilities', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('facilities', home_url('/#facilities')),
		),
		array(
			'label' => __('Seat Plans', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('seat-plans', home_url('/#seat-plans')),
		),
		array(
			'label' => __('Gallery', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('gallery', home_url('/#gallery')),
		),
		array(
			'label' => __('Contact', 'anshika-digital-library'),
			'url'   => anshika_digital_library_get_page_url('contact', home_url('/#contact')),
		),
	);
}

function anshika_digital_library_render_primary_menu() {
	if (has_nav_menu('primary')) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'adl-nav-list',
				'fallback_cb'    => false,
			)
		);
		return;
	}

	echo '<ul class="adl-nav-list">';
	foreach (anshika_digital_library_get_fallback_menu_items() as $item) {
		echo '<li><a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a></li>';
	}
	echo '</ul>';
}

function anshika_digital_library_render_mobile_menu() {
	echo '<div class="adl-mobile-panel" id="mobile-menu">';

	if (has_nav_menu('primary')) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'adl-mobile-nav',
				'fallback_cb'    => false,
			)
		);
		echo '</div>';
		return;
	}

	echo '<ul class="adl-mobile-nav">';
	foreach (anshika_digital_library_get_fallback_menu_items() as $item) {
		echo '<li><a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a></li>';
	}
	echo '</ul>';
	echo '</div>';
}

function anshika_digital_library_get_icon($icon) {
	$icons = array(
		'book'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5V4.5Zm0 0V20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'snow'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2v20M4.93 6l14.14 12M4.93 18 19.07 6M2 12h20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'wifi'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 9a16 16 0 0 1 19 0M6 12.5a10.5 10.5 0 0 1 12 0M9.5 16a5 5 0 0 1 5 0M12 20h0" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'cctv'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8h12l4 4H7l-4-4Zm8 4v4m-3 4h6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'group'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.5 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm9 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.5 20a4 4 0 0 1 8 0m5-3a4 4 0 0 1 4 3" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'water'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3s5 5.3 5 9a5 5 0 1 1-10 0c0-3.7 5-9 5-9Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'print'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 8V3h10v5M7 17h10v4H7v-4Zm-2 0H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-1" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'desk'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16v5H4V7Zm2 5v5m12-5v5m-8-5v9" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'test'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'shield'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'quiet'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9a6 6 0 0 1 12 0c0 3-2 4-2 7H8c0-3-2-4-2-7Zm3 11h6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'phone'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 3h3L11 7.2 8.8 8.8A14.5 14.5 0 0 0 15.2 15l1.6-2.2L21 14.4v3a2 2 0 0 1-2.2 2A17.8 17.8 0 0 1 4.6 5.2 2 2 0 0 1 6.6 3Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'location'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-5.7 7-11a7 7 0 1 0-14 0c0 5.3 7 11 7 11Zm0-8.5A2.5 2.5 0 1 0 12 7a2.5 2.5 0 0 0 0 5.5Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'message'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 5h14v10H8l-3 3V5Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'star'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6-5.4-2.9-5.4 2.9 1-6L3.2 9.4l6.1-.9L12 3Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);

	return isset($icons[ $icon ]) ? $icons[ $icon ] : $icons['star'];
}

function anshika_digital_library_render_contact_form() {
	$shortcode = anshika_digital_library_get_contact_form_shortcode();

	if (! empty($shortcode) && shortcode_exists('contact-form-7')) {
		$output = do_shortcode(wp_kses_post($shortcode));

		if (is_string($output) && '' !== trim(wp_strip_all_tags($output))) {
			echo $output;
			return;
		}
	}

	echo '<div class="adl-form-fallback">';
	echo '<h3>' . esc_html__('Enquiry Form Placeholder', 'anshika-digital-library') . '</h3>';
	echo '<p>' . esc_html__('Install and activate Contact Form 7, then replace the shortcode from Appearance > Customize > Library Contact Details.', 'anshika-digital-library') . '</p>';
	echo '<code>[contact-form-7 id="123" title="Library Enquiry Form"]</code>';
	echo '</div>';
}

function anshika_digital_library_body_classes($classes) {
	$classes[] = 'anshika-theme';
	return $classes;
}
add_filter('body_class', 'anshika_digital_library_body_classes');

function anshika_digital_library_document_title_parts($title_parts) {
	if (is_front_page()) {
		$title_parts['title'] = 'Anshika Digital Library Ghazipur | AC Study Zone & Reading Hall';
	}

	return $title_parts;
}
add_filter('document_title_parts', 'anshika_digital_library_document_title_parts');

function anshika_digital_library_pre_get_document_title($title) {
	if (is_front_page()) {
		return 'Anshika Digital Library Ghazipur | AC Study Zone & Reading Hall';
	}

	return $title;
}
add_filter('pre_get_document_title', 'anshika_digital_library_pre_get_document_title');

function anshika_digital_library_ensure_core_pages() {
	if (get_option('anshika_digital_library_pages_created')) {
		return;
	}

	$pages = array(
		array(
			'title'    => 'Home',
			'slug'     => 'home',
			'template' => 'default',
			'front'    => true,
		),
		array(
			'title'    => 'About',
			'slug'     => 'about',
			'template' => 'page-about.php',
		),
		array(
			'title'    => 'Library Facilities',
			'slug'     => 'library-facilities',
			'template' => 'page-facilities.php',
		),
		array(
			'title'    => 'Seat Plans',
			'slug'     => 'seat-plans',
			'template' => 'page-seat-plans.php',
		),
		array(
			'title'    => 'Gallery',
			'slug'     => 'gallery',
			'template' => 'page-gallery.php',
		),
		array(
			'title'    => 'Contact',
			'slug'     => 'contact',
			'template' => 'page-contact.php',
		),
	);

	$home_page_id = 0;

	foreach ($pages as $page_config) {
		$page = get_page_by_path($page_config['slug'], OBJECT, 'page');

		if (! $page instanceof WP_Post) {
			$page_id = wp_insert_post(
				array(
					'post_title'   => $page_config['title'],
					'post_name'    => $page_config['slug'],
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => '',
				),
				true
			);

			if (is_wp_error($page_id)) {
				continue;
			}

			$page = get_post($page_id);
		}

		if (! $page instanceof WP_Post) {
			continue;
		}

		if (! empty($page_config['template']) && 'default' !== $page_config['template']) {
			update_post_meta($page->ID, '_wp_page_template', $page_config['template']);
		}

		if (! empty($page_config['front'])) {
			$home_page_id = (int) $page->ID;
		}
	}

	if ($home_page_id > 0) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $home_page_id);
	}

	update_option('anshika_digital_library_pages_created', 1);
}
add_action('init', 'anshika_digital_library_ensure_core_pages');

function anshika_digital_library_ensure_permalink_structure() {
	if (get_option('anshika_digital_library_permalinks_set')) {
		return;
	}

	if ('' === get_option('permalink_structure')) {
		update_option('permalink_structure', '/%postname%/');
		flush_rewrite_rules(false);
	}

	update_option('anshika_digital_library_permalinks_set', 1);
}
add_action('init', 'anshika_digital_library_ensure_permalink_structure', 20);
