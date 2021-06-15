import { gsap } from "gsap";


const animationsDefaults = {
    duration: 1,
    duration2: 2,
    duration3: 3,
    duration5: 5,
    duration20: 20,
    durationSmall: 0.15,
    durationSmall2: 0.6,
    easing: "expo.out",
    easingIn: "sine.in",
    easing2: "power3.out",
    easingLinear: "none",
    stagger: 0.4,
    delay: 0.2,
    delay2: 0.2,
    delay6: 0.6,
    delay1: 0.1,

};


// Default text-image animation
const blockTitleTextImagesAnimation = (section) => {
    const titleEl = section.querySelector('.title');
    const contentEls = section.querySelectorAll('.content > *');
    const imgsEl = section.querySelectorAll('.column__image img');
    const imgsBkEl = section.querySelectorAll('.column__image');
    const ctaEls = section.querySelector('.cta');
    const sliderEl = section.querySelector('#slider');

    //console.log(imgsBkEl);

    const tl = gsap.timeline({ paused: true });
    let staggerValue = 0;

    if (titleEl) {
        staggerValue += animationsDefaults.delay;
        tl.fromTo(titleEl, { y: "+=45px", autoAlpha: 0 }, { y: "0px", autoAlpha: 1, duration: animationsDefaults.duration2, ease: animationsDefaults.easing });
    }
    if (imgsBkEl) {
        tl.fromTo(imgsBkEl, { autoAlpha: 0 }, { duration: animationsDefaults.duration2, autoAlpha: 1, ease: animationsDefaults.easingLinear, stagger: animationsDefaults.stagger }, staggerValue);
    }
    if (imgsEl) {
        tl.fromTo(imgsEl, { autoAlpha: 0 }, { duration: animationsDefaults.duration, autoAlpha: 1, ease: animationsDefaults.easingLinear, stagger: animationsDefaults.stagger }, staggerValue);
    }
    if (contentEls) {
        staggerValue += animationsDefaults.delay;
        tl.fromTo(contentEls, { y: "+=45px", autoAlpha: 0 }, { y: "0px", autoAlpha: 1, duration: animationsDefaults.duration, ease: animationsDefaults.easing, stagger: animationsDefaults.stagger }, staggerValue);
    }
    if (ctaEls) {
        staggerValue += animationsDefaults.delay;
        tl.fromTo(ctaEls, { y: "+=45px", autoAlpha: 0 }, { y: "0px", autoAlpha: 1, duration: animationsDefaults.duration2, ease: animationsDefaults.easing, stagger: animationsDefaults.stagger }, staggerValue);
    }
    if (sliderEl) {
        staggerValue += animationsDefaults.delay;
        tl.fromTo(sliderEl, { autoAlpha: 0 }, { duration: animationsDefaults.duration2, autoAlpha: 1, ease: animationsDefaults.easing, stagger: animationsDefaults.stagger }, staggerValue);
    }
    return tl;
};



export { blockTitleTextImagesAnimation };
