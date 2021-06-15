import $ from "jquery";
import 'lightgallery';

const init = () => {
    $(".ilightbox , .ilightbox-gallery, .lightbox, .lightbox-gallery").lightGallery({
        mode: 'lg-slide',
        cssEasing: 'cubic-bezier(0.465, 0.100, 0.220, 0.910)',
        // easing: 'easeInOutQuart',
        speed: 600,
        mousewheel: false,
        hideControlOnEnd: true,
        loop: false,
        counter: false,
        download: false,
        actualSize: false,
        fullScreen: true,
        slideEndAnimatoin: false,
        subHtmlSelectorRelative: true,
        selector: 'a',
    });

    $(".lightbox-gallery-thumbs").lightGallery({
        mode: 'lg-slide',
        cssEasing: 'cubic-bezier(0.465, 0.100, 0.220, 0.910)',
        // easing: 'easeInOutQuart',
        speed: 600,
        mousewheel: false,
        hideControlOnEnd: true,
        loop: false,
        counter: false,
        download: false,
        actualSize: false,
        fullScreen: true,
        slideEndAnimatoin: false,
        subHtmlSelectorRelative: true,
        selector: '.swiper-slide',
    });

    /*
    $(".lightgallery-video").lightGallery({
    mode: 'lg-slide',
    cssEasing : 'cubic-bezier(0.860, 0.000, 0.070, 1.000)',
    easing: 'easeInOutQuint',
    speed: 300,
    mousewheel: false,
    hideControlOnEnd: true,
    loop: false,
    counter: false,
    download: false,
    actualSize: false,
    fullScreen: false,
    slideEndAnimatoin: false,
    videoMaxWidth: '70%',
    youtubePlayerParams: {showinfo: 0, controls: 1},
    selector: 'this'
    });

    $(".lightgallery-iframe").lightGallery({
    selector: 'this',
    iframeMaxWidth: '90%',
    videoMaxWidth: '90%',
    zoom: false,
    actualSize: false,
    fullScreen: false,
    download: false,
    });
    */
};

export { init };
