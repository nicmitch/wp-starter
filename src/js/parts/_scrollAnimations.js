import { blockTitleTextImagesAnimation } from './_animations.js'; 
import Foundation from "foundation-sites";

const intersectionObserverDefaultOptions = {
    rootMargin: '0px 0px -20% 0px',
    threshold: 0,

};
const intersectionObserverFirstBlockOptions = {
    rootMargin: '0px 0px -20% 0px',
    threshold: 0,

};
const intersectionObserverContactsOptions = {
    rootMargin: '0px 0px -60% 0px',
    threshold: 0.2
};

const intersectionObserverGalleryOptions = {
    rootMargin: '0px 0px -70% 0px',
    threshold: 0
};


const intersectionObserverArticles = {
    rootMargin: '0px 0px -20% 0px',
    threshold: 0
};


const intersectionObserverSingleArticles = {
    rootMargin: '0px 0px -30% 0px',
    threshold: 0,
};


if (Foundation.MediaQuery.atLeast('large')) {
    /*
        Animate text readmore blocks
    */
    const blockTitleTextImagesAnimation = document.querySelectorAll('.block-title-text-images');
    
    for (let section of blockTitleTextImagesAnimation) {

        const sectionId = section.getAttribute('id');

        const animation = blockTitleTextImagesAnimation(section);
        let animationDone = false;

        const blockTextObserver = new window.IntersectionObserver(
            (entries) => {
                for (const e of entries) {
                    if (e.isIntersecting) {
                        if (!animationDone) {
                            animation.restart();
                            animationDone = true;
                        } else {
                            // console.log("Block text animation already done");
                        }   
                    }
                }
            },

            intersectionObserverDefaultOptions
        );

        blockTextObserver.observe(section);
    }



}