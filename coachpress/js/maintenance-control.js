(function($) {
    $(document).on('click', '.maintenance-btn', function(e) {
        e.preventDefault();

        var $btn = $(this);
        var action = $btn.data('action');
        var $status = $('.maintenance-status');
        var nonce = $('#coachpress_maintenance_nonce_field').val();

        if (action === 'reset_db' || action === 'remove_pages') {
            if (!confirm('Are you sure? This action cannot be undone.')) {
                return;
            }
        }

        $btn.prop('disabled', true).addClass('updating-message');
        $status.text('Processing...');

        $.post(ajaxurl, {
            action: 'coachpress_maintenance_action',
            maintenance_action: action,
            nonce: nonce
        }, function(response) {
            $btn.prop('disabled', false).removeClass('updating-message');
            if (response.success) {
                $status.css('color', 'green').text(response.data.message);
                if (action === 'reset_db') {
                    // Reload the customizer to reflect changes
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            } else {
                $status.css('color', 'red').text(response.data.message || 'An error occurred.');
            }
        });
    });
})(jQuery);
