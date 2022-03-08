<template>
  <div class="block md:inline-flex top-0 w-full overflow-auto border-gray-200">
    <inertia-link
      v-show="current != 'login'"
      :href="route('login')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Login</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'home'"
      :href="route('home')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Home</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'registerClub'"
      :href="route('register')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Registreer je vereniging</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'about'"
      :href="route('about')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Over SchaakManager</span>
      </div>
    </inertia-link>
    <inertia-link
      v-show="current != 'help'"
      :href="route('help')"
      class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
    >
      <div class="text-center">
        <span class="block text-sm leading-none">Help</span>
      </div>
    </inertia-link>
    <div v-if="this.club === null">
      <dropdown
        class="flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-orange-500"
        placement="bottom-end"
      >

        <div class="text-center">
          <span class="block text-sm leading-none">Kies je favoriete club</span>
        </div>
        <icon
          class="w-5 h-5 group-hover:fill-orange-600 fill-gray-700 focus:fill-orange-600"
          name="cheveron-down"
        />
        <template v-slot:dropdown>
          <div class="mt-2 py-2 shadow-xl bg-white rounded text-sm">
            <div
              v-for="clubs in $page.props.clubs.clubs"
              :key="clubs.id"
            >
              <button
                class="block px-6 py-2 hover:bg-orange-500 hover:text-white"
                @click="setFavoriteClub(clubs.id)"
              >{{clubs.name}}</button>
            </div>

          </div>
        </template>
      </dropdown>
    </div>
  </div>
</template>

<script>
import Dropdown from "@/Shared/Dropdown";
import Icon from "@/Shared/Icon";

export default {
  props: {
    current: String,
  },
  components: {
    Icon,
    Dropdown,
  },
  data() {
    return {
      club: null,
    };
  },
  mounted() {
    const club = this.$cookies.get("club");
    return (this.club = club);
  },
  methods: {
    setFavoriteClub(favoriteClub) {
      this.$inertia.visit(this.route("setFavoriteClub"), {
        data: { favoriteClub },
      });
    },
  },
  name: "Guestmenu",
};
</script>

