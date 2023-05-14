<?php

class CreateProJectManagement
{
    protected $post_type = 'project-management';

    public function __construct()
    {
        // init register post type
        add_action('init', [$this, 'func_project_management']);

        // Add Project Manager role
        add_role('project_manager', 'Project Manager', get_role('author')->capabilities);

        // Validate when pre post update with php
        add_action('pre_post_update', [$this, 'validateProjectData']);

        // Show notice
        add_action('admin_notices', [$this, 'showValidateNotices']);

        // Validate with javascript
        $this->registerValidateScript();

        // Replace title placeholder
        add_filter('enter_title_here', [$this, 'custom_enter_title_here'], 10, 2);

        require_once PROJECT_MANAGEMENT_PATH . '/features/class-replace-author-box.php';
        require_once PROJECT_MANAGEMENT_PATH . '/features/class-project-management-metabox.php';
        require_once PROJECT_MANAGEMENT_PATH . '/features/class-members-metabox.php';

    }

    function func_project_management()
    {
        $labels = array(
            'name' => __('Project List'),
            'singular_name' => __('Project'),
            'menu_name' => __('Projects'),
            'add_new' => __('Add New Project'),
            'add_new_item' => __('New Project'),
            'edit' => __('Edit Project'),
            'edit_item' => __('Edit Project'),
            'search_items' => __('Search Project'),
            'not_found' => __('Not found Project'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'service'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'author', 'thumbnail'),
        );

        register_post_type($this->post_type, $args);

    }


    /**
     * Show validate errors
     */
    public function showValidateNotices()
    {
        /** Get and remove message (Just like Flash message) */
        $errors = get_transient('validate_errors');
        delete_transient('validate_errors');

        if (isset($errors) && $errors !== false) {
            foreach ($errors as $error) {
                ?>
                <div class="notice notice-error is-dismissible">
                    <p>
                        <?php echo $error; ?>
                    </p>
                </div>
                <?php
            }
        }
    }


    /**
     * Validate player form data. Check if user filled squad number, nationality and suburbs
     */
    public function validateProjectData()
    {
        /** Don't check if delete player */
        if (isset($_GET['action']) && $_GET['action'] == 'trash') {
            return;
        }
        $errors = [];

        if (!isset($_POST['pj_start_date']) || $_POST['pj_start_date'] == '') {
            $errors[] = 'Start Date is required';
        }
        if (!isset($_POST['pj_end_date']) || $_POST['pj_end_date'] == '') {
            $errors[] = 'End Date is required';
        }
        if (!isset($_POST['title']) || $_POST['title'] == '') {
            $errors[] = 'Title is required';
        }

        /** If have error */
        if (sizeof($errors) != 0) {
            /** Set errors */
            set_transient('validate_errors', $errors, 60);

            /** Redirect back */
            $back_location = $_REQUEST['_wp_http_referer'];
            wp_safe_redirect($back_location);
            exit();
        }
    }

    private function registerValidateScript()
    {
        if ($this->isCorrectPage()) {
            wp_enqueue_script('validation-project-management', PROJECT_MANAGEMENT_URL . '/assets/js/project-management-validation.js');
        }
    }

    private function isCorrectPage()
    {
        global $pagenow;

        $isCorrectPage = false;

        if ($pagenow == 'post-new.php' && isset($_GET['post_type']) && $_GET['post_type'] == $this->post_type) {
            $isCorrectPage = true;
        }

        if ($pagenow == 'post.php') {
            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
                $post = get_post($post_id);
                $isCorrectPage = $post->post_type == $this->post_type;
            }

            if (isset($_POST['post_type']) && $_POST['post_type'] == $this->post_type) {
                $isCorrectPage = true;
            }
        }

        return $isCorrectPage;
    }

    function custom_enter_title_here($placeholder, $post)
    {
        if ($this->post_type === $post->post_type) {
            $placeholder = 'Enter your project name';
        }
        return $placeholder;
    }
}