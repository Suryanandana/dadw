 // splide config
 var detail = {
     perPage: 3,
     perMove: 1,
     drag: true,
     pagination: false,
     type: 'loop',
     breakpoints: {
         640: {
             perPage: 1,
         },
         1024: {
             perPage: 2,
         }
     }
 }

 new Splide('#service', detail).mount()
 new Splide('#testimonial', detail).mount()

 new Splide('#hero', {
     type: 'fade',
     autoplay: true,
     interval: 8000,
     speed: 2000,
     rewind: true,
     pagination: false,
     arrows: false,
     breakpoints: {}
 }).mount();
