<script setup lang="ts">
import {onMounted, ref} from 'vue';

defineProps({
  modelValue: {
    type: String,
    required: true,
  },
});

const emits = defineEmits(['update:modelValue']);

const input = <any>ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
  <input
      class="p-3 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
      :value="modelValue"
      @input="emits('update:modelValue', $event.target.value)"
      ref="input"
  />
</template>
