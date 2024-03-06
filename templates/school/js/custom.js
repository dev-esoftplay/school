(function () {
  'use strict';

  var owlCarousel = function () {
    var owl = jQuery('.owl-carousel-carousel');
    owl.owlCarousel({
      items: 3,
      loop: true,
      margin: 20,
      nav: false,
      dots: true,
      smartSpeed: 800,
      autoHeight: true,
      navText: [
        "<i class='icon-keyboard_arrow_left owl-direction'></i>",
        "<i class='icon-keyboard_arrow_right owl-direction'></i>",
      ],
      responsive: {
        0: {
          items: 1,
        },
        400: {
          items: 1,
        },
        600: {
          items: 2,
        },
        1000: {
          items: 3,
        },
      },
    });

    var owl = jQuery('.owl-carousel-fullwidth');
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 20,
      nav: false,
      dots: true,
      smartSpeed: 800,
      autoHeight: true,
      autoplay: true,
      navText: [
        "<i class='icon-keyboard_arrow_left owl-direction'></i>",
        "<i class='icon-keyboard_arrow_right owl-direction'></i>",
      ],
    });

    var owl = jQuery('.owl-work');
    owl.owlCarousel({
      stagePadding: 150,
      loop: true,
      margin: 20,
      nav: true,
      dots: false,
      mouseDrag: false,
      autoWidth: true,
      autoHeight: true,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      navText: [
        "<i class='icon-chevron-thin-left'></i>",
        "<i class='icon-chevron-thin-right'></i>",
      ],
      responsive: {
        0: {
          items: 1,
          stagePadding: 10,
        },
        500: {
          items: 2,
          stagePadding: 20,
        },
        600: {
          items: 2,
          stagePadding: 40,
        },
        800: {
          items: 2,
          stagePadding: 100,
        },
        1100: {
          items: 3,
        },
        1400: {
          items: 4,
        },
      },
    });
  };

  var tabsOwl = function () {
    initialize_owl(jQuery('#owl1'));

    jQuery('a[href="#highlights-tab1"]')
      .on('shown.bs.tab', function () {
        initialize_owl(jQuery('#owl1'));
        console.log('nice');
      })
      .on('hide.bs.tab', function () {
        destroy_owl(jQuery('#owl1'));
      });
    jQuery('a[href="#highlights-tab2"]')
      .on('shown.bs.tab', function () {
        initialize_owl(jQuery('#owl2'));
        console.log('nice');
      })
      .on('hide.bs.tab', function () {
        destroy_owl(jQuery('#owl2'));
      });
    jQuery('a[href="#highlights-tab3"]')
      .on('shown.bs.tab', function () {
        initialize_owl(jQuery('#owl3'));
        console.log('nice');
      })
      .on('hide.bs.tab', function () {
        destroy_owl(jQuery('#owl3'));
      });

    function initialize_owl(el) {
      el.owlCarousel({
        items: 3,
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        smartSpeed: 800,
        autoHeight: true,
        navText: [
          "<i class='icon-keyboard_arrow_left owl-direction'></i>",
          "<i class='icon-keyboard_arrow_right owl-direction'></i>",
        ],
        responsive: {
          0: {
            items: 1,
          },
          400: {
            items: 1,
          },
          600: {
            items: 2,
          },
          1000: {
            items: 3,
          },
        },
      });
    }

    function destroy_owl(el) {
      el.trigger('destroy.owl.carousel');
      el.find('.owl-stage-outer').children(':eq(0)').unwrap();
    }
  };

  jQuery(document).ready(function () {
    tabsOwl();
  });
  jQuery(window).load(function () {
    owlCarousel();
  });
})();
