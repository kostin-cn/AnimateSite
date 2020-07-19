jQuery.noConflict();
(function($){
    $(function(){

        $('#menuBtn').click(function () {
            $(this).toggleClass('active');
            $('#reserveBtn').toggleClass('active');
            $('#logo').toggleClass('active');
            $('#menu').toggleClass('active');
            $('.mainNavMenu').toggleClass('active');
            $('#content').toggleClass('active');
            // $('body').toggleClass('lock-scroll');
        });

        $('.scroll-btn').click(function () {
            let scroll_pos = $(window).height();

            $('html, body').animate({
                scrollTop: scroll_pos
            }, 1000);

        });

        $('.scroll-up').click(function () {
            let scroll_pos = 0;

            $('html, body').animate({
                scrollTop: scroll_pos
            }, 1000);

        });

        $('#reserveBtn').click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                context: $('#pop-content'),
                type:'GET',
                success: function(data){
                    $(this).html(data);
                },
                complete: function() {
                    if (!$('#pop-up').hasClass('active')) {
                        $('#pop-up').addClass('active');
                    }
                }
            });
        });

        $('#pop-close').click(function () {
            $('#pop-up').removeClass('active');
            $('#pop-content').empty();
        });

        var scrolled;
        let sp = $(window).height();
        scrolled = window.pageYOffset || document.documentElement.scrollTop;
        let padding_top;
        if (window.innerWidth <= 960) {
            padding_top = 75;
        }else {
            if (window.innerWidth <= 1400) {
                padding_top = 120;
            } else {
                padding_top = 180;
            }
        }

        window.onscroll = function() {
            scrolled = window.pageYOffset || document.documentElement.scrollTop;
            sp = $(window).height();
            show_jq_hidden();

            if ($('.menuContainer').length) {
                if (window.innerWidth <= 960) {
                    padding_top = 75;
                }else {
                    if (window.innerWidth <= 1400) {
                        padding_top = 120;
                    } else {
                        padding_top = 180;
                    }
                }
                if ($('.leftMenu').parent().offset().top < scrolled + padding_top) {
                    $('.leftMenu').offset({top:scrolled + padding_top});
                }else {
                    $('.leftMenu').offset({top:$('.leftMenu').parent().offset().top});
                }
            }
        };
        show_jq_hidden();
        function show_jq_hidden() {
            $('.jq_hidden').each(function(){
                let scroll_pos = window.pageYOffset;
                if ($(this).offset().top < scroll_pos + $(window).height() + 300) {
                    $(this).addClass('jq_active');
                }
                if ($(this).offset().top > scroll_pos + $(window).height() + 300) {
                    $(this).removeClass('jq_active');
                }
            });
        }

        if ($('#map').length) {
            initialize();
        }

        if ($('.ias-news-block').length) {
            let ias;
            iasNews();

            function iasNews(){
                let ias = jQuery.ias({
                    container:  '#indexNews',
                    item:       '.newsItem',
                    pagination: '#pagination',
                    next:       '.next a'
                });

                let text = $('#indexNews').data('load-more');

                ias.extension(new IASTriggerExtension({
                    html: '<div class="load-more"><div class="load-more-btn"><div class="ico icon-arrow-redo"></div>' + text +'</div></div>' // optionally
                }));

                ias.on('rendered', function(items) {
                    let $items = $(items);
                    $items.addClass('jq_active');
                })
            }
        }

        //SLIDER GALLERY
        let galSliders = $('.gallerySlider');
        if (galSliders) {
            galSliders.each(function () {
                gallerySlider(this);
                if ($(this).hasClass('gallerySliderSecond')) {
                    slider.goTo('last')
                }
            });
        }

        if ($('.gallery-page').length) {

            // gSlider();

            let container = $('#gallerySlider');
            let current = container.scrollLeft();

            imgMatrix(container);

            container.smoothWheel();

            $('.imgWrap').click(function () {
                $(this).toggleClass('fullScreen')
            });

            window.addEventListener('resize', ()=>{innerWidth = window.innerWidth;});
            window.addEventListener("wheel", event => {
                // const delta = Math.sign(event.deltaY);

                // current = container.scrollLeft();
                // container.scrollLeft(current + delta*150);

                // container.stop().animate({
                //     scrollLeft: '+='+(event.deltaY * 3)+'px'
                // }, 200);

                imgMatrix(container);

                // if (delta > 0){
                    // galSlider.goTo("next");
                // }
                // else {
                    // galSlider.goTo("prev");
                // }
            });
            window.addEventListener('touchmove', ()=>{imgMatrix(container)});
        }

        // анимация на странице галереи
        function imgMatrix (container) {
            let innerWidth = window.innerWidth;
            container.find('.slide').each(function () {
                let curr = this.getBoundingClientRect().left;
                if (curr < innerWidth && curr>0) {
                    let d = innerWidth/2/curr;
                    if (d>1) {d=1}
                    $(this).find('.imgWrap').css('transform', 'matrix('+d+', 0, 0, '+d+', '+(100-(d*100))+', '+(100-(d*100))+')');
                }
                if (curr >= innerWidth) {
                    $(this).find('.imgWrap').css('transform', 'matrix(0.5, 0, 0, 0.5, 50, 50)');
                }
                if (curr <= 0) {
                    $(this).find('.imgWrap').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
                }
            });
        }

        //SLIDER MAIN
        if (document.getElementById('indexSlider')) {
            let container = $('#indexSlider');
            let current = container.scrollLeft();

            // initSlider();

            // document.addEventListener('keydown', function(event) {
            //     switch (event.key) {
            //         case "ArrowUp":
            //             slider.goTo("prev");
            //             sliderNav()
            //             break;
            //         case "ArrowDown":
            //             slider.goTo("next");
            //             sliderNav()
            //             break;
            //     }
            // });

            indexAnimate(container);

            container.smoothWheel();

            window.addEventListener("wheel", event => {
                // const delta = Math.sign(event.deltaY);

                // current = container.scrollLeft();
                // container.scrollLeft(current + delta*150);

                // container.stop().animate({
                //     scrollLeft: '+='+(event.deltaY * 3)+'px'
                // }, 500);

                indexAnimate(container);

                // if (delta > 0){
                    // slider.goTo("next");
                    // sliderNav()
                // }
                // else {
                    // slider.goTo("prev");
                    // sliderNav()
                // }

            });

            let firstX;
            let firstY;
            let currX;
            let currY;

            window.addEventListener('touchstart', function (event) {
                firstX = event.touches[0].clientX;
                firstY = event.touches[0].clientY;
                currX = event.touches[0].clientX;
                currY = event.touches[0].clientY;
            });

            window.addEventListener('touchmove', function (event) {
                event.preventDefault();
                // console.log(event.changedTouches[0].clientX - currX);
                container.stop().animate({
                    scrollLeft: '-='+(event.changedTouches[0].clientX - currX)+'px'
                }, 1, 'swing', function () {
                    indexAnimate(container);
                });
                $('.thisSlide-active').find('.slideTextWrap').animate({
                    scrollTop: '-='+(event.changedTouches[0].clientY - currY)+'px'
                }, 1);
                currX = event.changedTouches[0].clientX;
                currY = event.changedTouches[0].clientY;
            }, { passive: false });

            window.addEventListener('touchend', function (event) {
                // это доводчик страницы, чтобы край блока совпадал с краем окна
                let innerWidth = window.innerWidth;
                container.find('.slide').each(function () {
                    let curr = this.getBoundingClientRect().left;
                    if (curr > 50 && curr < innerWidth-50) {
                        if ((event.changedTouches[0].clientX - firstX) > 0) {
                            container.stop().animate({
                                scrollLeft: '+='+(curr - innerWidth)+'px'
                            }, 500, 'swing', function () {
                                indexAnimate(container);
                                container.find('.slide').removeClass('thisSlide-active');
                                container.find('.slide').each(function () {
                                    if (this.getBoundingClientRect().left === 0) {
                                        $(this).addClass('thisSlide-active');
                                    }
                                });
                            });
                        }else {
                            container.stop().animate({
                                scrollLeft: '+='+curr+'px'
                            }, 500, 'swing', function () {
                                indexAnimate(container);
                                container.find('.slide').removeClass('thisSlide-active');
                                container.find('.slide').each(function () {
                                    if (this.getBoundingClientRect().left === 0) {
                                        $(this).addClass('thisSlide-active');
                                    }
                                });
                            });
                        }
                    }else {
                        if ((curr>0 && curr<50) || (curr>innerWidth-50 && curr < innerWidth)) {
                            let offset = $('.thisSlide-active').offset();
                            container.stop().animate({
                                scrollLeft: '+='+(offset.left)+'px'
                            }, 500, 'swing', function () {
                                indexAnimate(container);
                            });
                        }
                    }
                });
            });
        }

        //анимация на главной странице
        function indexAnimate (container) {
            let innerWidth = window.innerWidth;
            container.find('.slide').each(function () {
                let curr = this.getBoundingClientRect().left;
                let d = curr/innerWidth/2;
                if (d>-0.1 && d<0.1) {d=0}
                if (curr >= -innerWidth && curr < 0) {
                    $(this).find('.bg-image').css('transform', 'scale('+(1-d)+')');
                    $(this).find('.slideText').each(function () {
                        if ($(this).hasClass('left')) {
                            $(this).css('transform', 'translate3d('+(d*20)+'vw, 0, 0)');
                        }
                        if ($(this).hasClass('center')) {
                            $(this).css('transform', 'translate3d('+-(50-d*20)+'%, -50%, 0)');
                        }
                        if ($(this).hasClass('contacts')) {
                            $(this).css('transform', 'translate3d('+(d*40)+'vw, 0, 0)');
                        }
                        if ($(this).hasClass('right')) {
                            $(this).css('transform', 'scale('+(1-d)+')');
                            $(this).find('.slideTextWrap').css('opacity', 1+d*2);
                        }
                    });
                    $(this).find('.slideBottom').css('transform', 'translate3d('+(d*20)+'vw, 0, 0)');
                    let i =1;
                    $(this).find('.slideImg img').each(function () {
                        $(this).css('transform', 'translate3d('+(d*20*i)+'vw, 0, 0)');
                        i++;
                    });
                }
                if (curr >= 0 && curr <= innerWidth) {
                    $(this).find('.bg-image').css('transform', 'scale('+(1+d)+')');
                    $(this).find('.slideText').each(function () {
                        if ($(this).hasClass('left')) {
                            $(this).css('transform', 'translate3d('+(d*20)+'vw, 0, 0)');
                        }
                        if ($(this).hasClass('center')) {
                            $(this).css('transform', 'translate3d('+-(50-d*20)+'%, -50%, 0)');
                        }
                        if ($(this).hasClass('contacts')) {
                            $(this).css('transform', 'translate3d('+(d*40)+'vw, 0, 0)');
                        }
                        if ($(this).hasClass('right')) {
                            $(this).css('transform', 'scale('+(1+d)+')');
                            $(this).find('.slideTextWrap').css('opacity', 1-d*2);
                            // $(this).find('.slideTextWrap').css('transform', 'translate3d('+(d*10)+'px, 0, 0)');
                        }
                    });
                    $(this).find('.slideBottom').css('transform', 'translate3d('+(d*20)+'vw, 0, 0)');
                    let i =1;
                    $(this).find('.slideImg img').each(function () {
                        $(this).css('transform', 'translate3d('+(d*20*i)+'vw, 0, 0)');
                        i++;
                    });
                }
            });
        }

        $('.slide-next').click(function () {
            // slider.goTo("next");
            // sliderNav()

            let container = $('#indexSlider');
            container.stop().animate({
                scrollLeft: '+='+window.innerWidth+'px'
            }, 1000, 'swing', function () {
                indexAnimate(container);
            });
        });

        function initSlider (){
            slider = tns({
                container: '#indexSlider',
                items: 1,
                mode: 'carousel',
                // axis: "vertical",
                speed: 1500,
                slideBy: 'page',
                controls: true ,
                mouseDrag: true,
                autoplay: false,
                //animateDelay:1000,
                autoplayButton: false,
                autoplayButtonOutput: false,
                controlsPosition:'bottom',
                navPosition:'bottom',
                navContainer:document.querySelector(".indexSliderNav"),
                //arrowKeys:true,
                viewportMax:true,
                //navAsThumbnails:true,
                loop:false,
                preventActionWhenRunning:true,
            });
        }

        function gallerySlider (container){
            slider = tns({
                container: container,
                items: 1,
                mode: 'carousel',
                gutter: 40,
                speed: 300,
                slideBy: 1,
                controls: false ,
                nav: false,
                mouseDrag: true,
                autoplay: false,
                //animateDelay:1000,
                autoplayButton: false,
                autoplayButtonOutput: false,
                controlsPosition:'bottom',
                navPosition:'bottom',
                navContainer:document.querySelector(".gallerySliderNav"),
                //arrowKeys:true,
                viewportMax: true,
                //navAsThumbnails:true,
                loop:false,
                preventActionWhenRunning:true,
            });
        }

        function gSlider (){
            galSlider = tns({
                container: '#gallerySlider',
                items: 1,
                mode: 'carousel',
                speed: 300,
                slideBy: 1,
                controls: false ,
                nav: false,
                mouseDrag: true,
                autoplay: false,
                //animateDelay:1000,
                autoplayButton: false,
                autoplayButtonOutput: false,
                controlsPosition:'bottom',
                navPosition:'bottom',
                navContainer:document.querySelector(".gallerySliderNav"),
                //arrowKeys:true,
                viewportMax: true,
                //navAsThumbnails:true,
                loop:false,
                preventActionWhenRunning:true,
                responsive: {
                    500: {
                        items: 2,
                    },
                    960: {
                        items: 3,
                    },
                }
            });
        }

        function sliderNav() {
            let current = $('.tns-nav-active').data('nav');
            $('.tns-nav button').each(function () {
                if ($(this).data('nav') < current) {
                    if (!$(this).hasClass('filled')) {
                        $(this).addClass('filled');
                    }
                }else {
                    if ($(this).hasClass('filled')) {
                        $(this).removeClass('filled');
                    }
                }
            });

        }

    });
})(jQuery);

