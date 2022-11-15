<script setup>
import axios from 'axios';
import { reactive, onBeforeMount, toRaw } from 'vue';
import { useRouter, useRoute, onBeforeRouteUpdate } from 'vue-router';

function getInitialProductState() {
    return {
        id: null,
        name: null,
        description: null,
        category: {
            id: null
        },
        identifier: null
    };
}

const product = reactive(getInitialProductState());

const productCategories = reactive([]);

const router = useRouter();
const route = useRoute();

onBeforeMount(async () => {
    let categoriesResponse = await axios.get('/api/v1/products/categories');
    
    Object.assign(productCategories, categoriesResponse.data.data)

    if (route?.params?.product) {
        axios.get(`/api/v1/products/${route?.params?.product}`).then(response => Object.assign(product, response.data.data)
        );
    }
});

onBeforeRouteUpdate(async () => {
    Object.assign(product, getInitialProductState());
});

function onSaveButtonClick() {
    const productRaw = toRaw(product);

    let url = '/api/v1/products';

    if (productRaw.id) {
        url += '/' + productRaw.id;
    }

    if (productRaw.category?.id) {
        productRaw.category_id = productRaw.category.id;

        delete productRaw.category;
    }

    axios({
        method: productRaw.id ? 'patch' : 'post',
        url: url,
        data: productRaw
    }).then(response => {
        router.push({
            name: 'products.view',
            params: {
                product: response.data.data.id
            }
        });
    });
}
</script>
<template>
  <div>
    <FloatingInput
      v-model="product.name"
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
        v-model="product.description"
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
        v-model="product.category.id"
        class="form-select"
      >
        <option value="null">
          Choose category
        </option>
        <option
          v-for="category in productCategories"
          :key="`cat-${category.id}`"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
    </FloatingElement>

    <FloatingInput
      v-model="product.identifier"
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