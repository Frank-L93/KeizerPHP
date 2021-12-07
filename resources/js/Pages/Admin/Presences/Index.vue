<template>
  <div>
    <teleport to="head">
      <title>{{ title("Admin - Presences") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Aanwezigheden</div>
      <div class="flex">
        <inertia-link
          v-show="Presences.length === 0"
          :href="route('admin.presences.create')"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
          as="button"
          method="post"
          type="button"
        >
          Genereer aanwezigheden
        </inertia-link>
        <inertia-link
          :href="route('admin.presences.singleCreate')"
          class="py-2 px-2 bg-red-400 hover:bg-red-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
          as="button"
          method="GET"
          type="button"
        >
          Voeg nieuwe aanwezigheden toe
        </inertia-link>
      </div>
    </div>

    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">
        <table class="sticky top-0 min-w-max w-full table-auto">
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-center">Gebruiker</th>
              <th class="py-3 px-6 text-center">Ronde</th>
              <th class="py-3 px-6 text-center">Aanwezigheid</th>
              <th class="py-3 px-6 text-center">Acties</th>
            </tr>
          </thead>
          <tbody
            v-for="(presence, key) in Presences"
            class="text-gray-600 text-sm font-light"
            v-bind:key="presence.id"
          >
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              :class="{ 'bg-gray-50': checkOdd(key) }"
            >
              <td>{{ presence.user.name }}</td>
              <td>{{ presence.date.date }}</td>
              <td>
                <div v-if="presence.presence === 1">Aanwezig</div>
                <div v-else>Afwezig</div>
              </td>
              <td>
                <div class="flex item-center justify-center">
                  <button @click="edit(presence.id)">
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                        />
                      </svg>
                    </div>
                  </button>
                  <button
                    v-if="1 === 1"
                    type="button"
                    @click="destroy(presence.id)"
                  >
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        />
                      </svg>
                    </div>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";

export default {
  layout: Layout,
  name: "Presences",
  props: {
    Presences: Array,
  },
  methods: {
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    destroy(presence_id) {
      this.$inertia.delete(this.route("admin.presence.delete", presence_id));
    },
    edit(presence_id) {
      this.$inertia.patch(this.route("admin.presence.edit", presence_id));
    },
  },
};
</script>

<style scoped>
</style>
