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

jQuery(function($) {
  let canBeLoaded = true; // This param allows to initiate the AJAX call only if necessary
  const bottomOffset = 1500; // The distance (in px) from the page bottom when you want to load more posts

  $(window).scroll(function() {
    const data = {
      'action': 'loadmore',
      'query': forest_cliff_params.posts,
      'page': forest_cliff_params.cur_page
    };

    if ($(document).scrollTop() > ($(document).height() - bottomOffset) && canBeLoaded === true) {
      $.ajax({
        url: forest_cliff_params.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function(xhr) {
          $('#loading-spinner').show();
          canBeLoaded = false;
        },
        success: function(data) {
          if (data) {
            $('main#primary').find('article:last-of-type').after(data); // Where to insert posts
            canBeLoaded = true; // The AJAX is completed, now we can run it again
            forest_cliff_params.cur_page++;
            console.log('Current page:', forest_cliff_params.cur_page);
          }
          $('#loading-spinner').hide();
        },
        error: function(xhr, status, error) {
          console.error(status, error);
          $('#loading-spinner').hide();
        }
      });
    }
  });
});