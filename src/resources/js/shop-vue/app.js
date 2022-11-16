import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

import Router from './router';

import ShopApp from './ShopApp.vue'
import FloatingInput from './components/FloatingInput.vue';
import FloatingElement from './components/FloatingElement.vue';
import BootstrapModal from './components/BootstrapModal.vue';

const pinia = createPinia()

const app = createApp(ShopApp);

app.use(pinia);
app.use(Router);

app.component('FloatingInput', FloatingInput);
app.component('FloatingElement', FloatingElement);
app.component('BootstrapModal', BootstrapModal);

app.mount('#shop');