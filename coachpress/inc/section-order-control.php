<?php
/**
 * CoachPress Theme Customizer Section Order Control
 *
 * @package CoachPress
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class CoachPress_Section_Order_Control extends WP_Customize_Control {
    public $type = 'section-order';

    public function enqueue() {
        wp_enqueue_script( 'coachpress-section-order', get_template_directory_uri() . '/js/section-order.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), COACHPRESS_VERSION, true );
        wp_enqueue_style( 'coachpress-section-order', get_template_directory_uri() . '/css/section-order.css', array(), COACHPRESS_VERSION );
    }

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <ul class="section-order-list">
                <?php
                $order = explode( ',', $this->value() );
                $sections = coachpress_get_section_choices();
                foreach ( $order as $section_id ) {
                    if ( isset( $sections[ $section_id ] ) ) {
                        echo '<li class="section-order-item" data-section-id="' . esc_attr( $section_id ) . '">' . esc_html( $sections[ $section_id ] ) . '</li>';
                    }
                }
                foreach ( $sections as $section_id => $section_name ) {
                    if ( ! in_array( $section_id, $order ) ) {
                        echo '<li class="section-order-item" data-section-id="' . esc_attr( $section_id ) . '">' . esc_html( $section_name ) . '</li>';
                    }
                }
                ?>
            </ul>
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
        </label>
        <?php
    }
}
