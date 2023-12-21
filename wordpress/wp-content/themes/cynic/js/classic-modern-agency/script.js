jQuery.noConflict();

(function ($) {
    "use strict";
    // Boostrap navigation modification
    var $document = $(document),
        $fwindow = $(window),
        equalheight;

    if ($('.cynic-normal-menu').length > 0) {
        //Adding class for page scroll
        function add_attr_for_mobile() {
            if ($fwindow.width() <= 767) {
                var $data_scroll = $('.page-scroll-to').attr('data-scroll-to');
                var $data_scroll_for_mobile = parseInt($data_scroll) - 40;
                $('.page-scroll-to').attr('data-scroll-to', $data_scroll_for_mobile);
            }
        }
        // Dropdown clickable in mobile and tab start
        function checkWidth(init) {
            /*If browser resized, check width again */
            if ($fwindow.width() <= 1024) {
                $('.page-template-unit-mode .dropdown-menu').css('display', 'none');
            } else {
                if (!init) {
                    $('.page-template-unit-mode .dropdown-menu').removeAttr('style');
                }
            }
        }

        checkWidth(true);
        $fwindow.resize(function () {
            checkWidth(false);
        });

        // Boostrap navigation modification
        jQuery(function ($) {
            if ($fwindow.width() < 768) {
                add_attr_for_mobile();
                $document.on('click', '.navbar .dropdown > a', function () {
                    location.href = this.href;
                });
            }
        });
        //Dropdown clickable in mobile and tab end

        /* Show/Hide menu in device*/
        $('.page-template-unit-mode .navbar-nav').find('.dropdown-menu').after('<span class="dropdown-toggle"></span>');
        $document.on('click', '.page-template-unit-mode  .dropdown-toggle', function (e) {
            var parent = $(this).closest('li');
            e.preventDefault();
            parent.find("> .dropdown-menu").slideToggle("fast");
        });
    }

    //Hide sub menu after click on body for both mobile and tab
    $('.navbar li a').not('li.dropdown > a').on('click', function (e) {
        if ($fwindow.width() < 768) {
            $("button.navbar-toggle").trigger('click');
        }
    });

    /*Display video in video template*/
    var video_portfolio = $('.portfolio-type-video').length;
    if (video_portfolio > 0) {
        var video_attr = $('html, body').find('.portfolio-type-video').attr('data-attr');
        $('html, body').find('.portfolio-type-video').html('<iframe width="900" height="506" src="https://www.youtube.com/embed/' + video_attr + '" frameborder="0" allowfullscreen></iframe>');
    }

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $document.on('click', '.to-top, .page-template-template-modernpage .main-menu .navbar-nav>li a', function (e, autoClick) {
        if (!$('.page-template-template-modernpage').hasClass('multipage-agency')) {
            e.preventDefault();
            var $anchor = $(this);
            if ($('.page-template-template-modernpage').hasClass('single') && autoClick != "autoClick") {
                window.location.href = cynic_homeurl + $(this).attr('href');
            }
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top - 100)
            }, 1500, 'easeInOutExpo');
            return false;
        }
    });

    $('.page-template-template-modernpage').scrollspy({
        target: 'nav',
        offset: 200
    });

    $('.page-template-template-modernpage:not(.multipage-agency) #navbar-main').affix({
        offset: {
            top: 200
        }
    });

    // Sticky header...

    $fwindow.on('scroll', function (e) {
        if ($fwindow.scrollTop() >= 1) {
            if ($('.logged-in').find('.fixed-header') || $('.logged-in').find('.affix')) {
                $('.admin-bar').addClass('fixed-header-padding');
            }
        } else {
            $('body').removeClass('fixed-header-padding');
        }
        if ($fwindow.scrollTop() >= 100) {
            $('.to-top').addClass('show-to-top');
        } else {
            $('.to-top').removeClass('show-to-top');
        }

        //Change position of the scroll-top button on mobile device
        if ($fwindow.width() < 768) {
            var docHeight = document.body.offsetHeight;
            docHeight = docHeight == undefined ? window.document.documentElement.scrollHeight : docHeight;

            var winheight = window.innerHeight;
            winheight = winheight == undefined ? document.documentElement.clientHeight : winheight;

            var scrollpoint = window.scrollY;
            scrollpoint = scrollpoint == undefined ? window.document.documentElement.scrollTop : scrollpoint;

            if ((scrollpoint + winheight) >= docHeight) {
                $('.to-top').addClass('abs');
            } else {
                $('.to-top').removeClass('abs');
            }
        }
    });


    //Remove menug menu class
    $('.dropdown').each(function () {
        var megu_menu = $(this).find('.dropdown-megamenu li .dropdown-submenu li').length;
        if (megu_menu == 0) {
            $(this).find('.dropdown-megamenu').removeClass('dropdown-megamenu');
        } else {
            $(this).find('.dropdown-megamenu').parent().addClass('list-with-megamenu');
        }
    });

    // set background image
    $('[data-bg]').each(function () {
        var $bg = $(this).data('bg');
        $(this).css({
            backgroundImage: 'url(' + $bg + ')'
        });
    });
    $('[data-bg-color]').each(function () {
        var $bg = $(this).attr('data-bg-color');
        $(this).css({
            backgroundColor: $bg
        });
    });

    // when object with class close-popup is clicked...
    $('#portfolioDetModal').on('hidden.bs.modal', function (e) {
        $('.close').trigger('click');
    })

    //Close a modal after click...
    $('.close').on('click', function (e) {
        e.preventDefault();
        var $modalid = '#portfolioDetModal';
        $($modalid + " .modal-body").find('iframe').attr('src', '');
        setTimeout(function () {
            $($modalid).removeClass('blogModal');
        }, 500);
    });
    //Open video in magnifix popup
    $document.on('click', '.video-popup', function (e) {
        var magnific = $('.video-popup').magnificPopup({
            items: {
                src: $(this).attr('href'),
                type: 'iframe'
            }
        });
        magnific.magnificPopup('open');
        e.preventDefault();
        return false;
    });

    //Featured details Portfoilo details in modal
    $document.on('click', '.proDetModal', function (e) {
        e.preventDefault();

        var $modalid = '#portfolioDetModal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');

        if ($(this).attr('data-modalbox')) {
            $modalid = $(this).attr('data-modalbox');
        }

        if ($(this).hasClass('getAQuoteModal')) {
            $modalid = '#getAQuoteModal';
            $($modalid).modal('show');
            return false;
        }
        if ($(this).hasClass('getPrivacyPage')) {
            $modalid = '#getPrivacyPage';
            $($modalid).modal('show');
            return false;
        }
        if ($(this).hasClass('getTermsConditionsPage')) {
            $modalid = '#getTermsConditionsPage';
            $($modalid).modal('show');
            return false;
        }
        $('.modal-content').css('border', 'none');
        $('.modal-header .close').css('display', 'none');
        $($modalid).modal('show');

        var $postid = $(this).attr('data-postid');
        var $posttype = $(this).attr('data-posttype');

        if ($posttype == "positions") {
            $('#portfolioDetModal').addClass('positions-modal');
        }

        $.ajax({
            url: cynic_ajax,
            data: {
                action: 'cynic_get_custom_content',
                postid: $postid,
                posttype: $posttype
            },
            method: 'POST',
            success: function (resp) {
                if (resp != '' && resp != '0') {
                    var $resp = $(resp),
                        $output = $resp.find("#" + $posttype + "-detail-content").html();
                    $($modalid + " .modal-body").html($output);
                    setTimeout(function () {
                        disPlayBGImage();
                        $($modalid).modal('show');
                    }, 100);
                }
                $('.modal-content').removeAttr('style');
                $('.modal-header .close').removeAttr('style');
            }
        });
    });

    //Get pages in modal
    // getPageInModal
    $document.on('click', '.getPageInModal', function (e) {
        e.preventDefault();

        var $modalid = '#portfolioDetModal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');


        var $page_slug = $(this).attr('data-slug');
        var $posttype = $(this).attr('data-posttype');
        if ($page_slug != "") {
            $.ajax({
                url: cynic_ajax,
                data: {
                    action: 'cynic_get_custom_content',
                    postid: $page_slug,
                    posttype: $posttype,
                },
                method: 'POST',
                success: function (resp) {
                    if (resp != '' && resp != '0') {
                        $($modalid + " .modal-body").html(resp);
                        $($modalid).modal('show');
                    }
                    $('.modal-content').removeAttr('style');
                    $('.modal-header .close').removeAttr('style');
                }
            });
        }
    });

    //Portfoilo details in modal
    $document.on('click', '.baseModal', function (e) {
        e.preventDefault();
        var $modalid = '#portfolioDetModal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');

        $('.modal-content').css('border', 'none');
        $('.modal-header .close').css('display', 'none');
        $($modalid).modal('show');

        var $self = $(this);
        var $postid = $(this).attr('data-id');
        var $security_nonce = $(this).attr('data-nonce');
        var $action = $(this).attr('data-action');
        alert($action);
        $self.addClass('disabled');
        $.ajax({
            url: cynic_ajax,
            data: {
                action: $action,
                security_nonce: $security_nonce,
                postid: $postid,
            },
            method: 'POST',
            success: function (resp) {
                var $html = $.parseJSON(resp);
                $(".modal-body").html($html.outputs);
                var $modalid = '#portfolioDetModal';
                $($modalid).modal('show');
                $self.removeClass('disabled');

                $('.modal-content').removeAttr('style');
                $('.modal-header .close').removeAttr('style');
            }
        });
    });

    // Open team details in modal
    $document.on('click', '.getTeamMember', function (e) {
        e.preventDefault();
        var $modalid = '#portfolioDetModal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');

        $('.modal-content').css('border', 'none');
        $('.modal-header .close').css('display', 'none');
        $($modalid).modal('show');

        var $self = $(this);
        $self.addClass('disabled');
        setTimeout(function () {

            var $data_id = $self.attr('data-id');
            var $html = $('#' + $data_id).html();

            $($modalid + " .modal-body").html($html);

            $($modalid).modal('show');
            $self.removeClass('disabled');

            $('.modal-content').removeAttr('style');
            $('.modal-header .close').removeAttr('style');

        }, 2000);
    });

    $document.on('click touchstart', '.blog-modal', function (e) {
        e.preventDefault();
        $('.blog-modal').addClass('text-loading');
        var $self = $(this);
        var $postid = $self.attr('data-post-id');
        var $catid = $self.attr('data-cat-id');
        var $security_nonce = $self.attr('data-nonce');
        var $action = $self.attr('data-action');
        var $pp = $self.attr('data-pp');
        var $pageno = $self.attr('data-page');
        var $data_attr = $self.attr('data-attr');
        $self.addClass('disabled');
        $.ajax({
            url: cynic_ajax,
            data: {
                action: $action,
                security_nonce: $security_nonce,
                postid: $postid,
                catid: $catid,
                pp: $pp,
                pageno: $pageno,
            },
            method: 'POST',
            success: function (resp) {
                var $html = $.parseJSON(resp);
                if (typeof ($html.outputs) != "undefined") {
                    $self.attr('data-page', parseInt($pageno) + 1);
                    if ($('.blog-single-2').length > 0) {
                        $self.parent().parent().parent().find('.row:first').append($html.outputs);
                    } else {
                        $self.parent().parents().eq(2).find('.row:first').append($html.outputs);
                    }
                    $self.removeClass('disabled');
                }
                var $max_length = $("." + $data_attr).find('.col-sm-4').length;
                if ($html.total == '0' || $max_length == $html.total) {
                    $self.addClass('hidden');
                }
                setTimeout(function () {
                    equalheight(".onepage-news-equalheight");
                    $('.blog-modal').removeClass('text-loading');
                }, 100);
            }
        });
    });

    /* To Display single blog in modal    
     * Author Axilweb
     * Website http://www.axilweb.com
     */

    $document.on('click touchstart', '.one-page-blog-single', function (e) {
        e.preventDefault();
        var $modalid = '#portfolioDetModal';
        var _img_src = $('.loading-img').html();
        $($modalid + " .modal-body").html('');
        $($modalid + " .modal-body").html('<div class="portfolio-loading">' + _img_src + '</div>');
        $($modalid).addClass('blogModal');

        $('.modal-content').css('border', 'none');
        $('.modal-header .close').css('display', 'none');
        $($modalid).modal('show');
        var $postid = $(this).attr('data-postid');
        var $action = $(this).attr('data-action');
        $.ajax({
            url: cynic_ajax,
            data: {
                action: $action,
                postid: $postid,
            },
            method: 'POST',
            success: function (resp) {
                var $html = $.parseJSON(resp);
                $($modalid + ' .modal-body').html($html.outputs);
                $('.modal-content').removeAttr('style');
                $('.modal-header .close').removeAttr('style');
            }
        });
    });

    // script for tab steps
    $('a[data-toggle="tab"]').on('click', function (e) {
        var href = $(this).attr('href');
        var $curr = $(this).closest('li');

        $('.process-model li').removeClass();

        $curr.addClass("active");
        $curr.prevAll().addClass("visited");
        $(href).addClass('active');
        $(href).siblings('.tab-pane').removeClass('active');
    });
    // end  script for tab steps

    $('.carousel').carousel({
        interval: 5000
    });

    //script for page scroll to top and bottom
    $document.on('click', '.page-scroll, a.tp-caption, .menu-footer-services-container li a, .page-scroll-kickass', function (e, autoClick) {
        if (this.pathname === undefined) {
            return true;
        }
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var current_url = $(location).attr('href');
            var last_part = current_url.substr(this.href.lastIndexOf('/') + 1);
            var is_preview = last_part.indexOf('customize_changeset_uuid');
            var scroll_position = $('.page-scroll-to').attr('data-scroll-to');
            if (is_preview > 0) {
                var target = $(this.hash);
                __offset = $('#top').offset().top;
                return false;
            } else if (autoClick == "autoClick" && window.location.hash.substr(1) != "") {
                var target = $('#' + window.location.hash.substr(1) + '');
                __offset = target.offset().top - 180;
            } else {
                if (autoClick == "autoClick" && last_part.indexOf('s?') != '-1') {
                    var target = $('' + last_part + '');
                } else if (autoClick == "autoClick" && last_part.indexOf('s?') == '-1') {
                    var target = $('#no-scroll');
                } else {
                    var target = $(this.hash);
                }
                if (this.hash.slice(1) != "") {
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                }
                if ($('.page-template-template-modernpage.onepage-agency').length > 0) {
                    var __offset = (target.length > 0) ? target.offset().top - 100 : 0;
                } else {
                    var __offset = (target.length > 0) ? target.offset().top : 0;
                }
                var is_sticky_header = $('body').find('.sticky-header').length;
                if (is_sticky_header > 0 && target.length > 0) {
                    var back_to_top = $(this).attr('href');
                    if (back_to_top == "#top" && autoClick != "autoClick") {
                        __offset = $('#top').offset().top;
                    } else if (autoClick == "autoClick" && last_part.indexOf("comment") > 0) {
                        __offset = $(last_part).offset().top - 150;
                    } else {
                        __offset = target.position().top + parseInt(scroll_position);
                    }
                }
            }
            if (target.length && __offset > 0) {
                $('html, body').animate({
                    scrollTop: __offset
                }, 1000);
                return false;
            }
        }
    });
    //end script for page scroll to top and bottom

    // Content Slider
    $(".content-slider").owlCarousel({
        slideSpeed: 350,
        singleItem: true,
        autoHeight: true,
        navigation: true,
        navigationText: ["<i class='icon-chevron-left'></i>", "<i class='icon-chevron-right'></i>"]
    });

    //script for parallex
    function parallaxIt() {

        // create variables
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // on window scroll event
        $fwindow.on('scroll resize', function () {
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        });

        // for each of content parallax element
        $('[data-type="content"]').each(function (index, e) {
            var $contentObj = $(this);
            var fgOffset = parseInt($contentObj.offset().top);
            var yPos;
            var speed = ($contentObj.data('speed') || 1);

            $fwindow.on('scroll resize', function () {
                yPos = fgOffset - scrollTop / speed;

                $contentObj.css('top', yPos);
            });
        });

        // for each of background parallax element
        $('[data-type="background"]').each(function () {
            var $backgroundObj = $(this);
            var bgOffset = parseInt($backgroundObj.offset().top);
            var yPos;
            var coords;
            var speed = ($backgroundObj.data('speed') || 0);

            $fwindow.on('scroll resize', function () {
                yPos = -((scrollTop - bgOffset) / speed);
                coords = '50% ' + yPos + 'px';

                $backgroundObj.css({
                    backgroundPosition: coords
                });
            });
        });

        // triggers winodw scroll for refresh
        $fwindow.trigger('scroll');
    }

    parallaxIt();
    //end script for parallex


    //script for owl carousel 
    //Clients section owl-carousel
    $(".clients .owl-carousel").owlCarousel({
        margin: 13,
        navigationText: ["<i class='icon-chevron-left'></i>", "<i class='icon-chevron-right'></i>"],
        dots: false,
        autoplay: true,
        navigation: true,
        smartSpeed: 600,
        autoplayHoverPause: true,
        loop: true,
        responsiveClass: true,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 3],
        itemsTabletSmall: false,
        itemsMobile: [479, 1]
    });

    //end script for owl carousel 

    //script for number counter
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
    //end script for number counter

    //script for full view port slider 
    $fwindow.on('resize', fullViewPort);
    fullViewPort();

    function fullViewPort() {
        if ($fwindow.width() < 992) {
            var height = $fwindow.height() - 100;
            $(".top-carousel .item, .top-carousel").height(height);
        } else {
            var height = $fwindow.height() - 154;
            $(".top-carousel .item, .top-carousel").height(height);
        }
    }
    //end script for full view port slider

    // script for category filter (portfolio page)
    $(function () {
        if (typeof $.fn.isotope != 'undefined') {

            //Add masonry to review grid
            if ($fwindow.width() > 767) {
                var $review = $('.grid').isotope({
                    // options
                    itemSelector: '.grid-item',
                    layoutMode: 'masonry',
                    percentPosition: true
                });
            }

            //Apply isope in portfolio grid
            var $grid = $('.full-portfolio .port-cat-con').isotope();
            // filter items on button click
            $('.pro-controls').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
                $(this).siblings('button').removeClass('active');
                $(this).addClass('active');
            });
        }
        $('.load-more-portfolio').on('click', function (e) {
            e.preventDefault();

            if ($(this).hasClass('disabled')) {
                return false;
            }
            $('.load-more-portfolio').addClass('text-loading');
            var $elem = $(this),
                $nonce = $elem.data('nonce'),
                $action = $elem.data('action'),
                $targetbox = $elem.data('target'),
                $perpage = $elem.data('pp'),
                $pageno = $elem.attr('data-page'),
                $order = $elem.data('order'),
                $orderby = $elem.data('orderby'),
                $category = $elem.data('cat'),
                $data_layout = $elem.data('layout'),
                $category_slug = $('.pro-controls').find('.active').data('slug');

            $elem.addClass('disabled');

            $.ajax({
                url: cynic_ajax,
                data: {
                    security_nonce: $nonce,
                    action: $action,
                    page: $pageno,
                    pp: $perpage,
                    orderby: $orderby,
                    order: $order,
                    catid: $category,
                    data_layout: $data_layout
                },
                method: 'POST',
                dataType: 'json',
                success: function (resp) {

                    var $htmloutput = '';

                    if (typeof resp.outputs != 'undefined') {

                        $htmloutput = resp.outputs.replace(/\+/g, ' ');
                        $htmloutput = decodeURIComponent($htmloutput);

                        var $isotope = $($targetbox).data('isotope');
                        if ($isotope) {
                            var $items = $($htmloutput);
                            $items.each(function () {
                                var $content = $(this);
                                $($targetbox).append($content).isotope('insert', $content);
                            });
                        } else {
                            $($targetbox).append($htmloutput);
                        }
                        $elem.attr('data-page', parseInt($pageno) + 1);
                        $('.load-more-portfolio').removeClass('text-loading');
                    }

                    if (typeof resp.total !== undefined && $($targetbox + ' > *').length >= resp.total) {
                        var $complete_element = $('.pro-controls').find('.active').addClass('complete');
                        $elem.addClass('hidden');
                        $elem.attr('data-show', 'no')
                    }

                    $elem.removeClass('disabled');
                }
            });

        });

    });
    //end  script for category filter

    //disable load more button for isotope cat 
    $document.on('click', '.filter', function (e) {
        var _slug = $(this).attr('data-filter');
        _slug = _slug.replace('.', '');
        var data_show = $('.load-more-portfolio').attr('data-show');
        if (_slug != "*") {
            $('.load-more-portfolio').prop("disabled", true);
            $('.load-more-portfolio').addClass('hidden');
        } else {
            if (data_show != "no") {
                $('.load-more-portfolio').removeClass('hidden');
                $('.load-more-portfolio').prop("disabled", false);
            }
        }

    });
    //end script for Disable load more button for isotope cat 
    var selectorIdx = 1;
    var numItems = 12;
    // handles the carousel thumbnails
    $document.on('click', '.carousel-selector', function () {
        selectorIdx = $(this).closest('li').index();
        $('#myCarousel').carousel(selectorIdx);
        $(this).closest('#myCarousel')
            .find('.carousel-selector').removeClass('selected')
            .eq(selectorIdx).addClass('selected')
            .end()
            .find('.item').removeClass('selected')
            .eq(selectorIdx).addClass('active');
    });

    $document.on('slide.bs.carousel', '#myCarousel', function (e) {
        selectorIdx = $(e.relatedTarget).index();
        $(this)
            .find('.carousel-selector').removeClass('selected')
            .eq(selectorIdx).addClass('selected')
            .end()
            .find('.item').removeClass('selected')
            .eq(selectorIdx).addClass('active');
    });
    // end protfolio modal's slider script

    //script for box equal height
    equalheight = function (t) {
        var i, topPostion,
            currentDiv, n = 0,
            e = 0,
            o = new Array;
        $(t).each(function () {
            if (i = $(this), $(i).outerHeight("auto"), topPostion = i.position().top, e != topPostion) {
                for (currentDiv = 0; currentDiv < o.length; currentDiv++)
                    o[currentDiv].outerHeight(n);
                o.length = 0, e = topPostion, n = i.outerHeight(), o.push(i);
            } else
                o.push(i), n = n < i.outerHeight() ? i.outerHeight() : n;
            for (currentDiv = 0; currentDiv < o.length; currentDiv++)
                o[currentDiv].outerHeight(n);
        });
    }, $fwindow.on('load resize', function () {
        equalheight(".equalheight");
        equalheight(".pricing-height");
        equalheight(".service-height");
        equalheight(".about-height");
        equalheight(".service-box .equalheight");
        equalheight('.onepage-news-equalheight');
    });
    //end script for box equal height   

    /* Case Study Slider Carousole & portfolio*/
    disPlayBGImage();

    function disPlayBGImage() {
        if ($('[data-bg-img]').length > 0) {
            $('[data-bg-img]').each(function () {
                var $bg = $(this).data('bg-img');
                $(this).css('background-image', 'url(' + $bg + ')');
            });
        }
    }

    //Validation script for commnets
    var $is_commentform = $('#commentform').length;
    if ($is_commentform > 0) {
        $('#commentform').validate({
            rules: {
                author: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                comment: {
                    required: true
                }
            },
            messages: {
                author: "Enter your name.",
                email: "Enter valid email address.",
                comment: "Enter your comment."
            },
            errorElement: "div",
            errorPlacement: function (error, element) {
                element.after(error);
            }

        });
    }

    /*accordion*/
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('icon-plus icon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    //fixed header
    var lastScrollTop = 0;
    $fwindow.on('scroll', function () {
        var currentScrollPosition = $fwindow.scrollTop();
        if (currentScrollPosition < 500) {
            $(".sticky-header").removeClass('show-header').addClass("hide-header");
        }
        if (currentScrollPosition < 600) {
            $(".sticky-header").removeClass('hide-header').removeClass("show-header");
        }
        if (currentScrollPosition > lastScrollTop && currentScrollPosition > 100) {
            $(".sticky-header").addClass("hide-header").removeClass('show-header');
        }
        if (currentScrollPosition > lastScrollTop && currentScrollPosition > 400) {
            $(".sticky-header").addClass('show-header').removeClass("hide-header");
        }
        lastScrollTop = currentScrollPosition;

    });

})(jQuery);