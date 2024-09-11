import Swiper from 'swiper';
import {Autoplay, Pagination} from 'swiper/modules';

document.addEventListener("DOMContentLoaded", function () {
    var reviewsSwiper = new Swiper(".rates-dates-swiper", {
        modules: [Pagination, Autoplay],
        // autoplay: {
        //     delay: 5000,
        //     disableOnInteraction: true,
        // },
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            clickable: true
        },
        grabCursor: true,
        loop: true,
    });
});

