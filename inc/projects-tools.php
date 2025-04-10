<?php
// Register the Portfolio Projects Custom Post Type
function nl_portfolio_projects_cpt() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'nl-portfolio-theme' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'nl-portfolio-theme' ),
        'menu_name'             => __( 'Projects', 'nl-portfolio-theme' ),
        'name_admin_bar'        => __( 'Project', 'nl-portfolio-theme' ),
        'archives'              => __( 'Project Archives', 'nl-portfolio-theme' ),
        'attributes'            => __( 'Project Attributes', 'nl-portfolio-theme' ),
        'parent_item_colon'     => __( 'Parent Project:', 'nl-portfolio-theme' ),
        'all_items'             => __( 'All Projects', 'nl-portfolio-theme' ),
        'add_new_item'          => __( 'Add New Project', 'nl-portfolio-theme' ),
        'add_new'               => __( 'Add New', 'nl-portfolio-theme' ),
        'new_item'              => __( 'New Project', 'nl-portfolio-theme' ),
        'edit_item'             => __( 'Edit Project', 'nl-portfolio-theme' ),
        'update_item'           => __( 'Update Project', 'nl-portfolio-theme' ),
        'view_item'             => __( 'View Project', 'nl-portfolio-theme' ),
        'view_items'            => __( 'View Projects', 'nl-portfolio-theme' ),
        'search_items'          => __( 'Search Projects', 'nl-portfolio-theme' ),
        'not_found'             => __( 'Project Not found', 'nl-portfolio-theme' ),
        'not_found_in_trash'    => __( 'Project Not found in Trash', 'nl-portfolio-theme' ),
        'featured_image'        => __( 'Featured Image', 'nl-portfolio-theme' ),
        'set_featured_image'    => __( 'Set featured image', 'nl-portfolio-theme' ),
        'remove_featured_image' => __( 'Remove featured image', 'nl-portfolio-theme' ),
        'use_featured_image'    => __( 'Use as featured image', 'nl-portfolio-theme' ),
        'insert_into_item'      => __( 'Insert into project', 'nl-portfolio-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'nl-portfolio-theme' ),
        'items_list'            => __( 'Projects list', 'nl-portfolio-theme' ),
        'items_list_navigation' => __( 'Projects list navigation', 'nl-portfolio-theme' ),
        'filter_items_list'     => __( 'Filter projects list', 'nl-portfolio-theme' ),
    );

    $args = array(
        'label'                 => __( 'Project', 'nl-portfolio-theme' ),
        'description'           => __( 'Portfolio projects', 'nl-portfolio-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array( 'project_category', 'project_tool' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'project' ),
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'nl_portfolio_projects_cpt', 0 );

// Register Taxonomies for Projects

// 1. Project Categories (hierarchical)
function nl_register_project_categories() {
    $labels = array(
        'name'              => _x( 'Project Categories', 'taxonomy general name', 'nl-portfolio-theme' ),
        'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'nl-portfolio-theme' ),
        'search_items'      => __( 'Search Project Categories', 'nl-portfolio-theme' ),
        'all_items'         => __( 'All Project Categories', 'nl-portfolio-theme' ),
        'parent_item'       => __( 'Parent Project Category', 'nl-portfolio-theme' ),
        'parent_item_colon' => __( 'Parent Project Category:', 'nl-portfolio-theme' ),
        'edit_item'         => __( 'Edit Project Category', 'nl-portfolio-theme' ),
        'update_item'       => __( 'Update Project Category', 'nl-portfolio-theme' ),
        'add_new_item'      => __( 'Add New Project Category', 'nl-portfolio-theme' ),
        'new_item_name'     => __( 'New Project Category Name', 'nl-portfolio-theme' ),
        'menu_name'         => __( 'Project Categories', 'nl-portfolio-theme' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rest_base'         => 'project_category',
        'rewrite'           => array( 'slug' => 'project-category' ),
    );
    register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action( 'init', 'nl_register_project_categories', 0 );

// 2. Project Tools (non-hierarchical)
function nl_register_project_tools() {
    $labels = array(
        'name'                       => _x( 'Project Tools', 'taxonomy general name', 'nl-portfolio-theme' ),
        'singular_name'              => _x( 'Project Tool', 'taxonomy singular name', 'nl-portfolio-theme' ),
        'search_items'               => __( 'Search Project Tools', 'nl-portfolio-theme' ),
        'popular_items'              => __( 'Popular Project Tools', 'nl-portfolio-theme' ),
        'all_items'                  => __( 'All Project Tools', 'nl-portfolio-theme' ),
        'edit_item'                  => __( 'Edit Project Tool', 'nl-portfolio-theme' ),
        'update_item'                => __( 'Update Project Tool', 'nl-portfolio-theme' ),
        'add_new_item'               => __( 'Add New Project Tool', 'nl-portfolio-theme' ),
        'new_item_name'              => __( 'New Project Tool Name', 'nl-portfolio-theme' ),
        'separate_items_with_commas' => __( 'Separate project tools with commas', 'nl-portfolio-theme' ),
        'add_or_remove_items'        => __( 'Add or remove project tools', 'nl-portfolio-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used project tools', 'nl-portfolio-theme' ),
        'not_found'                  => __( 'No project tools found.', 'nl-portfolio-theme' ),
        'menu_name'                  => __( 'Project Tools', 'nl-portfolio-theme' ),
    );
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'project_tool',
        'rewrite'               => array( 'slug' => 'project-tool' ),
    );
    register_taxonomy( 'project_tool', 'project', $args );
}
add_action( 'init', 'nl_register_project_tools', 0 );

// Add custom meta field to the Project Tools taxonomy (Icon URL)

// Add field to the add new term form
function nl_project_tool_add_meta_field() {
    ?>
    <div class="form-field term-group">
        <label for="project_tool_icon"><?php _e('Icon URL', 'nl-portfolio-theme'); ?></label>
        <input type="text" id="project_tool_icon" name="project_tool_icon" value="">
        <p class="description"><?php _e('Enter the URL for the tool icon. You can later enhance this with the media uploader.', 'nl-portfolio-theme'); ?></p>
    </div>
    <?php
}
add_action('project_tool_add_form_fields', 'nl_project_tool_add_meta_field', 10, 2);

// Add field to the edit term form
function nl_project_tool_edit_meta_field($term) {
    // Retrieve existing value from term meta
    $icon_url = get_term_meta($term->term_id, 'project_tool_icon', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="project_tool_icon"><?php _e('Icon URL', 'nl-portfolio-theme'); ?></label></th>
        <td>
            <input type="text" id="project_tool_icon" name="project_tool_icon" value="<?php echo esc_attr($icon_url); ?>">
            <p class="description"><?php _e('Enter the URL for the tool icon.', 'nl-portfolio-theme'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('project_tool_edit_form_fields', 'nl_project_tool_edit_meta_field', 10, 2);

// Save the term meta when a Project Tool term is created or edited
function nl_save_project_tool_meta($term_id) {
    if (isset($_POST['project_tool_icon'])) {
        update_term_meta($term_id, 'project_tool_icon', sanitize_text_field($_POST['project_tool_icon']));
    }
}
add_action('created_project_tool', 'nl_save_project_tool_meta', 10, 2);
add_action('edited_project_tool', 'nl_save_project_tool_meta', 10, 2);

// Register Meta Boxes for Additional Fields in Projects
function nl_add_project_meta_boxes() {
    add_meta_box(
        'project_links',
        __( 'Project Links', 'nl-portfolio-theme' ),
        'nl_render_project_links_box',
        'project',
        'side',
        'default'
    );
    add_meta_box(
        'project_details',
        __( 'Project Details', 'nl-portfolio-theme' ),
        'nl_render_project_details_box',
        'project',
        'normal',
        'default'
    );
    add_meta_box(
        'project_description',
        __( 'Project Description', 'nl-portfolio-theme' ),
        'nl_render_project_description_box',
        'project',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'nl_add_project_meta_boxes' );

// Render the Project Links meta box
function nl_render_project_links_box( $post ) {
    // Add a nonce field for security
    wp_nonce_field( basename( __FILE__ ), 'nl_project_links_nonce' );

    $github_link = get_post_meta( $post->ID, '_nl_github_link', true );
    $live_link   = get_post_meta( $post->ID, '_nl_live_link', true );
    ?>
    <p>
        <label for="nl_github_link"><?php _e( 'GitHub Repository URL', 'nl-portfolio-theme' ); ?></label>
        <input type="url" name="nl_github_link" id="nl_github_link" value="<?php echo esc_attr( $github_link ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="nl_live_link"><?php _e( 'Live Project URL', 'nl-portfolio-theme' ); ?></label>
        <input type="url" name="nl_live_link" id="nl_live_link" value="<?php echo esc_attr( $live_link ); ?>" style="width:100%;" />
    </p>
    <?php
}

// Render the Project Details meta box
function nl_render_project_details_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_details_nonce' );

    $role       = get_post_meta( $post->ID, '_nl_project_role', true );
    $teammates  = get_post_meta( $post->ID, '_nl_project_teammates', true );
    $is_featured = get_post_meta( $post->ID, '_nl_project_featured', true );
    ?>
    <p>
        <label for="nl_project_role"><?php _e( 'Your Role', 'nl-portfolio-theme' ); ?></label>
        <input type="text" name="nl_project_role" id="nl_project_role" value="<?php echo esc_attr( $role ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="nl_project_teammates"><?php _e( 'Other Teammates (comma separated)', 'nl-portfolio-theme' ); ?></label>
        <input type="text" name="nl_project_teammates" id="nl_project_teammates" value="<?php echo esc_attr( $teammates ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="nl_project_featured">
            <input type="checkbox" name="nl_project_featured" id="nl_project_featured" <?php checked( $is_featured, 'on' ); ?> />
            <?php _e( 'Featured Project', 'nl-portfolio-theme' ); ?>
        </label>
    </p>
    <?php
}

// Render the Project Description meta box
function nl_render_project_description_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_description_nonce' );
    $project_description = get_post_meta( $post->ID, '_nl_project_description', true );
    
    // Using the built-in WordPress editor
    wp_editor( $project_description, 'nl_project_description', array(
        'textarea_name' => 'nl_project_description',
        'textarea_rows' => 10,
        'media_buttons' => false,
    ) );
    ?>

    <?php
}

// Save the meta box data for Projects
function nl_save_project_meta_boxes( $post_id ) {
    // Verify nonces for each meta box
    if ( isset( $_POST['nl_project_links_nonce'] ) && !wp_verify_nonce( $_POST['nl_project_links_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    if ( isset( $_POST['nl_project_details_nonce'] ) && !wp_verify_nonce( $_POST['nl_project_details_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    if ( isset( $_POST['nl_project_description_nonce'] ) && !wp_verify_nonce( $_POST['nl_project_description_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    
    // Check permissions
    if ( isset( $_POST['post_type'] ) && 'project' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    // Save Project Links
    if ( isset( $_POST['nl_github_link'] ) ) {
        update_post_meta( $post_id, '_nl_github_link', esc_url_raw( $_POST['nl_github_link'] ) );
    }
    if ( isset( $_POST['nl_live_link'] ) ) {
        update_post_meta( $post_id, '_nl_live_link', esc_url_raw( $_POST['nl_live_link'] ) );
    }

    // Save Project Details
    if ( isset( $_POST['nl_project_role'] ) ) {
        update_post_meta( $post_id, '_nl_project_role', sanitize_text_field( $_POST['nl_project_role'] ) );
    }
    if ( isset( $_POST['nl_project_teammates'] ) ) {
        update_post_meta( $post_id, '_nl_project_teammates', sanitize_text_field( $_POST['nl_project_teammates'] ) );
    }
    // Checkbox: if not checked, update accordingly.
    update_post_meta( $post_id, '_nl_project_featured', isset( $_POST['nl_project_featured'] ) ? 'on' : '' );

    // Save Project Description
    if ( isset( $_POST['nl_project_description'] ) ) {
        update_post_meta( $post_id, '_nl_project_description', wp_kses_post( $_POST['nl_project_description'] ) );
    }
}
add_action( 'save_post', 'nl_save_project_meta_boxes' );
?>
