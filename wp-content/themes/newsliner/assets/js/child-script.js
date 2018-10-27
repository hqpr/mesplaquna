/**
 * Custom js for child theme
 */

(function ($) {
    $(document).ready(function () {
        $(".news-scroller").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 12000,
            infinite: true,
            nextArrow: '<i class="Thememattic-icon slide-icon slide-next ion-ios-arrow-right"></i>',
            prevArrow: '<i class="Thememattic-icon slide-icon slide-prev ion-ios-arrow-left"></i>',
            responsive: [
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 678,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

    });

})(jQuery);