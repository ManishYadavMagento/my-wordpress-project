<?php
/**
 * ACF local field groups for the theme.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

function anshika_digital_library_acf_text_field($key, $label, $name, $type = 'text', $extra = array()) {
	return array_merge(
		array(
			'key'   => 'field_' . $key,
			'label' => $label,
			'name'  => $name,
			'type'  => $type,
		),
		$extra
	);
}

function anshika_digital_library_acf_tab_field($key, $label) {
	return array(
		'key'   => 'field_' . $key,
		'label' => $label,
		'name'  => '',
		'type'  => 'tab',
	);
}

function anshika_digital_library_acf_icon_group_field($key, $label, $name, $default_icon, $default_title, $default_description) {
	return array(
		'key'        => 'field_' . $key,
		'label'      => $label,
		'name'       => $name,
		'type'       => 'group',
		'layout'     => 'block',
		'sub_fields' => array(
			anshika_digital_library_acf_text_field($key . '_icon', 'Icon Key', 'icon', 'text', array('default_value' => $default_icon, 'instructions' => 'Use icon keys like phone, location, wifi, snow, shield, test, print, water, desk, group, quiet, star, book, cctv, message.')),
			anshika_digital_library_acf_text_field($key . '_title', 'Title', 'title', 'text', array('default_value' => $default_title)),
			anshika_digital_library_acf_text_field($key . '_description', 'Description', 'description', 'textarea', array('default_value' => $default_description, 'rows' => 3)),
		),
	);
}

function anshika_digital_library_acf_register_field_groups() {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	$front_fields = array(
		anshika_digital_library_acf_tab_field('front_site_settings_tab', 'Site Settings'),
		anshika_digital_library_acf_text_field('site_brand_name', 'Brand Name', 'site_brand_name', 'text'),
		anshika_digital_library_acf_text_field('site_tagline', 'Tagline', 'site_tagline', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('site_phone', 'Phone Number', 'site_phone'),
		anshika_digital_library_acf_text_field('site_address', 'Address', 'site_address', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('site_whatsapp_link', 'WhatsApp Link', 'site_whatsapp_link', 'url'),
		anshika_digital_library_acf_text_field('site_contact_form_code', 'Contact Form Shortcode', 'site_contact_form_code', 'textarea', array('rows' => 3)),
		anshika_digital_library_acf_text_field('header_call_label', 'Header Call Button Label', 'header_call_label'),
		anshika_digital_library_acf_text_field('footer_about_heading', 'Footer About Heading', 'footer_about_heading'),
		anshika_digital_library_acf_text_field('footer_description', 'Footer Description', 'footer_description', 'textarea', array('rows' => 3)),
		anshika_digital_library_acf_text_field('footer_links_heading', 'Footer Links Heading', 'footer_links_heading'),
		anshika_digital_library_acf_text_field('footer_facilities_heading', 'Footer Facilities Heading', 'footer_facilities_heading'),
		anshika_digital_library_acf_text_field('footer_contact_heading', 'Footer Contact Heading', 'footer_contact_heading'),
		anshika_digital_library_acf_text_field('footer_facility_1', 'Footer Facility 1', 'footer_facility_1'),
		anshika_digital_library_acf_text_field('footer_facility_2', 'Footer Facility 2', 'footer_facility_2'),
		anshika_digital_library_acf_text_field('footer_facility_3', 'Footer Facility 3', 'footer_facility_3'),
		anshika_digital_library_acf_text_field('footer_facility_4', 'Footer Facility 4', 'footer_facility_4'),
		anshika_digital_library_acf_tab_field('front_banner_tab', 'Banner Section'),
		anshika_digital_library_acf_text_field('hero_badge', 'Badge', 'hero_badge'),
		anshika_digital_library_acf_text_field('hero_title', 'Heading', 'hero_title', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('hero_description', 'Description', 'hero_description', 'textarea', array('rows' => 4)),
		anshika_digital_library_acf_text_field('hero_call_label', 'Call Button Label', 'hero_call_label'),
		anshika_digital_library_acf_text_field('hero_whatsapp_label', 'WhatsApp Button Label', 'hero_whatsapp_label'),
		anshika_digital_library_acf_text_field('hero_facilities_label', 'Facilities Button Label', 'hero_facilities_label'),
		anshika_digital_library_acf_text_field('hero_mobile_label', 'Mobile Badge Label', 'hero_mobile_label'),
		anshika_digital_library_acf_text_field('hero_highlight_1', 'Highlight 1', 'hero_highlight_1'),
		anshika_digital_library_acf_text_field('hero_highlight_2', 'Highlight 2', 'hero_highlight_2'),
		anshika_digital_library_acf_text_field('hero_highlight_3', 'Highlight 3', 'hero_highlight_3'),
		anshika_digital_library_acf_text_field('hero_image', 'Hero Image', 'hero_image', 'image', array('return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all')),
		anshika_digital_library_acf_text_field('hero_overlay_label', 'Hero Overlay Label', 'hero_overlay_label'),
		anshika_digital_library_acf_text_field('hero_overlay_title', 'Hero Overlay Title', 'hero_overlay_title', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('hero_banner_title', 'Hero Banner Title', 'hero_banner_title'),
		anshika_digital_library_acf_text_field('hero_banner_note', 'Hero Banner Note', 'hero_banner_note', 'textarea', array('rows' => 2)),
	);

	$mini_defaults = array(
		array('AC', 'AC', 'Cool and comfortable reading hall'),
		array('Wi-Fi', 'Wi-Fi', 'Connected digital learning support'),
		array('Safe', 'Safe', 'CCTV monitored disciplined environment'),
		array('Seats', 'Seats', 'Separate seating and comfortable furniture'),
	);
	for ($index = 1; $index <= 4; $index++) {
		$front_fields[] = anshika_digital_library_acf_icon_group_field('hero_mini_card_' . $index, 'Hero Mini Card ' . $index, 'hero_mini_card_' . $index, $mini_defaults[ $index - 1 ][0], $mini_defaults[ $index - 1 ][1], $mini_defaults[ $index - 1 ][2]);
	}

	$front_fields[] = anshika_digital_library_acf_tab_field('front_trust_tab', 'Trust Strip');
	$trust_defaults = array(
		array('location', 'Easy Location', 'Nawapura Petrol Pump ke bagal me, Ghazipur'),
		array('phone', 'Direct Enquiry', '7704064507'),
		array('test', 'Weekly Practice', 'CBT and OMR based support for serious learners'),
		array('shield', 'Secure Environment', 'CCTV monitored and disciplined study atmosphere'),
	);
	for ($index = 1; $index <= 4; $index++) {
		$front_fields[] = anshika_digital_library_acf_icon_group_field('trust_item_' . $index, 'Trust Item ' . $index, 'trust_item_' . $index, $trust_defaults[ $index - 1 ][0], $trust_defaults[ $index - 1 ][1], $trust_defaults[ $index - 1 ][2]);
	}

	$front_fields = array_merge(
		$front_fields,
		array(
			anshika_digital_library_acf_tab_field('front_about_tab', 'About Section'),
			anshika_digital_library_acf_text_field('home_about_badge', 'Badge', 'home_about_badge'),
			anshika_digital_library_acf_text_field('home_about_title', 'Heading', 'home_about_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('home_about_description', 'Description', 'home_about_description', 'textarea', array('rows' => 4)),
			anshika_digital_library_acf_text_field('home_about_card_description', 'Card Description', 'home_about_card_description', 'textarea', array('rows' => 4)),
			anshika_digital_library_acf_text_field('home_about_point_1', 'Point 1', 'home_about_point_1'),
			anshika_digital_library_acf_text_field('home_about_point_2', 'Point 2', 'home_about_point_2'),
			anshika_digital_library_acf_text_field('home_about_point_3', 'Point 3', 'home_about_point_3'),
			anshika_digital_library_acf_text_field('home_about_link_label', 'Link Label', 'home_about_link_label'),
			anshika_digital_library_acf_tab_field('front_why_choose_tab', 'Why Choose Section'),
			anshika_digital_library_acf_text_field('why_choose_badge', 'Badge', 'why_choose_badge'),
			anshika_digital_library_acf_text_field('why_choose_title', 'Heading', 'why_choose_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('why_choose_description', 'Description', 'why_choose_description', 'textarea', array('rows' => 3)),
		)
	);

	$why_defaults = array(
		array('book', 'Peaceful Study Environment', 'Competitive exam preparation, self-study, aur long focused sessions ke liye calm and distraction-free setup.'),
		array('snow', 'AC Reading Hall', 'Temperature-controlled hall jahan students long hours tak better focus ke saath padh sakein.'),
		array('wifi', 'Wi-Fi Enabled', 'Online tests, PDFs, research, aur digital study support ke liye reliable internet access.'),
		array('shield', 'CCTV Security', 'Disciplined, monitored, aur secure environment jo students ko confidence ke saath study karne deta hai.'),
		array('group', 'Separate Seating', 'Boys and girls ke liye organized seating arrangement for comfort and discipline.'),
		array('quiet', 'Clean & Disciplined Space', 'Neat, well-maintained, and structured study zone that supports consistency every day.'),
	);
	for ($index = 1; $index <= 6; $index++) {
		$front_fields[] = anshika_digital_library_acf_icon_group_field('why_choose_item_' . $index, 'Why Choose Item ' . $index, 'why_choose_item_' . $index, $why_defaults[ $index - 1 ][0], $why_defaults[ $index - 1 ][1], $why_defaults[ $index - 1 ][2]);
	}

	$front_fields = array_merge(
		$front_fields,
		array(
			anshika_digital_library_acf_tab_field('front_facilities_preview_tab', 'Facilities Preview'),
			anshika_digital_library_acf_text_field('home_facilities_badge', 'Badge', 'home_facilities_badge'),
			anshika_digital_library_acf_text_field('home_facilities_title', 'Heading', 'home_facilities_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('home_facilities_description', 'Description', 'home_facilities_description', 'textarea', array('rows' => 3)),
			anshika_digital_library_acf_text_field('home_facilities_button_label', 'Button Label', 'home_facilities_button_label'),
			anshika_digital_library_acf_tab_field('front_optional_tab', 'Optional Education Section'),
			anshika_digital_library_acf_text_field('optional_badge', 'Badge', 'optional_badge'),
			anshika_digital_library_acf_text_field('optional_title', 'Heading', 'optional_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('optional_description', 'Description', 'optional_description', 'textarea', array('rows' => 3)),
		)
	);

	$course_defaults = array('DCA', 'ADCA', 'CCC', 'O Level', 'Typing Hindi/English', 'Tally', 'Advance Excel', 'Basic Computer Course');
	for ($index = 1; $index <= 8; $index++) {
		$front_fields[] = anshika_digital_library_acf_text_field('optional_course_' . $index, 'Course ' . $index, 'optional_course_' . $index, 'text', array('default_value' => $course_defaults[ $index - 1 ]));
	}

	$front_fields = array_merge(
		$front_fields,
		array(
			anshika_digital_library_acf_tab_field('front_contact_tab', 'CTA Section'),
			anshika_digital_library_acf_text_field('home_contact_badge', 'Contact Badge', 'home_contact_badge'),
			anshika_digital_library_acf_text_field('home_contact_title', 'Contact Heading', 'home_contact_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('home_contact_map_title', 'Map Title', 'home_contact_map_title'),
			anshika_digital_library_acf_text_field('home_contact_map_description', 'Map Description', 'home_contact_map_description', 'textarea', array('rows' => 3)),
			anshika_digital_library_acf_text_field('home_contact_form_badge', 'Form Badge', 'home_contact_form_badge'),
			anshika_digital_library_acf_text_field('home_contact_form_title', 'Form Heading', 'home_contact_form_title', 'textarea', array('rows' => 2)),
			anshika_digital_library_acf_text_field('home_contact_call_label', 'Call Button Label', 'home_contact_call_label'),
			anshika_digital_library_acf_text_field('home_contact_whatsapp_label', 'WhatsApp Button Label', 'home_contact_whatsapp_label'),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_front_page',
			'title'    => 'Anshika Home Page Content',
			'fields'   => $front_fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_about_page',
			'title'    => 'About Page Content',
			'fields'   => array(
				anshika_digital_library_acf_tab_field('about_hero_tab', 'Banner Section'),
				anshika_digital_library_acf_text_field('page_hero_badge_about', 'Badge', 'page_hero_badge'),
				anshika_digital_library_acf_text_field('page_hero_title_about', 'Heading', 'page_hero_title', 'textarea', array('rows' => 2)),
				anshika_digital_library_acf_text_field('page_hero_description_about', 'Description', 'page_hero_description', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_tab_field('about_section_one_tab', 'About Section'),
				anshika_digital_library_acf_text_field('section_one_title', 'Left Card Title', 'section_one_title'),
				anshika_digital_library_acf_text_field('section_one_description', 'Left Card Description', 'section_one_description', 'textarea', array('rows' => 4)),
				anshika_digital_library_acf_text_field('section_one_point_1', 'Left Card Point 1', 'section_one_point_1'),
				anshika_digital_library_acf_text_field('section_one_point_2', 'Left Card Point 2', 'section_one_point_2'),
				anshika_digital_library_acf_text_field('section_one_point_3', 'Left Card Point 3', 'section_one_point_3'),
				anshika_digital_library_acf_tab_field('about_section_two_tab', 'CTA Section'),
				anshika_digital_library_acf_text_field('section_two_title', 'Right Card Title', 'section_two_title'),
				anshika_digital_library_acf_text_field('section_two_paragraph_1', 'Paragraph 1', 'section_two_paragraph_1', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_text_field('section_two_paragraph_2', 'Paragraph 2', 'section_two_paragraph_2', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_text_field('section_two_button_label', 'Button Label', 'section_two_button_label'),
				anshika_digital_library_acf_text_field('section_two_button_link', 'Button Link', 'section_two_button_link', 'url'),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-about.php',
					),
				),
			),
		)
	);

	$facility_fields = array(
		anshika_digital_library_acf_tab_field('facilities_hero_tab', 'Banner Section'),
		anshika_digital_library_acf_text_field('page_hero_badge_fac', 'Badge', 'page_hero_badge'),
		anshika_digital_library_acf_text_field('page_hero_title_fac', 'Heading', 'page_hero_title', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('page_hero_description_fac', 'Description', 'page_hero_description', 'textarea', array('rows' => 3)),
		anshika_digital_library_acf_tab_field('facilities_items_tab', 'Services Section'),
	);
	$facility_defaults = array(
		array('snow', 'Full AC Zone', 'Comfortable temperature-controlled study hall for long and productive reading sessions.'),
		array('wifi', 'High-Speed Wi-Fi', 'Fast internet for online classes, PDFs, mock tests, and digital study support.'),
		array('cctv', 'CCTV Monitoring', 'Secure and disciplined study environment with regular monitoring.'),
		array('group', 'Boys/Girls Separate Seating', 'Organized seating arrangement for comfort, discipline, and smooth daily study.'),
		array('water', 'Drinking Water', 'Clean drinking water facility available inside the study space.'),
		array('print', 'PDF Printout', 'Quick print support for notes, PDFs, forms, and study documents.'),
		array('print', 'Free Admit Card Print', 'Helpful admit card print support for students during exam season.'),
		array('desk', 'Comfortable Desk & Chair', 'Ergonomic study setup designed for long sitting hours and better focus.'),
		array('test', 'Weekly CBT / OMR Test', 'Practice-oriented weekly support for exam preparation and progress checking.'),
		array('quiet', 'Quiet Study Zone', 'Low-distraction atmosphere made for concentration and serious self-study.'),
		array('shield', 'Clean Environment', 'Hygienic, neat, and disciplined surroundings to keep study sessions comfortable.'),
		array('star', 'Power Backup', 'Placeholder support for uninterrupted study environment when required.'),
	);
	for ($index = 1; $index <= 12; $index++) {
		$facility_fields[] = anshika_digital_library_acf_icon_group_field('facility_item_' . $index, 'Facility Item ' . $index, 'facility_item_' . $index, $facility_defaults[ $index - 1 ][0], $facility_defaults[ $index - 1 ][1], $facility_defaults[ $index - 1 ][2]);
	}
	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_facilities_page',
			'title'    => 'Facilities Page Content',
			'fields'   => $facility_fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-facilities.php',
					),
				),
			),
		)
	);

	$plan_fields = array(
		anshika_digital_library_acf_tab_field('plans_hero_tab', 'Banner Section'),
		anshika_digital_library_acf_text_field('page_hero_badge_plans', 'Badge', 'page_hero_badge'),
		anshika_digital_library_acf_text_field('page_hero_title_plans', 'Heading', 'page_hero_title', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('page_hero_description_plans', 'Description', 'page_hero_description', 'textarea', array('rows' => 3)),
		anshika_digital_library_acf_tab_field('plans_items_tab', 'Services Section'),
	);
	for ($index = 1; $index <= 3; $index++) {
		$plan_fields[] = array(
			'key'        => 'field_seat_plan_' . $index,
			'label'      => 'Seat Plan ' . $index,
			'name'       => 'seat_plan_' . $index,
			'type'       => 'group',
			'layout'     => 'block',
			'sub_fields' => array(
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_badge', 'Badge', 'badge'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_name', 'Plan Name', 'name'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_price', 'Price', 'price'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_description', 'Description', 'description', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_feature_1', 'Feature 1', 'feature_1'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_feature_2', 'Feature 2', 'feature_2'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_feature_3', 'Feature 3', 'feature_3'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_featured', 'Featured Plan', 'featured', 'true_false', array('ui' => 1)),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_button_label', 'Button Label', 'button_label'),
				anshika_digital_library_acf_text_field('seat_plan_' . $index . '_button_link', 'Button Link', 'button_link', 'url'),
			),
		);
	}
	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_seat_plans_page',
			'title'    => 'Seat Plans Page Content',
			'fields'   => $plan_fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-seat-plans.php',
					),
				),
			),
		)
	);

	$gallery_fields = array(
		anshika_digital_library_acf_tab_field('gallery_hero_tab', 'Banner Section'),
		anshika_digital_library_acf_text_field('page_hero_badge_gallery', 'Badge', 'page_hero_badge'),
		anshika_digital_library_acf_text_field('page_hero_title_gallery', 'Heading', 'page_hero_title', 'textarea', array('rows' => 2)),
		anshika_digital_library_acf_text_field('page_hero_description_gallery', 'Description', 'page_hero_description', 'textarea', array('rows' => 3)),
		anshika_digital_library_acf_tab_field('gallery_items_tab', 'Gallery Section'),
	);
	for ($index = 1; $index <= 6; $index++) {
		$gallery_fields[] = anshika_digital_library_acf_text_field('gallery_item_' . $index . '_title', 'Gallery Item ' . $index . ' Title', 'gallery_item_' . $index . '_title');
		$gallery_fields[] = anshika_digital_library_acf_text_field('gallery_item_' . $index . '_image', 'Gallery Item ' . $index . ' Image', 'gallery_item_' . $index . '_image', 'image', array('return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all'));
	}
	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_gallery_page',
			'title'    => 'Gallery Page Content',
			'fields'   => $gallery_fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-gallery.php',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_adl_contact_page',
			'title'    => 'Contact Page Content',
			'fields'   => array(
				anshika_digital_library_acf_tab_field('contact_hero_tab', 'Banner Section'),
				anshika_digital_library_acf_text_field('page_hero_badge_contact', 'Badge', 'page_hero_badge'),
				anshika_digital_library_acf_text_field('page_hero_title_contact', 'Heading', 'page_hero_title', 'textarea', array('rows' => 2)),
				anshika_digital_library_acf_text_field('page_hero_description_contact', 'Description', 'page_hero_description', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_tab_field('contact_card_tab', 'CTA Section'),
				anshika_digital_library_acf_text_field('visit_badge', 'Visit Badge', 'visit_badge'),
				anshika_digital_library_acf_text_field('visit_title', 'Visit Heading', 'visit_title', 'textarea', array('rows' => 2)),
				anshika_digital_library_acf_text_field('call_button_label', 'Call Button Label', 'call_button_label'),
				anshika_digital_library_acf_text_field('whatsapp_button_label', 'WhatsApp Button Label', 'whatsapp_button_label'),
				anshika_digital_library_acf_text_field('map_title', 'Map Title', 'map_title'),
				anshika_digital_library_acf_text_field('map_description', 'Map Description', 'map_description', 'textarea', array('rows' => 3)),
				anshika_digital_library_acf_text_field('map_embed', 'Map Embed Code', 'map_embed', 'textarea', array('rows' => 5)),
				anshika_digital_library_acf_tab_field('contact_form_tab', 'Form Section'),
				anshika_digital_library_acf_text_field('form_badge', 'Form Badge', 'form_badge'),
				anshika_digital_library_acf_text_field('form_title', 'Form Heading', 'form_title', 'textarea', array('rows' => 2)),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-contact.php',
					),
				),
			),
		)
	);
}
add_action('acf/init', 'anshika_digital_library_acf_register_field_groups');
