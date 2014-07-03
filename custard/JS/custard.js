/**************************************\
|---Custard Skin  JavaScript Scripts---|
|--Written for use on Brickimedia.org--|
\**************************************/

$(document).ready(function () {
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

    /* $( '#temp .tag' ).funcToggle( 'click', function () {
    $( '#temp .info' ).stop( true, true ).slideToggle( slow, easing );
    } );

    if ( $( '#temp' ).length !== 0 ) {
    $( document.head ).children( 'title' ).text( 'Custard: a New Face for Brickimedia' );
    } */

    if ($.cookie('custard_notice') !== 'read') {
        $('#skin-notice').fadeIn(slow, function () {
            $('#skin-notice .wrapper').show('drop', { direction: 'down' }, slow, easing);
        });
    } else {
        $('#skin-notice .button').on('click', function () {
            $('#skin-notice .wrapper').hide('drop', { direction: 'down' }, slow, easing, function () {
                $('#skin-notice').fadeOut(slow);
                $.cookie('custard_notice', 'read');
            });
        });
    }
});

function dialog(cookie) {

    var dHeight, dBox = function () {
        TweenLite.fromTo($('#dialog .box'), .5, { marginTop: '-' + ($('#dialog .box').height() + 40) + 'px' }, { marginTop: $(window).height() / 2 - $('#dialog .box').height() / 2 - 20 + 'px' });
    }, dScreen = function () {
        TweenLite.fromTo($('#dialog'), .5, { opacity: '1' }, { opacity: '0', onComplete: dHide });
    }, dHide = function () {
        $('#dialog').hide();
    };

    if ($.cookie(cookie) !== 'check') {
        $('#dialog').show(function () {
            $('#dialog .box').css('marginTop', '-' + ($('#dialog .box').height() + 40) + 'px');
            TweenLite.fromTo($('#dialog'), .5, { opacity: '0' }, { opacity: '1', onComplete: dBox });
        });
    }

    $('#dialog .button, #dialog').on('click', function () {
        $.cookie(cookie, 'check', { expires: 90 });
        TweenLite.fromTo($('#dialog .box'), .5, { marginTop: $(window).height() / 2 - $('#dialog .box').height() / 2 - 20 + 'px' }, { marginTop: '-' + ($('#dialog .box').height() + 40) + 'px', onComplete: dScreen });
    });

    $('#dialog .box').click(function () {
        return false;
    })
    
}

window.onload = function () {
    dialog('welcome');
}