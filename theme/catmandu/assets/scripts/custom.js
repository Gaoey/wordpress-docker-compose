(function($) {

    "use strict";
    $.fn.travelGemPortfolio = function() {
        return this.each(function(i, elem) {
            var portfolioContainer = jQuery('.portfolio-container', elem);
            portfolioContainer.imagesLoaded(function() {
                portfolioContainer.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
            });
            jQuery('.portfolio-filter a', elem).on('click', function(e) {
                e.preventDefault();
                jQuery('.portfolio-filter .current', elem).removeClass('current');
                jQuery(this).addClass('current');

                var selector = jQuery(this).attr('data-filter');
                portfolioContainer.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        });
    };

    $(document).ready(function($) {
        $('.portfolio-main-wrapper').travelGemPortfolio();

        $.fn.viewportChecker = function(useroptions) {
            // Define options and extend with user.
            var options = {
                classToAdd: 'visible',
                offset: 100,
                callbackFunction: function(elem) {}
            };
            $.extend(options, useroptions);

            // Cache the given element and height of the browser
            var $elem = this,
                windowHeight = $(window).height();

            this.checkElements = function() {
                // Set some vars to check with
                var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
                    viewportTop = $(scrollElem).scrollTop(),
                    viewportBottom = (viewportTop + windowHeight);

                $elem.each(function() {
                    var $obj = $(this);
                    // If class already exists; quit
                    if ($obj.hasClass(options.classToAdd)) {
                        return;
                    }

                    // define the top position of the element and include the offset which makes is appear earlier or later
                    var elemTop = Math.round($obj.offset().top) + options.offset,
                        elemBottom = elemTop + ($obj.height());

                    // Add class if in viewport
                    if ((elemTop < viewportBottom) && (elemBottom > viewportTop)) {
                        $obj.addClass(options.classToAdd);

                        // Do the callback function. Callback will send the jQuery object as parameter
                        options.callbackFunction($obj);
                    }
                });
            };

            // Run checkelements on load and scroll.
            $(window).on('scroll', this.checkElements);
            this.checkElements();

            // On resize change the height var.
            $(window).on('resize', function(e) {
                windowHeight = e.currentTarget.innerHeight;
            });

        };

        // Search in header.
        if ($('.search-icon').length > 0) {
            $('.search-icon').on('click', function(e) {
                e.preventDefault();
                $('.search-box-wrap').slideToggle();
            });
        }
        
        // Trigger mobile menu.
        $('#mobile-trigger').sidr({
            timing: 'ease-in-out',
            speed: 500,
            source: '#mob-menu',
            renaming: false,
            name: 'mob-menu',
            onOpen: function() {
                $( '#mob-menu' ).addClass( 'sidr-visible' );
                $( '#mobile-trigger.open-sidr' ).css( 'display', 'none' );
                $( '#mobile-trigger-close.close-sidr' ).css( 'display', 'block' );
                $('#mobile-trigger-close').sidr('close');
            },
            onCloseEnd: function() {
                $( '#mob-menu' ).removeClass( 'sidr-visible' );
                $( '#mobile-trigger-close.close-sidr' ).css( 'display', 'none' );
                $( '#mobile-trigger.open-sidr' ).css( 'display', 'block' );
            }
        });

        // if( $( '#mobile-trigger-close' ).css('display') == 'block' ) {
        // }


        
        // $('#mobile-trigger-quick').sidr({
        //     timing: 'ease-in-out',
        //     side: 'right',
        //     speed: 500,
        //     source: '#mob-menu-quick',
        //     name: 'sidr-quick',
        // });

        // $('#mob-menu').find('.sub-menu,.flat-mega-memu').before('<span class="dropdown-toggle"><strong class="dropdown-icon"></strong>');

        // $('#mob-menu').find('.dropdown-toggle').on('click', function(e) {
        //     e.preventDefault();
        //     $(this).next('.sub-menu,.flat-mega-memu').slideToggle();
        //     $(this).toggleClass('toggle-on');
        // });

        // Counter up.
        $('.counter-nos').counterUp({
            delay: 10,
            time: 1000
        });

        // // Fixed header.
        // $(window).on('scroll', function() {
        //     if ($(window).scrollTop() > $('.sticky-enabled').offset().top && !($('.sticky-enabled').hasClass('sticky-header'))) {
        //         $('.sticky-enabled').addClass('sticky-header');
        //     } else if (0 === $(window).scrollTop()) {
        //         $('.sticky-enabled').removeClass('sticky-header');
        //     }
        // });
        // Slick carousel column 2.
        $(".iteam-col-2.section-carousel-enabled").slick({
            dots: true,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fas fa-angle-right" aria-hidden="true"></i></span>'
        });

        // Slick carousel column 3.
        $(".iteam-col-3.section-carousel-enabled").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        });

        // Slick carousel column 4
        $(".iteam-col-4.section-carousel-enabled").slick({
            dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            dots: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        });

        // Slick carousel column 5
        $(".iteam-col-5.section-carousel-enabled").slick({
            dots: true,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        });

        // Skil bar.
        jQuery('.skillbar').each(function() {
            jQuery(this).find('.skillbar-bar').animate({
                width: jQuery(this).attr('data-percent')
            }, 3000);
        });

        // Lighbox.
        jQuery('a[data-gal]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('gal'));
        });
        jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
            animationSpeed: 'slow',
            slideshow: false,
            overlay_gallery: false,
            theme: 'light_square',
            social_tools: false,
            deeplinking: false
        });


        // Implement go to top.
        var $scroll_obj = $('#btn-scrollup');
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 100) {
                $scroll_obj.fadeIn();
            } else {
                $scroll_obj.fadeOut();
            }
        });

        $scroll_obj.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });


        $("#fakeloader").fakeLoader({
            timeToHide: 1000, //Time in milliseconds for fakeLoader disappear
            zIndex: "9999", //Default zIndex
            spinner: catmandu_options.loader_spinner, //Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor: catmandu_options.loader_bg, //Hex, RGB or RGBA colors
        });

        $('a[href*="#demosz"]:not([href=""])').on('click', function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 0
                    }, 1000);
                    return false;
                }
            }
        });
    });

    var dom = {};

    var CM_Catmandu = {

        init: function () {
            this._cacheDOM();
            this._listeners();
            this.focusMenuWithChildren();
        },

        // The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
        // by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
        focusMenuWithChildren: function() {
            // Get all the link elements within the primary menu.
            var links, i, len,
                menu = document.querySelector( '#main-navigation' );

            if ( ! menu ) {
                return false;
            }

            links = menu.getElementsByTagName( 'a' );

            // Each time a menu link is focused or blurred, toggle focus.
            for ( i = 0, len = links.length; i < len; i++ ) {
                links[i].addEventListener( 'focus', toggleFocus, true );
                links[i].addEventListener( 'blur', toggleFocus, true );
            }

            //Sets or removes the .focus class on an element.
            function toggleFocus() {
                var self = this;

                // Move up through the ancestors of the current link until we hit .primary-menu.
                while ( -1 === self.className.indexOf( 'primary-menu' ) ) {
                    // On li elements toggle the class .focus.
                    if ( 'li' === self.tagName.toLowerCase() ) {
                        if ( -1 !== self.className.indexOf( 'focus' ) ) {
                            self.className = self.className.replace( ' focus', '' );
                        } else {
                            self.className += ' focus';
                        }
                    }
                    self = self.parentElement;
                }
            }
        },

        _cacheDOM: function () {
            //Ajax Pagination
            this.$loadMoreButton = $('#catmandu-ajax-load-more');
            dom.$paginationDiv = $('.catmandu-pagination');
            dom.$paginationType = catmandu_options.ajaxButtonType;
        },

        _listeners: function () {
            //Ajax load more btn
            if (dom.$paginationType === "load-more") {
                this.$loadMoreButton.on('click', this.ajaxLoadMorePosts.bind(this));
            }

        },

        /**
         * Ajax Load more posts script
         */
        ajaxLoadMorePosts: function () {
            var that = this.$loadMoreButton;
            // Get current page number from the button.
            var current_page = $(that).data('current-page');
            that.data('current-page', ++current_page);

            var filter = $(that).data('filter');
            var postData = {
                'action': 'catmandu_load_more_posts',
                'page': current_page,
                'filter': filter
            };

            var locales = catmandu_options.ajaxLoadMoreLocales;

            $.ajax({
                url: catmandu_options.ajaxurl,
                data: postData,
                type: 'POST',
                context: this,
                beforeSend: function () {
                    if (dom.$paginationType === "load-more") {
                        $(that).text(locales.loading);
                    }
                },
                success: function (response) {
                    if (true === response.success) {
                        var responseData = response.data;

                        if (dom.$paginationType === "load-more") {
                            $(that).text(locales.load_more);
                            $(dom.$paginationDiv).prev().append(responseData.post_html);

                            if (current_page >= parseInt(responseData.max_page)) {
                                $(that).hide();
                            }
                        }
                    }
                },
                error: function () {
                    console.log(locales.error);
                },
            });
        },
    };

    CM_Catmandu.init();
})(jQuery);