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

    // Hero Slider (Modern 2026 Active-Indicator Navigation)
    if ($('.hero-slider').length) {
        var $heroSlider = $('.hero-slider');
        
        $heroSlider.slick({
            autoplay: true,
            autoplaySpeed: 6000,
            pauseOnFocus: false,
            pauseOnHover: false,
            infinite: true,
            arrows: false,
            fade: false,
            speed: 600,
            cssEase: 'ease-in-out',
            dots: false
        });

        // Update custom yellow active slide indicator smoothly
        $heroSlider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var slideCount = slick.slideCount || 4;
            var translatePercent = nextSlide * 100; // translates active bar by 100% of its width
            $('#heroActiveIndicator').css('transform', 'translateX(' + translatePercent + '%)');
        });

        // Click on indicator track to jump directly to target slide
        $(document).on('click', '.hero-indicator-track', function (e) {
            var trackWidth = $(this).width();
            var clickX = e.pageX - $(this).offset().left;
            var slideCount = $heroSlider.slick('getSlick').slideCount || 4;
            var targetSlide = Math.floor((clickX / trackWidth) * slideCount);
            if (targetSlide >= 0 && targetSlide < slideCount) {
                $heroSlider.slick('slickGoTo', targetSlide);
            }
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
        $('.venobox').venobox({
            numeratio: true,
            infinigall: true,
            titleattr: 'data-title',
            overlayColor: 'rgba(6, 72, 122, 0.90)',
            arrowsColor: '#ffbc3b',
            closeColor: '#ffffff',
            closeBackground: '#06487a',
            numerationColor: '#ffffff',
            numerationBackground: '#06487a',
            titleColor: '#ffffff',
            titleBackground: 'rgba(6, 72, 122, 0.95)'
        }); 
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