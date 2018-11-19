require('./bootstrap');

import router from './routes';

Vue.component('navbar', require('./components/layout/Navbar.vue'));
Vue.component('single-image-upload', require('./components/uploads/SingleImageUpload.vue'));


const app = new Vue({
    el: '#app',
    router,
});
