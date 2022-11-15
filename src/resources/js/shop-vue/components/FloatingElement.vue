<script setup>
defineProps({
    title: {
      type: String,
      default: null
    },
    name: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: null
    },

    // modelValue: {
    //   type: String,
    //   default: null
    // }
});

// defineEmits(['update:modelValue']);

const id = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
</script>
<template>
  <div class="form-floating">
    <slot :id="id" />
    <label :for="id">{{ title }}</label>
  </div>
</template>