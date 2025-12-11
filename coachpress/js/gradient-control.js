wp.customize.controlConstructor['coachpress-gradient'] = wp.customize.Control.extend({
    ready: function() {
        'use strict';

        var control = this;

        // Initialize color pickers
        control.container.find('.color-picker-hex').wpColorPicker({
            change: function() {
                updateValue();
            },
            clear: function() {
                updateValue();
            }
        });

        // Tab switching
        control.container.on('click', '.gradient-tab', function(e) {
            e.preventDefault();
            var tab = jQuery(this).data('tab');

            jQuery(this).addClass('active').siblings().removeClass('active');
            control.container.find('.gradient-tab-content').removeClass('active');
            control.container.find('.' + tab + '-content').addClass('active');

            updateValue();
        });

        function updateValue() {
            var activeTab = control.container.find('.gradient-tab.active').data('tab');
            var value;

            if (activeTab === 'solid') {
                value = control.container.find('.solid-content .color-picker-hex').val();
            } else {
                var color1 = control.container.find('.gradient-color-1 .color-picker-hex').val();
                var color2 = control.container.find('.gradient-color-2 .color-picker-hex').val();
                value = 'linear-gradient(90deg, ' + color1 + ', ' + color2 + ')';
            }

            control.setting.set(value);
        }
    }
});
