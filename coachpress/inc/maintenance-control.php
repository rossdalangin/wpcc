<?php
/**
 * Customizer Maintenance Control
 *
 * @package CoachPress
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Maintenance_Control extends WP_Customize_Control {
        public $type = 'coachpress-maintenance';

        public function render_content() {
            ?>
            <div class="coachpress-maintenance-control">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

                <div class="maintenance-buttons" style="margin-top: 10px;">
                    <button type="button" class="button button-primary maintenance-btn" data-action="reset_db" style="margin-bottom: 5px; width: 100%;"><?php esc_html_e( 'Reset Database', 'coachpress' ); ?></button>
                    <button type="button" class="button button-secondary maintenance-btn" data-action="add_data" style="margin-bottom: 5px; width: 100%;"><?php esc_html_e( 'Add Sample Data', 'coachpress' ); ?></button>
                    <button type="button" class="button button-secondary maintenance-btn" data-action="recreate_pages" style="margin-bottom: 5px; width: 100%;"><?php esc_html_e( 'Recreate Necessary Pages', 'coachpress' ); ?></button>
                    <button type="button" class="button button-link-delete maintenance-btn" data-action="remove_pages" style="width: 100%; text-align: center;"><?php esc_html_e( 'Remove Necessary Pages', 'coachpress' ); ?></button>
                </div>

                <div class="maintenance-status" style="margin-top: 10px; font-weight: bold;"></div>

                <?php wp_nonce_field( 'coachpress_maintenance_nonce', 'coachpress_maintenance_nonce_field' ); ?>
            </div>
            <?php
        }
    }
}
