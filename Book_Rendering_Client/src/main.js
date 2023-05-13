import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import AOS from "aos"


//Style
import 'aos/dist/aos.css'


library.add(fas, far, fab)
dom.watch();

import App from './App.vue'
import router from './router'
import naive from "naive-ui";
import './index.css'
const config = {
    duration: 850,
    once: false
}
const app = createApp(App)
app.use(createPinia())
app.use(router)
app.use(AOS.init(config))
app.component("font-awesome-icon", FontAwesomeIcon)
app.use(naive);
app.mount('#app')


