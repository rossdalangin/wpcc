/**
 * File section-order.js.
 *
 * Handles the drag-and-drop functionality for the section order control.
 */

( function( $ ) {
    wp.customize.controlConstructor['section-order'] = wp.customize.Control.extend({
        ready: function() {
            var control = this;

            var updateValue = function() {
                var order = [];
                $( '.section-order-item', control.container ).each( function() {
                    if ( $( this ).find( '.section-visibility-toggle' ).is( ':checked' ) ) {
                        order.push( $( this ).data( 'section-id' ) );
                    }
                });

                var newValue = order.join( ',' );

                // Set the value on the setting object directly
                control.setting.set( newValue );

                // Also update the hidden input just in case
                $( '.section-order-input', control.container ).val( newValue ).trigger( 'change' );
            };

            $( '.section-order-list', control.container ).sortable({
                handle: '.dashicons-sort',
                update: updateValue
            });

            $( control.container ).on( 'change', '.section-visibility-toggle', function() {
                var item = $( this ).closest( '.section-order-item' );
                if ( $( this ).is( ':checked' ) ) {
                    item.addClass( 'active' ).removeClass( 'inactive' );
                } else {
                    item.addClass( 'inactive' ).removeClass( 'active' );
                }
                updateValue();
            });
        }
    });
} )( jQuery );
