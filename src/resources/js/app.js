import * as bootstrap from 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import {createApp} from 'vue'

import store from './store/index'
import Notifications from '@kyvg/vue3-notification'
import App from "./components/App.vue";

createApp(App).use(store).use(Notifications).mount("#app")
