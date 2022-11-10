<script setup>
	import HeaderView from './components/partials/HeaderView.vue';
	import FooterView from './components/partials/FooterView.vue';
</script>
<template>
	<div class="container mt-5">
		<HeaderView/>
		<RouterView></RouterView>
		<FooterView/>
	</div>
</template>