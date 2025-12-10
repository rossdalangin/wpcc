<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Border_Radius_Control extends WP_Customize_Control {
        public $type = 'coachpress-border-radius';

        public function enqueue() {
            wp_enqueue_script( 'coachpress-border-radius-control', get_template_directory_uri() . '/js/border-radius-control.js', array( 'jquery' ), COACHPRESS_VERSION, true );
            wp_enqueue_style( 'coachpress-border-radius-control', get_template_directory_uri() . '/css/border-radius-control.css' );
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <div class="border-radius-inputs">
                    <div class="top-left">
                        <label for="<?php echo esc_attr( $this->id ); ?>-top-left"><?php _e( 'TL', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-top-left" data-corner="top-left" value="<?php echo esc_attr( $this->get_value( 'top-left' ) ); ?>" />
                    </div>
                    <div class="top-right">
                        <label for="<?php echo esc_attr( $this->id ); ?>-top-right"><?php _e( 'TR', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-top-right" data-corner="top-right" value="<?php echo esc_attr( $this->get_value( 'top-right' ) ); ?>" />
                    </div>
                    <div class="bottom-right">
                        <label for="<?php echo esc_attr( $this->id ); ?>-bottom-right"><?php _e( 'BR', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-bottom-right" data-corner="bottom-right" value="<?php echo esc_attr( $this->get_value( 'bottom-right' ) ); ?>" />
                    </div>
                    <div class="bottom-left">
                        <label for="<?php echo esc_attr( $this->id ); ?>-bottom-left"><?php _e( 'BL', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-bottom-left" data-corner="bottom-left" value="<?php echo esc_attr( $this->get_value( 'bottom-left' ) ); ?>" />
                    </div>
                </div>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
            </label>
            <?php
        }

        private function get_value( $corner ) {
            $value = json_decode( $this->value(), true );
            return isset( $value[$corner] ) ? $value[$corner] : '';
        }
    }
}
