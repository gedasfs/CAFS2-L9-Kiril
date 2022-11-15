import { createWebHistory, createRouter } from 'vue-router';

import ProductsView from './components/products/ProductsView.vue';
// import SingleProductView from './components/products/SingleProductView.vue';

const SingleProductView = () => import('./components/products/SingleProductView.vue');
const ManageProductView = () => import('./components/products/ManageProductView.vue');

const router = createRouter({
	history: createWebHistory('/spa'),
	
	routes: [
		{
			path: '/',
			component: ProductsView,
			name: 'products.index'
		},
		{
			path: '/products/manage/:product?',
			component: ManageProductView,
			name: 'products.manage'
		},
		{
			path: '/products/:product',
			component: SingleProductView,
			name: 'products.view'

		},
	],
});

export default router;