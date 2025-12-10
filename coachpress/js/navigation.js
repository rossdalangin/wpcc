/**
 * File navigation.js.
 *
 * Handles toggling the mobile menu.
 */

( function() {
    var container, button, menu;

    container = document.getElementById( 'site-navigation' );
    if ( ! container ) {
        return;
    }

    button = container.getElementsByClassName( 'menu-toggle' )[0];
    if ( 'undefined' === typeof button ) {
        return;
    }

    menu = container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu ) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
        menu.className += ' nav-menu';
    }

    button.onclick = function() {
        container.classList.toggle( 'toggled' );
        button.classList.toggle( 'toggled' );
        var isExpanded = container.classList.contains( 'toggled' );
        button.setAttribute( 'aria-expanded', isExpanded );
        menu.setAttribute( 'aria-expanded', isExpanded );
    };
} )();
