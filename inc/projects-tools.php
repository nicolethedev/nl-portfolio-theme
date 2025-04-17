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
    register_taxonomy( 'project_tool', array( 'project' ), $args );
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
    add_meta_box('project_links', __( 'Project Links', 'nl-portfolio-theme' ), 'nl_render_project_links_box', 'project', 'side');
    add_meta_box('project_details', __( 'Project Details', 'nl-portfolio-theme' ), 'nl_render_project_details_box', 'project', 'normal');
    add_meta_box('project_description', __( 'Project Description', 'nl-portfolio-theme' ), 'nl_render_project_description_box', 'project', 'normal');
    add_meta_box('project_gallery', __( 'Project Gallery', 'nl-portfolio-theme' ), 'nl_render_project_gallery_box', 'project', 'normal');
}
add_action( 'add_meta_boxes', 'nl_add_project_meta_boxes' );

function nl_render_project_links_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_links_nonce' );
    $github_link = get_post_meta( $post->ID, '_nl_github_link', true );
    $live_link   = get_post_meta( $post->ID, '_nl_live_link', true );
    echo '<p><label for="nl_github_link">GitHub URL</label><input type="url" name="nl_github_link" value="' . esc_attr($github_link) . '" style="width:100%;" /></p>';
    echo '<p><label for="nl_live_link">Live URL</label><input type="url" name="nl_live_link" value="' . esc_attr($live_link) . '" style="width:100%;" /></p>';
}

function nl_render_project_details_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_details_nonce' );
    $role = get_post_meta( $post->ID, '_nl_project_role', true );
    $teammates = get_post_meta( $post->ID, '_nl_project_teammates', true );
    $is_featured = get_post_meta( $post->ID, '_nl_project_featured', true );
    $client = get_post_meta( $post->ID, '_nl_project_client', true );
    $brief = get_post_meta( $post->ID, '_nl_project_brief', true );
    echo '<p><label>Your Role</label><input type="text" name="nl_project_role" value="' . esc_attr($role) . '" style="width:100%;" /></p>';
    echo '<p><label>Teammates</label><input type="text" name="nl_project_teammates" value="' . esc_attr($teammates) . '" style="width:100%;" /></p>';
    echo '<p><label><input type="checkbox" name="nl_project_featured" ' . checked($is_featured, 'on', false) . ' /> Featured Project</label></p>';
    echo '<p><label>Client / Purpose</label><input type="text" name="nl_project_client" value="' . esc_attr($client) . '" style="width:100%;" /></p>';
    echo '<p><label>Project Brief</label><textarea name="nl_project_brief" rows="4" style="width:100%;">' . esc_textarea($brief) . '</textarea></p>';
}

function nl_render_project_description_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_description_nonce' );
    $desc = get_post_meta( $post->ID, '_nl_project_description', true );
    wp_editor( $desc, 'nl_project_description', [ 'textarea_name' => 'nl_project_description', 'textarea_rows' => 10, 'media_buttons' => false ] );
}

function nl_render_project_gallery_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nl_project_gallery_nonce' );
    $image_ids = get_post_meta( $post->ID, '_nl_project_gallery', true );
    ?>
    <p><a href="#" class="button" id="nl_add_project_images">Add Project Images</a>
    <input type="hidden" id="nl_project_gallery" name="nl_project_gallery" value="<?php echo esc_attr( $image_ids ); ?>" />
    <ul id="nl_project_gallery_preview">
        <?php
        if ( $image_ids ) {
            foreach ( explode(',', $image_ids) as $id ) {
                echo '<li style="display:inline-block; margin-right:10px;">' . wp_get_attachment_image($id, 'thumbnail') . '</li>';
            }
        }
        ?>
    </ul></p>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#nl_add_project_images').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'Select or Upload Images', button: { text: 'Use these images' }, multiple: true });
            frame.on('select', function(){
                var attachments = frame.state().get('selection').toJSON();
                var ids = attachments.map(img => img.id).join(',');
                var preview = attachments.map(img => `<li style=\"display:inline-block; margin-right:10px;\"><img src=\"${img.sizes.thumbnail.url}\" /></li>`).join('');
                $('#nl_project_gallery').val(ids);
                $('#nl_project_gallery_preview').html(preview);
            });
            frame.open();
        });
    });
    </script>
    <?php
}

function nl_save_project_meta_boxes( $post_id ) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( isset($_POST['post_type']) && 'project' == $_POST['post_type'] && !current_user_can('edit_post', $post_id) ) return;

    // Save Links
    if ( isset($_POST['nl_github_link']) ) update_post_meta($post_id, '_nl_github_link', esc_url_raw($_POST['nl_github_link']));
    if ( isset($_POST['nl_live_link']) ) update_post_meta($post_id, '_nl_live_link', esc_url_raw($_POST['nl_live_link']));

    // Save Details
    update_post_meta($post_id, '_nl_project_featured', isset($_POST['nl_project_featured']) ? 'on' : '');
    if ( isset($_POST['nl_project_role']) ) update_post_meta($post_id, '_nl_project_role', sanitize_text_field($_POST['nl_project_role']));
    if ( isset($_POST['nl_project_teammates']) ) update_post_meta($post_id, '_nl_project_teammates', sanitize_text_field($_POST['nl_project_teammates']));
    if ( isset($_POST['nl_project_client']) ) update_post_meta($post_id, '_nl_project_client', sanitize_text_field($_POST['nl_project_client']));
    if ( isset($_POST['nl_project_brief']) ) update_post_meta($post_id, '_nl_project_brief', sanitize_textarea_field($_POST['nl_project_brief']));

    // Save Description
    if ( isset($_POST['nl_project_description']) ) update_post_meta($post_id, '_nl_project_description', wp_kses_post($_POST['nl_project_description']));

    // Save Gallery
    if ( isset($_POST['nl_project_gallery']) ) update_post_meta($post_id, '_nl_project_gallery', sanitize_text_field($_POST['nl_project_gallery']));
}
add_action('save_post', 'nl_save_project_meta_boxes');

