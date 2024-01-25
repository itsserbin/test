<template>
  <div>
    <Button label="Submit" @click="todo"/>

  </div>
</template>

<script setup>
const response = await $fetch('http://localhost:48080/sanctum/csrf-cookie', {
  credentials: 'include'
});


const token = useCookie('XSRF-TOKEN')

const todo = async () => await $fetch('http://localhost:48080/api/register', {
  credentials: 'include',
  method: 'POST',
  watch: false,
  body: {
    name: 'test',
    email: 'test@test.test',
    password: 'password',
    password_confirmation: 'password',
  },
  headers:{
    'X-XSRF-TOKEN': token.value
  }
});
//
// const test = async () => {
//   const token = await $fetch('http://localhost:48080/sanctum/csrf-cookie');
//   console.log(token);
// }

// await test();
</script>