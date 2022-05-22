import {createApp} from 'vue'

require('../bootstrap')

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
