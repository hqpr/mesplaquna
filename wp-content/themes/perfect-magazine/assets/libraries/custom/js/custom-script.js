(function (e) {
    "use strict";
    var n = window.Thememattic_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()
            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },
            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
                }
            }
        },

        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.SlickCarousel = function () {
            e(".mainbanner-jumbotron").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="Thememattic-icon slide-icon slide-next ion-ios-arrow-right secondary-bgcolor"></i>',
                prevArrow: '<i class="Thememattic-icon slide-icon slide-prev ion-ios-arrow-left secondary-bgcolor"></i>',
            });


            e('.tm-slider-widget').each(function () {
                e(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 8000,
                    infinite: true,
                    dots: false,
                    nextArrow: '<i class="Thememattic-icon slide-icon slide-next ion-ios-arrow-right secondary-bgcolor"></i>',
                    prevArrow: '<i class="Thememattic-icon slide-icon slide-prev ion-ios-arrow-left secondary-bgcolor"></i>',
                });
            });

            e('.tm-carousel-widget').each(function () {
                e(this).slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 8000,
                    infinite: true,
                    nextArrow: '<i class="Thememattic-icon slide-icon slide-next ion-ios-arrow-right"></i>',
                    prevArrow: '<i class="Thememattic-icon slide-icon slide-prev ion-ios-arrow-left"></i>',
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                dots: true

                            }
                        }
                    ]
                });
            });


            e(".gallery-columns-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="Thememattic-icon slide-icon slide-next ion-ios-arrow-right secondary-bgcolor"></i>',
                prevArrow: '<i class="Thememattic-icon slide-icon slide-prev ion-ios-arrow-left secondary-bgcolor"></i>',
            });
        },


        n.Thememattic_preloader = function () {
            e(window).load(function () {
                e("body").addClass("page-loaded");
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        n.MagnificPopup = function () {

            e('div.zoom-gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,
                        titleSrc: function (item) {
                            return item.el.attr('title');
                        }
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });

            e('.gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },

        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.DataBackground(), n.SlickCarousel(), n.Thememattic_preloader(), n.MagnificPopup(), n.scroll_up();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    })
})(jQuery);

