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

}(jQuery));
/*ready*/