/**
 * Customizer Controls JS
 *
 * Implements intelligent color recommendations based on background brightness.
 */
(function($) {
    wp.customize.bind('ready', function() {
        var sections = ['hero', 'trust', 'problem', 'about-preview', 'services', 'processes', 'testimonials', 'portfolio', 'case-studies', 'faqs', 'cta', 'contact', 'team'];

        function getBrightness(hex) {
            if (!hex) return 255;
            hex = hex.replace('#', '');
            if (hex.length === 3) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
            if (hex.length !== 6) return 255;
            var r = parseInt(hex.substr(0, 2), 16);
            var g = parseInt(hex.substr(2, 2), 16);
            var b = parseInt(hex.substr(4, 2), 16);
            return ((r * 299) + (g * 587) + (b * 114)) / 1000;
        }

        sections.forEach(function(sectionId) {
            wp.customize('coachpress_' + sectionId + '_bg_color', function(setting) {
                setting.bind(function(newColor) {
                    var brightness = getBrightness(newColor);
                    var isDark = brightness < 155;

                    // Recommend colors
                    var recommendedHeading = isDark ? '#FFFFFF' : '#1a365d';
                    var recommendedText = isDark ? '#e2e8f0' : '#2d3748';

                    // Update controls
                    wp.customize('coachpress_' + sectionId + '_heading_color').set(recommendedHeading);
                    wp.customize('coachpress_' + sectionId + '_text_color').set(recommendedText);
                });
            });
        });
    });
})(jQuery);
