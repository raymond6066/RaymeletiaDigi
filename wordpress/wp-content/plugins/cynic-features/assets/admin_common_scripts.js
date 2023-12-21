jQuery(function ($) {
    "use strict";
    // Set all variables to be used in scope

    var theme_layout_updated_form = $("#cynic_feature_theme_layout_update_form")
    $(document).on('click', '#cynic_feature_theme_layout_update_form .cynic_theme_type_item .theme_type_selectorbtn', function (e) {
        e.preventDefault()

        var theme_layout_type = $(this).data('theme-type');
        var theme_layout_category = $(this).data('category');

        if (theme_layout_category == '' || typeof theme_layout_category === "undefined") {
            alert('Please refrash the page and select again.');
            return false;
        }

        var fd = new FormData();
        fd.append("action", 'cynic_feature_theme_layout_type_update');
        fd.append("cynic_theme_type", theme_layout_type);
        fd.append("theme_layout_category", theme_layout_category);

        $.ajax({
            url: ajaxurl,
            dataType: "json",
            method: 'post',
            processData: false,
            contentType: false,
            data: fd,
            success: function (data) {
                console.log(data);
                if (data.result) {
                    window.location.href = data.href;
                    // _this.find('.submit').html(data.html)
                } else {
                    alert("Please refrash the page and try again.")
                }
            },
            error: function (errorThrown) {
            }
        });

    })

    var cynic_feature_theme_type_tab_commonTab = $('.ocdi__gl-header.js-ocdi-gl-header nav li'),
        cynic_feature_theme_type_tab_tabPane = $('.ocdi__gl-item')
    $(window).on('load', function () {
        var loc = window.location.href;
        console.log("Test", loc);
        if (/digitalagency/.test(loc)) {
            cynic_feature_theme_type_tab_commonTab.removeClass('active');
            cynic_feature_theme_type_tab_tabPane.css('display', 'none');
            $('.ocdi__gl-header.js-ocdi-gl-header nav li a[href^="#digitalagency"]').parent().addClass('active');
            // $('.ocdi__gl-header.js-ocdi-gl-header nav li a:not([href^="#modernagencies"])').css('display', 'none');
            $('.ocdi__gl-item[data-categories*="digitalagency"]').css('display', 'block');
            // _anim();
        } else if (/seoagency/.test(loc)) {
            cynic_feature_theme_type_tab_commonTab.removeClass('active');
            cynic_feature_theme_type_tab_tabPane.css('display', 'none');
            $('.ocdi__gl-header.js-ocdi-gl-header nav li a[href^="#seoagency"]').parent().addClass('active');
            // $('.ocdi__gl-header.js-ocdi-gl-header nav li a:not([href^="#seoagencies"])').css('display', 'none');
            $('.ocdi__gl-item[data-categories*="seoagency"]').css('display', 'block');
        } else if (/trendyagency/.test(loc)) {
            cynic_feature_theme_type_tab_commonTab.removeClass('active');
            cynic_feature_theme_type_tab_tabPane.css('display', 'none');
            $('.ocdi__gl-header.js-ocdi-gl-header nav li a[href^="#trendyagency"]').parent().addClass('active');
            // $('.ocdi__gl-header.js-ocdi-gl-header nav li a:not([href^="#seoagencies"])').css('display', 'none');
            $('.ocdi__gl-item[data-categories*="trendyagency"]').css('display', 'block');
        } else if (/illustration/.test(loc)) {
            cynic_feature_theme_type_tab_commonTab.removeClass('active');
            cynic_feature_theme_type_tab_tabPane.css('display', 'none');
            $('.ocdi__gl-header.js-ocdi-gl-header nav li a[href^="#illustration"]').parent().addClass('active');
            // $('.ocdi__gl-header.js-ocdi-gl-header nav li a:not([href^="#seoagencies"])').css('display', 'none');
            $('.ocdi__gl-item[data-categories*="illustration"]').css('display', 'block');
        }
    });
});


