jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var loader = $('#loader');
    var loader_container = $('#preloader');
    var scroll = $(window).scrollTop();  
    var scrollup = $('.backtotop');
    var menu_toggle = $('.menu-toggle');
    var dropdown_toggle = $('.main-navigation button.dropdown-toggle');
    var nav_menu = $('.main-navigation ul.nav-menu');
    var featured_slider = $('#featured-slider');
    var popular_post_slider = $('#popular-posts .inner-posts-wrapper');

/*------------------------------------------------
            PRELOADER
------------------------------------------------*/

    loader_container.delay(1000).fadeOut();
    loader.delay(1000).fadeOut("slow");

/*------------------------------------------------
            BACK TO TOP
------------------------------------------------*/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

/*------------------------------------------------
            MAIN NAVIGATION
------------------------------------------------*/

    $('#sidr-left-top-button').sidr({
        name: 'sidr-left-top',
        timing: 'ease-in-out',
        speed: 500,
        side: 'right',
        source: '.left'
    });

    $('#sidr-right-top-button').sidr({
        name: 'sidr-right-top',
        timing: 'ease-in-out',
        speed: 500,
        side: 'left',
        source: '.right'
    });

    $('#primary-menu .menu-item-has-children > a > svg').click(function(event) {
        event.preventDefault();
        $(this).parent().find('.sub-menu').first().slideToggle();
    })

    menu_toggle.click(function() {
        $(this).toggleClass('active');
    });

    $('.main-navigation ul li.search-menu a').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('search-active');
        $('.main-navigation #search').fadeToggle();
        $('.main-navigation .search-field').focus();
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.main-navigation ul li.search-menu a').removeClass('search-active');
            $('.main-navigation #search').fadeOut();
        }
    });

    $(document).click(function (e) {
        var container = $("#masthead");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('#site-navigation').removeClass('menu-open');
            $('#primary-menu').slideUp();
            $('.main-navigation ul li.search-menu a').removeClass('search-active');
            $('.main-navigation #search').fadeOut();
        }
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            $('.primary-menu-sticky #masthead').addClass('nav-shrink');
            $('.secondary-menu-sticky #masthead').addClass('nav-shrink');
        } 
        else {
            $('.primary-menu-sticky #masthead').removeClass('nav-shrink');
            $('.secondary-menu-sticky #masthead').removeClass('nav-shrink');
        }
    });

/*------------------------------------------------
            SLICK SLIDER
------------------------------------------------*/

featured_slider.slick();
popular_post_slider.slick({
    responsive: [
        {
        breakpoint: 992,
            settings: {
                slidesToShow: 3,
                vertical: false

            }
        },
        {
        breakpoint: 767,
            settings: {
                slidesToShow: 2,
                vertical: false
            }
        },
        {
        breakpoint: 567,
            settings: {
                slidesToShow: 1,
                vertical: false
            }
        }
    ]
});

$('#featured-slider .slick-dots').before('<div class="slider-pagination"><div class="wrapper">');
$('#featured-slider .slick-dots').appendTo('.slider-pagination .wrapper');
$('#featured-slider .slick-prev').insertBefore('#featured-slider .slick-dots');
$('#featured-slider .slick-next').insertAfter('#featured-slider .slick-dots');

/*------------------------------------------------
            MATCH HEIGHT
------------------------------------------------*/
$('.posts-wrapper article.has-post-thumbnail .entry-container').matchHeight();
$('#featured-posts article').matchHeight();


/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});