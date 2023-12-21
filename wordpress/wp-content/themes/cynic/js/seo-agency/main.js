jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";

    //varialbles
    var _document, _window, _html, _body;
    _document = $(document);
    _window = $(window);
    _html = $('html');
    _body = $('body');

    //window load funtion
    _window.on("load resize", function () {

        if ($('.measure-performance-banner').length > 0 && _window.width() > 1600) {
            _body.addClass('p-0');
        }

        //banner-carousel initialization
        var _bannerCarousel = $('.banner-carousel');
        _bannerCarousel.carousel({
            interval: 5000
        })

        //banner-carousel animation on-load and on-slide
        _bannerCarousel.find('.carousel-item').addClass('active-anim');

        _bannerCarousel.on('slide.bs.carousel', function () {
            $(this).find('.active').removeClass('active-anim');
            $(this).find('.carousel-item:not(.active)').addClass('active-anim');
        })


        // isotope initialization
        var $grid = $('.grid').imagesLoaded(function () {
            $grid.isotope({
                // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    // use element for option
                    columnWidth: '.grid-sizer'
                }
            });

            // filter items on button click
            $('.filter-button-group').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            $('.button-group').each(function (i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'button', function () {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $(this).addClass('is-checked');
                });
            });
        });



        //script for box equal height
        var maxHeight = 0;
        var _equalHeight = function (eq) {
            $(eq).each(function () {
                $(this).find('.equalHeight').each(function () {
                    if ($(this).height() > maxHeight) {
                        maxHeight = $(this).height();
                    }
                });
                $(this).find('.equalHeight').height(maxHeight);
            });
        }
        _equalHeight('.equalHeightWrapper');

    });


    //End of window.load function

    //fullscreen menu
    var _fullNav = $(".fullscreen-menu");
    _document.on('click', '.mm-toggler', function (e) {
        _fullNav.addClass("show-menu");
        _html.css("overflow", "hidden");
    });
    _document.on('click', '.close-menu', function (e) {
        _fullNav.removeClass("show-menu");
        _html.css("overflow", "auto");
    });

    //script for page scroll to top and bottom
    _document.on('click', '.page-scroll , .go-to-top', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 1000, 'easeInOutExpo');

                return false;
            }
        }
    });
    //end script for page scroll to top and bottom

    //Scroll to bottom for mailchimp
    if ($('.page-footer .mc4wp-alert').length > 0) {
        $('html, body').animate({
            scrollTop: $("#footer-scroll").offset().top
        }, 1000, 'easeInOutExpo');
    }

    //animated nav button
    $(".navbar").on('click', '.navbar-toggler-right', function () {
        $(this).toggleClass("change");
    });

    //Closing menu after clicking on mobile
    var _exceptions = $('.navbar .nav-item');
    _document.on('click', function (e) {
        if (!_exceptions.is(e.target) && _exceptions.has(e.target).length === 0) {
            if (_window.width() < 992) {
                $('.navbar-collapse').removeClass('show');
            }
            $('.sub-menu').removeAttr('style');
            $('.navbar-nav .nav-item').removeClass('open-nav');
        }
    });

    var _serviceNav = $('.cynic-open-on-click');


    _serviceNav.on('click', '.navbar-nav .menu-item-has-children:not(.open-nav) .nav-link', function () {
        if (_window.width() > 991) {
            $('.nav-item').removeClass('open-nav');
            $('.sub-menu').removeAttr('style');
        }
    });

    _serviceNav.on('click', '.navbar-nav .menu-item-has-children > a', function (e) {
        e.preventDefault();
        $(this).parent('.menu-item-has-children').toggleClass('open-nav');
        $(this).next('.sub-menu').slideToggle();
    });

    if (_window.width() < 991) {
        $('.service-nav').not('.cynic-open-on-click').on('click', '.navbar-nav .menu-item-has-children > a', function () {
            $(this).parent('.menu-item-has-children').toggleClass('open-nav');
            $(this).next('.sub-menu').slideToggle();
        });

        //adding dropdown arrow in nav-menu in for mobile devices
        $('.unit-mode .service-nav .sub-menu').prev('.nav-link').after('<span class="fa fa-caret-down"></span>');

        //toggle dropdown menu
        var _dropdownToggler = $('.unit-mode .navbar');
        _dropdownToggler.on('click', 'ul li span', function () {
            $(this).next('.sub-menu').slideToggle('fast');
        });
    }

    //Script for magnific pop up 
    $('.magnify').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

    //Counter up js
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    //floating body on footer
    if (_window.width() > 767) {
        _window.on("load resize", function () {
            var footerHeight = $('.page-footer').height();
            $('body').css('margin-bottom', footerHeight);

            var _comp = $('.components .nav').height();
            $('.components .nav').css('margin-top', -_comp / 2);

            var mapNav = $('.location-map .tab-container.type-1 .nav-tabs').height();
            $(".location-map .tab-container.type-1 .nav-tabs").css('top', -mapNav / 2);
        }).trigger("resize");
    }

    //Bootstrap Carousel
    $('.carousel').carousel({
        interval: 2000
    })

    //Custom file input 
    var _a = $(".fileinputgroup");
    _a.on('change', '.form-control-file', function (e) {
        e.preventDefault();
        var parentSelector = $(this).parent().next('.fileLabel');
        parentSelector.text($(this)[0].files[0].name).addClass('success-upload');
    });

    //Toggleable dropdown menu

    $('.fullscreen-menu .dropdown-toggle').on('click', function (e) {
        e.preventDefault();
        $(this).next('.dropdown-menu').slideToggle('1000');
    });

    //Trigger counter in button click
    var _navTab = $('.featured-projects');
    _navTab.on('click', '.nav-link', function () {
        var selector_id = $(this).attr('href');
        $(selector_id).find('.counter').counterUp();
    });

    // Call Gridder

    if ($('ul').hasClass('gridder')) {
        $(".gridder").gridderExpander({
            scrollOffset: parseInt($('.header-wrapper').height() + $('.gridder-list').height() + 40),
            scrollTo: "panel", // "panel" or "listitem"
            animationSpeed: 400,
            animationEasing: "easeInOutExpo",
            onStart: function () {},
            onContent: function () {},
            onClosed: function () {}

        });
    }

    $('.form-footer').after('');

    $("input").on('focus', function () {
        $('.msg').fadeOut();
    });

    //Go to top button
    _window.on('scroll', function () {
        if (_window.scrollTop() >= 200) {
            $('.go-to-top').addClass('show');
        } else {
            $('.go-to-top').removeClass('show');
        }
    });

    /* Start Replace background url for banner to display images */

    $('[data-bg]').each(function () {
        var $bg = $(this).data('bg');
        $(this).css({
            backgroundImage: 'url(' + $bg + ')'
        });
    });

    $('[data-bgcolor]').each(function () {
        var $bgc = $(this).data('bgcolor');
        $(this).css({
            backgroundColor: $bgc
        });
    });

    $('[data-color]').each(function () {
        var $color = $(this).data('color');
        $(this).css({
            color: $color
        });
    });

    $('[data-font-size]').each(function () {
        var $fontsize = $(this).data('font-size');
        $(this).css({
            'font-size': $fontsize
        });
    });
    /* End */

    _document.on('click', '.wpcf7-checkbox label', function (e) {
        e.preventDefault();
        if ($(this).hasClass("checkd-box-field")) {
            $(this).removeClass("checkd-box-field");
            $(this).find('input').removeAttr('checked');
        } else {
            $(this).addClass('checkd-box-field');
            $(this).find('input').attr('checked', true);
        }
    });

    //Reset checkbbox for contact form 7
    document.addEventListener('wpcf7mailsent', function (event) {
        var Response = event.detail.apiResponse;
        var form_id = Response.into;
        $(Response.into).find(".checkd-box-field input").removeAttr("checked");
        $(Response.into).find(".checkd-box-field").removeClass("checkd-box-field");
        var parentSelector = $(form_id).find('.fileinputgroup .fileLabel').removeClass("success-upload").text('Choose File')
    }, false);

    $(window).load(function () {
        $(".loader_wrapper").fadeOut("slow");
    })

    _body.has('.rev_slider').addClass('no-top-padding');

    $(".menu-item.active").parents(".menu-item-has-children").addClass('current-menu-ancestor')

}(jQuery));
/*ready*/