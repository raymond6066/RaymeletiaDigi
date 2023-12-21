jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";
    var $document = $(document);
    var $ajax_nonce = cynicSEO_feature_ajax.ajax_nonce;
    var $cynicSEO_feature_ajax_url = cynicSEO_feature_ajax.ajax_url;

    /*Global functions*/

    function ShowLoader() {
        $document.find('.loader_wrapper').css('display','block');
    }

    function HideLoader() {
        $document.find('.loader_wrapper').css('display','none');
    }

    /*cynic Feature Slider Initialized*/
    $('.cynicSEO-slick-slider').slick();

    /*Read More Ajax Load for Customer Reviews */
    $document.on('click', '.read_more_client_reviews_btn', function (e) {
        ShowLoader();
        e.preventDefault();
        var This = $(this);
        var wrapperSelector = This.parents('.cynicSEO-customer-review-details')
        var $settings = wrapperSelector.attr('data-settings');
        var $query = wrapperSelector.attr('data-query');

        var settings = $.parseJSON($settings);
        var query = $.parseJSON($query);
        var paged = wrapperSelector.attr('data-paged');
        var post_count = wrapperSelector.attr('data-post-count');

        $.ajax({
            url: $cynicSEO_feature_ajax_url,
            dataType: "json",
            method: 'post',
            cache: false,
            data: {
                'action': 'cynicSEO_feature_client_review_read_more',
                'security': $ajax_nonce,
                'query': query,
                'settings': settings,
                'paged': paged,
                'post_count': post_count
            },
            success: function (resp) {
                var $html = resp;
                if (typeof ($html.outputs) != "undefined" || ($html)) {
                    var postsCount = parseInt($html.posts_count);
                    wrapperSelector.attr('data-paged', parseInt(paged) + 1);
                    wrapperSelector.attr('data-post-count', parseInt(postsCount));
                    wrapperSelector.find('.row:first').append($html.outputs);

                    if (postsCount >= settings.found_posts) {
                        This.parent().addClass('d-none');
                    }
                    wrapperSelector.find('[data-bg]').each(function () {
                        var $bg = $(this).data('bg');
                        $(this).css({
                            backgroundImage: 'url(' + $bg + ')'
                        });
                    });
                }
                HideLoader();
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    })

    //Typed js
    var $typedContent = $(".banner-slider-cynicSEO-feature");
    $.each($typedContent, function (index, value) {
        var Dthis = $(this);
        var allImg = Dthis.find(".search-slider img");
        var i = 1;
        var title = [];
        $.each(allImg, function (index, value) {
            $(this).addClass('img-' + i);
            title.push($(this).attr('alt'));
            i++;
        });
        Dthis.find(".typed").typed({
            strings: title,
            stringsElement: null,
            typeSpeed: 15,
            startDelay: 15,
            backSpeed: 15,
            backDelay: 2000,
            loop: true,
            loopCount: true,
            showCursor: false,
            cursorChar: " ",
            attr: null,
            contentType: 'html',
            callback: function () {
            },
            preStringTyped: function (value) {
                var value = value + 1;
                $('.search-slider').find('img.img-' + value).removeClass('hide-img').addClass('show-img');
            },
            onStringTyped: function (value) {
                var value = value + 1;
                setTimeout(function () {
                    $('.search-slider').find('img').removeClass('show-img').addClass('hide-img');
                }, 2000);

            },
            resetCallback: function () {
            }
        });

    });

    $(document).on('click', '.cynicSEO_contact_us_form', function (e) {
        var id = $(this).data('target');
        $('#' + id).modal('show');
    })


    /*Tab Nav*/
    var _navLink = $('.type-2 .nav-item a[data-toggle="tab"]');
    _navLink.on('click', function (e) {
        var _curr = $(this).closest('li');
        _curr.prevAll().addClass("visited");
        _curr.removeClass("visited");
        _curr.nextAll().removeClass("visited");
    });


    $(document).on('mouseenter', '.social-bg', function () {
        var socialbg = $(this).attr('data-hover-bg');
        $(this).css("background", socialbg).css("color", "#fff");
    })
    $(document).on('mouseleave', '.social-bg', function () {
        var socialbg = $(this).attr('data-hover-bg');
        $(this).css("background", 'transparent').css("color", socialbg);
    });

    $(".nav-social-links").find('[data-hover-bg]').each(function () {
        var This = $(this);
        var socialbg = This.attr('data-hover-bg');
        This.css("color", socialbg)
    });

    $(document).on('click', '.map-tab-wrapper .nav-tabs a.nav-link', function (e) {
        var address = $(this).data('address');
        $(this).parents('.cynicSEO-google-map-section').find('.addressbox').text(address);
    })

}(jQuery));
/*ready*/