<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <nuxt-link to="/">
        <div class="w-20 h-20 fill-current text-gray-500">
          Nuxt APP
        </div>
        <!--        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
      </nuxt-link>
    </div>

    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
    >
      <slot></slot>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>