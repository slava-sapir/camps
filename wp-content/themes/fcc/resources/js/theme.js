// require('@popperjs/core');
import 'bootstrap/js/dist/offcanvas';
import 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/modal';
// import 'bootstrap/js/dist/tooltip';
//import Swiper from 'swiper';
//import {Navigation} from 'swiper/modules';

document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");

const accordionButtons = document.querySelectorAll('.accordion-button');

  accordionButtons.forEach(button => {
    button.addEventListener('click', () => {
      const accordionItem = button.closest('.accordion-item');
      
      // Toggle the class on the clicked accordion-item and remove from others
      document.querySelectorAll('.accordion-item').forEach(item => {
        item.classList.toggle('tile-shadow', item === accordionItem && !item.classList.contains('tile-shadow'));
      });
    });
  });