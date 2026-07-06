<?php
/**
 * Dynamic content helpers powered by ACF with sensible theme fallbacks.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

function anshika_digital_library_has_meaningful_value($value) {
	if (is_array($value)) {
		foreach ($value as $item) {
			if (anshika_digital_library_has_meaningful_value($item)) {
				return true;
			}
		}

		return false;
	}

	return null !== $value && '' !== trim((string) $value);
}

function anshika_digital_library_get_dynamic_page_id($key) {
	static $page_ids = array();

	if (isset($page_ids[ $key ])) {
		return $page_ids[ $key ];
	}

	$path = anshika_digital_library_get_page_path($key);

	if ('home' === $key || '' === $path) {
		$page_ids[ $key ] = (int) get_option('page_on_front');
		return $page_ids[ $key ];
	}

	$page = get_page_by_path($path, OBJECT, 'page');
	$page_ids[ $key ] = $page instanceof WP_Post ? (int) $page->ID : 0;

	return $page_ids[ $key ];
}

function anshika_digital_library_get_settings_page_id() {
	$page_id = anshika_digital_library_get_dynamic_page_id('home');

	if ($page_id > 0) {
		return $page_id;
	}

	return 0;
}

function anshika_digital_library_get_acf_field_value($field_name, $post_id, $fallback = '') {
	if (function_exists('get_field') && $post_id > 0) {
		$value = get_field($field_name, $post_id);

		if (anshika_digital_library_has_meaningful_value($value)) {
			return $value;
		}
	}

	return $fallback;
}

function anshika_digital_library_merge_group_field($field_name, $post_id, $fallback) {
	$value = anshika_digital_library_get_acf_field_value($field_name, $post_id, array());

	if (! is_array($value)) {
		return $fallback;
	}

	foreach ($fallback as $key => $default_value) {
		if (isset($value[ $key ]) && anshika_digital_library_has_meaningful_value($value[ $key ])) {
			$fallback[ $key ] = $value[ $key ];
		}
	}

	return $fallback;
}

function anshika_digital_library_get_image_data($field_name, $post_id, $fallback_url, $fallback_alt = '') {
	$value = anshika_digital_library_get_acf_field_value($field_name, $post_id, null);

	if (is_array($value) && ! empty($value['ID'])) {
		return array(
			'id'  => (int) $value['ID'],
			'url' => wp_get_attachment_image_url((int) $value['ID'], 'full'),
			'alt' => ! empty($value['alt']) ? $value['alt'] : $fallback_alt,
		);
	}

	if (is_numeric($value)) {
		return array(
			'id'  => (int) $value,
			'url' => wp_get_attachment_image_url((int) $value, 'full'),
			'alt' => get_post_meta((int) $value, '_wp_attachment_image_alt', true),
		);
	}

	if (is_string($value) && '' !== trim($value)) {
		return array(
			'id'  => 0,
			'url' => esc_url_raw($value),
			'alt' => $fallback_alt,
		);
	}

	return array(
		'id'  => 0,
		'url' => $fallback_url,
		'alt' => $fallback_alt,
	);
}

function anshika_digital_library_get_image_html($image, $size = 'full', $attributes = array()) {
	$defaults = array(
		'alt' => '',
	);

	$attributes = wp_parse_args($attributes, $defaults);

	if (! empty($image['id'])) {
		return wp_get_attachment_image((int) $image['id'], $size, false, $attributes);
	}

	if (empty($image['url'])) {
		return '';
	}

	$attribute_html = '';
	foreach ($attributes as $name => $value) {
		if (null === $value || '' === $value) {
			continue;
		}

		$attribute_html .= sprintf(' %1$s="%2$s"', esc_attr($name), esc_attr((string) $value));
	}

	return sprintf('<img src="%1$s"%2$s>', esc_url($image['url']), $attribute_html);
}

function anshika_digital_library_get_global_settings() {
	static $settings = null;

	if (null !== $settings) {
		return $settings;
	}

	$page_id = anshika_digital_library_get_settings_page_id();

	$settings = array(
		'brand_name'            => anshika_digital_library_get_acf_field_value('site_brand_name', $page_id, 'Anshika Digital Library'),
		'tagline'               => anshika_digital_library_get_acf_field_value('site_tagline', $page_id, __('AC study zone, reading hall, and peaceful digital library in Ghazipur.', 'anshika-digital-library')),
		'phone'                 => anshika_digital_library_get_acf_field_value('site_phone', $page_id, '7704064507'),
		'address'               => anshika_digital_library_get_acf_field_value('site_address', $page_id, 'Nawapura Petrol Pump ke bagal me, Ghazipur'),
		'whatsapp_link'         => anshika_digital_library_get_acf_field_value('site_whatsapp_link', $page_id, 'https://wa.me/917704064507'),
		'contact_form_code'     => anshika_digital_library_get_acf_field_value('site_contact_form_code', $page_id, '[contact-form-7 id="123" title="Library Enquiry Form"]'),
		'header_call_label'     => anshika_digital_library_get_acf_field_value('header_call_label', $page_id, __('Call Now', 'anshika-digital-library')),
		'footer_about_heading'  => anshika_digital_library_get_acf_field_value('footer_about_heading', $page_id, 'Anshika Digital Library'),
		'footer_description'    => anshika_digital_library_get_acf_field_value('footer_description', $page_id, __('Modern digital library, peaceful study zone, and disciplined reading environment for students in Ghazipur.', 'anshika-digital-library')),
		'footer_links_heading'  => anshika_digital_library_get_acf_field_value('footer_links_heading', $page_id, __('Quick Links', 'anshika-digital-library')),
		'footer_facilities_heading' => anshika_digital_library_get_acf_field_value('footer_facilities_heading', $page_id, __('Facilities', 'anshika-digital-library')),
		'footer_contact_heading'    => anshika_digital_library_get_acf_field_value('footer_contact_heading', $page_id, __('Contact', 'anshika-digital-library')),
		'footer_facility_items' => array(
			anshika_digital_library_get_acf_field_value('footer_facility_1', $page_id, __('Full AC Study Zone', 'anshika-digital-library')),
			anshika_digital_library_get_acf_field_value('footer_facility_2', $page_id, __('High-Speed Wi-Fi', 'anshika-digital-library')),
			anshika_digital_library_get_acf_field_value('footer_facility_3', $page_id, __('Separate Seating', 'anshika-digital-library')),
			anshika_digital_library_get_acf_field_value('footer_facility_4', $page_id, __('Weekly CBT / OMR Test', 'anshika-digital-library')),
		),
	);

	return $settings;
}

function anshika_digital_library_get_global_option($key) {
	$settings = anshika_digital_library_get_global_settings();

	if ('contact_form_code' === $key && isset($settings['contact_form_code'])) {
		return $settings['contact_form_code'];
	}

	if (isset($settings[ $key ])) {
		return $settings[ $key ];
	}

	return null;
}

function anshika_digital_library_get_homepage_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id           = anshika_digital_library_get_settings_page_id();
	$library_image_uri = anshika_digital_library_get_library_image_uri();
	$facilities_page   = anshika_digital_library_get_facilities_page_data();
	$contact_page      = anshika_digital_library_get_contact_page_data();

	$data = array(
		'hero' => array(
			'eyebrow'        => anshika_digital_library_get_acf_field_value('hero_badge', $page_id, __('Premium Digital Library in Ghazipur', 'anshika-digital-library')),
			'title'          => anshika_digital_library_get_acf_field_value('hero_title', $page_id, __('Anshika Digital Library', 'anshika-digital-library')),
			'subtitle'       => anshika_digital_library_get_acf_field_value('hero_description', $page_id, __('AC Study Zone, Wi-Fi, CCTV, Separate Seating aur Comfortable Study Environment ke saath Ghazipur mein premium digital library.', 'anshika-digital-library')),
			'call_label'     => anshika_digital_library_get_acf_field_value('hero_call_label', $page_id, __('Call Now', 'anshika-digital-library')),
			'whatsapp_label' => anshika_digital_library_get_acf_field_value('hero_whatsapp_label', $page_id, __('WhatsApp Enquiry', 'anshika-digital-library')),
			'facilities_label' => anshika_digital_library_get_acf_field_value('hero_facilities_label', $page_id, __('View Facilities', 'anshika-digital-library')),
			'mobile_label'   => anshika_digital_library_get_acf_field_value('hero_mobile_label', $page_id, __('Mobile:', 'anshika-digital-library')),
			'highlights'     => array(
				anshika_digital_library_get_acf_field_value('hero_highlight_1', $page_id, __('Focused self-study and competitive exam preparation', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('hero_highlight_2', $page_id, __('Separate seating with disciplined atmosphere', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('hero_highlight_3', $page_id, __('Admission and seat enquiry support available', 'anshika-digital-library')),
			),
			'image'          => anshika_digital_library_get_image_data('hero_image', $page_id, $library_image_uri, __('Study hall view of Anshika Digital Library', 'anshika-digital-library')),
			'overlay_label'  => anshika_digital_library_get_acf_field_value('hero_overlay_label', $page_id, __('Focused Study Experience', 'anshika-digital-library')),
			'overlay_title'  => anshika_digital_library_get_acf_field_value('hero_overlay_title', $page_id, __('Discipline, comfort, and consistency', 'anshika-digital-library')),
			'banner_title'   => anshika_digital_library_get_acf_field_value('hero_banner_title', $page_id, __('Admissions Open', 'anshika-digital-library')),
			'banner_note'    => anshika_digital_library_get_acf_field_value('hero_banner_note', $page_id, __('Seat enquiry, admission guidance, and monthly plan support available now.', 'anshika-digital-library')),
			'mini_cards'     => array(),
		),
		'trust_items' => array(),
		'about_preview' => array(
			'eyebrow'          => anshika_digital_library_get_acf_field_value('home_about_badge', $page_id, __('About Anshika Digital Library', 'anshika-digital-library')),
			'title'            => anshika_digital_library_get_acf_field_value('home_about_title', $page_id, __('A premium study space designed for serious students.', 'anshika-digital-library')),
			'description'      => anshika_digital_library_get_acf_field_value('home_about_description', $page_id, __('Anshika Digital Library is built for students preparing for competitive exams, school and college study, and self-study routines. Yahan focus, comfort, discipline, aur peaceful environment ko first priority di gayi hai.', 'anshika-digital-library')),
			'card_description' => anshika_digital_library_get_acf_field_value('home_about_card_description', $page_id, __('Whether you need a calm reading hall, structured daily study environment, or a clean place to stay productive for hours, this library is created to support deep concentration, better consistency, and stronger results.', 'anshika-digital-library')),
			'card_points'      => array(
				anshika_digital_library_get_acf_field_value('home_about_point_1', $page_id, __('Peaceful and quiet study atmosphere', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('home_about_point_2', $page_id, __('Comfortable seating and modern facilities', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('home_about_point_3', $page_id, __('Suitable for competitive, school, college, and self-study students', 'anshika-digital-library')),
			),
			'link_label'       => anshika_digital_library_get_acf_field_value('home_about_link_label', $page_id, __('Read full about page', 'anshika-digital-library')),
		),
		'why_choose' => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('why_choose_badge', $page_id, __('Why Choose Us', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('why_choose_title', $page_id, __('A study environment that helps students stay consistent.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('why_choose_description', $page_id, ''),
			'items'       => array(),
		),
		'facilities_intro' => array(
			'eyebrow'      => anshika_digital_library_get_acf_field_value('home_facilities_badge', $page_id, __('Library Facilities', 'anshika-digital-library')),
			'title'        => anshika_digital_library_get_acf_field_value('home_facilities_title', $page_id, __('Everything needed for a productive and comfortable study routine.', 'anshika-digital-library')),
			'description'  => anshika_digital_library_get_acf_field_value('home_facilities_description', $page_id, __('From AC comfort and Wi-Fi to print support and weekly tests, the library is designed to reduce distractions and improve daily focus.', 'anshika-digital-library')),
			'button_label' => anshika_digital_library_get_acf_field_value('home_facilities_button_label', $page_id, __('Explore All Facilities', 'anshika-digital-library')),
		),
		'optional_courses' => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('optional_badge', $page_id, __('Optional Computer Education Support', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('optional_title', $page_id, __('Additional learning support for students who also want digital skills.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('optional_description', $page_id, __('Digital library main focus rahega, lekin zarurat par selected computer education guidance bhi available ho sakti hai.', 'anshika-digital-library')),
			'items'       => array(),
		),
		'contact_section' => array(
			'eyebrow'          => anshika_digital_library_get_acf_field_value('home_contact_badge', $page_id, __('Contact Details', 'anshika-digital-library')),
			'title'            => anshika_digital_library_get_acf_field_value('home_contact_title', $page_id, __('Book your study seat or ask for admission details.', 'anshika-digital-library')),
			'map_title'        => anshika_digital_library_get_acf_field_value('home_contact_map_title', $page_id, __('Google Map Placeholder', 'anshika-digital-library')),
			'map_description'  => anshika_digital_library_get_acf_field_value('home_contact_map_description', $page_id, __('Map embed can be added later. Filhal directions ke liye upar diya gaya address use karein.', 'anshika-digital-library')),
			'form_eyebrow'     => anshika_digital_library_get_acf_field_value('home_contact_form_badge', $page_id, __('Enquiry Form', 'anshika-digital-library')),
			'form_title'       => anshika_digital_library_get_acf_field_value('home_contact_form_title', $page_id, __('Send your seat enquiry here.', 'anshika-digital-library')),
			'call_button'      => anshika_digital_library_get_acf_field_value('home_contact_call_label', $page_id, __('Call Now', 'anshika-digital-library')),
			'whatsapp_button'  => anshika_digital_library_get_acf_field_value('home_contact_whatsapp_label', $page_id, __('WhatsApp', 'anshika-digital-library')),
		),
	);

	for ($index = 1; $index <= 4; $index++) {
		$data['hero']['mini_cards'][] = anshika_digital_library_merge_group_field(
			'hero_mini_card_' . $index,
			$page_id,
			array(
				'icon'        => array('AC', 'Wi-Fi', 'Safe', 'Seats')[ $index - 1 ],
				'title'       => array('AC', 'Wi-Fi', 'Safe', 'Seats')[ $index - 1 ],
				'description' => array(
					__('Cool and comfortable reading hall', 'anshika-digital-library'),
					__('Connected digital learning support', 'anshika-digital-library'),
					__('CCTV monitored disciplined environment', 'anshika-digital-library'),
					__('Separate seating and comfortable furniture', 'anshika-digital-library'),
				)[ $index - 1 ],
			)
		);
	}

	for ($index = 1; $index <= 4; $index++) {
		$defaults = array(
			array('icon' => 'location', 'title' => __('Easy Location', 'anshika-digital-library'), 'description' => anshika_digital_library_get_global_settings()['address']),
			array('icon' => 'phone', 'title' => __('Direct Enquiry', 'anshika-digital-library'), 'description' => anshika_digital_library_get_global_settings()['phone']),
			array('icon' => 'test', 'title' => __('Weekly Practice', 'anshika-digital-library'), 'description' => __('CBT and OMR based support for serious learners', 'anshika-digital-library')),
			array('icon' => 'shield', 'title' => __('Secure Environment', 'anshika-digital-library'), 'description' => __('CCTV monitored and disciplined study atmosphere', 'anshika-digital-library')),
		);
		$data['trust_items'][] = anshika_digital_library_merge_group_field('trust_item_' . $index, $page_id, $defaults[ $index - 1 ]);
	}

	for ($index = 1; $index <= 6; $index++) {
		$defaults = array(
			array('icon' => 'book', 'title' => 'Peaceful Study Environment', 'description' => 'Competitive exam preparation, self-study, aur long focused sessions ke liye calm and distraction-free setup.'),
			array('icon' => 'snow', 'title' => 'AC Reading Hall', 'description' => 'Temperature-controlled hall jahan students long hours tak better focus ke saath padh sakein.'),
			array('icon' => 'wifi', 'title' => 'Wi-Fi Enabled', 'description' => 'Online tests, PDFs, research, aur digital study support ke liye reliable internet access.'),
			array('icon' => 'shield', 'title' => 'CCTV Security', 'description' => 'Disciplined, monitored, aur secure environment jo students ko confidence ke saath study karne deta hai.'),
			array('icon' => 'group', 'title' => 'Separate Seating', 'description' => 'Boys and girls ke liye organized seating arrangement for comfort and discipline.'),
			array('icon' => 'quiet', 'title' => 'Clean & Disciplined Space', 'description' => 'Neat, well-maintained, and structured study zone that supports consistency every day.'),
		);
		$data['why_choose']['items'][] = anshika_digital_library_merge_group_field('why_choose_item_' . $index, $page_id, $defaults[ $index - 1 ]);
	}

	for ($index = 1; $index <= 8; $index++) {
		$default_courses = array('DCA', 'ADCA', 'CCC', 'O Level', 'Typing Hindi/English', 'Tally', 'Advance Excel', 'Basic Computer Course');
		$data['optional_courses']['items'][] = anshika_digital_library_get_acf_field_value('optional_course_' . $index, $page_id, $default_courses[ $index - 1 ]);
	}

	$data['facilities_preview_items'] = array_slice($facilities_page['items'], 0, 6);
	$data['contact_page']             = $contact_page;

	return $data;
}

function anshika_digital_library_get_about_page_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id = anshika_digital_library_get_dynamic_page_id('about');

	$data = array(
		'hero' => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('page_hero_badge', $page_id, __('About', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('page_hero_title', $page_id, __('A trusted study space for focused learners in Ghazipur.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('page_hero_description', $page_id, __('Anshika Digital Library is designed for competitive exam aspirants, school and college students, and dedicated self-study learners who need a calm, disciplined, and premium environment.', 'anshika-digital-library')),
		),
		'left_card' => array(
			'title'       => anshika_digital_library_get_acf_field_value('section_one_title', $page_id, __('Why students choose Anshika Digital Library', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('section_one_description', $page_id, __('Yahan study ka focus sirf seat dena nahi, balki ek aisa environment create karna hai jahan students roz discipline ke saath apne goals par kaam kar saken.', 'anshika-digital-library')),
			'points'      => array(
				anshika_digital_library_get_acf_field_value('section_one_point_1', $page_id, __('Peaceful environment for deep focus and consistency', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('section_one_point_2', $page_id, __('Comfortable seating for long study hours', 'anshika-digital-library')),
				anshika_digital_library_get_acf_field_value('section_one_point_3', $page_id, __('Local trust, clean management, and student-friendly enquiry support', 'anshika-digital-library')),
			),
		),
		'right_card' => array(
			'title'        => anshika_digital_library_get_acf_field_value('section_two_title', $page_id, __('Built for serious preparation', 'anshika-digital-library')),
			'paragraph_1'  => anshika_digital_library_get_acf_field_value('section_two_paragraph_1', $page_id, __('Whether you are preparing for competitive exams, revising school or college subjects, or building a self-study routine, the library supports calm concentration, regularity, and productivity.', 'anshika-digital-library')),
			'paragraph_2'  => anshika_digital_library_get_acf_field_value('section_two_paragraph_2', $page_id, __('The goal is simple: give students a better place to study with less distraction and more comfort.', 'anshika-digital-library')),
			'button_label' => anshika_digital_library_get_acf_field_value('section_two_button_label', $page_id, __('Contact for Admission Enquiry', 'anshika-digital-library')),
			'button_link'  => anshika_digital_library_get_acf_field_value('section_two_button_link', $page_id, anshika_digital_library_get_page_url('contact')),
		),
	);

	return $data;
}

function anshika_digital_library_get_facilities_page_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id = anshika_digital_library_get_dynamic_page_id('facilities');
	$data    = array(
		'hero'  => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('page_hero_badge', $page_id, __('Library Facilities', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('page_hero_title', $page_id, __('Modern facilities that support comfortable and focused study.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('page_hero_description', $page_id, __('Anshika Digital Library offers practical daily-study support with comfort, discipline, and student-friendly amenities.', 'anshika-digital-library')),
		),
		'items' => array(),
	);

	$defaults = array(
		array('icon' => 'snow', 'title' => 'Full AC Zone', 'description' => 'Comfortable temperature-controlled study hall for long and productive reading sessions.'),
		array('icon' => 'wifi', 'title' => 'High-Speed Wi-Fi', 'description' => 'Fast internet for online classes, PDFs, mock tests, and digital study support.'),
		array('icon' => 'cctv', 'title' => 'CCTV Monitoring', 'description' => 'Secure and disciplined study environment with regular monitoring.'),
		array('icon' => 'group', 'title' => 'Boys/Girls Separate Seating', 'description' => 'Organized seating arrangement for comfort, discipline, and smooth daily study.'),
		array('icon' => 'water', 'title' => 'Drinking Water', 'description' => 'Clean drinking water facility available inside the study space.'),
		array('icon' => 'print', 'title' => 'PDF Printout', 'description' => 'Quick print support for notes, PDFs, forms, and study documents.'),
		array('icon' => 'print', 'title' => 'Free Admit Card Print', 'description' => 'Helpful admit card print support for students during exam season.'),
		array('icon' => 'desk', 'title' => 'Comfortable Desk & Chair', 'description' => 'Ergonomic study setup designed for long sitting hours and better focus.'),
		array('icon' => 'test', 'title' => 'Weekly CBT / OMR Test', 'description' => 'Practice-oriented weekly support for exam preparation and progress checking.'),
		array('icon' => 'quiet', 'title' => 'Quiet Study Zone', 'description' => 'Low-distraction atmosphere made for concentration and serious self-study.'),
		array('icon' => 'shield', 'title' => 'Clean Environment', 'description' => 'Hygienic, neat, and disciplined surroundings to keep study sessions comfortable.'),
		array('icon' => 'star', 'title' => 'Power Backup', 'description' => 'Placeholder support for uninterrupted study environment when required.'),
	);

	for ($index = 1; $index <= 12; $index++) {
		$data['items'][] = anshika_digital_library_merge_group_field('facility_item_' . $index, $page_id, $defaults[ $index - 1 ]);
	}

	return $data;
}

function anshika_digital_library_get_seat_plans_page_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id = anshika_digital_library_get_dynamic_page_id('seat-plans');
	$data    = array(
		'hero'  => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('page_hero_badge', $page_id, __('Seat Plans', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('page_hero_title', $page_id, __('Study plans for daily visitors, monthly learners, and reserved seat enquiries.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('page_hero_description', $page_id, __('Simple and flexible options so students can choose the plan that matches their study schedule and commitment level.', 'anshika-digital-library')),
		),
		'plans' => array(),
	);

	$defaults = array(
		array(
			'badge'        => '',
			'name'         => 'Daily Pass',
			'price'        => 'Contact for Price',
			'description'  => 'Short-term study visitors aur trial study sessions ke liye flexible access.',
			'feature_1'    => 'Flexible daily access',
			'feature_2'    => 'Quiet study zone',
			'feature_3'    => 'Wi-Fi support',
			'featured'     => 0,
			'button_label' => __('Enquiry for This Plan', 'anshika-digital-library'),
			'button_link'  => anshika_digital_library_get_page_url('contact'),
		),
		array(
			'badge'        => __('Most Popular', 'anshika-digital-library'),
			'name'         => 'Monthly Seat',
			'price'        => 'Contact for Price',
			'description'  => 'Regular students ke liye monthly structured study routine and disciplined daily environment.',
			'feature_1'    => 'Consistent monthly access',
			'feature_2'    => 'AC reading hall',
			'feature_3'    => 'Best for regular students',
			'featured'     => 1,
			'button_label' => __('Enquiry for This Plan', 'anshika-digital-library'),
			'button_link'  => anshika_digital_library_get_page_url('contact'),
		),
		array(
			'badge'        => '',
			'name'         => 'Reserved Seat',
			'price'        => 'Contact for Price',
			'description'  => 'Dedicated seat preference ke saath more stable study experience for serious learners.',
			'feature_1'    => 'Dedicated seat preference',
			'feature_2'    => 'Long-hour comfort',
			'feature_3'    => 'Priority enquiry support',
			'featured'     => 0,
			'button_label' => __('Enquiry for This Plan', 'anshika-digital-library'),
			'button_link'  => anshika_digital_library_get_page_url('contact'),
		),
	);

	for ($index = 1; $index <= 3; $index++) {
		$data['plans'][] = anshika_digital_library_merge_group_field('seat_plan_' . $index, $page_id, $defaults[ $index - 1 ]);
	}

	return $data;
}

function anshika_digital_library_get_gallery_page_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id           = anshika_digital_library_get_dynamic_page_id('gallery');
	$library_image_uri = anshika_digital_library_get_library_image_uri();

	$data = array(
		'hero'  => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('page_hero_badge', $page_id, __('Gallery', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('page_hero_title', $page_id, __('Preview the visual feel of a clean and premium study environment.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('page_hero_description', $page_id, __('Library photos will be updated soon. The layout is ready so real images can be added later without redesigning the page.', 'anshika-digital-library')),
		),
		'items' => array(),
	);

	$default_titles = array(
		'Reading Hall View',
		'Student Seating Area',
		'AC Study Zone',
		'Focused Self-Study Corner',
		'Seat Layout Preview',
		'Library Interior View',
	);

	for ($index = 1; $index <= 6; $index++) {
		$data['items'][] = array(
			'title' => anshika_digital_library_get_acf_field_value('gallery_item_' . $index . '_title', $page_id, $default_titles[ $index - 1 ]),
			'image' => anshika_digital_library_get_image_data('gallery_item_' . $index . '_image', $page_id, $library_image_uri, $default_titles[ $index - 1 ]),
		);
	}

	return $data;
}

function anshika_digital_library_get_contact_page_data() {
	static $data = null;

	if (null !== $data) {
		return $data;
	}

	$page_id = anshika_digital_library_get_dynamic_page_id('contact');

	$data = array(
		'hero' => array(
			'eyebrow'     => anshika_digital_library_get_acf_field_value('page_hero_badge', $page_id, __('Contact', 'anshika-digital-library')),
			'title'       => anshika_digital_library_get_acf_field_value('page_hero_title', $page_id, __('Ask for seat availability, admission details, or visit information.', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('page_hero_description', $page_id, __('Direct call, WhatsApp enquiry, and contact form support are available for students and parents.', 'anshika-digital-library')),
		),
		'contact_card' => array(
			'eyebrow'         => anshika_digital_library_get_acf_field_value('visit_badge', $page_id, __('Visit or Call', 'anshika-digital-library')),
			'title'           => anshika_digital_library_get_acf_field_value('visit_title', $page_id, __('Anshika Digital Library, Ghazipur', 'anshika-digital-library')),
			'call_button'     => anshika_digital_library_get_acf_field_value('call_button_label', $page_id, __('Call Now', 'anshika-digital-library')),
			'whatsapp_button' => anshika_digital_library_get_acf_field_value('whatsapp_button_label', $page_id, __('WhatsApp', 'anshika-digital-library')),
		),
		'map' => array(
			'title'       => anshika_digital_library_get_acf_field_value('map_title', $page_id, __('Google Map Placeholder', 'anshika-digital-library')),
			'description' => anshika_digital_library_get_acf_field_value('map_description', $page_id, __('Map embed can be added here later. Filhal directions ke liye Nawapura Petrol Pump ke bagal ka address use karein.', 'anshika-digital-library')),
			'embed'       => anshika_digital_library_get_acf_field_value('map_embed', $page_id, ''),
		),
		'form' => array(
			'eyebrow' => anshika_digital_library_get_acf_field_value('form_badge', $page_id, __('Contact Form 7', 'anshika-digital-library')),
			'title'   => anshika_digital_library_get_acf_field_value('form_title', $page_id, __('Send your enquiry using the form below.', 'anshika-digital-library')),
		),
	);

	return $data;
}
