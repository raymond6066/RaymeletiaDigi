jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";
    var $document = $(document),
        $ajax_nonce = cynicTrendy_feature_ajax.ajax_nonce,
        $cynic_ajax_url = cynicTrendy_feature_ajax.ajax_url,
        $window = $(window);

    /* Init Isotope */
    $window.on("load", function () {
        //isotope initialization
        var $grid = $('.grid').isotope({
            // options
            itemSelector: '.grid-item',
            layoutMode: 'masonry',
            percentPosition: true
        });


        // filter items on button click
        var $filterButton = '.filter-button';
        $('.filter-button-group').on('click', $filterButton, function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });

        $('.filter-button-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', $filterButton, function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });
    });

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
    $document.on('click', '.cynic-single-content', function (e) {
        var $modalid = '#trendy-agency-modal';
        $($modalid).addClass('featured-project-modal');
        $($modalid).attr('data-modalwrapper', 'featured-project-modal');
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');
        $($modalid).modal('show');
        var data_settings = $(this).data('settings');
        var posttype = $(this).data('posttype');
        var data_portfoliotype = $(this).data('portfolio-type');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            data: {
                'action': 'cynic_single_post_content',
                'security': $ajax_nonce,
                'settings': data_settings
            },
            success: function (resp) {
                // var $resp = $(resp),
                //     $output = $resp.find("#single-" + posttype + "-content").html();
                // console.log($output);
                $('#trendy-agency-modal .modal-body').html(resp);

            }
        });
    });

    /* Load All Portfolio In Modal */
    $document.on('click', '.load-more', function (e) {
        e.preventDefault();
        var _self = $(this);
        showTextLoading('.load-more');
        var $settings = _self.attr('data-settings');
        var $query = _self.attr('data-query');

        var settings = $.parseJSON($settings),
            query = $.parseJSON($query),
            paged = _self.attr('data-paged'),
            post_count = _self.attr('data-post-count'),
            $target = _self.data('target');

        $.ajax({
            url: $cynic_ajax_url,
            dataType: "json",
            method: 'post',
            cache: false,
            data: {
                'action': 'cynic_get_all_posts_content',
                'security': $ajax_nonce,
                'query': query,
                'settings': settings,
                'paged': paged,
                'post_count': post_count
            },
            success: function (resp) {
                var $html = resp;
                if (typeof($html.outputs) != "undefined" || ($html)) {
                    var postsCount = parseInt($html.posts_count),
                        total_posts = 0;
                    _self.attr('data-paged', parseInt(paged) + 1);
                    _self.attr('data-post-count', parseInt(postsCount));

                    var $isotope = $($target).data('isotope');
                    if ($isotope) {
                        var $items = $($html.outputs);
                        $items.each(function () {
                            var $content = $(this);
                            setTimeout(function () {
                                _self.parent().find('.row').append($content).isotope('insert', $content);
                                total_posts = $($target).find('.grid-item').length;
                            }, setTime());
                        });
                    } else {
                        _self.parent().find('.row').append($html.outputs);
                    }

                    setTimeout(function () {
                        if ($html.outputs == "" || (total_posts == $html.posts_count)) {
                            _self.remove();
                        }
                    }, setTime());
                    hideTextLoading('.load-more');
                }
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });

    });

    /* Load Single Portfolio In Modal */
    $document.on('click', '.cynic-blog-single-content', function (e) {
        var $modalid = '#trendy-agency-modal';
        $($modalid).addClass('news-modal');
        $($modalid).attr('data-modalwrapper', 'news-modal');
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');
        $($modalid).modal('show');
        var data_settings = $(this).data('settings');
        var posttype = $(this).data('posttype');
        $.ajax({
            url: $cynic_ajax_url,
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {
                'action': 'cynic_blog_single_post_content',
                'security': $ajax_nonce,
                'settings': data_settings
            },
            success: function (resp) {
                var $html = resp;
                if ($html.outputs) {
                    $($modalid + " .modal-body").html($html.outputs);
                }
            }
        });
    });

    /* Load Single Pages In Modal */
    $document.on('click', '.cynic-pages-modal', function (e) {
        var $modalid = '#cynic-pages-modal';
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


    // when object with class close-popup is clicked...
    $('#trendy-agency-modal').on('hidden.bs.modal', function (e) {
        setTimeout(function () {
            var modalAttribute = $(this).attr('data-modalwrapper');
            $('#trendy-agency-modal .close').trigger('click', [modalAttribute]);
        }, setTime());
    })

    //Close a modal after click...
    $('#trendy-agency-modal .close').on('click', function (e, param1) {
        e.preventDefault();
        var $modalid = '#trendy-agency-modal';
        var _trendyWrapper;
        $($modalid + " .modal-body").find('iframe').attr('src', '');
        setTimeout(function () {
            if (typeof(param1) != "undefined") {
                _trendyWrapper = param1
            } else {
                _trendyWrapper = $('#trendy-agency-modal').attr('data-modalwrapper');
            }
            $($modalid).removeClass(_trendyWrapper);
            $($modalid).removeAttr('data-modalwrapper');
        }, setTime());
    });

    function setTime() {
        return 300;
    }

    function showTextLoading(selector) {
        $('' + selector + '').addClass('text-loading');
        $('' + selector + '').addClass('disabled');
    }

    function hideTextLoading(selector) {
        $('' + selector + '').removeClass('text-loading');
        $('' + selector + '').removeClass('disabled');
    }

    /**
     * Team Modal
     */

    $document.on('click', '.cynic_team_vc_element', function (e) {
        e.preventDefault();
        var _this = $(this);
        var avator = _this.find('.img-container').html();
        var fullname = _this.find('.cynic_team_modal').data('fullname');
        var designation = _this.find('.cynic_team_modal').data('designation');
        var bio = _this.find('.cynic_team_modal').data('bio');
        var socialhtml = _this.find('.socialmediacontainer').html();
        var html = '';
        html += avator;
        html += "<h4>" + fullname + "<span>" + designation + "</span></h4>";
        html += "<p>" + bio + "</p>"
        html += socialhtml;


        $('.cynic_feature_team_modal .modal-body').html(html);
        $('.cynic_feature_team_modal').modal('show');

    })

    /**
     * Case Studies Slider Modal
     */

    $document.on('click', '.case-study-slider .item a.show-modal', function (e) {
        e.preventDefault();
        var _this = $(this);
        var $modalSelector = '#cynic_feature_case_studies_slider_modal';
        $($modalSelector + " .modal-content").html('');

        var _img_src = $($modalSelector + ' .loading-img').html();
        $($modalSelector + " .modal-content").html('<div class="portfolio-loading">' + _img_src + '</div>');

        $($modalSelector).modal('show');
        var postID = _this.data('id');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                'action': 'cynic_case_studies_slider_modal_content',
                'security': $ajax_nonce,
                'post_id': postID,
            },
            success: function (resp) {
                if (resp.outputs) {
                    var $html = resp.outputs;
                    $($modalSelector + " .modal-content").html($html);
                }

            }
        });

    })

    $document.on('click', '.getCustomBlog', function (e) {
        e.preventDefault();
        var _self = $(this),
            _pageno = _self.data('pageno'),
            _settings = _self.data('settings');
        showTextLoading('.getCustomBlog');
        $.ajax({
            url: $cynic_ajax_url,
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                'action': 'cynic_get_custom_blog',
                'security': $ajax_nonce,
                'pageno': _pageno,
                'settings': _settings,
            },
            success: function (resp) {
                if (resp.outputs) {
                    var _selector = $("." + resp.dataTarget + " .row");
                    _selector.find('.item:last').after(resp.outputs);
                    _self.attr('data-pageno', parseInt(_pageno) + 1);
                    var $max_length = _selector.find('.item').length;
                    if (resp.outputs.total == '0' || $max_length == resp.total) {
                        _self.addClass('d-none');
                    }
                    hideTextLoading('.getCustomBlog');
                }

            }
        });
    })

}(jQuery));