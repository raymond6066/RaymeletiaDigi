jQuery(function ($) {

    // Toggle between image and video in portfolio custom post
    var $portfolio_type = $("input[name='portfolio_type']:checked").val();
    if ($portfolio_type == '0') {
        $('#cynic_portfolio').css('display', 'block');
        $('#cynic_video_information').css('display', 'none');
    } else {
        $('#cynic_portfolio').css('display', 'none');
        $('#cynic_video_information').css('display', 'block');
    }
    $("input[name='portfolio_type']").on('click', function (e) {
        var $portfolio_type = $(this).val();
        if ($portfolio_type == '0') {
            $('#cynic_portfolio').css('display', 'block');
            $('#cynic_video_information').css('display', 'none');
        } else {
            $('#cynic_portfolio').css('display', 'none');
            $('#cynic_video_information').css('display', 'block');
        }
    });


    // Toggle between fonts in case studies
    $(document).on('change', '#cynic_case_studies_solution_icon_type', function (e) {
        e.preventDefault();
        caseStudiesPostsEntry('#cynic_case_studies_solution');
    })

    $(document).on('change', '#cynic_case_studies_challenges_icon_type', function (e) {
        e.preventDefault();
        caseStudiesPostsEntry('#cynic_case_studies_challenges');
    })

    caseStudiesPostsEntry('#cynic_case_studies_solution');
    caseStudiesPostsEntry('#cynic_case_studies_challenges');

    function caseStudiesPostsEntry(selector) {
        if ($(selector).length == 1) {
            $caseStudies_challengeIconType = $(selector).find(selector + '_icon_type').val();
            if ($caseStudies_challengeIconType == 'default_icon') {
                $(selector).find('.cynicIconsPicker').parents('.rwmb-text-wrapper').addClass('hidden');
            } else {
                $(selector).find('.cynicIconsPicker').parents('.rwmb-text-wrapper').removeClass('hidden');
            }
        }
    }

    /**
     * Video uploader for VC
     */

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


    // Show hide meta box value for page settings

    var $display_header = $("input[name='cynic_page_display_header']:checked").val();
    if ($display_header == 2) {
        $('.cynic_page_header_colors').css('display', 'none');
        $('.cynic_page_title').css('display', 'none');
        $('.cynic_page_headingtext').css('display', 'none');
    } else {
        $('.cynic_page_header_colors').css('display', 'block');
        $('.cynic_page_title').css('display', 'block');
        $('.cynic_page_headingtext').css('display', 'block');
    }
    $("input[name='cynic_page_display_header']").on('click', function (e) {
        var $display_header = $(this).val();
        if ($display_header == 2) {
            $('.cynic_page_header_colors').css('display', 'none');
            $('.cynic_page_title').css('display', 'none');
            $('.cynic_page_headingtext').css('display', 'none');
        } else {
            $('.cynic_page_header_colors').css('display', 'block');
            $('.cynic_page_title').css('display', 'block');
            $('.cynic_page_headingtext').css('display', 'block');
        }
    });


}(jQuery));
/*ready*/