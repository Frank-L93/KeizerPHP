<template>
  <div>
    <div class="md:flex md:flex-col">
      <div class="md:h-screen md:flex md:flex-col">
        <div class="md:flex md:flex-shrink-0">
          <div class="bg-white border-b md:flex-shrink-0 md:w-100 px-6 py-4 flex items-center justify-between md:justify-center">
            <inertia-link
              class="mt-1"
              href="/"
            >
              <Logo />
            </inertia-link>

            <dropdown class="md:hidden">
              <svg
                class="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
              </svg>
              <template v-slot:dropdown>
                <div class="mt-2 px-8 py-4 shadow-lg bg-white rounded">
                  <main-menu />
                </div>
              </template>
            </dropdown>

          </div>
          <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-end items-center">
            <!-- Admin Menu -->
            <AdminMenu />
            <!-- User Menu -->
            <UserMenu />

          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <main-menu class="hidden md:block bg-gray-200 flex-shrink-0 md:w-100 p-12 overflow-y-auto" />
          <div
            class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto"
            scroll-region
          >
            <flash-messages />
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MainMenu from "@/Shared/MainMenu";
import SideBar from "@/Shared/SideBar";
import FlashMessages from "@/Shared/FlashMessages";
import Dropdown from "@/Shared/Dropdown";
import Icon from "@/Shared/Icon";
import Logo from "@/Shared/Logo";
import AdminMenu from "@/Shared/AdminMenu";
import UserMenu from "@/Shared/UserMenu";

export default {
  name: "Layout",
  components: {
    Logo,
    FlashMessages,
    MainMenu,
    SideBar,
    Dropdown,
    Icon,
    AdminMenu,
    UserMenu,
  },
};
</script>

<style scoped>
</style>
