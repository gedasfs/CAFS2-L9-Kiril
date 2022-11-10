import './bootstrap';
import { createApp } from 'vue';
import Router from './router';

import ShopApp from './ShopApp.vue'
import FloatingInput from './components/FloatingInput.vue';

const app = createApp(ShopApp);

app.use(Router);

app.component('FloatingInput', FloatingInput);

app.mount('#shop');