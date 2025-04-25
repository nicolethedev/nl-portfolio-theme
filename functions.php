<?php

require_once get_template_directory() . '/inc/projects-tools.php';
require_once get_template_directory() . '/inc/experience.php';

function nl_enqueue_theme_assets() {
    // Always load Normalize and main theme stylesheet
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/styles/normalize.css', [], null, 'all' );
    wp_enqueue_style( 'nl-portfolio-theme', get_stylesheet_uri(), [], null, 'all' );

    // Front page styling
    if ( is_front_page() ) {
        wp_enqueue_style( 'front-page-style', get_template_directory_uri() . '/styles/front-page.css', [], '1.0.0', 'all' );
    }

    // Archive - Projects
    if ( is_post_type_archive( 'project' ) ) {
        wp_enqueue_style( 'archive-project-style', get_template_directory_uri() . '/styles/archive-project.css', [], '1.0.0', 'all' );
    }

    // Standard pages (About, Contact, etc.)
    if ( is_page() ) {
        wp_enqueue_style( 'page-style', get_template_directory_uri() . '/styles/page.css', [], '1.0.0', 'all' );
    }

    // Single post or custom post type entries
    if ( is_singular() ) {
        wp_enqueue_style( 'single-style', get_template_directory_uri() . '/styles/single.css', [], '1.0.0', 'all' );
    }

    // 404 page
    if ( is_404() ) {
        wp_enqueue_style( 'custom-404-style', get_template_directory_uri() . '/styles/404.css', [], '1.0', 'all' );
        wp_enqueue_script( 'custom-404-script', get_template_directory_uri() . '/assets/js/404.js', [], '1.0', true );
        wp_localize_script( 'custom-404-script', 'themeData', [
            'themeDirectory' => get_template_directory_uri(),
        ] );
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


// Project Role

function nl_project_role_shortcode() {
    $role = get_post_meta( get_the_ID(), '_nl_project_role', true );
    return $role ? '<p><strong>Role:</strong> ' . esc_html( $role ) . '</p>' : '';
}
add_shortcode( 'project_role', 'nl_project_role_shortcode' );


// Project Teammates

function nl_project_teammates_shortcode() {
    $team = get_post_meta( get_the_ID(), '_nl_project_teammates', true );
    return $team ? '<p><strong>Teammates:</strong> ' . esc_html( $team ) . '</p>' : '';
}
add_shortcode( 'project_teammates', 'nl_project_teammates_shortcode' );


// Project Client / Purpose

function nl_project_client_shortcode() {
    if ( is_singular( 'project' ) ) {
        $client = get_post_meta( get_the_ID(), '_nl_project_client', true );
        return $client ? '<p><strong>Purpose:</strong> ' . esc_html( $client ) . '</p>' : '';
    }
    return '';
}
add_shortcode( 'project_client', 'nl_project_client_shortcode' );


// Project Brief

function nl_project_brief_shortcode() {
    if ( is_singular( 'project' ) ) {
        $brief = get_post_meta( get_the_ID(), '_nl_project_brief', true );
        return $brief ? '<p>' . esc_html( $brief ) . '</p>' : '';
    }
    return '';
}
add_shortcode( 'project_brief', 'nl_project_brief_shortcode' );


// Project Tools shortcode — outputs <span class="nl-term-badge">…</span>

function nl_project_tools_shortcode() {
    global $post;
    if ( ! $post || 'project' !== $post->post_type ) {
        return '';
    }
    $tools = get_the_terms( $post->ID, 'project_tool' );
    if ( ! $tools || is_wp_error( $tools ) ) {
        return '';
    }
    $out = '<div class="taxonomy-badges project-tools">';
    foreach ( $tools as $tool ) {
        $out .= '<span class="nl-term-badge">' . esc_html( $tool->name ) . '</span> ';
    }
    $out .= '</div>';
    return $out;
}
add_shortcode( 'project_tools', 'nl_project_tools_shortcode' );


// Project Categories shortcode — outputs <span class="nl-term-badge">…</span>

function nl_project_categories_shortcode() {
    global $post;
    if ( ! $post || 'project' !== $post->post_type ) {
        return '';
    }
    $cats = get_the_terms( $post->ID, 'project_category' );
    if ( ! $cats || is_wp_error( $cats ) ) {
        return '';
    }
    $out = '<div class="taxonomy-badges project-categories">';
    foreach ( $cats as $cat ) {
        $out .= '<span class="nl-term-badge">' . esc_html( $cat->name ) . '</span> ';
    }
    $out .= '</div>';
    return $out;
}
add_shortcode( 'project_categories', 'nl_project_categories_shortcode' );


// Exclude current project from “more projects” loops

function nl_exclude_current_project_from_query_loop( $query ) {
    if (
        ! is_admin()
        && is_singular( 'project' )
        && ! $query->is_main_query()
        && isset( $query->query_vars['post_type'] )
        && 'project' === $query->query_vars['post_type']
    ) {
        $query->set( 'post__not_in', array_merge(
            (array) $query->get( 'post__not_in', [] ),
            [ get_the_ID() ]
        ) );
    }
}
add_action( 'pre_get_posts', 'nl_exclude_current_project_from_query_loop' );

function nl_enqueue_front_page_assets() {
    if ( is_front_page() ) {
        wp_enqueue_script(
            'nl-tabs-script',
            get_template_directory_uri() . '/assets/js/tabs.js',
            [],
            '1.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'nl_enqueue_front_page_assets' );


// Shortcode to list terms for a given taxonomy

function nl_list_terms_for_taxonomy_shortcode( $atts ) {
    $atts = shortcode_atts( [
        'taxonomy'   => '',
        'hide_empty' => 'false',
        'parent'     => '',
    ], $atts, 'list_terms' );

    if ( empty( $atts['taxonomy'] ) ) {
        return '<p><em>Error: no taxonomy defined.</em></p>';
    }

    $tax = sanitize_key( $atts['taxonomy'] );
    $args = [
        'taxonomy'   => $tax,
        'hide_empty' => filter_var( $atts['hide_empty'], FILTER_VALIDATE_BOOLEAN ),
    ];
    if ( '' !== $atts['parent'] ) {
        $args['parent'] = ( '0' === $atts['parent'] ) ? 0 : absint( $atts['parent'] );
    }

    $terms = get_terms( $args );
    if ( is_wp_error( $terms ) || empty( $terms ) ) {
        return '<p>No terms found.</p>';
    }

    $out = '<ul class="nl-term-list">';
    foreach ( $terms as $term ) {
        $name = esc_html( $term->name );

        if ( in_array( $tax, [ 'project_tool', 'project_category' ], true ) ) {
            $out .= '<li><span class="nl-term-badge">' . $name . '</span></li>';
        } else {
            $link  = esc_url( get_term_link( $term ) );
            $out  .= '<li><a href="' . $link . '">' . $name . '</a></li>';
        }
    }
    $out .= '</ul>';

    return $out;
}
add_shortcode( 'list_terms', 'nl_list_terms_for_taxonomy_shortcode' );


// Strip <a> tags from get_the_term_list() for project taxonomies

function nl_strip_term_links( $links ) {
    foreach ( $links as &$html ) {
        $name  = strip_tags( $html );
        $html  = '<span class="nl-term-badge">' . esc_html( $name ) . '</span>';
    }
    return $links;
}
add_filter( 'term_links-project_tool',     'nl_strip_term_links' );
add_filter( 'term_links-project_category', 'nl_strip_term_links' );


// Swap <a>→<span> in Core Post Terms block for those taxonomies 

function nl_unanchor_post_terms_block( $block_content, $block ) {
    if ( ! empty( $block['attrs']['taxonomy'] ) && in_array(
        $block['attrs']['taxonomy'],
        [ 'project_tool', 'project_category' ],
        true
    ) ) {
        $block_content = preg_replace(
            '#<a[^>]*>(.*?)</a>#i',
            '<span class="nl-term-badge">$1</span>',
            $block_content
        );
    }
    return $block_content;
}
add_filter( 'render_block_core/post-terms', 'nl_unanchor_post_terms_block', 10, 2 );
