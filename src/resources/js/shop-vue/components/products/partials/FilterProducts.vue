<script setup>
import { ref, reactive, } from 'vue';

defineProps({
	categories: {
		type: Array,
		default: function() {
      return [];
    }
	},

	title: {
    type: String,
    default: null
  }
});

const emit = defineEmits(['on-filter-change']);

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
	emit('on-filter-change', filters);
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
    <h1 v-if="title">
      {{ title }}
    </h1>

    <div
      v-if="categories.length > 0"
      class="col-12"
    >
      <label
        class="visually-hidden"
        for="category"
      >Category</label>
      <select
        id="category"
        v-model="filters.categoryId"
        class="form-select"
        name="category_id"
        :disabled="isRequestInProgress"
      >
        <option value="null">
          Choose category
        </option>
        <option
          v-for="category in categories"
          :key="`cat-${category.id}`"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
    </div>
    <div class="col-12">
      <div class="input-group">
        <span
          id="search"
          class="input-group-text"
        >Search</span>
        <input
          v-model.lazy="filters.search"
          type="text"
          class="form-control"
          placeholder="Enter something..."
          aria-describedby="search"
          name="search"
          :disabled="isRequestInProgress"
        >
      </div>
      <!-- <FloatingInput title="search" name="search" v-model="filters.search"/> -->
    </div>
    <div class="col-12">
      <label
        class="visually-hidden"
        for="order_by"
      >Order By</label>
      <select
        id="order_by"
        v-model="filters.orderBy"
        class="form-select"
        name="order_by"
        :disabled="isRequestInProgress"
      >
        <option
          v-for="(orderByTitle, value) in orderByValues"
          :key="value"
          :value="value"
        >
          {{ orderByTitle }}
        </option>
      </select>
    </div>
    <div class="col-12">
      <button
        type="submit"
        class="btn btn-primary me-1"
        @click="onFiltersSubmit"
      >
        Submit
      </button>
      <button
        type="submit"
        class="btn btn-warning"
        @click="onFiltersClear"
      >
        Clear
      </button>
    </div>
  </div>
</template>