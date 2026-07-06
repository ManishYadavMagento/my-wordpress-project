<?php
/**
 * Generic page hero.
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'eyebrow'     => '',
		'title'       => '',
		'description' => '',
	)
);
?>
<section class="adl-page-hero">
	<div class="adl-container">
		<?php if (! empty($args['eyebrow'])) : ?>
			<span class="adl-eyebrow"><?php echo esc_html($args['eyebrow']); ?></span>
		<?php endif; ?>
		<?php if (! empty($args['title'])) : ?>
			<h1><?php echo esc_html($args['title']); ?></h1>
		<?php endif; ?>
		<?php if (! empty($args['description'])) : ?>
			<p><?php echo esc_html($args['description']); ?></p>
		<?php endif; ?>
	</div>
</section>
