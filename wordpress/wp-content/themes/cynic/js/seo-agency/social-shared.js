jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";

    var windowOpen;
    $(document.body).on('click', 'a.share-twitter', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcomtwitter', 'menubar=1,resizable=1,width=600,height=350');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-facebook', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcomfacebook', 'menubar=1,resizable=1,width=600,height=400');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-mwp', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcommwp', 'menubar=1,resizable=1,width=600,height=350');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-linkedin', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcomlinkedin', 'menubar=1,resizable=1,width=580,height=450');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-google-plus-1', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcomgoogle-plus-1', 'menubar=1,resizable=1,width=480,height=550');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-pocket', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcompocket', 'menubar=1,resizable=1,width=450,height=450');
        return false;
    });
    var windowOpen;
    $(document.body).on('click', 'a.share-tumblr', function () {
        // If there's another sharing window open, close it.
        if ('undefined' !== typeof windowOpen) {
            windowOpen.close();
        }
        windowOpen = window.open($(this).attr('href'), 'wpcomtumblr', 'menubar=1,resizable=1,width=450,height=450');
        return false;
    });


}(jQuery));
/*ready*/