( function( $ ) {
    wp.customize.control.add( 'coachpress-responsive-font-size', function( control ) {
        control.container.on( 'ready', function() {
            var container = control.container;
            var inputs = container.find( 'input[type="text"]' );
            var hiddenInput = container.find( 'input[type="hidden"]' );

            inputs.on( 'change keyup', function() {
                var value = {};
                inputs.each( function() {
                    var input = $( this );
                    var device = input.data( 'device' );
                    value[device] = input.val();
                } );
                hiddenInput.val( JSON.stringify( value ) ).trigger( 'change' );
            } );
        } );
    } );
} )( jQuery );
