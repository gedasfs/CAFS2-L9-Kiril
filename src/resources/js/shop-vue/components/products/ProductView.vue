<script setup>
import FilterProducts from './partials/FilterProducts.vue';

import axios from 'axios';
import { ref, reactive, onBeforeMount, watch } from 'vue';

const products = ref([]);

const filters = {};

async function getProducts(facorites  = false) {
	const urlSearchParams = new URLSearchParams();

	if (filters.categoryId) {
		urlSearchParams.set('category_id', filters.categoryId);
	}

	if (filters.search) {
		urlSearchParams.set('search', filters.search);
	}

	if (filters.orderBy) {
		urlSearchParams.set('order_by', filters.orderBy);
	}

	let response = await axios.get('/api/v1/products?' + urlSearchParams.toString());

	return response.data.data;
}

onBeforeMount(async () => {
	let categoriesResponse = await axios.get('/api/v1/products/categories');

	products.value = await getProducts();
});
</script>
<template>
	<FilterProducts/>
	<div v-if="products.length > 0" class="row row-cols-1 row-cols-md-3 mb-3 text-center">
	    <div v-for="product in products" class="col">
	        <div class="card mb-4 rounded-3 shadow-sm">
	            <div class="card-header py-3">
	                <h4 class="my-0 fw-normal">#{{ product.id }} {{ product.name }}</h4>
	            </div>
	            <div class="card-body">
	                <h3>{{ product.description }}</h3>
	                <a :href="`/products/${product.id}/show`" type="button" class="w-100 btn btn-lg btn-outline-primary">View</a>
	            </div>
	        </div>
	    </div>
	</div>
	<h3 v-else>Products not found</h3>
</template>