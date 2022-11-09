<script setup>
import { ref, reactive, watch } from 'vue';

const props = defineProps({
	categories: {
		type: Array,
		default: []
	},

	title: String
});

const emit = defineEmits(['onFilterChange']);

const isRequestInProgress = ref(false);

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

// watch(filters, async (newValue, oldValue) => {
// 	onFiltersSubmit();
// });

function onFiltersSubmit() {
	emit('onFilterChange', filters);
}

function onFiltersClear() {
	filters.categoryId = null;
	filters.search = null;
	filters.orderBy = 'created_at';

	onFiltersSubmit();
}
</script>
<template>
	<div class="row row-cols-lg-auto g-3 align-items-center mb-3">
		<h1 v-if="title">{{ title }}</h1>

		<div class="col-12" v-if="categories.length > 0">
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
			<!-- <FloatingInput title="search" name="search" v-model="filters.search"/> -->
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