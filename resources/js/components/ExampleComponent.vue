<template>
    <div>
        <div id="vidHeader" class="fullsize-video-bg">
            <div class="inner pt-jumbo">
                <div class="jumbotron bg-transparent">
                    <transition v-on:before-appear="beforeAppear" v-on:appear="appear">
                        <h1 v-bind:data-delay="500" v-bind:key="0" class="display-responsive-jumbo">Let's fortify your business with an
                            <span class="text-blue">APP</span></h1>

                    </transition>
                    <transition v-on:before-appear="beforeAppearLead" v-on:appear="appearLead">
                    <p v-bind:data-delay="500" class="leadCustom ">FULL-STACK DEVELOPER</p>
                    </transition>
                    <transition v-on:before-appear="beforeAppearButton" v-on:appear="appearButton">
                    <a v-bind:data-delay="500" class="btn btn-accent btn-lg btn-size" href="#" role="button">Start a Project</a>
                    </transition>
                </div>
            </div>
            <div id="video-viewport">
                <video poster="vids/towerink.gif" width="1920" autoplay muted loop>
                    <source src="vids/towerink2.webm" type="video/webm"/>
                    <source src="vids/towerink2_2.mp4" type="video/mp4"/>
                </video>
                <div class="cursor cursor--small" style="transform: matrix(1, 0, 0, 1, 1346, 560);">
                    <div class="cursor--loader"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid vh-100">

        </div>

    </div>


</template>
<script>
    import jQuery from 'jquery'
    let $ = jQuery;
    var min_w = 300;
    var vid_w_orig;
    var vid_h_orig;
    $(function () {

        vid_w_orig = parseInt($('video').attr('width'));
        vid_h_orig = parseInt($('video').attr('height'));

        $(window).resize(function () {
            fitVideo();
        });
        $(window).trigger('resize');

    });
    function fitVideo() {

        $('#video-viewport').width($('.fullsize-video-bg').width());
        $('#video-viewport').height($('.fullsize-video-bg').height());

        var scale_h = $('.fullsize-video-bg').width() / vid_w_orig;
        var scale_v = $('.fullsize-video-bg').height() / vid_h_orig;
        var scale = scale_h > scale_v ? scale_h : scale_v;

        if (scale * vid_w_orig < min_w) {
            scale = min_w / vid_w_orig;
        }
        ;

        $('video').width(scale * vid_w_orig);
        $('video').height(scale * vid_h_orig);

        $('#video-viewport').scrollLeft(($('video').width() - $('.fullsize-video-bg').width()) / 2);
        $('#video-viewport').scrollTop(($('video').height() - $('.fullsize-video-bg').height()) / 2);


    };
    export default {

        beforeCreate() {

        },
        mounted() {
            document.onreadystatechange = () => {
                if (document.readyState == "complete") {
                    $('#video-viewport').width($('.fullsize-video-bg').width());
                    $('#video-viewport').height($('.fullsize-video-bg').height());

                    var scale_h = $('.fullsize-video-bg').width() / vid_w_orig;
                    var scale_v = $('.fullsize-video-bg').height() / vid_h_orig;
                    var scale = scale_h > scale_v ? scale_h : scale_v;

                    if (scale * vid_w_orig < min_w) {
                        scale = min_w / vid_w_orig;
                    }
                    ;

                    $('video').width(scale * vid_w_orig);
                    $('video').height(scale * vid_h_orig);

                    $('#video-viewport').scrollLeft(($('video').width() - $('.fullsize-video-bg').width()) / 2);
                    $('#video-viewport').scrollTop(($('video').height() - $('.fullsize-video-bg').height()) / 2);


                }

            };


        },
        methods: {
            beforeAppear: function (el) {
                el.style.opacity = 0;
                el.style.marginTop = "-500px";
            },
            appear: function (el, done) {
                var delay = +el.dataset.delay;
                setTimeout(function () {
                    Velocity(
                        el, {
                            marginTop: 0,
                            opacity:1
                        }, { duration: 1500 }, {
                            easing: "easeInSine" // Default easing
                        }, {
                            complete: done
                        }
                    )
                }, delay)
            },
            beforeAppearLead: function (el) {
                el.style.opacity= 0;
                el.style.marginTop = "500px";
            },
            appearLead: function (el, done) {
                var delay = +el.dataset.delay;
                setTimeout(function () {
                    Velocity(
                        el, {
                            opacity: 1,
                            marginTop:0
                        }, { duration: 1500 }, {
                            easing: "easeInSine" // Default easing
                        }, {
                            complete: done
                        }
                    )
                }, delay)
            },
            beforeAppearButton: function (el) {
                el.style.opacity= 0;

            },
            appearButton: function (el, done) {
                var delay = +el.dataset.delay;
                setTimeout(function () {
                    Velocity(
                        el, {
                            opacity: 1,

                        },{ duration: 1500 }, {
                            easing: "easeInSine" // Default easing
                        }, {
                            complete: done
                        }
                    )
                }, delay)
            }
        }
    }
</script>
<style>

</style>