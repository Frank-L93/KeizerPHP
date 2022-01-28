<template>
  <div class="block z-10 bg-white absolute top-0 w-full overflow-auto border-gray-200 md:flex">
    <inertia-link
      v-show="current != 'login'"
      :href="route('login')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Login</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'home'"
      :href="route('home')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Home</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'registerClub'"
      :href="route('register')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Registreer je vereniging</span>
      </div>
    </inertia-link>
    <inertia-link
      :href="route('about')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Over KeizerPHP</span>
      </div>
    </inertia-link>
    <inertia-link
      :href="route('help')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Help</span>
      </div>
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: {
    current: String,
  },
  name: "Guestmenu",
};
</script>

<style scoped>
</style>
