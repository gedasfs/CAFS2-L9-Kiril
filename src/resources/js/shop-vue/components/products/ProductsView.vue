<script setup>
import FilterProducts from './partials/FilterProducts.vue';

import axios from 'axios';
import { ref, onBeforeMount} from 'vue';

const products = ref([]);
const productCategories = ref([]);

async function getProducts(filters = {}) {
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

function loadProducts(filters = {}) {
	getProducts(filters).then(_products => products.value = _products);
}

onBeforeMount(async () => {
	let categoriesResponse = await axios.get('/api/v1/products/categories');
	
	productCategories.value = categoriesResponse.data.data;

	loadProducts();
});
</script>
<template>
  <FilterProducts
    :categories="productCategories"
    title="Filters:"
    @on-filter-change="loadProducts"
  />
  <div
    v-if="products.length > 0"
    class="row row-cols-1 row-cols-md-3 mb-3 text-center"
  >
    <div
      v-for="(product, index) in products"
      :key="`p-${index}`"
      class="col"
    >
      <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3 d-flex justify-content-between">
          <h4 class="my-0 fw-normal">
            #{{ product.id }} {{ product.name }}
          </h4>
          <RouterLink
            :to="{name: 'products.manage', params: {product: product.id}}"
            class="btn btn-warning"
          >
            Edit
          </RouterLink>
        </div>
        <div class="card-body">
          <h3>{{ product.description }}</h3>
          <RouterLink
            :to="{name: 'products.view', params: {product: product.id}}"
            type="button"
            class="w-100 btn btn-lg btn-outline-primary"
          >
            View
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
  <h3 v-else>
    Products not found
  </h3>
</template>