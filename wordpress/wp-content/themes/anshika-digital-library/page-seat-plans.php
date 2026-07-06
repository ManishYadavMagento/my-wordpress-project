<?php
/**
 * Template Name: Seat Plans Page
 *
 * @package AnshikaDigitalLibrary
 */

if (! defined('ABSPATH')) {
	exit;
}

$seat_plans_page = anshika_digital_library_get_seat_plans_page_data();
$seat_plans      = $seat_plans_page['plans'];

get_header();
?>

<?php get_template_part('template-parts/common/page-hero', null, $seat_plans_page['hero']); ?>

<section class="adl-section">
	<div class="adl-container">
		<div class="adl-plan-grid">
			<?php foreach ($seat_plans as $plan) : ?>
				<article class="adl-plan-card<?php echo ! empty($plan['featured']) ? ' is-featured' : ''; ?>">
					<?php if (! empty($plan['featured']) && ! empty($plan['badge'])) : ?>
						<span class="adl-plan-badge"><?php echo esc_html($plan['badge']); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html($plan['name']); ?></h3>
					<div class="adl-plan-price"><?php echo esc_html($plan['price']); ?></div>
					<p><?php echo esc_html($plan['description']); ?></p>
					<ul class="adl-plan-features">
						<?php foreach (array($plan['feature_1'], $plan['feature_2'], $plan['feature_3']) as $feature) : ?>
							<?php if (! empty($feature)) : ?>
								<li><?php echo esc_html($feature); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<a class="adl-button adl-button-outline" href="<?php echo esc_url($plan['button_link']); ?>"><?php echo esc_html($plan['button_label']); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
