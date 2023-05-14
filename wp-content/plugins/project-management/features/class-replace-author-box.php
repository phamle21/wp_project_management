<?php

class ReplaceAuthorBox extends CreateProJectManagement
{
    public function __construct()
    {
        // Replace box author
        add_action('admin_menu', [$this, 'remove_custom_post_author_metabox']);
        add_action('add_meta_boxes', [$this, 'add_custom_post_author_metabox']);
        add_action('save_post', [$this, 'save_custom_post_author_meta_box_data']);
    }

    /**************************************************
     * Start Customize author box
     **************************************************/

    function remove_custom_post_author_metabox()
    {
        remove_meta_box('authordiv', $this->post_type, 'normal');
    }

    function add_custom_post_author_metabox()
    {
        add_meta_box(
            'custom_post_author',
            __('Author', 'textdomain'),
            [$this, 'custom_post_author_meta_box_callback'],
            $this->post_type,
            'side',
            'low'
        );
    }
    function custom_post_author_meta_box_callback($post)
    {
        wp_nonce_field(basename(__FILE__), 'custom_post_author_nonce');
        $authors = get_users(
            array(
                'who' => 'authors'
            )
        );

        $author_id = $post->post_author;
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_avatar = get_avatar_url($author_id);
        if ($author_avatar) {
            echo '<p><img src="' . $author_avatar . '" alt="' . $author_name . '" /></p>';
        }
        ?>
        <label for="post_author">Select author:</label>
        <select name="post_author" id="post_author">
            <?php
            foreach ($authors as $author) {
                $selected = '';
                if ($author->ID == $post->post_author) {
                    $selected = ' selected="selected"';
                }
                ?>
                <option value="<?php echo esc_attr($author->ID); ?>" <?php echo $selected; ?>><?php echo esc_html($author->display_name); ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    function save_custom_post_author_meta_box_data($post_id)
    {
        if (!isset($_POST['custom_post_author_nonce'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['custom_post_author_nonce'], basename(__FILE__))) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (isset($_POST['post_author']) && $_POST['post_author']) {
            $new_author_id = sanitize_text_field($_POST['post_author']);
            if ($new_author_id) {
                wp_update_post(
                    array(
                        'ID' => $post_id,
                        'post_author' => $new_author_id
                    )
                );
            }
        }
    }

/**************************************************
 * End Customize author box
 **************************************************/
}

new ReplaceAuthorBox();