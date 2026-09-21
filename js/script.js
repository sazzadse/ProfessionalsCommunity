(function ($) {
    'use strict';

    // Sticky Menu
    $(window).scroll(function () {
        if ($('header').offset().top > 10) {
            $('.top-header').addClass('hide');
            $('.navigation').addClass('nav-bg');
        } else {
            $('.top-header').removeClass('hide');
            $('.navigation').removeClass('nav-bg');
        }
    });

    // Background-images
    $('[data-background]').each(function () {
        $(this).css({
            'background-image': 'url(' + $(this).data('background') + ')'
        });
    });

    //Hero Slider
    if ($('.hero-slider').length) {
        $('.hero-slider').slick({
            autoplay: true,
            autoplaySpeed: 6000,
            pauseOnFocus: false,
            pauseOnHover: false,
            infinite: true,
            arrows: true,
            fade: false,
            speed: 600,
            cssEase: 'ease-in-out',
            prevArrow: '<button type="button" class="prevArrow"><i class="ti-angle-left"></i></button>',
            nextArrow: '<button type="button" class="nextArrow"><i class="ti-angle-right"></i></button>',
            dots: true
        });
    }

    // Partner Slider
    if ($('.partner-slider').length) {
        $('.partner-slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 500,
            infinite: true,
            arrows: false,
            dots: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: { slidesToShow: 4 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 3 }
                },
                {
                    breakpoint: 480,
                    settings: { slidesToShow: 2 }
                }
            ]
        });
    }

    // venobox popup
    $(document).ready(function(){
        $('.venobox').venobox(); 
    });

    
    // mixitup filter
    var containerEl = document.querySelector('[data-ref~="mixitup-container"]');
    var mixer;
    if (containerEl) {
        mixer = mixitup(containerEl, {
            selectors: {
                target: '[data-ref~="mixitup-target"]'
            }
        });
    }

    //  Count Up
    function counter() {
        var oTop;
        if ($('.count').length !== 0) {
            oTop = $('.count').offset().top - window.innerHeight;
        }
        if ($(window).scrollTop() > oTop) {
            $('.count').each(function () {
                var $this = $(this),
                    countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {
                    duration: 1000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                });
            });
        }
    }
    $(window).on('scroll', function () {
        counter();
    });

})(jQuery);