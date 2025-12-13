wp.customize.controlConstructor['coachpress-responsive-font-size'] = wp.customize.Control.extend({
    ready: function() {
        'use strict';

        var control = this;

        control.container.on('change keyup paste', 'input[type="text"]', function() {
            var value = {};
            control.container.find('input[type="text"]').each(function() {
                var device = jQuery(this).data('device');
                if (device) {
                    value[device] = jQuery(this).val();
                }
            });
            control.setting.set(JSON.stringify(value));
        });
    }
});
