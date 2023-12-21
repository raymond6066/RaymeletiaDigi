jQuery(function ($) {

    /*-- Strict mode enabled --*/
    "use strict";

    //Show hide video length field for other post format
    var radioButtonVal = $('#post-formats-select input[type="radio"]:checked').val();
    showHideRadioButton(radioButtonVal);
    $('#post-formats-select input[type="radio"]').click(function () {
        radioButtonVal = $(this).val();
        showHideRadioButton(radioButtonVal);
    });

    function showHideRadioButton(radioButtonVal) {
        if (radioButtonVal == "video") {
            $('#cynic_post_image_video_length').parent().parent().css('display', 'block');
        } else {
            $('#cynic_post_image_video_length').parent().parent().css('display', 'none');
        }
    }

    //End

    //Show hide portfolio type
    var isPortfolio = $('input[name=portfolio_type]:checked').val();
    showHidePortfolio(isPortfolio);
    $('input[name=portfolio_type]').click(function () {
        isPortfolio = $(this).val();
        showHidePortfolio(isPortfolio);
    });

    function showHidePortfolio(radioButtonVal) {
        if (radioButtonVal == 0) {
            $('#cynic_portfolio_banner').css('display', 'block');
            $('#cynic_portfolio_video').css('display', 'none');
        } else {
            $('#cynic_portfolio_banner').css('display', 'none');
            $('#cynic_portfolio_video').css('display', 'block');
        }
    }

    //End

    var cynic_add_media_uploaderbtn;
    $(document).on("click", '.cynic_media_upload_btn785', function (e) {
        e.preventDefault();
        var This = $(this);
        var targetSelector = This.data('target');

        if (cynic_add_media_uploaderbtn) {
            cynic_add_media_uploaderbtn.open();
            return;
        }
        cynic_add_media_uploaderbtn = wp.media.frames.file_frame = wp.media({
            title: 'Upload Video',
            button: {
                text: 'Insert Video'
            },
            multiple: false,
            library: {type: 'video'}
        });
        cynic_add_media_uploaderbtn.on('select', function () {
            var attachment = cynic_add_media_uploaderbtn.state().get('selection').first().toJSON();
            var videourl = attachment.url;
            $('.' + targetSelector).val(videourl);
        });
        cynic_add_media_uploaderbtn.open();
    });

    // Cynic Global Uploader
    var cynic_wp_add_media_upload;
    $(document).on("click", '.cynic_global_uploader_btn786', function (e) {
        e.preventDefault();

        // Setting values
        var DefaultOPtion = {
            "title": "Media Upload",
            "button_text": "Insert",
            "library_type": "image",
            "multiple": false,
            "parent_selector": '.form-field',
            'show_media': false,
            'show_selector': '',
            'show_attr': '',
            'param_selector': ''
        };
        var settings = $(this).data('settings');
        var option = {}
        $.extend(option, DefaultOPtion, settings);

        var This_parent = $(this).closest(option.parent_selector);

        if (cynic_wp_add_media_upload) {
            cynic_wp_add_media_upload.open();
            return;
        }

        cynic_wp_add_media_upload = wp.media.frames.file_frame = wp.media({
            title: option.title,
            button: {
                text: option.button_text
            },
            multiple: option.multiple,
            library: {type: option.library_type}
        });

        cynic_wp_add_media_upload.on('select', function () {
            var attachment = cynic_wp_add_media_upload.state().get('selection').first().toJSON();
            if (option.show_media && option.show_selector && option.show_attr) {
                This_parent.find(option.show_selector).attr(option.show_attr, attachment.url);
            }
            if (option.param_selector) {
                This_parent.find(option.param_selector).val(attachment.id)
            }
        });
        cynic_wp_add_media_upload.open();
    });


    // Showhide Case Studies fields
    function showHideCaseStudiesCounter(_this) {
        var IconType = _this.val();
        if (IconType == 'font_icons') {
            _this.parents('.rwmb-group-clone').find('.cynic_case_studies_counter_font_icons').closest('.rwmb-field').css('display', 'block');
            _this.parents('.rwmb-group-clone').find('.cynic_case_studies_counter_image_icon').closest('.rwmb-field').css('display', 'none');
        } else {
            _this.parents('.rwmb-group-clone').find('.cynic_case_studies_counter_font_icons').closest('.rwmb-field').css('display', 'none');
            _this.parents('.rwmb-group-clone').find('.cynic_case_studies_counter_image_icon').closest('.rwmb-field').css('display', 'block');
        }

    }

    $(document).on('change', '.cynic_case_studies_counter_icon_type', function () {
        showHideCaseStudiesCounter($(this));
    })
    $.each($('.cynic_case_studies_counter_icon_type'), function (key, value) {
        showHideCaseStudiesCounter($(this));
    });



    // Cynic Gallery widgets
    var cynic_gallery_widget_media_uploader;
    $(document).on("click", '.cynic_widget_add_gallery_uploader, .cynic_widget_edit_gallery_uploader', function (e) {
        e.preventDefault();
        var This = $(this);
        var targetSelector = This.data('target');
        var param_selector = This.data('parent')
        var This_parent = $(this).closest('.'+param_selector);

        cynic_gallery_widget_media_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Upload Images',
            priority:   40,
            toolbar:    'main-gallery',
            multiple:   'add',
            editable:   true,
            library: {type: 'image'},
            filterable: 'uploaded',
        }).on('open',function() {
            var selection = cynic_gallery_widget_media_uploader.state().get('selection');
            var imageids = This_parent.find('.'+targetSelector).val();
            var imageidsArr = imageids.split(',');
            if(imageidsArr.length > 0){
                imageidsArr.forEach(function(id) {
                var attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );
            });
            }
        }).on('select', function () {
            var imagesObjects = cynic_gallery_widget_media_uploader.state().get('selection').toJSON();
            var ids = new Array();
            var imagehtml = '';
            if(imagesObjects.length > 0){
                $.each(imagesObjects, function( index, value ) {
                    if(value.url){
                    imagehtml +="<dl class=\"ss gallery-item\">";
                    imagehtml +="<dt class=\"gallery-icon\">";
                    imagehtml +="<img src='"+value.url+"'" + " />";
                    imagehtml +="</dl>";
                    imagehtml +="</dl>";
                    ids.push(value.id)
                    }
                });
                This.addClass('hidden');
                This_parent.find('.cynic_widget_edit_gallery_uploader').removeClass('hidden');
            }
            This_parent.find('.media-widget-preview').html(imagehtml);
            ids = ids.join(',');
            This_parent.find('.'+targetSelector).val(ids);
            This_parent.find('.widefat').trigger('change');
        });
        cynic_gallery_widget_media_uploader.open();
    });


    // Cynic Global Uploader
    var cynic_wp_add_media_upload;
    $(document).on("click", '.cynic_global_uploader_btn786', function (e) {
        e.preventDefault();

        // Setting values
        var DefaultOPtion = {
            "title": "Media Upload",
            "button_text": "Insert",
            "library_type": "image",
            "multiple": false,
            "parent_selector": '.form-field',
            'show_media': false,
            'show_selector': '',
            'show_attr': '',
            'param_selector': ''
        };
        var settings = $(this).data('settings');
        var option = {}
        $.extend(option, DefaultOPtion, settings);

        var This_parent = $(this).closest(option.parent_selector);

        if (cynic_wp_add_media_upload) {
            cynic_wp_add_media_upload.open();
            return;
        }

        cynic_wp_add_media_upload = wp.media.frames.file_frame = wp.media({
            title: option.title,
            button: {
                text: option.button_text
            },
            multiple: option.multiple,
            library: {type: option.library_type}
        });

        cynic_wp_add_media_upload.on('select', function () {
            var attachment = cynic_wp_add_media_upload.state().get('selection').first().toJSON();
            if (option.show_media && option.show_selector && option.show_attr) {
                This_parent.find(option.show_selector).attr(option.show_attr, attachment.url);
            }
            if (option.param_selector) {
                This_parent.find(option.param_selector).val(attachment.id)
            }
        });
        cynic_wp_add_media_upload.open();
    });

}(jQuery));
/*ready*/