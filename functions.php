<?php

// Enqueue a custom stylesheet for the front page only
function my_theme_enqueue_front_page_styles() {
    if ( is_front_page() ) {
        wp_enqueue_style( 
            'front-page-style', 
            get_template_directory_uri() . '/styles/front-page.css', 
            array(), 
            '1.0.0' 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_front_page_styles' );

// Calling in my style.css
function enqueue_theme_styles() {
    wp_enqueue_style('nl-portfolio-theme', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

