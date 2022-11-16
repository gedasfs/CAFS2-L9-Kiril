<script setup>
import { onBeforeMount } from 'vue';
import { useRouter, useRoute, onBeforeRouteUpdate } from 'vue-router';
import { useCategoriesStore } from '@/stores/categories.js';
import { useProductStore } from '@/stores/product.js';

const productStore = useProductStore();
const categoriesStore = useCategoriesStore();

const router = useRouter();
const route = useRoute();

onBeforeMount(async () => {
    categoriesStore.load();
    
    if (route?.params?.product) {
        productStore.find(route.params.product);
    }
});

onBeforeRouteUpdate(async () => {
    productStore.$reset();
});

function onSaveButtonClick() {
    productStore.save().then(() => {
        router.push({
            name: 'products.view',
            params: {
                product: productStore.id
            }
        });
    });
}
</script>
<template>
  <div>
    <FloatingInput
      v-model="productStore.name"
      title="Product name"
      name="name"
      type="text"
    />

    <FloatingElement
      v-slot="{id}"
      title="Product description"
      :class="'mb-3'"
    >
      <textarea
        :id="id"
        v-model="productStore.description"
        placeholder="Product description"
        class="form-control"
        style="height: 100px"
      />
    </FloatingElement>

    <FloatingElement
      v-slot="{id}"
      title="Product category"
      :class="'mb-3'"
    >
      <select
        :id="id"
        v-model="productStore.category.id"
        class="form-select"
      >
        <option value="null">
          Choose category
        </option>
        <option
          v-for="category in categoriesStore.categories"
          :key="`cat-${category.id}`"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
    </FloatingElement>

    <FloatingInput
      v-model="productStore.identifier"
      title="Product identifier"
      name="identifier"
      type="text"
    />

    <button
      class="btn btn-success"
      @click="onSaveButtonClick"
    >
      Save
    </button>
  </div>
</template>