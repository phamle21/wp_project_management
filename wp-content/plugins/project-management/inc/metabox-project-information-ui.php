<?php
wp_nonce_field(basename(__FILE__), 'custom_post_metabox_nonce'); // Thêm nonce để bảo vệ form
$description = get_post_meta($post->ID, '_description', true);
$start_date = get_post_meta($post->ID, '_start_date', true);
$end_date = get_post_meta($post->ID, '_end_date', true);
$estimize = get_post_meta($post->ID, '_estimize', true);
$members = (array) get_post_meta($post->ID, '_members', true);
$all_users = get_users();
?>
<!-- Link CSS và JS của Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    textarea,
    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Tùy chỉnh select2 */
    .select2-container {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .select2-selection {
        height: auto !important;
        border: 1px solid #ced4da !important;
        border-radius: 4px !important;
    }

    .select2-selection__choice {
        background-color: #007bff !important;
        color: #fff !important;
    }

    .select2-selection__choice__remove {
        color: #fff !important;
        margin-right: 5px !important;
    }

    .select2-selection__choice__remove:hover {
        color: #fff !important;
    }
</style>


<script>
    jQuery(document).ready(function ($) {
        // Khởi tạo Select2 cho phần tử select
        $('#members').select2({
            placeholder: 'Select members',
            allowClear: true,
        });

        // Khởi tạo date picker cho 2 trường start_date và end_date
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>



<!-- // Hiển thị trường description -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description"><?= esc_textarea($description) ?></textarea>
</div>

<!-- // Hiển thị trường start_date -->
<div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="text" id="start_date" name="start_date" value="<?= esc_attr($start_date) ?>"  class="datepicker" />
</div>

<!-- // Hiển thị trường end_date -->
<div class="form-group">
    <label for="end_date">End Date</label>
    <input type="text" id="end_date" name="end_date" value="<?= esc_attr($end_date) ?>"  class="datepicker" />
</div>

<!-- // Hiển thị trường estimize -->
<div class="form-group">
    <label for="estimize">Estimize</label>
    <input type="text" id="estimize" name="estimize" value="<?= esc_attr($estimize) ?>" />
</div>

<!-- // Hiển thị trường members -->
<div class="form-group">
    <label for="members">Members</label>
    <select id="members" name="members[]" multiple>
        <?php foreach ($all_users as $user):
            $selected = '';
            if (in_array($user->ID, $members)) {
                $selected = ' selected="selected"';
            }
            ?>
            <option value="<?= esc_attr($user->ID) ?>" <?= $selected ?>>
                <?= esc_html($user->display_name) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>