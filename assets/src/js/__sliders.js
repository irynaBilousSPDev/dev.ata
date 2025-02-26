import $ from 'jquery';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import 'slick-carousel';


export function initializeMainSlider(container) {
    // Wait until Slick is fully loaded
    function waitForSlick(callback) {
        const checkSlick = setInterval(() => {
            if (typeof $.fn.slick !== "undefined") {
                clearInterval(checkSlick);
                callback();
            }
        }, 100);
    }

    waitForSlick(() => {
        $(container).each(function () {
            const $thisContainer = $(this);
            const $sliderFor = $thisContainer.find('.main_slider_active');
            const $sliderNav = $thisContainer.find('.main_slider_nav');
            const controlsWrapper = $thisContainer.find('.main_slider_controls');

            // Ensure both elements exist before initializing Slick
            if ($sliderFor.length && $sliderNav.length) {
                if (!$sliderFor.hasClass('slick-initialized')) {
                    $sliderFor.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        fade: true,
                        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
                        touchThreshold: 100,
                        lazyLoad: 'ondemand',
                        lazyLoadBuffer: 0,
                        centerMode: true,
                        adaptiveHeight: true, // Ensure correct height
                        // lazyLoad: "progressive", // Lazy loading for better performance
                        asNavFor: $sliderNav,
                        autoplay: true,
                        autoplaySpeed: 5000,
                        // cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)', // Smooth animation
                        // speed: 1000
                    });
                }

                if (!$sliderNav.hasClass('slick-initialized')) {
                    $sliderNav.slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: $sliderFor,
                        dots: true,
                        centerMode: true,
                        focusOnSelect: true,
                        variableWidth: true,
                        lazyLoad: 'progressive',
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 5000,
                        // cssEase: 'cubic-bezier(0.77, 0, 0.175, 1)', // Smooth animation
                        // speed: 1000,
                        appendDots: controlsWrapper,
                        adaptiveHeight: true, // Ensure correct height
                    });
                }

                // Accessibility fix: Prevent focus on hidden slides
                function updateAccessibility() {
                    $thisContainer.find('.slick-slide').each(function () {
                        const isHidden = $(this).attr('aria-hidden') === 'true';
                        if (isHidden) {
                            $(this).attr('inert', '');
                            $(this).find(':focus').blur();
                        } else {
                            $(this).removeAttr('inert');
                        }
                    });
                }

                $sliderFor.on('afterChange', updateAccessibility);
                $sliderNav.on('afterChange', updateAccessibility);
                updateAccessibility();

                // Play/Pause button functionality
                const playPauseButton = $('<button class="slick-play-pause">❚❚</button>');
                controlsWrapper.append(playPauseButton);
                let isPlaying = true;

                playPauseButton.on('click', function () {
                    if (isPlaying) {
                        $sliderFor.slick('slickPause');
                        $sliderNav.slick('slickPause');
                        $(this).text('▶');
                    } else {
                        $sliderFor.slick('slickPlay');
                        $sliderNav.slick('slickPlay');
                        $(this).text('❚❚');
                    }
                    isPlaying = !isPlaying;
                });
            } else {
                console.error("Error: Missing '.main_slider_active' or '.main_slider_nav' inside the container.");
            }
        });
    });
}

export function initializeOffersCategoriesSlider(selector) {
    const $slider = $(selector);
    if ($slider.length && $.fn.slick) {
        $slider.slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            prevArrow: '<button class="slick-prev"></button>',
            nextArrow: '<button class="slick-next"></button>',
            dots: true,
            autoplay: false,
            variableWidth: true,
            responsive: [
                {breakpoint: 1366, settings: {slidesToShow: 4}},
                {breakpoint: 1025, settings: {slidesToShow: 3}},
                {breakpoint: 768, settings: {slidesToShow: 2}},
                {breakpoint: 480, settings: {slidesToShow: 1}}
            ]
        });
    }
}

export function initializeImageContentSlider(container) {
    function waitForSlick(callback) {
        const checkInterval = setInterval(() => {
            if (typeof $ !== 'undefined' && $.fn && $.fn.slick) {
                clearInterval(checkInterval);
                callback();
            }
        }, 100);
    }

    waitForSlick(() => {
        if (!container || !(container instanceof Element || typeof container === 'string')) {
            console.error('Error: Invalid container. It should be a DOM element or a selector string.');
            return;
        }

        const $container = $(container instanceof Element ? container : document.querySelector(container));
        if (!$container.length) {
            console.warn(`Warning: Container ${container} not found, skipping initialization.`);
            return;
        }

        const $sliderFor = $container.find('.slider_for_images');
        const $sliderNav = $container.find('.slider_nav_content');

        if (!$sliderFor.length || !$sliderNav.length) {
            console.warn(`Warning: Sliders not found inside ${container}, skipping initialization.`);
            return;
        }
        const controlsWrapper = $('.controls_wrapper');

        $sliderFor.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: $sliderNav,
            autoplay: true,
            autoplaySpeed: 5000
        });

        $sliderNav.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: $sliderFor,
            dots: true,
            appendDots: controlsWrapper,//Move dots to your custom div
            arrows: false,
            // centerMode: true,
            // focusOnSelect: true,
            autoplay: true,
            autoplaySpeed: 5000
        });

        const playPauseButton = $('<button class="slick-play-pause">❚❚</button>');
        controlsWrapper.append(playPauseButton);

        let isPlaying = true;

        playPauseButton.on('click', function () {
            if (isPlaying) {
                $sliderFor.slick('slickPause');
                $sliderNav.slick('slickPause');
                $(this).text('▶');
            } else {
                $sliderFor.slick('slickPlay');
                $sliderNav.slick('slickPlay');
                $(this).text('❚❚');
            }
            isPlaying = !isPlaying;
        });
    });
}


export function initializePartnerLogosSlider(selector) {
    const $slider = $(selector);
    if ($slider.length && $.fn.slick) {
        $slider.slick({
            speed: 10000,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 0,
            cssEase: 'linear',
            slidesToShow: 9,
            slidesToScroll: 1,
            infinite: true,
            swipeToSlide: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 750,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }
}

export function initializeNewWhyStudySlider(selector) {
    const $slider = $(selector);
    if ($slider.length && $.fn.slick) {
        $slider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            centerMode: false,
            arrows: true,
            prevArrow: '<button class="slick-prev"></button>',
            nextArrow: '<button class="slick-next"></button>',
            dots: false,
            autoplay: false,
            variableWidth: true,
            responsive: [
                {breakpoint: 768, settings: {slidesToShow: 2}},
                {breakpoint: 480, settings: {slidesToShow: 1}}
            ]
        });
    }
}





