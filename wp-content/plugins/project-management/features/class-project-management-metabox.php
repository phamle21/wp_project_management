<?php

class CreateProJectManagementMetaBox extends CreateProJectManagement
{
    public function __construct()
    {
        // Add meta box project information 
        add_action('add_meta_boxes', [$this, 'custom_project_metabox']);
        add_action('save_post', [$this, 'save_custom_project_metabox'], 20);
    }

    /**************************************************
     * Start Customize meta box project information
     **************************************************/
    function custom_project_metabox()
    {
        add_meta_box(
            // ID của metabox, phải là duy nhất
            'custom_project_metabox',
            // Tiêu đề của metabox
            'Project infomation',
            // Callback function để hiển thị nội dung metabox
            [$this, 'custom_project_metabox_callback'],
            // Tên của custom post type mà bạn muốn thêm metabox vào
            $this->post_type,
            // Vị trí của metabox: normal (bên cạnh editor), side (ở bên phải) hoặc advanced (ở dưới editor)
            'normal',
            // Ưu tiên hiển thị của metabox (high, core hoặc default)
            'high'
        );
    }

    function custom_project_metabox_callback($post)
    {
        require_once PROJECT_MANAGEMENT_PATH . 'inc/metabox-project-information-ui.php';
    }

    // Lưu giá trị của các trường trong metabox khi lưu post
    function save_custom_project_metabox($post_id)
    {
        // Kiểm tra nonce để bảo vệ form
        // if (!isset($_POST['custom_post_metabox_nonce']) || !wp_verify_nonce($_POST['custom_post_metabox_nonce'], 'custom_project_metabox')) {
        //     return;
        // } 

        // Kiểm tra quyền hạn của user
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Lưu giá trị của trường description
        if (isset($_POST['description'])) {
            update_post_meta($post_id, '_description', sanitize_textarea_field($_POST['description']));
        }

        // Lưu giá trị của trường start_date
        if (isset($_POST['start_date'])) {
            update_post_meta($post_id, '_start_date', sanitize_text_field($_POST['start_date']));
        }

        // Lưu giá trị của trường end_date
        if (isset($_POST['end_date'])) {
            update_post_meta($post_id, '_end_date', sanitize_text_field($_POST['end_date']));
        }

        // Lưu giá trị của trường end_date
        if (isset($_POST['estimize'])) {
            update_post_meta($post_id, '_estimize', sanitize_text_field($_POST['estimize']));
        }

        // Lưu giá trị của trường members
        if (isset($_POST['members'])) {
            update_post_meta($post_id, '_members', array_map('intval', $_POST['members']));
            $arr_members_details = [];
            foreach ($_POST['members'] as $member_id) {
                $arr_members_details[] = [
                    'member_id' => $member_id,
                    'member_position' => '',
                    'member_level' => '',
                ];
            }
            update_post_meta($post_id, '_members_details', array_map('string', $arr_members_details));
            
            echo '<pre>';
            var_dump(get_post_meta($post_id, '_members_details', true));
            echo '</pre>';

            exit();

        }
    }
/**************************************************
 * End Customize meta box project information
 **************************************************/
}

new CreateProJectManagementMetaBox();