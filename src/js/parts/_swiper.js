import Swiper from "swiper";
import Foundation from 'foundation-sites';



/*
    Single slide slider
*/
const singleSwiperElements = document.querySelectorAll('.swiper-single-container');
for (const item of Array.from(singleSwiperElements)) {
    const singleSwiper = new Swiper (item, {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        speed: 800,
        followFinger: false,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        /*
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        */

        // If we need pagination
        pagination: {
            el: '.swiper-single-pagination',
            clickable: true
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-single-button-next',
            prevEl: '.swiper-single-button-prev',
        }
    });
    // Handle autoplay stop/start when hovering on slider
    singleSwiper.el.addEventListener("mouseenter", () => { singleSwiper.autoplay.stop(); });
    singleSwiper.el.addEventListener("mouseleave", () => { singleSwiper.autoplay.start(); });
}


/*
    Multiple slider container: init Swiper in a responsive way
    - small & medium: 1 centered slide (airbnb style)
    - desktop up: 3 slides
*/
const multipleSwiperElements = document.querySelectorAll('.swiper-multiple-container');
for (const item of Array.from(multipleSwiperElements)) {
    if (Foundation.MediaQuery.atLeast('large')) {
        // Desktop: classic 3 slides
        const multipleSwiper = new Swiper (item, {
            direction: 'horizontal',
            loop: false,
            speed: 800,
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 3,

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-multiple-button-next',
                prevEl: '.swiper-multiple-button-prev',
            },

            pagination: {
                el: '.swiper-multiple-pagination',
                clickable: true
            }
        });
    } else {
        // Small/Medium breakpoints: centered slide
        const multipleSwiper = new Swiper (item, {
            direction: 'horizontal',
            loop: false,
            speed: 800,
            slidesPerView: 'auto',
            spaceBetween: 15,
            centeredSlides: true,
            freeMode: true,

            // Navigation arrows
            /*
            navigation: {
                nextEl: '.swiper-multiple-button-next',
                prevEl: '.swiper-multiple-button-prev',
            },
            */

            pagination: {
                el: '.swiper-multiple-pagination',
                clickable: true
            },
        });
    }
}




/*
    Block gallery thumbs
*/
const thumbsGalleryElements = document.querySelectorAll('.block-gallery-thumbs');
for (const item of Array.from(thumbsGalleryElements)) {
    const galleryThumbsEl = item.querySelector('.block-gallery__thumbs .swiper-container');
    const galleryThumbsPaginationEl = item.querySelector('.swiper-pagination');
    const galleryThumbsNavPrevEl = item.querySelector('.swiper-button-prev');
    const galleryThumbsNavNextEl = item.querySelector('.swiper-button-next');
    const galleryMainEl = item.querySelector('.block-gallery__main .swiper-container');

    if (Foundation.MediaQuery.atLeast('large')) {
        const fadeGalleryThumbsSlider = new Swiper(galleryThumbsEl, {
            spaceBetween: 4,
            slidesPerView: 4,
            slidesPerGroup: 4,
            loop: false,
            freeMode: false,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            watchOverflow: true,
            direction: 'horizontal',
            navigation: {
                nextEl: galleryThumbsNavNextEl,
                prevEl: galleryThumbsNavPrevEl,
            },
            pagination: {
                el: galleryThumbsPaginationEl,
                type: 'bullets',
                clickable: true
            },
        });

        // Move main image slider by hovering on thumbs
        /*
        galleryThumbsEl.find('.swiper-slide').on("mouseover", function() {
            fadeGalleryMainSlider.slideTo($(this).index());
        });
        */

        const fadeGalleryMainSlider = new Swiper (galleryMainEl, {
            direction: 'horizontal',
            slidesPerView: 1,
            loop: false,
            speed: 240,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoHeight: false,

            thumbs: {
                swiper: fadeGalleryThumbsSlider
            }
        });

    } else {
        const fadeGalleryThumbsSlider = new Swiper(galleryThumbsEl, {
            spaceBetween: 4,
            slidesPerView: 4,
            loop: false,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            direction: 'horizontal',
            watchOverflow: true,
            pagination: {
                el: galleryThumbsPaginationEl,
                type: 'bullets',
                clickable: true
            },
        });

        const fadeGalleryMainSlider = new Swiper (galleryMainEl, {
            direction: 'horizontal',
            slidesPerView: 1,
            loop: false,
            speed: 240,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoHeight: false,

            thumbs: {
                swiper: fadeGalleryThumbsSlider
            }
        });
    }
}
