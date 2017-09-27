$(document).ready(function () {
    "use strict";
    // toat popup js
    $.toast({
        heading: 'Welcome to Merlplus admin',
        text: 'Use the predefined ones, or specify a custom position object.',
        position: 'top-right',
        loaderBg: '#fff',
        icon: 'info',
        hideAfter: 3500,
        stack: 6
    });
    // counter
    $(".counter").counterUp({
        delay: 100,
        time: 1200
    });

});
