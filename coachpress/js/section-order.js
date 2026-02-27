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
                    if ( $( this ).find( '.section-visibility-toggle' ).prop( 'checked' ) ) {
                        order.push( $( this ).data( 'section-id' ) );
                    }
                });

                var newValue = order.join( ',' );

                // Set the value on the setting object directly
                control.setting.set( newValue );

                // Also update the hidden input and trigger change for safety
                $( '.section-order-input', control.container ).val( newValue ).trigger( 'change' );
            };

            $( '.section-order-list', control.container ).sortable({
                handle: '.dashicons-sort',
                update: function() {
                    updateValue();
                }
            });

            // Handle both click and change to ensure persistence
            $( control.container ).on( 'click change', '.section-visibility-toggle', function(e) {
                var item = $( this ).closest( '.section-order-item' );
                if ( $( this ).prop( 'checked' ) ) {
                    item.addClass( 'active' ).removeClass( 'inactive' );
                } else {
                    item.addClass( 'inactive' ).removeClass( 'active' );
                }

                // If it was a click, let the change event handle the update logic if possible
                // but we call updateValue here to be absolutely sure.
                updateValue();
            });

            // Initial UI state setup
            $( '.section-order-item', control.container ).each(function() {
                if ( $(this).find('.section-visibility-toggle').prop('checked') ) {
                    $(this).addClass('active').removeClass('inactive');
                } else {
                    $(this).addClass('inactive').removeClass('active');
                }
            });
        }
    });
} )( jQuery );
