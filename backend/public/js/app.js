$('.js-develop-report-toggle-button').on('click', function () {
    $(this).parent().find(".js-develop-report-toggle-block").slideToggle();
    $(this).parent().find(".js-toggle-icon").toggleClass('rotate-180');

});
$(window).on('load', function () {
    var target = $('.has-error');
    if (target.length === 0) {
        return false;
    }

    $("html,body").animate({scrollTop: target.offset().top - 200});
    return false;
});
$(function () {
    $('.js-modal-confirm-open').on('click', function () {
        let target_modal = $(this).attr('target-modal');
        $(this).parent().find('.' + target_modal).fadeIn();
        return false;
    });
    $('.js-modal-confirm-close').on('click', function () {
        $('.js-modal-confirm').fadeOut();
        return false;
    });
});
$(function () {
    $('#js-user-search-submit').on('click', function () {
        let keyword = $('#js-user-search-input').val();
        let action = $('#js-user-search-form').attr('action');
        $(location).attr("href", action + '/' + encodeURIComponent(keyword));
    });
});




