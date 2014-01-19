define(function (require, exports, module) {
    var $ = require("jquery"), store = require("store");

    avalon.ready(function () {
        var app = avalon.define("application", function (vm) {
        });

        avalon.scan()
    });

    $(function () {
        $('#overlay').fadeOut(800);

        $('body,#wrapper').removeAttr('class');
        $('body').removeAttr('style');


        $('#sizeToggle').click(function () {
            $('#wrapper').toggleClass('sidebar-mini');
        });

        //Toggle Menu
        $('#sidebarToggle').click(function () {
            $('#wrapper').toggleClass('sidebar-display');
        });


        if ($.type(store.get('skin_color')) != 'undefined') {

            $('aside').removeClass('skin-1 skin-2 skin-3 skin-4');
            $('#top-nav').removeClass('skin-1 skin-2 skin-3 skin-4');

            $('aside').addClass(store.get('skin_color'));
            $('#top-nav').addClass(store.get('skin_color'));
        }
        else {
            $('aside').removeClass('skin-1 skin-2 skin-3 skin-4');
            $('#top-nav').removeClass('skin-1 skin-2 skin-3 skin-4');

            $('aside').addClass('skin-1');
            $('#top-nav').addClass('skin-1');
        }


        //Skin color
        $('.theme-color').click(function () {
            store.set('skin_color', $(this).attr('id'));

            $('aside').removeClass('skin-1 skin-2 skin-3 skin-4');
            $('#top-nav').removeClass('skin-1 skin-2 skin-3 skin-4');

            $('aside').addClass($(this).attr('id'));
            $('#top-nav').addClass($(this).attr('id'));
        });

        //theme setting
        $("#theme-setting-icon").click(function () {
            if ($('#theme-setting').hasClass('open')) {
                $('#theme-setting,#theme-setting-icon').removeClass('open');
            }
            else {
                $('#theme-setting,#theme-setting-icon').addClass('open');
            }

            return false;
        });

        //scroll to top of the page
        $("#scroll-to-top").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

        $(window).scroll(function () {

            var position = $(window).scrollTop();

            //Display a scroll to top button
            if (position >= 200) {
                $('#scroll-to-top').attr('style', 'bottom:8px;');
            }
            else {
                $('#scroll-to-top').removeAttr('style');
            }
        });
    });
});





