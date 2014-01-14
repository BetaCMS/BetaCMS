define('avalon', function () {
    console.log(avalon)
    avalon.ready(function () {
        $('#overlay').fadeOut(800);

        $('body').removeAttr('class', 'style');

        //Enable animation
        $('#wrapper').removeAttr('class');

        $('#sizeToggle').click(function () {
            $('#wrapper').toggleClass('sidebar-mini');
        });


        avalon.define("application", function (vm) {
            console.log(vm)
        });


        avalon.scan()
    });
})



