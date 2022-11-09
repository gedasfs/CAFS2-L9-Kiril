<script setup>
defineProps({
    title: String,
    name: String,
    type: String,

    modelValue: String
});

defineEmits(['update:modelValue']);

const inputId = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
</script>
<template>
    <div class="form-floating mb-3">
        <input :type="type" class="form-control" :id="inputId" :placeholder="title" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <label :for="inputId">{{ title }}</label>
    </div>
</template>