<template>
  <dropdown
    class="mt-1"
    placement="bottom-end"
  >
    <div class="flex items-center cursor-pointer select-none group">
      <icon
        class="w-5 h-5 mx-1 group-hover:fill-orange-600 fill-gray-700 focus:fill-orange-600"
        name="user"
      />
      <div class="text-gray-700 group-hover:text-orange-600 focus:text-orange-600 mr-1 whitespace-no-wrap">
        <span>{{ $page.props.auth.user.name }}</span>
      </div>
      <icon
        class="w-5 h-5 group-hover:fill-orange-600 fill-gray-700 focus:fill-orange-600"
        name="cheveron-down"
      />
    </div>
    <template v-slot:dropdown>
      <div class="mt-2 py-2 shadow-xl bg-white rounded text-sm">

        <inertia-link
          class="block px-6 py-2 hover:bg-orange-500 hover:text-white"
          :href="route('settings')"
        >Jouw Instellingen</inertia-link>

        <inertia-link
          class="block px-6 py-2 hover:bg-orange-500 hover:text-white"
          :href="route('logout')"
          method="post"
        >Logout</inertia-link>
      </div>
    </template>
  </dropdown>
</template>

<script>
import Icon from "@/Shared/Icon";
import Dropdown from "@/Shared/Dropdown";

export default {
  name: "UserMenu",

  components: {
    Icon,
    Dropdown,
  },
};
</script>