import './bootstrap';
import { createApp } from 'vue';
import Router from './router';

import Shop from './Shop.vue'
import FloatingInput from './components/FloatingInput.vue';

const app = createApp(Shop);

app.use(Router);

app.component('FloatingInput', FloatingInput);

app.mount('#shop');