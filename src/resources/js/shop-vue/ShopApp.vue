<script setup>
	import HeaderView from './components/partials/HeaderView.vue';
	import FooterView from './components/partials/FooterView.vue';
</script>
<template>
  <div class="container mt-5">
    <HeaderView />
    <div class="text-end mb-3">
      <RouterLink
        :to="{name: 'products.manage'}"
        class="btn btn-success"
      >
        Create Product
      </RouterLink>
    </div>
    <RouterView />
    <FooterView />
  </div>
</template>