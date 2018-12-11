require('./bootstrap');

import router from './routes';
import store from './stores/index';
import {
    bulmaCarousel
} from 'bulma-extensions';

Vue.component('navbar', require('./components/layout/Navbar.vue'));
Vue.component('single-image-upload', require('./components/uploads/SingleImageUpload.vue'));


const app = new Vue({
    el: '#app',
    router,
    store
});

let carousels = bulmaCarousel.attach();
