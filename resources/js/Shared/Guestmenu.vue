<template>
  <div class="block z-10 bg-white absolute top-0 w-full overflow-auto border-gray-200 md:flex">
    <inertia-link
      :href="route('login')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-indigo-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Login</span>
      </div>
    </inertia-link>
    <inertia-link
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
  name: "Guestmenu",
};
</script>

<style scoped>
</style>
