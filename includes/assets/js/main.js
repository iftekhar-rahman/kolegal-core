(function ($) {
  jQuery(document).ready(function () {jQuery('#menu-handle').click(function(){      
    jQuery(this).toggleClass('open');    });
    var Testimonials = new Swiper(".testimonials", {
      slidesPerView: 1,
      spaceBetween: 30, // Distance between slides in px.
      loop: false,
      centeredSlides: false,
      autoplay: false,
      autoHeight: false,
      autoplay: {
        delay: 10000,
      },
      navigation: {
        nextEl: ".swiper-button-next-testi",
        prevEl: ".swiper-button-prev-testi",
      },
      fadeEffect: {
        crossFade: true,
      },
    });



    var mySwiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 0, // Distance between slides in px.
      loop: false,
      centeredSlides: false,
      autoplay: true,
      autoplay: {
        delay: 3000,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      fadeEffect: {
        crossFade: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        0: {
          slidesPerView: 1,
        },
      },
    });

    // Process Slider only visilbe below 1024
    if (jQuery(window).width() < 1024) {
      var Process = new Swiper(".Process", {
        slidesPerView: 3,
        spaceBetween: 140, // Distance between slides in px.
        loop: false,
        centeredSlides: false,
        preventInteractionOnTransition: true,
        autoplay: {
          delay: 3000,
        },
        fadeEffect: {
          crossFade: true,
        },
        breakpoints: {
          1024: {
            slidesPerView: 3,
          },
          768: {
            slidesPerView: 2,
            loop: true,
            spaceBetween: 30,
            autoplay: true,
            autoplay: {
              delay: 3000,
            },
          },
          0: {
            slidesPerView: 1,
            loop: true,
            autoplay: true,
            autoplay: {
              delay: 3000,
            },
          },
        },
      });

    }

    // Process Slider only visilbe below 1024
    if (jQuery(window).width() < 1024) {
      var Process = new Swiper(".Featured", {
        slidesPerView: 3,
        spaceBetween: 30, // Distance between slides in px.
        loop: false,
        centeredSlides: false,
        preventInteractionOnTransition: true,
        autoplay: {
          delay: 3000,
        },
        fadeEffect: {
          crossFade: true,
        },
        breakpoints: {
          1024: {
            slidesPerView: 4,
          },
          768: {
            slidesPerView: 4,
            loop: true,
            spaceBetween: 30,
            autoplay: true,
            autoplay: {
              delay: 3000,
            },
          },
          0: {
            slidesPerView: 2,
            loop: true,
            autoplay: true,
            autoplay: {
              delay: 3000,
            },
          },
        },
      });

    }

    

    var recentPosts = new Swiper(".recentPosts", {
      slidesPerView: 3,
      spaceBetween: 30, // Distance between slides in px.
      loop: true,
      centeredSlides: false,
      autoplay: false,
      // autoplay: {
      //   delay: 3000,
      // },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      fadeEffect: {
        crossFade: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        0: {
          slidesPerView: 1,
        },
      },
    });
    
    jQuery(window).load(function () {
      //open/close mega-navigation
      const $parent = $(".cd-dropdown-wrapper");
      $parent.find(".menu-item-has-children").addClass("has-children");
      $parent.find(".cd-dropdown-content").append(`
      <li class="cd-dropdown-footer-button">
      <a href="https://go-legal.co.uk/free-consultation/"><i aria-hidden="true" class="far fa-calendar-alt"></i> Free Consultation</a>
      </li>
      `);
     
      $parent
        .find(".cd-dropdown-content>li>ul")
        .addClass("cd-secondary-dropdown is-hidden");
      $parent.find(".cd-dropdown-content>li>ul ul").addClass("is-hidden");
      $parent.find(".cd-dropdown-content> ul").addClass("is-hidden");
      $parent
        .find(".cd-dropdown-content ul.sub-menu")
        .prepend(`<li class="go-back"><a href="#0">Back</a></li>`);

      $parent.find(".cd-dropdown-trigger").on("click", function (event) {
        event.preventDefault();
        toggleNav();
      });

      //on mobile - open submenu
      $parent
        .find(".has-children")
        .children("a")
        .on("click", function (event) {
          //prevent default clicking on direct children of .has-children
          event.preventDefault();

          var selected = $(this);
          selected
            .next("ul")
            .removeClass("is-hidden")
            .end()
            .parent(".has-children")
            .parent("ul")
            .addClass("move-out");
        });


      //submenu items - go back link
      $parent.find(".go-back").on("click", function () {
        var selected = $(this),
          visibleNav = $(this)
            .parent("ul")
            .parent(".has-children")
            .parent("ul");
        selected
          .parent("ul")
          .addClass("is-hidden")
          .parent(".has-children")
          .parent("ul")
          .removeClass("move-out");
      });

      function toggleNav() {
        var navIsVisible = !$(".cd-dropdown").hasClass("dropdown-is-active")
          ? true
          : false;
        $(".cd-dropdown").toggleClass("dropdown-is-active", navIsVisible);
        $(".cd-dropdown-trigger").toggleClass(
          "dropdown-is-active",
          navIsVisible
        );
        if (!navIsVisible) {
          $(".cd-dropdown").one(
            "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
            function () {
              $(".has-children ul").addClass("is-hidden");
              $(".move-out").removeClass("move-out");
              $(".is-active").removeClass("is-active");
            }
          );
        }
      }

      //IE9 placeholder fallback
      //credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
      if ("undefined" !== typeof Modernizr && !Modernizr.input.placeholder) {
        $("[placeholder]")
          .focus(function () {
            var input = $(this);
            if (input.val() == input.attr("placeholder")) {
              input.val("");
            }
          })
          .blur(function () {
            var input = $(this);
            if (input.val() == "" || input.val() == input.attr("placeholder")) {
              input.val(input.attr("placeholder"));
            }
          })
          .blur();
        $("[placeholder]")
          .parents("form")
          .submit(function () {
            $(this)
              .find("[placeholder]")
              .each(function () {
                var input = $(this);
                if (input.val() == input.attr("placeholder")) {
                  input.val("");
                }
              });
          });
      }
    });

    

    jQuery("#container").skeletabs();

    var demo2 = jQuery('#demo-2').slideMenu({
      submenuLinkAfter: '<i aria-hidden="true" class="fas fa-angle-right"></i>',
      backLinkBefore: '<i aria-hidden="true" class="fas fa-angle-left"></i>'
    });
    
    jQuery('#mobile-menu-handle').click(function(){
      jQuery(this).toggleClass('open');
      jQuery('.header-wrap').toggleClass('mobile-fixed');
    });

    jQuery('#primary-menu').after('<a class="menu-btn" href="https://go-legal.co.uk/free-consultation/"><i aria-hidden="true" class="far fa-calendar-alt"></i> Free Consultation</a>');

    
  });
})(jQuery);
