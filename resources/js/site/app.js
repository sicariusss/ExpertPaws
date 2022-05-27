import {createApp} from 'vue'

require('../bootstrap')

require('../swiper-bundle.min')

import App from './App.vue'
import axios from 'axios'
import router from './router'

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')

import {library, dom} from "@fortawesome/fontawesome-svg-core";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {fas} from '@fortawesome/free-solid-svg-icons'
import {far} from '@fortawesome/free-regular-svg-icons';
import {fab} from '@fortawesome/free-brands-svg-icons';

library.add(fas, far, fab)
dom.watch();
app.component("font-awesome-icon", FontAwesomeIcon)

new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 20
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 20
        }
    }
});
