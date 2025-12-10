( function( $ ) {
    wp.customize.control.add( 'coachpress-border-radius', function( control ) {
        control.container.on( 'ready', function() {
            var container = control.container;
            var inputs = container.find( 'input[type="text"]' );
            var hiddenInput = container.find( 'input[type="hidden"]' );

            inputs.on( 'change keyup', function() {
                var value = {};
                inputs.each( function() {
                    var input = $( this );
                    var corner = input.data( 'corner' );
                    value[corner] = input.val();
                } );
                hiddenInput.val( JSON.stringify( value ) ).trigger( 'change' );
            } );
        } );
    } );
} )( jQuery );
