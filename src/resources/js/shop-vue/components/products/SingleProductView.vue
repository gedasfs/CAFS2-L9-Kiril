<script setup>
	import { ref } from 'vue';
    import { useRoute } from 'vue-router';
    import { useProductStore } from '@/stores/product.js';
    import ManageProductView from './ManageProductView.vue';

	const productStore = useProductStore();

    const route = useRoute();

    const showModal = ref(false);

    productStore.find(route?.params?.product)
</script>
<template>
  <div
    v-if="productStore.id"
    class="row"
  >
    <div class="col-12">
      <div class="text-end mb-2">
        <RouterLink
          :to="{name: 'products.manage', params: {product: productStore.id}}"
          class="btn btn-warning me-2"
        >
          Edit
        </RouterLink>
        <button
          class="btn btn-danger"
          @click="showModal = true"
        >
          Edit Now
        </button>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div
        id="carouselExampleIndicators"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="0"
            class=""
            aria-label="Slide 1"
          />
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="1"
            aria-label="Slide 2"
            class=""
          />
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="2"
            aria-label="Slide 3"
            class="active"
            aria-current="true"
          />
        </div>
        <div class="carousel-inner">
          <div class="carousel-item">
            <svg
              class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
              width="800"
              height="400"
              xmlns="http://www.w3.org/2000/svg"
              role="img"
              aria-label="Placeholder: First slide"
              preserveAspectRatio="xMidYMid slice"
              focusable="false"
            >
              <title>Placeholder</title>
              <rect
                width="100%"
                height="100%"
                fill="#777"
              />
              <text
                x="50%"
                y="50%"
                fill="#555"
                dy=".3em"
              >First slide</text>
            </svg>
          </div>
          <div class="carousel-item">
            <svg
              class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
              width="800"
              height="400"
              xmlns="http://www.w3.org/2000/svg"
              role="img"
              aria-label="Placeholder: Second slide"
              preserveAspectRatio="xMidYMid slice"
              focusable="false"
            >
              <title>Placeholder</title>
              <rect
                width="100%"
                height="100%"
                fill="#666"
              />
              <text
                x="50%"
                y="50%"
                fill="#444"
                dy=".3em"
              >Second slide</text>
            </svg>
          </div>
          <div class="carousel-item active">
            <svg
              class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
              width="800"
              height="400"
              xmlns="http://www.w3.org/2000/svg"
              role="img"
              aria-label="Placeholder: Third slide"
              preserveAspectRatio="xMidYMid slice"
              focusable="false"
            >
              <title>Placeholder</title>
              <rect
                width="100%"
                height="100%"
                fill="#555"
              />
              <text
                x="50%"
                y="50%"
                fill="#333"
                dy=".3em"
              >Third slide</text>
            </svg>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev"
        >
          <span
            class="carousel-control-prev-icon"
            aria-hidden="true"
          />
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next"
        >
          <span
            class="carousel-control-next-icon"
            aria-hidden="true"
          />
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="h-100 p-5 bg-light border rounded-3">
        <h2> {{ productStore.name }}</h2>
        <p> {{ productStore.description }}</p>
      </div>
    </div>
  </div>
  <BootstrapModal
    :show-modal="showModal"
    @onBootstrapModalClose="showModal = false"
  >
    <ManageProductView />
  </BootstrapModal>
</template>