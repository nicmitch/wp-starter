import $ from "jquery";
import "../vendors/cookies-enabler";

! function($) {

    //*
    //	Banner stilizzato tramite src/components/_cookies.scss
    //	Dati passati tramite acf globali
    //	https://github.com/nicholasruggeri/cookies-enabler
    //*

    let cookiesData = window.cookies_data;
    const COOKIES_ENABLER = window.COOKIES_ENABLER;

    // Aggiungo gli attributi per le mappe google
    $('iframe').each(function() {
        var src = $(this).attr('src');
        $(this).attr('src', '');
        $(this).attr('data-ce-src', src);
        $(this).addClass('ce-iframe');
    });
    
    if (!cookiesData || cookiesData === null){
        console.error('Salva i contenuti globali nel backend almeno una volta.');
        return;
    }
    if (cookiesData.show == true) {
        COOKIES_ENABLER.init({
            bannerHTML: '<div class="row"><div class="side--left column small-12 large-10">' + cookiesData.banner_text + '</div><div class="side--right column small-12 large-2"><a href="#" class="ce-accept">' + cookiesData.button_label + '</a></div></div>',
        });
    }

}($);