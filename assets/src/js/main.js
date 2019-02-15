(function($, window, document, undefined) {
    'use strict';

    $(document).ready(function() {

        var EV = {
            init: function() {
                this.utils.init();
            },
            vals: {
                $window: $(window), // http://jsperf.com/jquery-window-cache
                $siteNavSticky: $('.site-nav-sticky').eq(0)
            },
            utils: {

                init: function() {

                    this.mqState.appendEl();
                    this.mqState.checkStateView();
                    this.setDelay();
                    this.scrollIt();
                    this.dataCss();
                    this.stickySiteNav();
                    this.scrollMagic();

                },
                mqState: {

                    appendEl: function() {

                        $('body').append('<div class="mq-state"/>');

                    },
                    checkStateView: function() {

                        EV.vals.view = parseInt($('.mq-state').css('z-index'));

                        // fallback to desktop if browser doesn't support media queries
                        if (!Modernizr.mq('only all')) EV.vals.view = 30;

                    },

                },

                setDelay: function() {

                    var scrolled = false,
                        resized = false;

                    // delay checking of scroll
                    EV.vals.$window.on('scroll touchmove', function() { scrolled = true; });
                    // delay checking of window resize
                    EV.vals.$window.on('resize', function() { resized = true; });

                    setInterval(function() {

                        if (scrolled) {

                            scrolled = false;

                        }

                        if (resized) {

                            resized = false;

                            EV.utils.mqState.checkStateView();
                        }

                    }, 50);
                },

                scrollIt: function() {

                    // Animate the scroll to top
                    $('.js-to-top').on('click', function(e) {

                        e.preventDefault();

                        $('html, body').animate({ scrollTop: 0 }, 300);

                    });

                    // Animate scroll to id
                    $('.js-scroll-to').on('click', function(e) {

                        e.preventDefault();

                        var href = $(this).attr('href'),
                            scrollPoint = $(href).offset();

                        $('html, body').animate({ scrollTop: scrollPoint.top }, 300);
                    });
                },

                dataCss: function() {

                    // background images
                    $('[data-bg-image]').each(function() {
                        var $this = $(this);
                        $this.css({ 'background-image': 'url("' + $this.data('bgImage') + '")' });
                    });

                    // background colors
                    $('[data-bg-color]').each(function() {
                        var $this = $(this);
                        $this.css({ 'background-color': $this.data('bgColor') });
                    });

                },

                stickySiteNav: function() {

                    var stickyTop = EV.vals.$siteNavSticky.height() + 200;

                    EV.vals.$window.scroll(function() {

                        if (EV.vals.$window.scrollTop() >= stickyTop) {
                            EV.vals.$siteNavSticky.addClass('visible');
                        } else {
                            EV.vals.$siteNavSticky.removeClass('visible');
                        }
                    });

                },
                scrollMagic: function() {
                    var blocks = $('.site-wrap').children('.block'),
                        ctrl = new ScrollMagic.Controller();

                    blocks.each(function(i, item) {
                        new ScrollMagic.Scene({
                                triggerElement: item,
                                duration: item.outerHeight,
                                triggerHook: 0.9,
                                reverse: false
                            })
                            .on("enter", function() {
                                var current = blocks.eq(i);
                                // Example usage
                                // if (current.hasClass('hero')) {
                                //     var tl = new TimelineMax({ paused: true, force3D: true, ease: Circ.easeInOut }),
                                //         bg = current.children('.bg-image'),
                                //         parallaxer = current.find('.parallax').children(),
                                //         opts = { delay: 0.6 },
                                //         duration = 1.5,
                                //         fromOpts = { drawSVG: '0' },
                                //         toOpts = { drawSVG: '100% 0', visibility: 'visible', ease: Circ.easeInOut },
                                //         path = document.querySelectorAll('.hero svg path');

                                //     if (winWidth >= mobile) {
                                //         var scene = document.getElementById('scene'),
                                //             parallax = new Parallax(scene);
                                //     }

                                //     tl.to(bg, 0.6, { autoAlpha: 1 });
                                //     tl.to(parallaxer, 0.6, { opacity: 1 }, '-=0.3');
                                //     tl.set(path, { fill: '#343130', attr: { 'fill-opacity': 0 } });
                                //     tl.fromTo(path, duration, fromOpts, toOpts);
                                //     tl.to(path, 0.6, { attr: { 'fill-opacity': 1 } });
                                //     tl.play();
                                // }
                            })
                            // Comment "addIndicators()" in/out to use
                            // .addIndicators()
                            .addTo(ctrl);
                    });
                }

            },
        };

        EV.init();

    });

})(jQuery, window, document);