<?php

class CreateMembersMetaBox extends CreateProJectManagement
{
    public function __construct()
    {
        // Add meta box members
        add_action('add_meta_boxes', [$this, 'custom_members_metabox']);
        add_action('save_post', [$this, 'save_custom_members_metabox']);
    }

    /**************************************************
     * Start Customize meta box for members
     **************************************************/
    function custom_members_metabox()
    {
        add_meta_box(
            // ID của metabox, phải là duy nhất
            'custom_members_metabox',
            // Tiêu đề của metabox
            'Members infomation',
            // Callback function để hiển thị nội dung metabox
            [$this, 'custom_members_metabox_callback'],
            // Tên của custom post type mà bạn muốn thêm metabox vào
            $this->post_type,
            // Vị trí của metabox: normal (bên cạnh editor), side (ở bên phải) hoặc advanced (ở dưới editor)
            'normal',
            // Ưu tiên hiển thị của metabox (high, core hoặc default)
            'high'
        );
    }

    function custom_members_metabox_callback($post)
    {
        require_once PROJECT_MANAGEMENT_PATH . 'inc/metabox-members-ui.php';
    }

    // Lưu giá trị của các trường trong metabox khi lưu post
    function save_custom_members_metabox($post_id)
    {
        // Kiểm tra nonce để bảo vệ form
        if (!isset($_POST['custom_post_metabox_nonce']) || !wp_verify_nonce($_POST['custom_post_metabox_nonce'], 'custom_post_metabox')) {
            return;

        } // Kiểm tra quyền hạn của user
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
/**************************************************
 * End Customize meta box for members
 **************************************************/
}

new CreateMembersMetaBox();