jQuery(function ($) {
    $('.presentation-tab').on('click', function() {
        let title = $(this).data('title');
        let text = $(this).data('text');
        $('.tab-title, .tab-text').fadeOut(200, function() {
            $('.tab-title').text(title);
            $('.tab-text').text(text);
            $('.tab-title, .tab-text').fadeIn(200);
        });
    })
});