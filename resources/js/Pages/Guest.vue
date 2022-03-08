<template>
  <div>
    <teleport to="head">
      <title>{{ title('Welkom') }}</title>
    </teleport>
    <div class="text-center pt-20 md:pt-0 max-w-xl my-5 mx-auto">
      <MainLogo />

      <guestmenu current="home"></guestmenu>
    </div>
    <div class="w-full bg-gray-300 border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
      <div class="w-full max-w-6xl mx-auto">

        <div v-show="dashboard">
          <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">
            <flash-messages />
            <landing />
          </div>
        </div>
        <div v-show="!dashboard">

          <flash-messages />
          <Dashboard />

        </div>
      </div>

    </div>
  </div>
</template>

<script>
import Guestmenu from "@/Shared/Guestmenu";
import FlashMessages from "@/Shared/FlashMessages";
import MainLogo from "@/Shared/MainLogo";
import landing from "@/Pages/Specials/landing";
import Dashboard from "@/Pages/Specials/Dashboard";

export default {
  name: "Guest",
  components: {
    Guestmenu,
    FlashMessages,
    MainLogo,
    landing,
    Dashboard,
  },
  data() {
    return {
      dashboard: true,
    };
  },
  mounted() {
    if (this.$page.props.clubs.clubs === false) {
      return (this.dashboard = false);
    }
  },
};
</script>
