// Slide
import '@splidejs/splide/css/core';
import '@splidejs/splide/css';

import Splide from '@splidejs/splide';

// Slides - Página Principal
document.addEventListener('DOMContentLoaded', () => {
  const slides = new Splide('.c-slides', {
    type: 'loop',
    height: '300px',
    rewind: true,
    breakpoints: {
      640: {
        height: '400px',
      },
    },
  });
  slides.mount();
});

const carrousels = document.querySelectorAll('.c-carrousel');

if (carrousels) {
  const carrousel = [];
  carrousels.forEach((list, index) => {
    carrousel[index] = new Splide(list, {
      type: 'loop',
      perPage: 4,
      rewind: true,
      gap: '20px',
      breakpoints: {
        640: {
          perPage: 2,
        },
        900: {
          perPage: 3,
        },
      },
    }).mount();
  });
}