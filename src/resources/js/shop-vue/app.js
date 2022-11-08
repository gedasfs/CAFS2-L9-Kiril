import './bootstrap';
import { createApp } from 'vue';
import Shop from './Shop.vue'
// import ProductView from './components/products/ProductView.vue';

const app = createApp(Shop);

// app.component('ProductView', ProductView);

app.mount('#shop');