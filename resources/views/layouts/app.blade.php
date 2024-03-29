<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
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
    <meta name="google-signin-client_id" content="92699194994-pc4hvrt5kbrc0s4cgquiq2a5vvcfmbol.apps.googleusercontent.com">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/velocity.min.js') }}" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
</head>
<body class="bg-white">
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v4.0'
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="2429679170609548"
     theme_color="#6699cc">
</div>
<div id="app">
    <div v-if="!siteStart" class="w-100 vh-100 mx-auto my-auto  spinnerContainer">
        <transition enter-active-class="animated flipInX" leave-active-class="animated bounceOutRight" leave-class="animated bounceOutRight">
            <half-circle-spinner class="" :animation-duration="1500" :size="100" color="#000000"/>
        </transition>
    </div>
    <div id="contents" v-else>
        <nav id="naviCFSC" :class="'navbar navbar-expand-xl shadow-sm pt-0  sticky-top '+transparentNav+' '+homePageClass">
            <div class="container-fluid ">
                <div class="cfsc pl-2  mr-lg-5">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <transition name="custom-classes-transition" enter-active-class="animated flipInX" leave-active-class="animated bounceOutRight">
                            <img v-if="loaded" :src="logoImage" height="40" class="d-inline-block align-top" alt="CFSCastillo Logo">
                        </transition>
                    </a>
                </div>
                <button id="navToggler" class="navbar-toggler hidden-xl-up" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <div :class="'icon nav-icon-1 '+dataToggleBackground">
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                        <span :class="dataToggleBackgroundSpan"></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <transition name="custom-classes-transition" enter-active-class="animated fadeInDown" leave-active-class="animated bounceOutRight">
                        <ul v-if="loaded" class="navbar-nav  mr-auto MainMenu py-1 ">
                            <li class="nav-item"><a href="/" class="nav-link nav-link-white">Home</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Portfolio</a></li>
                            <li class="nav-item"><a href="#" class="nav-link nav-link-white">Contact</a></li>
                        </ul>
                    </transition>
                    <transition name="custom-classes-transition" enter-active-class="animated fadeInDown" leave-active-class="animated bounceOutRight">
                        <ul v-if="loaded" class="navbar-nav ml-auto MainMenu py-1 ">
                            @guest
                                <li class="nav-item">
                                    <a class=" nav-link nav-link-right" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                </li>
                                <li class="nav-item">
                                    <div class=" socialIcons d-flex align-items-center  ">
                                        <a target="_blank" href="https://www.facebook.com/cfscastillo" :class="'icon-button  facebook '+socialIconsBackground"><i class="fab fa-facebook"></i><span></span></a>
                                        <a target="_blank" href="https://github.com/cfscastillo04" :class="'icon-button  github '+socialIconsBackground"><i class="fab fa-github"></i><span></span></a>
                                        <a target="_blank" href="https://www.instagram.com/cfs.castillo/" :class="'icon-button  instagram '+socialIconsBackground "><i class="fab fa-instagram"></i><span></span></a>
                                        <a target="_blank" href="https://twitter.com/CF_S_Castillo" :class="'icon-button  twitter '+socialIconsBackground "><i class="fab fa-twitter"></i><span></span></a>

                                    </div>
                                </li>
                            @else
                                <li class="nav-item  dropdown px-1">
                                    <a id="navbarDropdown" class="nav-link nav-icon dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        </ul>
                    </transition>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <v-footer height="auto">
            <v-card flat tile width="100%" class=" text-center">
                <v-card-text>
                    <v-btn class="mx-4" icon>
                        <v-icon dark size="24px">home</v-icon>
                    </v-btn>
                    <v-btn class="mx-4" icon>
                        <v-icon dark size="24px">mail</v-icon>
                    </v-btn>
                    <v-btn class="mx-4" icon>
                        <v-icon dark size="24px">message</v-icon>
                    </v-btn>
                </v-card-text>
                {{-- <v-card-text class=" pt-0">
                     Morbi vehicula lacinia malesuada.
                     Nulla
                     placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam
                     elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes,
                     nascetur
                     ridiculus mus.
                 </v-card-text>--}}
                <v-divider></v-divider>
                <div id="" class="b-flex align-items-center justify-content-between  ">
                    <div>
                        <p class="px-4 mb-0" v-html="'Copyright © '+ year +' — '+ brand">
                            <a target="_blank" rel="noopener" href="#" class="grey--text text--lighten-1">Privacy Policy</a>
                            <span class="grey--text text--lighten-1">  &nbsp;|  &nbsp;</span>
                            <a target="_blank" rel="noopener" href="#" class="grey--text text--lighten-1">Cookie Policy</a>
                    </div>
                    <div></div>
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
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
</script>
<script type="text/javascript"> //<![CDATA[
    var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
    //]]></script>
<script language="JavaScript" type="text/javascript">
    TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_sm_124x32.png", "POSDV", "none");
</script>
</body>
</html>
