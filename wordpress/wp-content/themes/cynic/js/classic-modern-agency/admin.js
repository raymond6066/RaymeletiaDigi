jQuery(function ($) {
    "use strict";
    // Set all variables to be used in scope
    var frame,
            addImgLink = $('.stylessalon_attachment_url');

    // ADD IMAGE LINK
    addImgLink.on('click', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: stylessalon_admin.media_title,
            button: {
                text: stylessalon_admin.media_button_title
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            $(this).val(attachment.url);
            // Send the attachment URL to our custom image input field.

        });

        // Finally, open the modal on click
        frame.open();
    });
    
    // icon autocomplete
    function rkb_return_matched_icons($rkbsearch) {
        var $rkbwrd = new RegExp($rkbsearch);
        var $rkbfounds = [];
        jQuery.each($linearicons, function (k, v) {
            if (v.match($rkbwrd)) {
                $rkbfounds[$rkbfounds.length] = v;
            }
        });
        return $rkbfounds;
    }
    $('.edit-menu-item-icon').each(function () {
        if ($(this).val()) {
            var theValue = $(this).val();
            $(this).siblings('.icon_autocomplete_holder').append('<span class="clearicon ' + theValue + '"></span>');
        }
    });

    //Auto Complete and delete icon functionality for menu start
    $(document.body).on('click', function (e) {
        var $elem = $(e.target);
        if ($elem.closest('.icon_autocomplete_holder').length > 0) {
            if (e.target.tagName.toLowerCase() == 'i') {
                var theValue = $elem.closest('li').attr('data-icon');
            } else if (e.target.tagName.toLowerCase() == 'li') {
                var theValue = $elem.attr('data-icon');
            }
            if (typeof theValue != 'undefined') {
                $elem.closest('.icon_autocomplete_holder').siblings('.edit-menu-item-icon').val(theValue);
                if ($elem.closest('.icon_autocomplete_holder').find('.clearicon').length > 0) {
                    $elem.closest('.icon_autocomplete_holder').find('.clearicon').remove();
                }
                $elem.closest('.icon_autocomplete_holder').append('<span class="clearicon ' + theValue + '"></span>');
                $elem.closest('.icon_autocomplete_holder').siblings('.edit-menu-item-icon').trigger('change');
            }
        }
        $('.icon_autocomplete_holder .cynic_icon_autocomplete').val('');
        $('.icon_autocomplete_holder .suggestions').remove();

    });

    $(document.body).on('click', '.icon_autocomplete_holder .clearicon', function (e) {
        var $elem = $(this);
        $elem.closest('.icon_autocomplete_holder').siblings('.edit-menu-item-icon').val('');
        $elem.remove();
    });

    $(document.body).on('keyup', '.icon_autocomplete_holder .cynic_icon_autocomplete', function (e) {
        var $item = $(this);
        var $parent = $item.closest('.icon_autocomplete_holder');
        if ($item.val().length > 2) {
            var $found = rkb_return_matched_icons($item.val());
            var $suggestions = $parent.find('ul.suggestions');
            if ($found.length > 0) {

                if ($suggestions.length < 1) {
                    $parent.append('<ul class="suggestions"></ul>');
                    $suggestions = $parent.find('ul.suggestions');
                }
                $suggestions.html('');
                $.each($found, function (k, v) {
                    $suggestions.append('<li data-icon="icon-' + v + '"><i class="icon-' + v + '"></i></li>');
                });
            } else if ($suggestions.length > 0) {
                $suggestions.remove();
            }
        }

    });

    //Auto Complete and delete icon functionality for menu end

    // Show hide portfolio image type
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

});