/**
 * Created by th on 20 Apr 2017.
 */
/**
 * Created By theodor-flavian hanu
 * Date: 18 Mar 2016
 * Time: 12:39
 */
(function( $ ) {
    'use strict';

    $( document ).ready( function() {
        $( '.import_artemis_btn ' ).click( function( event ) {
            var _self = this;
            $( this ).closest( '.import_items' ).find( '.import_spinner' ).addClass( 'active' );
        } );
    } );

})( window.jQuery );

(function() {
    var timeoutSpeed = 100;
    var continueLoop = true;

    function artemis_swp_check_for_finished_import () {
        if ( document.getElementById( 'artemis-import-finished' ) ) {
            jQuery( '.import_items .import_spinner' ).removeClass( 'active' );
            continueLoop = false;
        }

        if ( jQuery( '#artemis-swp-import-processing' ).length ) {
            timeoutSpeed = 500;
            jQuery( 'html,body' ).stop().animate( {
                scrollTop : jQuery( '#artemis-swp-import-processing' ).find( 'p:last-of-type' ).offset().top
            }, 500 );
        }

        if ( continueLoop ) {
            setTimeout( artemis_swp_check_for_finished_import, timeoutSpeed );
        }
    }

    if ( artemisSwpImport.processingImport ) {
        artemis_swp_check_for_finished_import();
    }
})();
