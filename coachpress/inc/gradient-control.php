<?php
/**
 * CoachPress Theme Customizer Gradient Control
 *
 * @package CoachPress
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class CoachPress_Gradient_Control extends WP_Customize_Control {
    public $type = 'coachpress-gradient';

    public function enqueue() {
        wp_enqueue_script( 'coachpress-gradient-control', get_template_directory_uri() . '/js/gradient-control.js', array( 'jquery', 'wp-color-picker' ), COACHPRESS_VERSION, true );
        wp_enqueue_style( 'coachpress-gradient-control', get_template_directory_uri() . '/css/gradient-control.css', array( 'wp-color-picker' ), COACHPRESS_VERSION );
    }

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="gradient-control-wrap">
                <div class="gradient-tabs">
                    <button type="button" class="gradient-tab active" data-tab="solid"><?php esc_html_e( 'Solid', 'coachpress' ); ?></button>
                    <button type="button" class="gradient-tab" data-tab="gradient"><?php esc_html_e( 'Gradient', 'coachpress' ); ?></button>
                </div>
                <div class="gradient-tab-content solid-content active">
                    <input type="text" class="color-picker-hex" value="<?php echo esc_attr( $this->value() ); ?>" />
                </div>
                <div class="gradient-tab-content gradient-content">
                    <div class="gradient-color-1">
                        <input type="text" class="color-picker-hex" />
                    </div>
                    <div class="gradient-color-2">
                        <input type="text" class="color-picker-hex" />
                    </div>
                </div>
            </div>
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
        </label>
        <?php
    }
}
