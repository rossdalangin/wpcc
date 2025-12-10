<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Responsive_Font_Size_Control extends WP_Customize_Control {
        public $type = 'coachpress-responsive-font-size';

        public function enqueue() {
            wp_enqueue_script( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/js/responsive-font-size-control.js', array( 'jquery' ), COACHPRESS_VERSION, true );
            wp_enqueue_style( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/css/responsive-font-size-control.css' );
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <div class="responsive-font-size-inputs">
                    <div class="desktop">
                        <label for="<?php echo esc_attr( $this->id ); ?>-desktop"><?php _e( 'Desktop', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-desktop" data-device="desktop" value="<?php echo esc_attr( $this->get_value( 'desktop' ) ); ?>" />
                    </div>
                    <div class="tablet">
                        <label for="<?php echo esc_attr( $this->id ); ?>-tablet"><?php _e( 'Tablet', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-tablet" data-device="tablet" value="<?php echo esc_attr( $this->get_value( 'tablet' ) ); ?>" />
                    </div>
                    <div class="mobile">
                        <label for="<?php echo esc_attr( $this->id ); ?>-mobile"><?php _e( 'Mobile', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-mobile" data-device="mobile" value="<?php echo esc_attr( $this->get_value( 'mobile' ) ); ?>" />
                    </div>
                </div>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
            </label>
            <?php
        }

        private function get_value( $device ) {
            $value = json_decode( $this->value(), true );
            return isset( $value[$device] ) ? $value[$device] : '';
        }
    }
}
