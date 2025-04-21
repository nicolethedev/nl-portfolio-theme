<?php

require_once get_template_directory() . '/inc/projects-tools.php';
require_once get_template_directory() . '/inc/experience.php';


function nl_enqueue_theme_assets() {
    // Always load Normalize and main theme stylesheet
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/styles/normalize.css', array(), null, 'all' );
    wp_enqueue_style( 'nl-portfolio-theme', get_stylesheet_uri(), array(), null, 'all' );

    // Front page styling
    if ( is_front_page() ) {
        wp_enqueue_style( 'front-page-style', get_template_directory_uri() . '/styles/front-page.css', array(), '1.0.0', 'all' );
    }

    // Archive - Projects
    if ( is_post_type_archive( 'project' ) ) {
        wp_enqueue_style( 'archive-project-style', get_template_directory_uri() . '/styles/archive-project.css', array(), '1.0.0', 'all' );
    }

    // Standard pages (like About, Contact, etc.)
    if ( is_page() ) {
        wp_enqueue_style( 'page-style', get_template_directory_uri() . '/styles/page.css', array(), '1.0.0', 'all' );
    }

    // Single post or custom post type entries
    if ( is_singular() ) {
        wp_enqueue_style( 'single-style', get_template_directory_uri() . '/styles/single.css', array(), '1.0.0', 'all' );
    }

    // 404 page
    if ( is_404() ) {
        wp_enqueue_style( 'custom-404-style', get_template_directory_uri() . '/styles/404.css', array(), '1.0', 'all' );
        wp_enqueue_script( 'custom-404-script', get_template_directory_uri() . '/assets/js/404.js', array(), '1.0', true );

        wp_localize_script( 'custom-404-script', 'themeData', array(
            'themeDirectory' => get_template_directory_uri()
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'nl_enqueue_theme_assets' );


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
        return '<a class="wp-block-button__link wp-element-button-live" href="' . esc_url( $live ) . '" target="_blank" rel="noopener">Live Website</a>';
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

// Adding function to prevent currently viewed project from showing in the 'more projects' section
function nl_exclude_current_project_from_query_loop( $query ) {
    if (
        !is_admin() &&
        is_singular( 'project' ) &&
        $query->is_main_query() === false &&
        isset( $query->query_vars['post_type'] ) &&
        $query->query_vars['post_type'] === 'project'
    ) {
        $current_post_id = get_the_ID();
        $excluded = (array) $query->get( 'post__not_in' );
        $excluded[] = $current_post_id;
        $query->set( 'post__not_in', $excluded );
    }
}
add_action( 'pre_get_posts', 'nl_exclude_current_project_from_query_loop' );

function nl_enqueue_front_page_assets() {
    if ( is_front_page() ) {
        
        wp_enqueue_script(
            'nl-tabs-script',
            get_template_directory_uri() . '/assets/js/tabs.js',
            array(), 
            '1.0',
            true 
        );
    }
}
add_action('wp_enqueue_scripts', 'nl_enqueue_front_page_assets');






