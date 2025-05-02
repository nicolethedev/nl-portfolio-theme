<?php

// Includes
require_once get_template_directory() . '/inc/projects-tools.php';
require_once get_template_directory() . '/inc/experience.php';


// Enqueue Styles and Scripts

/* Enqueue theme CSS and JS assets.*/
function nl_enqueue_theme_assets() {
    // Normalize and main stylesheet
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

    // Privacy Policy page
    if ( is_page( 'privacy-policy' ) ) {
        wp_enqueue_style( 'privacy-policy-style', get_template_directory_uri() . '/styles/privacy-policy.css', [], '1.0.0', 'all' );
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

/* Enqueue front page JS (tabs)*/
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

/* Enqueue weather widget JS and pass REST endpoint.*/
function nl_enqueue_weather_widget() {
    wp_enqueue_script(
        'weather-widget',
        get_stylesheet_directory_uri() . '/assets/js/weather-widget.js',
        [],
        '1.0',
        true
    );
    wp_localize_script( 'weather-widget', 'WeatherConfig', [
        'endpoint' => '/wp-json/weather/v1/current',
    ] );
}
add_action( 'wp_enqueue_scripts', 'nl_enqueue_weather_widget' );


// Shortcodes

/* Github button shortcode.*/
function nl_github_button_shortcode() {
    $github = get_post_meta( get_the_ID(), '_nl_github_link', true );
    if ( $github ) {
        return '<a class="wp-block-button__link wp-element-button-github" href="' . esc_url( $github ) . '" target="_blank" rel="noopener">Github Repo</a>';
    }
    return '';
}
add_shortcode( 'github_button', 'nl_github_button_shortcode' );

/*Live website button shortcode*/
function nl_live_button_shortcode() {
    $live = get_post_meta( get_the_ID(), '_nl_live_link', true );
    if ( $live ) {
        return '<a class="wp-block-button__link wp-element-button-live" href="' . esc_url( $live ) . '" target="_blank" rel="noopener">Live Website</a>';
    }
    return '';
}
add_shortcode( 'live_button', 'nl_live_button_shortcode' );

/* Project role shortcode*/
function nl_project_role_shortcode() {
    $role = get_post_meta( get_the_ID(), '_nl_project_role', true );
    return $role ? '<p><strong>Role:</strong> ' . esc_html( $role ) . '</p>' : '';
}
add_shortcode( 'project_role', 'nl_project_role_shortcode' );

/* Project teammates shortcode.*/
function nl_project_teammates_shortcode() {
    $team = get_post_meta( get_the_ID(), '_nl_project_teammates', true );
    return $team ? '<p><strong>Team:</strong> ' . esc_html( $team ) . '</p>' : '';
}
add_shortcode( 'project_teammates', 'nl_project_teammates_shortcode' );

/* Project client/purpose shortcode.*/
function nl_project_client_shortcode() {
    if ( is_singular( 'project' ) ) {
        $client = get_post_meta( get_the_ID(), '_nl_project_client', true );
        return $client ? '<p><strong>Purpose:</strong> ' . esc_html( $client ) . '</p>' : '';
    }
    return '';
}
add_shortcode( 'project_client', 'nl_project_client_shortcode' );

/* Project brief shortcode*/
function nl_project_brief_shortcode() {
    if ( is_singular( 'project' ) ) {
        $brief = get_post_meta( get_the_ID(), '_nl_project_brief', true );
        return $brief ? '<p>' . esc_html( $brief ) . '</p>' : '';
    }
    return '';
}
add_shortcode( 'project_brief', 'nl_project_brief_shortcode' );

/* Project tools shortcode - outputs <span class="nl-term-badge">…</span>*/
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

/* Project categories shortcode - outputs <span class="nl-term-badge">…</span>*/
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

/* List terms for a given taxonomy.*/
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


// Filters

/* Strip <a> tags from get_the_term_list() for project taxonomies */
function nl_strip_term_links( $links ) {
    foreach ( $links as &$html ) {
        $name  = strip_tags( $html );
        $html  = '<span class="nl-term-badge">' . esc_html( $name ) . '</span>';
    }
    return $links;
}
add_filter( 'term_links-project_tool', 'nl_strip_term_links' );
add_filter( 'term_links-project_category', 'nl_strip_term_links' );

/* Swap <a>→<span> in Core Post Terms block for those taxonomies.*/
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

// Query Modifications

/* Exclude current project from “more projects” loops.*/
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


// REST API: Weather Widget


/* Register a custom REST route under /wp-json/weather/v1/current. */
function nl_register_weather_rest_route() {
    register_rest_route( 'weather/v1', '/current', [
        'methods'             => 'GET',
        'callback'            => 'nl_get_current_weather',
        'permission_callback' => '__return_true',
    ] );
}
add_action( 'rest_api_init', 'nl_register_weather_rest_route' );

/**
 * Fetch, cache, and return current weather from OpenWeatherMap.
 *
 * Accepts either lat+lon or city param.
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response|WP_Error
 */
function nl_get_current_weather( WP_REST_Request $request ) {
    $lat = $request->get_param( 'lat' );
    $lon = $request->get_param( 'lon' );
    $city = sanitize_text_field( $request->get_param( 'city' ) );

    // Build query args
    if ( $lat && $lon ) {
        $args = [
            'lat'   => floatval( $lat ),
            'lon'   => floatval( $lon ),
            'units' => 'metric',
            'appid' => OWM_API_KEY,
        ];
        $cache_key = "owm_{$lat}_{$lon}";
    } else {
        $city = $city ?: 'Vancouver,CA';
        $args = [
            'q'     => $city,
            'units' => 'metric',
            'appid' => OWM_API_KEY,
        ];
        $cache_key = 'owm_' . md5( $city );
    }

    // Try cache first
    if ( false === ( $data = get_transient( $cache_key ) ) ) {
        $url = add_query_arg( $args, 'https://api.openweathermap.org/data/2.5/weather' );
        $resp = wp_remote_get( $url );

        if ( is_wp_error( $resp ) || 200 !== wp_remote_retrieve_response_code( $resp ) ) {
            return new WP_Error( 'weather_fetch_failed', 'Could not retrieve weather.', [ 'status' => 500 ] );
        }
        $data = json_decode( wp_remote_retrieve_body( $resp ), true );
        set_transient( $cache_key, $data, 10 * MINUTE_IN_SECONDS );
    }

    return rest_ensure_response( [
        'temp'        => $data['main']['temp'],
        'icon'        => $data['weather'][0]['icon'],
        'description' => $data['weather'][0]['description'],
    ] );
}
add_action( 'rest_api_init', 'nl_register_weather_rest_route' );