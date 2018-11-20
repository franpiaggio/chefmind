$(document).ready(function() {
    var stickyHeaderTop = $('.js-filters').offset().top;

    $(window).scroll(function() {
        if ($(window).scrollTop() > stickyHeaderTop) {
            $('.js-filters').addClass('sticky-filter');
            $('.custom-file').addClass('d-none');
        } else {
            $('.js-filters').removeClass('sticky-filter');
            $('.custom-file').removeClass('d-none');
        }
    });
});