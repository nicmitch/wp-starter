import $ from "jquery";

!function($){
    $(".mobile-menu-toggle").click(function(){
        if ($("body").hasClass("open-mobile-menu")) {
            $("body")
                .removeClass("open-mobile-menu")
                .addClass("close-mobile-menu");

            $('.menu-container--mobile').removeClass('open');
        } else {
            $("body")
                .addClass("open-mobile-menu")
                .removeClass("close-mobile-menu");

            $('.menu-container--mobile').addClass('open');
        }
    });

    /*
        Mobile menu EVO Studios style:
        con 3 livelli di menu, il secondo è una etichetta e il tutto è già esploso
    */
    $("#menu-main-menu > li > ul > li > ul").addClass("is-active");
    $("#menu-main-menu > li > ul > li > ul").addClass("nested");

}($);
