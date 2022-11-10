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

    modelValue: {
      type: String,
      default: null
    }
});

defineEmits(['update:modelValue']);

const inputId = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
</script>
<template>
  <div class="form-floating mb-3">
    <input
      :id="inputId"
      :type="type"
      class="form-control"
      :placeholder="title"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    >
    <label :for="inputId">{{ title }}</label>
  </div>
</template>