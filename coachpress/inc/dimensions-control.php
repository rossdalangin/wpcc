<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Dimensions_Control extends WP_Customize_Control {
        public $type = 'coachpress-dimensions';

        public function enqueue() {
            wp_enqueue_script( 'coachpress-dimensions-control', get_template_directory_uri() . '/js/dimensions-control.js', array( 'jquery' ), COACHPRESS_VERSION, true );
            wp_enqueue_style( 'coachpress-dimensions-control', get_template_directory_uri() . '/css/dimensions-control.css' );
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <div class="dimensions-inputs">
                    <div class="top">
                        <label for="<?php echo esc_attr( $this->id ); ?>-top"><?php _e( 'T', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-top" data-side="top" value="<?php echo esc_attr( $this->get_value( 'top' ) ); ?>" />
                    </div>
                    <div class="right">
                        <label for="<?php echo esc_attr( $this->id ); ?>-right"><?php _e( 'R', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-right" data-side="right" value="<?php echo esc_attr( $this->get_value( 'right' ) ); ?>" />
                    </div>
                    <div class="bottom">
                        <label for="<?php echo esc_attr( $this->id ); ?>-bottom"><?php _e( 'B', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-bottom" data-side="bottom" value="<?php echo esc_attr( $this->get_value( 'bottom' ) ); ?>" />
                    </div>
                    <div class="left">
                        <label for="<?php echo esc_attr( $this->id ); ?>-left"><?php _e( 'L', 'coachpress' ); ?></label>
                        <input type="text" id="<?php echo esc_attr( $this->id ); ?>-left" data-side="left" value="<?php echo esc_attr( $this->get_value( 'left' ) ); ?>" />
                    </div>
                </div>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
            </label>
            <?php
        }

        private function get_value( $side ) {
            $value = json_decode( $this->value(), true );
            return isset( $value[$side] ) ? $value[$side] : '';
        }
    }
}
