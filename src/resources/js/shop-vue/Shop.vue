<script setup>
	import { reactive, ref } from 'vue';

	const state = reactive({
		counter: 0,
		// someText: null
	});

	function increments() {
		state.counter++;
	}

	const someText = ref(null);

	function setSomeText(event) {
		someText.value = event.target.value;
	}
</script>
<template>
	<h1>Counter: {{ state.counter }}</h1>
	<button @click="increments">Increment</button>
	<h1>{{ someText }}</h1>
	<input type="text" @input="event => someText = event.target.value">
	<input type="text" @input="setSomeText">
</template>