/**************************************\
|---Custard Skin  JavaScript Scripts---|
|--Written for use on Brickimedia.org--|
\**************************************/

$(document).ready(function () {

    /*temporary inclusion of dependencies while resourceloader seems to be broken
    mw.loader.load(['jquery.jPlayer'], ['jquery.funcToggle']);
    console.log('success');*/

    var slow = 500;
    var fast = 250;
    var easing = 'linear';

    $('#taskbar .toggle').funcToggle('click', function () {
        $('#taskbar').stop(true, true).animate({ marginBottom: -($('#taskbar').height()) }, fast, easing);
    }, function () {
        $('#taskbar').stop(true, true).animate({ marginBottom: -30 }, fast, easing);
    });

    $('#actions .watch').not('.disabled').children('a').bind('click', function () {
        $('#actions .watch').toggleClass('watching');
    });

    $(window).on('load', function () {
        $('#temp .loader').fadeOut(slow, easing);
    });

    $('#temp .tag').funcToggle('click', function () {
        $('#temp .info').stop(true, true).slideToggle(slow, easing);
    });

    if ($('#temp').length !== 0) {
        $(document.head).children('title').text('Custard: a New Face for Brickimedia');
    }

    $('#skin-notice .button').click(function () {
        $('#skin-notice').hide(slow, easing, "drop", { direction: "down" });
        console.log("click!");
    });

});
