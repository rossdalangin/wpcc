wp.customize.controlConstructor['coachpress-dimensions'] = wp.customize.Control.extend({
    ready: function() {
        'use strict';

        var control = this;

        control.container.on('change keyup paste', 'input[type="text"]', function() {
            var value = {};
            control.container.find('input[type="text"]').each(function() {
                var side = jQuery(this).data('side');
                if (side) {
                    value[side] = jQuery(this).val();
                }
            });
            control.setting.set(JSON.stringify(value));
        });
    }
});
