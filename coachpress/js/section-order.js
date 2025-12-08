/**
 * File section-order.js.
 *
 * Handles the drag-and-drop functionality for the section order control.
 */

( function( $ ) {
    wp.customize.controlConstructor['section-order'] = wp.customize.Control.extend({
        ready: function() {
            var control = this;
            $( '.section-order-list', control.container ).sortable({
                update: function() {
                    var order = [];
                    $( '.section-order-item', control.container ).each( function() {
                        order.push( $( this ).data( 'section-id' ) );
                    });
                    control.setting.set( order.join( ',' ) );
                }
            });
        }
    });
} )( jQuery );
