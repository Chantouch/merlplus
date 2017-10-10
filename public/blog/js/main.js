function setCookie(e, t, i) {
    var n = new Date;
    n.setTime(n.getTime() + 24 * i * 60 * 60 * 1e3);
    var o = "expires=" + n.toGMTString();
    document.cookie = e + "=" + t + "; " + o
}

function getCookie(e) {
    for (var t = e + "=", i = document.cookie.split(";"), n = 0; n < i.length; n++) {
        var o = i[n].trim();
        if (0 === o.indexOf(t)) return o.substring(t.length, o.length)
    }
    return ""
}

function deleteCookie() {
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var equals = cookies[i].indexOf("=");
        var name = equals > -1 ? cookies[i].substr(0, equals) : cookies[i];
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

var clear = document.getElementById("show_menu");
clear.onclick = function () {
    deleteCookie();
};

var hidemenu;
jQuery(document).ready(function () {
    "use strict";
    $("#contactsubmit").bind("click", function () {
        return $.ajax({
            url: "contact.php", type: "POST", data: $("#contactform").serialize(), success: function (e) {
                "Sent Success" === e ? $("#formmsg").addClass("mag-alert-scc").show().find("span.error").html("Thank you for contact us") : $("#formmsg").addClass("mag-alert-dngr").show().find("span.error").html(e)
            }
        }), !1
    }), $("#hidemenu").bind("click", function () {
        $(".main-menu").removeClass("f-nav"), $(this).hide(), hidemenu = !0, setCookie("hidemenu", "hide", 10)
    }), $("#showmenu").bind("click", function () {
        $(".main-menu").addClass("f-nav"), $(this).show(), hidemenu = !1, setCookie("hidemenu", "hide", -10)
    }), $("#main-menu-items").smartmenus(), $(".boxgrid.caption").hover(function () {
        $(".cover", this).stop().animate({top: "70px"}, {queue: !1, duration: 183})
    }, function () {
        $(".cover", this).stop().animate({top: "142px"}, {queue: !1, duration: 153})
    }), $(".boxgrid2.caption").hover(function () {
        $(".cover", this).stop().animate({top: "270px"}, {queue: !1, duration: 183})
    }, function () {
        $(".cover", this).stop().animate({top: "366px"}, {queue: !1, duration: 153})
    }), $(".boxgrid3.caption").hover(function () {
        $(".cover", this).stop().animate({top: "145px"}, {queue: !1, duration: 183})
    }, function () {
        $(".cover", this).stop().animate({top: "202px"}, {queue: !1, duration: 153})
    })
}), $(window).on("load", function () {
    $(".flexslider.hm-slider").flexslider({
        animation: "fade",
        controlNav: !1,
        prevText: "",
        nextText: ""
    }), $(".flexslider.sm-sldr").flexslider({
        animation: "slide",
        controlNav: !1,
        slideshowSpeed: 2e3,
        animationSpeed: 2500,
        prevText: "",
        nextText: ""
    }), $(".flexslider.news-sldr").flexslider({
        animation: "slide",
        controlNav: !1,
        pauseText: "",
        itemWidth: 183,
        itemMargin: 0,
        slideshowSpeed: 4e3,
        animationSpeed: 2500,
        prevText: "",
        nextText: ""
    }), $(".flexslider.img-sm-gal").flexslider({
        animation: "slide",
        controlNav: !0,
        directionNav: !1,
        pauseText: "",
        itemWidth: 79,
        itemMargin: 15,
        slideshowSpeed: 6e3,
        animationSpeed: 2500,
        slideshow: !1,
        prevText: "",
        nextText: ""
    }), $(".flexslider.vid-thmb").flexslider({
        animation: "fade",
        controlNav: !1,
        itemWidth: 166,
        itemMargin: 10,
        slideshowSpeed: 4e3,
        animationSpeed: 2500,
        prevText: "",
        nextText: ""
    })
});
var nav = $(".main-menu");
var show_menu = $("#show_menu").hide();
$(window).scroll(function () {
    var e = getCookie("hidemenu");
    $(this).scrollTop() > 160 && !0 !== hidemenu && "hide" !== e ? (nav.fadeIn("slow").addClass("f-nav"), $("#hidemenu").fadeIn('slow'), $("#show_menu").fadeOut('slow')) : (nav.removeClass("f-nav"), $("#hidemenu").fadeOut('slow'))
    if (e == "hide") {
        show_menu.show();
    }
});

/* Custome js on home page */

new UISearch(document.getElementById('sb-search'));
window.addEventListener("load", function (event) {
    event.preventDefault();
   var load =  lazyload();
});

$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        lazyLoad: true,
        lazyContent: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: true,
                loop: true,
                autoplay: true
            },
            600: {
                items: 3,
                nav: false,
                dots: true,
                loop: true
            },
            1000: {
                items: 5,
                nav: false,
                dots: true,
                loop: false
            }
        }
    })
});

var $ = jQuery.noConflict();
jQuery(document).ready(function ($) {
    scrollToTop.init();
});

var scrollToTop = {
    /**
     * When the user has scrolled more than 100 pixels then we display the scroll to top button using the fadeIn function
     * If the scroll position is less than 100 then hide the scroll up button
     *
     * On the click event of the scroll to top button scroll the window to the top
     */
    init: function () {
        //Check to see if the window is top if not then display button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        // Click event to scroll to top
        $('.scrollToTop').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    }
};
