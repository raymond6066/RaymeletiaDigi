jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";
    var $document = $(document),
        $ajax_nonce = cynicIllustration_feature_ajax.ajax_nonce,
        $cynic_ajax_url = cynicIllustration_feature_ajax.ajax_url,
        $window = $(window);

    /*Equal Height*/
    $.fn.equalHeight = function (options) {
        var maxHeight = 0;
        var defaults = {
            selector: $('.equalHeight')
        };
        options = $.extend(defaults, options);

        $(this).each(function () {
            $(this).find(defaults.selector).each(function () {
                if ($(this).height() > maxHeight) {
                    maxHeight = $(this).height();
                }
            });
            $(this).find(defaults.selector).height(maxHeight);
        });
    }

    $('.equalHeightWrapper').equalHeight({
        selector: $('.equalHeight')
    });

    InitEqualHeight();

    function InitEqualHeight() {
        $('.latest-news').equalHeight({
            selector: $('.news-card h4')
        });

        $('.latest-news').equalHeight({
            selector: $('.news-card p:not(:empty)')
        });
    }

    /* Open Video in Magnific Pop Up */
    $document.on('click', '.video-popup', function (e) {
        var magnific = $(this).magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-with-zoom',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: '//www.youtube.com/embed/%id%?autoplay=1'
                    }
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                srcAction: 'iframe_src'
            }
        });
        magnific.magnificPopup('open');
        e.preventDefault();
        return false;
    });

    /* Load Single Portfolio In Modal */
    $document.on('click', '.get-single-post', function (e) {
        var $modalid = '#product-modal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');
        $($modalid).modal('show');
        var data_settings = $(this).data('settings'),
            data_action = $(this).data('action'),
            isModal = $(this).data('is-modal'),
            posttype = $(this).data('posttype'),
            portfoliotype = $(this).data('portfoliotype');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            data: {
                'action': data_action,
                'security': $ajax_nonce,
                'settings': data_settings,
                'posttype': posttype,
                'isModal': isModal,
                'portfoliotype': portfoliotype
            },
            success: function (resp) {

                if (posttype == 'post') {
                    $($modalid).addClass('blog-modal');
                } else if (posttype == 'portfolio') {
                    $($modalid).addClass('product-modal');
                } else {
                    $($modalid).addClass('product-modal');
                }

                $('.close').on('click', function () {
                    $('#product-modal').removeClass('product-modal');
                    $('#product-modal').removeClass('blog-modal');
                });

                var $resp = $(resp), $output;
                if (typeof (isModal) != "undefined") {
                    $output = resp;
                } else {
                    $output = $resp.find("#single-" + posttype + "-content").html();
                }
                $(' ' + $modalid + ' .modal-body').html($output);
            }
        });
    });

    /**
     * Team Modal
     */

    $document.on('click', '.cynic_team_vc_element', function (e) {
        e.preventDefault();
        var _this = $(this),
            avatar = _this.find('.img-container').html(),
            fullname = _this.find('.cynic_team_modal').data('fullname'),
            designation = _this.find('.cynic_team_modal').data('designation'),
            bio = _this.find('.cynic_team_modal').data('bio'),
            socialhtml = _this.find('.socialmediacontainer').html(),
            html = '';
        var html = '';
        html += avatar;
        html += "<div class='modal-title'><h4>" + fullname + "<span>" + designation + "</span></h4></div>";
        html += "<p>" + bio + "</p>";
        html += socialhtml;
        $('.team-modal .modal-body').html(html);
        $('.team-modal').modal('show');

    })

    /* Load Single Portfolio In Modal */
    $document.on('click', 'load-more-news', function (e) {
        var data_settings = $(this).data('settings'),
            data_action = $(this).data('action'),
            isModal = $(this).data('is-modal'),
            posttype = $(this).data('posttype');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            data: {
                'action': data_action,
                'security': $ajax_nonce,
                'settings': data_settings,
                'posttype': posttype,
                'isModal': isModal
            },
            success: function (resp) {
                var $resp = $(resp), $output;
                if (typeof (isModal) != "undefined") {
                    $output = resp;
                } else {
                    $output = $resp.find("#single-" + posttype + "-content").html();
                }
                $(' ' + $modalid + ' .modal-body').html($output);
            }
        });
    });

    $document.on('click', '.load-more', function (e) {
        e.preventDefault();
        var _self = $(this),
            _pageno = _self.attr('data-pageno'),
            _settings = _self.data('settings');
        showTextLoading('.load-more');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                'action': 'cynic_get_illustration_post',
                'security': $ajax_nonce,
                'pageno': _pageno,
                'settings': _settings,
            },
            success: function (resp) {
                if (resp.outputs) {
                    var _selector = $(".latest-news");
                    _selector.find('.col-lg-4:last').after(resp.outputs);
                    _self.attr('data-pageno', parseInt(_pageno) + 1);
                    var $max_length = _selector.find('.col-lg-4').length;
                    if (resp.outputs.total == '0' || $max_length == resp.total) {
                        _self.addClass('d-none');
                    }
                    InitEqualHeight();
                    hideTextLoading('.load-more');
                }

            }
        });
    });


    $document.on('click', '.load-more-cat-posts', function (e) {
        e.preventDefault();
        var _self = $(this),
            _pageno = _self.attr('data-pageno'),
            _random = _self.attr('data-unique'),
            _settings = _self.data('settings');
        showTextLoading('.random-' + _random + '');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                'action': 'cynic_get_illustration_blog_version_two',
                'security': $ajax_nonce,
                'pageno': _pageno,
                'settings': _settings,
            },
            success: function (resp) {
                if (resp.outputs) {
                    var _selector = _self.parent().parent();
                    _selector.find('.col-lg-4:last').after(resp.outputs);
                    _self.attr('data-pageno', parseInt(_pageno) + 1);
                    var $max_length = _selector.find('.col-lg-4').length;
                    if (resp.outputs.total == '0' || $max_length == resp.total) {
                        _self.addClass('d-none');
                    }
                    InitEqualHeight();
                    hideTextLoading('.random-' + _random + '');
                }

            }
        });
    });

    /* Load Single Pages In Modal */
    $document.on('click', '.cynic-pages-modal', function (e) {
        var $modalid = '#product-modal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');
        $($modalid).modal('show');
        var postID = $(this).data('post');
        var posttype = $(this).data('posttype');
        $.ajax({
            url: $cynic_ajax_url,
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {
                'action': 'cynic_pages_in_modal',
                'security': $ajax_nonce,
                'postID': postID
            },
            success: function (resp) {
                var $html = resp;
                if ($html.outputs) {
                    $($modalid + " .modal-body").html($html.outputs);
                }
            }
        });
    });

    function showTextLoading(selector) {
        $('' + selector + '').addClass('text-loading');
        $('' + selector + '').attr('disabled', 'disabled');
    }

    function hideTextLoading(selector) {
        $('' + selector + '').removeClass('text-loading');
        $('' + selector + '').removeAttr('disabled');
    }

}(jQuery));