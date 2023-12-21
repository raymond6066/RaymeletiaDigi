"use strict";
! function () {
    for (var e, t = function () {}, i = ["assert", "clear", "count", "debug", "dir", "dirxml", "error", "exception", "group", "groupCollapsed", "groupEnd", "info", "log", "markTimeline", "profile", "profileEnd", "table", "time", "timeEnd", "timeline", "timelineEnd", "timeStamp", "trace", "warn"], s = i.length, a = window.console = window.console || {}; s--;) a[e = i[s]] || (a[e] = t)
}(),
function (s) {
    s.fn.equalHeight = function (e) {
        var t = 0,
            i = {
                selector: s(".equalHeight")
            };
        return e = s.extend(i, e), s(this).each(function () {
            s(this).find(i.selector).each(function () {
                s(this).height() > t && (t = s(this).height())
            }), s(this).find(i.selector).height(t)
        }), this
    }, s.fn.equalWidth = function (e) {
        var t = 0,
            i = {
                selector: s(".equalWidth")
            };
        return e = s.extend(i, e), s(this).each(function () {
            s(this).find(i.selector).each(function () {
                s(this).width() > t && (t = s(this).width())
            }), s(this).find(i.selector).width(t)
        }), this
    }, 767 < s(window).width() && s(".equalHeightWrapper").equalHeight({
        selector: s(".equalHeight")
    })
}(jQuery), jQuery(function (i, e, r) {
    var t = r(e),
        l = r(i),
        s = r(".navbar-collapse"),
        a = r(".navbar-toggler");
    r(function () {
        var e = r(".dynamic-nav"),
            t = i.location.href.substr(i.location.href.lastIndexOf("/") + 1);
        e.each(function () {
            r(this).find("li a").each(function () {
                r(this).attr("href") != t && "" != r(this).attr("href") || (r(this).addClass("active"), r(this).parents("li").hasClass("has-dropdown") && r(this).parents(".has-dropdown").find(">a").addClass("active"))
            })
        })
    });
    r('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle="tab"]').not('[data-toggle="pill"]').on("click", function (e) {
        var t = 0,
            i = 0;
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var s, a = r(this.hash),
                o = a[0].hasAttribute("data-scroll-offset") ? a.data("scroll-offset") : t,
                n = a[0].hasAttribute("data-scroll-offset-mobile") ? a.data("scroll-offset-mobile") : i;
            s = l.width() < 768 ? n : o, (a = a.length ? a : r("[name=" + this.hash.slice(1) + "]")).length && (e.preventDefault(), r("html, body").animate({
                scrollTop: a.offset().top - s
            }, 800, "easeInOutExpo"))
        }
    }), t.on("click", ".navbar .navbar-toggler", function () {
        r(this).toggleClass("change")
    }), t.on("click", function (e) {
        s.hasClass("show") && !r(".navbar-nav, .navbar-nav *").is(e.target) && (console.log(e.target), s.removeClass("show"), a.removeClass("change"))
    }), l.width() < 992 && t.on("click", ".has-dropdown > a", function () {
        r(this).siblings(".submenu").slideToggle("300")
    }), r(".video-popup").magnificPopup({
        type: "iframe",
        mainClass: "mfp-with-zoom",
        iframe: {
            markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe></div>',
            patterns: {
                youtube: {
                    index: "youtube.com/",
                    id: "v=",
                    src: "//www.youtube.com/embed/%id%?autoplay=1"
                }
            },
            srcAction: "iframe_src"
        }
    }), r(".counter").counterUp({}), r(".quote-form").on("submit", function (e) {
        e.preventDefault();
        var t = r(this),
            i = r(this).serialize();
        t.closest("input, textarea");
        t.closest("div").find("input,textarea").removeAttr("style"), t.find(".err-msg").remove(), t.find(".form-success").removeClass("form-success"), r(".submit-loading-img").css("display", "block"), t.closest("div").find('button[type="submit"]').attr("disabled", "disabled"), r.ajax({
            url: "assets/email/email.php",
            type: "post",
            dataType: "json",
            data: i,
            success: function (e) {
                r(".submit-loading-img").css("display", "none"), t.closest("div").find('button[type="submit"]').removeAttr("disabled"), 0 == e.code ? (t.closest("div").find('[name="' + e.field + '"]').addClass("form-success"), t.closest("div").find('[name="' + e.field + '"]').after('<div class="err-msg">*' + e.err + "</div>")) : (t.find("textarea").after('<div class="success-msg">' + e.success + "</div>"), t[0].reset(), t.find(".success-msg").css({
                    display: "block"
                }), setTimeout(function () {
                    r(".success-msg").fadeOut("slow")
                }, 5e3))
            }
        })
    }), l.on("load resize", function () {
        r(".projects-carousel.owl-carousel").owlCarousel({
            margin: 0,
            nav: !0,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1025: {
                    items: 3
                },
                1199: {
                    items: 5
                }
            }
        }), r(".clients-carousel-wrapper.owl-carousel").owlCarousel({
            margin: 0,
            loop: !0,
            nav: !0,
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1199: {
                    items: 5
                }
            }
        });
        var t = r(".iso-grid").isotope({
            itemSelector: ".item",
            percentPosition: !0
        });
        r(".btn-filter-wrap").on("click", ".btn-filter", function () {
            var e = r(this).attr("data-filter");
            t.isotope({
                filter: e
            })
        }), r(".btn-filter-wrap").each(function (e, t) {
            var i = r(t);
            i.on("click", "button", function () {
                i.find(".is-checked").removeClass("is-checked"), r(this).addClass("is-checked")
            })
        })
    });
    var o = 0;
    r(".equalHeightWrapper").each(function () {
        r(this).find(".equalHeight").each(function () {
            r(this).height() > o && (o = r(this).height())
        }), r(this).find(".equalHeight").height(o)
    });
    var n = r(".page-header");
    l.on("scroll load", function () {
        100 <= l.scrollTop() ? n.addClass("scrolled") : n.removeClass("scrolled")
    })
}(window, document, jQuery));
//# sourceMappingURL=../maps/main.min.js.map