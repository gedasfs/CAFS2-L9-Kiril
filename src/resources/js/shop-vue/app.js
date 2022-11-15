import './bootstrap';
import { createApp } from 'vue';
import Router from './router';

import ShopApp from './ShopApp.vue'
import FloatingInput from './components/FloatingInput.vue';
import FloatingElement from './components/FloatingElement.vue';

const app = createApp(ShopApp);

app.use(Router);

app.component('FloatingInput', FloatingInput);
app.component('FloatingElement', FloatingElement);

app.mount('#shop');