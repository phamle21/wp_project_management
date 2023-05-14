
jQuery(document).ready(function ($) {
    $('#post').submit(function () {
        var postTitle = $('#title').val();
        var startDate = $('#start_date').val();
        var estimize = $('#estimize').val();

        var check = true;

        if (postTitle == '') {

            if (!$('#notice-error-title').length) {
                var errorText = 'Invalid project name';
                var errorHtml = '<div id="notice-error-title" class="notice notice-error is-dismissible"><p>' + errorText + '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
                $('#wpbody-content .wrap .wp-header-end').after(errorHtml);

            }

            // Add this code to handle notice-dismiss button click
            $('.notice-dismiss').click(function () {
                $(this).parent().remove(); // Remove the notice element
            });

            check = false;
        }

        if (startDate == '') {
            if (!$('#notice-error-startDate').length) {
                var errorText = 'Invalid Start Date';
                var errorHtml = '<div id="notice-error-startDate" class="notice notice-error is-dismissible"><p>' + errorText + '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
                $('#wpbody-content .wrap .wp-header-end').after(errorHtml);

            }

            // Add this code to handle notice-dismiss button click
            $('.notice-dismiss').click(function () {
                $(this).parent().remove(); // Remove the notice element
            });

            check = false;
        }

        if (estimize == '') {
            if (!$('#notice-error-estimize').length) {
                var errorText = 'Invalid Estimize';
                var errorHtml = '<div id="notice-error-estimize" class="notice notice-error is-dismissible"><p>' + errorText + '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
                $('#wpbody-content .wrap .wp-header-end').after(errorHtml);

            }

            // Add this code to handle notice-dismiss button click
            $('.notice-dismiss').click(function () {
                $(this).parent().remove(); // Remove the notice element
            });

            check = false;
        }

        return check;
    });
});
