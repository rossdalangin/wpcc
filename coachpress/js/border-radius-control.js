wp.customize.controlConstructor['coachpress-border-radius'] = wp.customize.Control.extend({
    ready: function() {
        'use strict';

        var control = this;

        control.container.on('change keyup paste', 'input[type="text"]', function() {
            var value = {};
            control.container.find('input[type="text"]').each(function() {
                var corner = jQuery(this).data('corner');
                if (corner) {
                    value[corner] = jQuery(this).val();
                }
            });
            control.setting.set(JSON.stringify(value));
        });
    }
});
