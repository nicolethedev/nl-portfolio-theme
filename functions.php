<?php

require_once get_template_directory() . '/inc/projects-tools.php';

// Enqueue the Normalize CSS file
function enqueue_normalize_css() {
    wp_enqueue_style(
        'normalize',
        get_template_directory_uri() . '/styles/normalize.css', 
        array(),
        null, 
        'all' 
    );
}
add_action('wp_enqueue_scripts', 'enqueue_normalize_css');

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

function enqueue_custom_404_assets() {
    if ( is_404() ) {
        wp_enqueue_style( 'custom-404-style', get_template_directory_uri() . '/styles/404.css', array(), '1.0' );
        wp_enqueue_script( 'custom-404-script', get_template_directory_uri() . '/assets/js/404.js', array(), '1.0', true );
        wp_localize_script( 'custom-404-script', 'themeData', array(
            'themeDirectory' => get_template_directory_uri()
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_404_assets' );


// Loading 'projects' post type in the archive page
function load_projects_in_archive( $query ) {

    if ( ! is_admin() && $query->is_main_query() && is_archive() ) {

        $query->set( 'post_type', 'projects' );
    }
}
add_action( 'pre_get_posts', 'load_projects_in_archive' );



