<?php
/**
 * CoachPress Theme Customizer Google Font Control
 *
 * @package CoachPress
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class CoachPress_Google_Font_Control extends WP_Customize_Control {
    public $type = 'google-font';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?>>
                <?php
                $fonts = $this->get_fonts();
                foreach ( $fonts as $font_family => $font_name ) {
                    echo '<option value="' . esc_attr( $font_family ) . '"' . selected( $this->value(), $font_family, false ) . '>' . esc_html( $font_name ) . '</option>';
                }
                ?>
            </select>
        </label>
        <?php
    }

    private function get_fonts() {
        return array(
            'Lora' => 'Lora',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Oswald' => 'Oswald',
            'Raleway' => 'Raleway',
            'Roboto' => 'Roboto',
            'Poppins' => 'Poppins',
        );
    }
}
