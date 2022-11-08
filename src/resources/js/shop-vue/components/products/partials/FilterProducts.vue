<script setup>
import axios from 'axios';
import { ref, reactive, onBeforeMount, watch } from 'vue';

const isRequestInProgress = ref(false);

const categories = ref([]);
const orderByValues = {
    'created_at' : 'Newest first',
    'name:asc'   : 'Name Accessing',
    'name:desc'  : 'Name Descending',
    'price:asc'  : 'Price Accessing',
    'price:desc' : 'Price Descending',
    'identifier:asc' : 'Identifier Accessing',
    'identifier:desc' : 'Identifier Descending',
};

const filters = reactive({
	categoryId: null,
	search: null,
	orderBy: 'created_at'
});

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

	isRequestInProgress.value = true;

	let response = await axios.get('/api/v1/products?' + urlSearchParams.toString());

	isRequestInProgress.value = false;

	return response.data.data;
}

onBeforeMount(async () => {
	let categoriesResponse = await axios.get('/api/v1/products/categories');

	categories.value = categoriesResponse.data.data;
});

// watch(filters, async (newValue, oldValue) => {
// 	products.value = await getProducts();
// });

// watch(filters, (newValue, oldValue) => {
// 	getProducts().then(p => products.value = p);
// });

function onFiltersSubmit() {
	// getProducts().then(p => products.value = p);
}

function onFiltersClear() {
	filters.categoryId = null;
	filters.search = null;
	filters.orderBy = 'created_at';

	// onFiltersSubmit();
}
</script>
<template>
	<div class="row row-cols-lg-auto g-3 align-items-center mb-3">
		<div class="col-12">
			<label class="visually-hidden" for="category">Category</label>
			<select class="form-select" id="category" name="category_id" v-model="filters.categoryId" :disabled="isRequestInProgress">
				<option value="null">Choose category</option>
				<option v-for="category in categories" :value="category.id" :key="`cat-${category.id}`">{{ category.name }}</option>
			</select>
		</div>
		<div class="col-12">
			<div class="input-group">
				<span class="input-group-text" id="search">Search</span>
				<input type="text" class="form-control" placeholder="Enter something..." aria-describedby="search" name="search"  v-model.lazy="filters.search" :disabled="isRequestInProgress">
			</div>
		</div>
		<div class="col-12">
			<label class="visually-hidden" for="order_by">Order By</label>
			<select class="form-select" id="order_by" name="order_by" v-model="filters.orderBy" :disabled="isRequestInProgress">
				<option v-for="(title, value) in orderByValues" :value="value" :key="value">{{ title }}</option>
			</select>
		</div>
		<div class="col-12">
			<button type="submit" class="btn btn-primary me-1" @click="onFiltersSubmit">Submit</button>
			<button type="submit" class="btn btn-warning" @click="onFiltersClear">Clear</button>
		</div>
	</div>
</template>