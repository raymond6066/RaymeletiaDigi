jQuery(
  (function ($) {
    /*-- Strict mode enabled --*/
    ("use strict");
    var _document = $(document),
      _window = $(window),
      _html = $("html"),
      _body = $("body"),
      _navbarCollapse = $(".navbar-collapse"),
      _customDropdownMenu = $(".custom-dropdown-menu");

    //animated navbar-toggler button
    _document.on("click", ".navbar .navbar-toggler", function () {
      $(this).toggleClass("change");
    });

    //Close menu when clicked menu-items or outside
    $(".onepage-navbar .navbar-nav li a").on("click", function () {
      _navbarCollapse.removeClass("show");
      $(".navbar-toggler").removeClass("change");
    });

    _document.on("click", function (e) {
      var _navMenu = $(".navbar-nav li");
      if (!_navMenu.is(e.target) && !_navMenu.find("li,a").is(e.target)) {
        if (_navbarCollapse.hasClass("show")) {
          _navbarCollapse.removeClass("show");
          $(".navbar-toggler").removeClass("change");
        }
        _customDropdownMenu.fadeOut("fast");
      }
    });

    //Toggle dropdown menu on click events
    _document.on("click", ".dropdown-opener", function (e) {
      e.preventDefault();
      if (_window.width() < 991) {
        $(this).next(_customDropdownMenu).slideToggle("fast");
      } else {
        if (!$(".sub-menu li a").is(e.target)) {
          _customDropdownMenu.fadeOut("fast");
        }
        $(this).next(_customDropdownMenu).fadeToggle("fast");
      }
    });

    //affixed nav with scrollspy
    $("body").scrollspy({
      target: ".onepage-navbar",
      offset: 100,
    });

    //Tab nav
    var _navLink = $(".service-process-tab");
    _navLink.on("click", '.nav-item a[data-toggle="tab"]', function () {
      var _curr = $(this).closest("li");

      _curr.prevAll().addClass("visited");
      _curr.removeClass("visited");
      _curr.nextAll().removeClass("visited");
    });

    //script for page scroll to top and bottom
    $(".page-scroll").on("click", function () {
      if (
        location.pathname.replace(/^\//, "") ==
          this.pathname.replace(/^\//, "") &&
        location.hostname == this.hostname
      ) {
        var target = $(this.hash);
        target = target.length
          ? target
          : $("[name=" + this.hash.slice(1) + "]");
        if (target.length) {
          if (_window.width() < 768) {
            $("html, body").animate(
              {
                scrollTop: target.offset().top - 80,
              },
              1000,
              "easeInOutExpo"
            );
          } else {
            $("html, body").animate(
              {
                scrollTop: target.offset().top - 90,
              },
              1000,
              "easeInOutExpo"
            );
          }
          return false;
        }
      }
    });

    //Counter Up js
    $(".counter").counterUp({
      delay: 10,
      time: 2000,
      triggerOnce:true,
    });

    // Team & Latest Blog slider
    $(".common-slider .carousel-container").slick({
      dots: true,
      infinite: true,
      speed: 200,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });

    $(".case-study-slider").slick({
      dots: true,
      infinite: true,
      speed: 200,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });

    $(".content-slider").slick({
      dots: true,
      infinite: true,
      speed: 1000,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });

    var equalheight = function (container) {
      var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
      $(container).each(function () {
        $el = $(this);
        $($el).height("auto");
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {
          for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
          }
          rowDivs.length = 0; // empty the array
          currentRowStart = topPostion;
          currentTallest = $el.height();
          rowDivs.push($el);
        } else {
          rowDivs.push($el);
          currentTallest =
            currentTallest < $el.height() ? $el.height() : currentTallest;
        }
        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }
      });
    };

    _window.on("load resize", function () {
      equalheight(".service-box");
      equalheight(".equalHeight");
    });

    //Change navbar style on scroll
    _window.on("scroll", function () {
      if (_window.scrollTop() >= 100) {
        $(".sticky-menu").addClass("scrolled");
      } else {
        $(".sticky-menu").removeClass("scrolled");
      }
    });

    //show/hide map
    var _contactWrapper = $(".contact-wrapper"),
      _txt =
        'VIEW MAP <i class="ml-symone-2-arrow-left-right-up-down-increase-decrease"></i>',
      _alterTxt =
        '<i class="ml-symone-1-arrow-left-right-up-down-increase-decrease"></i> CONTACT US';

    $.fn.extend({
      toggleText: function (a, b) {
        return this.html(this.html() === b ? a : b);
      },
    });

    _document.on("click", ".contact-wrapper .view-map-btn", function (e) {
      e.preventDefault();
      _contactWrapper.toggleClass("show-map");
      $(this).toggleText(_txt, _alterTxt);
    });

    //Service process tab
    var _serviceProcessTab = $(".service-process-tab");
    _serviceProcessTab.on("click", ".text-only-btn", function (e) {
      e.preventDefault();
      if (
        _serviceProcessTab
          .find(".nav-item:last-child .nav-link")
          .hasClass("active")
      ) {
        _serviceProcessTab
          .find(".nav-item:first-child .nav-link")
          .trigger("click");
      } else {
        _serviceProcessTab
          .find(".nav-link.active")
          .parent()
          .next(".nav-item")
          .find(".nav-link")
          .trigger("click");
      }
    });

    //Disable load more button for isotope cat
    _document.on("click", ".filter-button", function (e) {
      var _slug = $(this).data("filter"),
        _has_load_more = $(".load-more").length;
      _slug = _slug.replace(".", "");
      if (_slug != "*" && _has_load_more > 0) {
        $(".load-more").prop("disabled", true);
        $(".load-more").addClass("d-none");
      } else {
        if (_has_load_more > 0) {
          $(".load-more").removeClass("d-none");
          $(".load-more").prop("disabled", false);
        }
      }
    });

    if (_window.width() < 992) {
      var _mapLocAltTxt,
        _mapLocAlt = $(".map-loc-alt"),
        _locNavTab = $(".location-tab-nav"),
        _firstLocNavTabText = $(
          ".location-tab-nav li:nth-of-type(1) a .map-loc"
        ).text();
      _mapLocAlt.text(_firstLocNavTabText);

      _locNavTab.on("click", "li a", function () {
        _mapLocAltTxt = $(this).find(".map-loc").text();
        _mapLocAlt.text(_mapLocAltTxt);
      });
    }
  })(jQuery)
);
