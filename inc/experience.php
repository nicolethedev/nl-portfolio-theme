<?php

function nl_register_experience_cpt() {
    $labels = array(
        'name'                  => _x( 'Experience', 'Post Type General Name', 'nl-portfolio-theme' ),
        'singular_name'         => _x( 'Experience', 'Post Type Singular Name', 'nl-portfolio-theme' ),
        'menu_name'             => __( 'Experience', 'nl-portfolio-theme' ),
        'name_admin_bar'        => __( 'Experience', 'nl-portfolio-theme' ),
        'archives'              => __( 'Experience Archives', 'nl-portfolio-theme' ),
        'attributes'            => __( 'Experience Attributes', 'nl-portfolio-theme' ),
        'parent_item_colon'     => __( 'Parent Experience:', 'nl-portfolio-theme' ),
        'all_items'             => __( 'All Experience', 'nl-portfolio-theme' ),
        'add_new_item'          => __( 'Add New Experience', 'nl-portfolio-theme' ),
        'add_new'               => __( 'Add New', 'nl-portfolio-theme' ),
        'new_item'              => __( 'New Experience', 'nl-portfolio-theme' ),
        'edit_item'             => __( 'Edit Experience', 'nl-portfolio-theme' ),
        'update_item'           => __( 'Update Experience', 'nl-portfolio-theme' ),
        'view_item'             => __( 'View Experience', 'nl-portfolio-theme' ),
        'view_items'            => __( 'View Experience Items', 'nl-portfolio-theme' ),
        'search_items'          => __( 'Search Experience', 'nl-portfolio-theme' ),
        'not_found'             => __( 'Experience not found', 'nl-portfolio-theme' ),
        'not_found_in_trash'    => __( 'Experience not found in Trash', 'nl-portfolio-theme' ),
        'featured_image'        => __( 'Featured Image', 'nl-portfolio-theme' ),
        'set_featured_image'    => __( 'Set featured image', 'nl-portfolio-theme' ),
        'remove_featured_image' => __( 'Remove featured image', 'nl-portfolio-theme' ),
        'use_featured_image'    => __( 'Use as featured image', 'nl-portfolio-theme' ),
        'insert_into_item'      => __( 'Insert into experience', 'nl-portfolio-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this experience', 'nl-portfolio-theme' ),
        'items_list'            => __( 'Experience list', 'nl-portfolio-theme' ),
        'items_list_navigation' => __( 'Experience list navigation', 'nl-portfolio-theme' ),
        'filter_items_list'     => __( 'Filter experience list', 'nl-portfolio-theme' ),
    );

    $args = array(
        'label'                 => __( 'Experience', 'nl-portfolio-theme' ),
        'description'           => __( 'Work, education, and other relevant experience', 'nl-portfolio-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'experience_type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 4, 
        'menu_icon'             => 'dashicons-id-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'experience' ),
    );

    register_post_type( 'experience', $args );
}
add_action( 'init', 'nl_register_experience_cpt', 0 );


function nl_register_experience_type_taxonomy() {
    $labels = array(
        'name'              => _x( 'Experience Types', 'taxonomy general name', 'nl-portfolio-theme' ),
        'singular_name'     => _x( 'Experience Type', 'taxonomy singular name', 'nl-portfolio-theme' ),
        'search_items'      => __( 'Search Experience Types', 'nl-portfolio-theme' ),
        'all_items'         => __( 'All Experience Types', 'nl-portfolio-theme' ),
        'parent_item'       => __( 'Parent Experience Type', 'nl-portfolio-theme' ),
        'parent_item_colon' => __( 'Parent Experience Type:', 'nl-portfolio-theme' ),
        'edit_item'         => __( 'Edit Experience Type', 'nl-portfolio-theme' ),
        'update_item'       => __( 'Update Experience Type', 'nl-portfolio-theme' ),
        'add_new_item'      => __( 'Add New Experience Type', 'nl-portfolio-theme' ),
        'new_item_name'     => __( 'New Experience Type Name', 'nl-portfolio-theme' ),
        'menu_name'         => __( 'Experience Types', 'nl-portfolio-theme' ),
    );

    $args = array(
        'hierarchical'      => false, 
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rest_base'         => 'experience_type',
        'rewrite'           => array( 'slug' => 'experience-type' ),
    );

    register_taxonomy( 'experience_type', array( 'experience' ), $args );
}
add_action( 'init', 'nl_register_experience_type_taxonomy', 0 );
