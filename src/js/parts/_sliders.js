import Swiper from "swiper";

const init = () => {

    const swiper = new Swiper('.price-cards', {
        slidesPerView: 1,
        spaceBetween: 40,
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            large: {
                slidesPerView: 3,
                spaceBetween: 60
            }
        }
    });

};

export default { init };