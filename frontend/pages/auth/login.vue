<script setup>
import Guest from "~/layouts/guest.vue";

const form = ref({
  email: '',
  password: '',
  remember: false,
});

const onSubmit = async () => {
  const response = await useApiFetch('api/login', {
    data: form.value,
    method: 'POST'
  })

  if (response.success) {
    navigateTo('/');
  }
  console.log(response);
}
</script>

<template>
  <guest>
    <form @submit.prevent="onSubmit">
      <div>
        <input-label for="email" value="Email"/>

        <text-input
            id="email"
            type="email"
            v-model="form.email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="username"
        />

        <!--                <InputError class="mt-2" :message="form.errors.email" />-->
      </div>

      <div class="mt-4">
        <input-label for="password" value="Password"/>

        <text-input
            id="password"
            type="password"
            v-model="form.password"
            class="mt-1 block w-full"
            required
            autocomplete="current-password"
        />

        <!--                <InputError class="mt-2" :message="form.errors.password" />-->
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <checkbox name="remember" v-model:checked="form.remember"/>
          <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <nuxt-link
            to="/"
            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        >
          Forgot your password?
        </nuxt-link>

        <primary-button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </primary-button>
      </div>
    </form>
  </guest>
</template>
