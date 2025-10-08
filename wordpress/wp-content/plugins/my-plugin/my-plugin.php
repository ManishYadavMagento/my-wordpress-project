<?php
/**
 * Plugin Name: Hello World!
 */

add_action('wp_footer', function() {
    echo '<p style="text-align:center; color:red;">Hello from My Custom Plugin!</p>';
});

add_action('admin_notices', function() {
    echo '<div class="notice notice-success"><p>My Custom Plugin is active!</p></div>';
});
add_shortcode('hello', function() {
    return '<p>Hello World Shortcode!</p>';
});