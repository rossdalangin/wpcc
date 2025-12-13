/**
 * File modal.js.
 *
 * Handles the modal functionality for the header CTA.
 */

( function() {
    var modal = document.getElementById("cta-modal");
    var btn = document.getElementById("header-cta-button");
    var span = document.getElementsByClassName("close")[0];

    if ( ! btn || ! modal ) {
        return;
    }

    btn.onclick = function() {
        modal.style.display = "block";
    }

    if ( span ) {
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
} )();
