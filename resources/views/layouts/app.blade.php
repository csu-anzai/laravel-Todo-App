<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://www.google.com/recaptcha/api.js?render=explicit"
            async defer></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140847010-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-140847010-1');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '669471600192235',
            cookie: true,
            xfbml: true,
            version: 'v3.3'
        });

        FB.AppEvents.logPageView();

    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="app">
    <div v-if="!siteStart" class="w-100 vh-100 mx-auto my-auto  spinnerContainer">
        <transition
                name="custom-classes-transition"
                enter-active-class="animated flipInX"
                leave-active-class="animated bounceOutRight"
                leave-class="animated bounceOutRight"
        >
            <half-circle-spinner class=""
                                 :animation-duration="1500"
                                 :size="100"
                                 color="#ff1d5e"
            />
        </transition>
    </div>

    <div id="contents" v-if="siteStart">
        @if(Request::is('/'))
            <div class="container-background  ">
                <div class="background"></div>
            </div>
        @endif

        <nav :class="'navbar navbar-expand-xl shadow-sm navbar-light bg-white sticky-top '+transparentNav+' '+homePageClass">
            <div class="container-fluid ">
                <div class="cfsc pl-2  mr-lg-5">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <transition
                                name="custom-classes-transition"
                                enter-active-class="animated flipInX"
                                leave-active-class="animated bounceOutRight"
                        >
                            <img v-if="loaded" src="images/cfsclogo5.svg" height="40" class="d-inline-block align-top"
                                 alt="">
                        </transition>
                    </a>
                </div>
                <button class="navbar-toggler hidden-xl-up" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <transition
                            name="custom-classes-transition"
                            enter-active-class="animated fadeInLeft"
                            leave-active-class="animated bounceOutRight"
                    >
                        <ul v-if="loaded" class="navbar-nav  mr-auto MainMenu py-1 ">

                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Portfolio</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Packages</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Promos</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Demos</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">About</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Contact</a></li>
                        </ul>
                    </transition>
                    <transition
                            name="custom-classes-transition"
                            enter-active-class="animated fadeInRight"
                            leave-active-class="animated bounceOutRight"
                    >
                        <ul v-if="loaded" class="navbar-nav ml-auto MainMenu py-1 ">

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item"><a class=" nav-link nav-link-right"
                                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item"><a class="nav-link nav-link-right"
                                                            href="{{ route('register') }}">{{ __('Register') }}</a></li>

                                @endif
                            @else

                                <li class="nav-item  dropdown px-1">
                                    <a id="navbarDropdown" class="nav-link nav-icon dropdown-toggle " href="#"
                                       role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item " href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            @endguest
                            <li class="nav-item px-2"><a href="#" class="btn btn-dark">Get A Quote</a></li>
                        </ul>
                    </transition>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-4">
            @yield('content')
        </main>
        <v-footer height="auto">
            <v-card flat tile width="100%" class="bg-black text-center">
                <v-card-text>
                    <v-btn dark class="mx-4" icon>
                        <v-icon dark size="24px">home</v-icon>
                    </v-btn>
                    <v-btn dark class="mx-4" icon>
                        <v-icon dark size="24px">mail</v-icon>
                    </v-btn>
                    <v-btn dark

                           class="mx-4"
                           icon
                    >
                        <v-icon dark size="24px">message</v-icon>
                    </v-btn>
                </v-card-text>
                <v-card-text class="white--text pt-0">
                    Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum.
                    Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur
                    dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada.
                    Nulla
                    placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam
                    elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes,
                    nascetur
                    ridiculus mus.
                </v-card-text>
                <v-divider dark></v-divider>

                <div id="" class="b-flex align-items-center justify-content-between  ">


                    <div>
                        <p class="text-white   px-4 mb-0" v-html="'Copyright © '+ year +' — '+ brand">
                            <a target="_blank" rel="noopener" href="#" class="grey--text text--lighten-1">Privacy
                                Policy</a>
                            <span class="grey--text text--lighten-1">  &nbsp;|  &nbsp;</span>
                            <a target="_blank" rel="noopener" href="#" class="grey--text text--lighten-1">Cookie
                                Policy</a>
                    </div>
                    <div></div>
                    <div class=" socialIcons d-flex align-items-center bg-black ">
                        <a href="#" class="icon-button instagram"><i class="fab fa-instagram"></i><span></span></a>
                        <a href="#" class="icon-button twitter"><i class="fab fa-twitter"></i><span></span></a>
                        <a href="#" class="icon-button facebook"><i class="fab fa-facebook"></i><span></span></a>
                        <a href="#" class="icon-button google-plus"><i class="fab fa-google"></i><span></span></a>
                        <a href="#" class="icon-button youtube"><i class="fab fa-youtube"></i><span></span></a>
                        <a href="#" class="icon-button pinterest"><i class="fab fa-pinterest"></i><span></span></a>


                    </div>
                </div>
            </v-card>
        </v-footer>
    </div>

</div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6198365168970959",
        enable_page_level_ads: true
    });
</script>
<script>
    // Check that service workers are registered
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js');
        });
    }
</script>
</body>
</html>
