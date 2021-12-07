<template>
  <div class="w-100">
    <div class="mb-4">
      <inertia-link
        class="flex items-center group py-3"
        :href="route('dashboard')"
      >
        <icon
          name="dashboard"
          class="w-4 h-4 mr-2"
          :class="isUrl('/$') ? 'text-white' : 'text-blue-400 group-hover:fill-white'"
        />
        <div :class="isUrl('/') ? 'text-white' : 'text-gray-500 group-hover:text-orange-400'">Dashboard</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link
        class="flex items-center group py-3"
        :href="route('presences')"
      >
        <icon
          name="office"
          class="w-4 h-4 mr-2"
          :class="isUrl('/presences*') ? 'fill-white' : 'fill-blue-400 group-hover:fill-white'"
        />
        <div :class="isUrl('/presences*') ? 'text-white' : 'text-gray-500 group-hover:text-orange-400'">Aanwezigheden</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link
        class="flex items-center group py-3"
        :href="route('games')"
        :data="{round: $page.props.club.details.veryFirstRound.uuid}"
      >
        <icon
          name="users"
          class="w-4 h-4 mr-2"
          :class="isUrl('/games*') ? 'fill-white' : 'fill-blue-400 group-hover:fill-white'"
        />
        <div :class="isUrl('/games*') ? 'text-white' : 'text-gray-500 group-hover:text-orange-400'">Partijen</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link
        class="flex items-center group py-3"
        :href="route('rankings')"
      >
        <icon
          name="printer"
          class="w-4 h-4 mr-2"
          :class="isUrl('/rankings*') ? 'fill-white' : 'fill-blue-400 group-hover:fill-white'"
        />
        <div :class="isUrl('/rankings*') ? 'text-white' : 'text-gray-500 group-hover:text-orange-400'">Ranglijst</div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from "@/Shared/Icon";

export default {
  name: "MainMenu",
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
  components: {
    Icon,
  },
};
</script>
