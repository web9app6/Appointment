/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('internal-chat-component', require('./components/InternalChatComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueChatScroll from 'vue-chat-scroll'
import VueTimeago from 'vue-timeago';
import VueSweetalert2 from 'vue-sweetalert2';
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);
Vue.use(VueSweetalert2);
Vue.use(VueChatScroll)


Vue.use(VueTimeago, {
    name: 'Timeago', // component name, `timeago` by default
    locale: 'en', // Default locale
    locales: {
      ar: require('date-fns/locale/ar')
    }    
})

const app = new Vue({
    el: '#app',
});
