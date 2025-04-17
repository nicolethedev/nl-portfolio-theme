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

// GitHub button shortcode
function nl_github_button_shortcode() {
    $github = get_post_meta( get_the_ID(), '_nl_github_link', true );
    if ( $github ) {
        return '<a class="wp-block-button__link wp-element-button-github" href="' . esc_url( $github ) . '" target="_blank" rel="noopener">Github Repo</a>';
    }
    return '';
}
add_shortcode( 'github_button', 'nl_github_button_shortcode' );

// Live button shortcode
function nl_live_button_shortcode() {
    $live = get_post_meta( get_the_ID(), '_nl_live_link', true );
    if ( $live ) {
        return '<a class="wp-block-button__link wp-element-button-live" href="' . esc_url( $live ) . '" target="_blank" rel="noopener">Live Project</a>';
    }
    return '';
}
add_shortcode( 'live_button', 'nl_live_button_shortcode' );

// Shortcode for Project Role
function nl_project_role_shortcode() {
    $role = get_post_meta( get_the_ID(), '_nl_project_role', true );
    if ( $role ) {
        return '<p><strong>Role:</strong> ' . esc_html( $role ) . '</p>';
    }
    return '';
}
add_shortcode( 'project_role', 'nl_project_role_shortcode' );

// Shortcode for Project Teammates
function nl_project_teammates_shortcode() {
    $teammates = get_post_meta( get_the_ID(), '_nl_project_teammates', true );
    if ( $teammates ) {
        return '<p><strong>Teammates:</strong> ' . esc_html( $teammates ) . '</p>';
    }
    return '';
}
add_shortcode( 'project_teammates', 'nl_project_teammates_shortcode' );

// Shortcode for Project Client or Purpose
function nl_project_client_shortcode() {
    if ( is_singular( 'project' ) ) {
        $client = get_post_meta( get_the_ID(), '_nl_project_client', true );
        if ( $client ) {
            return '<p><strong>Purpose:</strong> ' . esc_html( $client ) . '</p>';
        }
    }
    return '';
}
add_shortcode( 'project_client', 'nl_project_client_shortcode' );

// Shortcode for Project Brief
function nl_project_brief_shortcode() {
    if ( is_singular( 'project' ) ) {
        $brief = get_post_meta( get_the_ID(), '_nl_project_brief', true );
        if ( $brief ) {
            return '' . esc_html( $brief ) . '</p>';
        }
    }
    return '';
}
add_shortcode( 'project_brief', 'nl_project_brief_shortcode' );

// Shortcode for Project Tools
function nl_project_tools_shortcode() {
    global $post;

    if ( empty( $post ) || $post->post_type !== 'project' ) return '';

    $tools = get_the_terms( $post->ID, 'project_tool' );
    if ( !$tools || is_wp_error( $tools ) ) return '';

    $output = '<div class="taxonomy-badges project-tools">';
    foreach ( $tools as $tool ) {
        $output .= '<span class="taxonomy-badge">' . esc_html( $tool->name ) . '</span> ';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode( 'project_tools', 'nl_project_tools_shortcode' );

// Project Categories Shortcode
function nl_project_categories_shortcode() {
    global $post;

    if ( empty( $post ) || $post->post_type !== 'project' ) return '';

    $categories = get_the_terms( $post->ID, 'project_category' );
    if ( !$categories || is_wp_error( $categories ) ) return '';

    $output = '<div class="taxonomy-badges project-categories">';
    foreach ( $categories as $category ) {
        $output .= '<span class="taxonomy-badge">' . esc_html( $category->name ) . '</span> ';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode( 'project_categories', 'nl_project_categories_shortcode' );








