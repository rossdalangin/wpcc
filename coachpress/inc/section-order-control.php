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
                $order = array_filter( explode( ',', $this->value() ) );
                $sections = coachpress_get_section_choices();

                // First, show active sections in order
                foreach ( $order as $section_id ) {
                    if ( isset( $sections[ $section_id ] ) ) {
                        echo '<li class="section-order-item active" data-section-id="' . esc_attr( $section_id ) . '">';
                        echo '<span class="dashicons dashicons-sort"></span>';
                        echo '<input type="checkbox" checked class="section-visibility-toggle" /> ';
                        echo '<span class="section-name">' . esc_html( $sections[ $section_id ] ) . '</span>';
                        echo '</li>';
                    }
                }

                // Then, show available but inactive sections
                foreach ( $sections as $section_id => $section_name ) {
                    if ( ! in_array( $section_id, $order ) ) {
                        echo '<li class="section-order-item inactive" data-section-id="' . esc_attr( $section_id ) . '">';
                        echo '<span class="dashicons dashicons-sort"></span>';
                        echo '<input type="checkbox" class="section-visibility-toggle" /> ';
                        echo '<span class="section-name">' . esc_html( $section_name ) . '</span>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
            <input type="hidden" class="section-order-input" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
        </label>
        <?php
    }
}
