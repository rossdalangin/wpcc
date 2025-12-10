( function( $ ) {
    wp.customize.control.add( 'coachpress-gradient', function( control ) {
        control.container.on( 'ready', function() {
            var container = control.container;
            var tabs = container.find( '.gradient-tab' );
            var contents = container.find( '.gradient-tab-content' );
            var hiddenInput = container.find( 'input[type="hidden"]' );

            tabs.on( 'click', function() {
                var tab = $( this );
                var tabId = tab.data( 'tab' );

                tabs.removeClass( 'active' );
                tab.addClass( 'active' );

                contents.removeClass( 'active' );
                container.find( '.' + tabId + '-content' ).addClass( 'active' );
            } );

            container.find( '.color-picker-hex' ).wpColorPicker( {
                change: function() {
                    var value = '';
                    if ( container.find( '.solid-content' ).hasClass( 'active' ) ) {
                        value = container.find( '.solid-content .color-picker-hex' ).val();
                    } else {
                        var color1 = container.find( '.gradient-color-1 .color-picker-hex' ).val();
                        var color2 = container.find( '.gradient-color-2 .color-picker-hex' ).val();
                        value = 'linear-gradient(to right, ' + color1 + ', ' + color2 + ')';
                    }
                    hiddenInput.val( value ).trigger( 'change' );
                }
            } );
        } );
    } );
} )( jQuery );
