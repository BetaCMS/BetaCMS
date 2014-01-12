define("avalon", function () {
    avalon.ready(function () {
        $('#overlay').fadeOut(800);


        avalon.define("application", function (vm) {
            console.log(vm)
        })

        avalon.scan()
    });
})



