/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import vueHeadful from 'vue-headful';
import {VTooltip, VPopover, VClosePopover} from 'v-tooltip'
import Vuetify from 'vuetify'

import 'vuetify/dist/vuetify.min.css'
import 'babel-polyfill'
import 'vuetify/src/stylus/app.styl'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

VTooltip.options.popover.defaultPlacement = 'bottom-end';
Vue.component('vue-headful', vueHeadful);
Vue.directive('tooltip', VTooltip);
Vue.directive('close-popover', VClosePopover);
Vue.component('v-popover', VPopover);
Vue.use(BootstrapVue);
Vue.use(Vuetify);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('categories-component', require('./components/backroom/CategoriesComponent.vue').default);
Vue.component('categoriesside-component', require('./components/backroom/CategoriesSideComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {HalfCircleSpinner} from 'epic-spinners'

const app = new Vue({
    el: '#app',
    data: {
        currentRoute: window.location.pathname,
        drawer: false,
        year: new Date().getFullYear(),
        brand: 'CFSCastillo',
        tile: false,
        color: 'accent',
        img: false,
        scrolledToBottom: false,
        scrolledTop: true,
        transparentNav: 'transparentNav',
        loaded: false,
        siteStart: false,
        homePageClass: "",
    },
    methods: {
        scroll() {
            window.onscroll = () => {
                let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight;
                let topOfWindow = window.pageYOffset;
                this.scrolledTop = !topOfWindow;
                if (this.scrolledTop) {
                    this.transparentNav = 'transparentNav';
                } else {
                    this.transparentNav = '';
                }
            }

        },
        loadSite() {
            setTimeout(() => {
                this.loadIt()
            }, 1500);

        },
        startSite() {
            setTimeout(() => {
                this.siteStart = true
            }, 500);

        },
        loadIt() {
            this.loaded = true;
        }
    },
    beforeMount() {


    },
    created() {


    },
    mounted() {
        this.startSite();
        this.homePageClass = this.currentRoute === "/" ? "homePageClass" : "notHomePageClass";
        this.scroll();
        this.loadSite();

    },
    components: {
        HalfCircleSpinner
    }
});
