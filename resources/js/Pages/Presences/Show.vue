<template>
  <div>
    <teleport to="head">
      <title>{{ title('Presences') }}</title>
    </teleport>
    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Aanwezigheden</div>
      <div class="flex">
        <button
          @click="add"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
        >
          Voeg aanwezigheden toe
        </button>
      </div>
    </div>

    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">

        <table class="sticky top-0 min-w-max w-full table-auto">
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
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

              <td class="py-3 px-6 text-center">{{presence.date.round }} - {{ formattedDate(presence.date.date)}}</td>
              <td class="py-3 px-6 text-center">
                <div v-if="presence.presence === 1">Aanwezig</div>
                <div v-else>Afwezig</div>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                  <div v-if="$page.props.club.details.lastProcessed === NULL">
                  </div>
                  <div v-else>
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
                  </div>
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
import moment from "moment";

export default {
  name: "ShowPresences",
  layout: Layout,
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
    add() {
      this.$inertia.visit("/presences/create");
    },
    edit(presence_id) {
      this.$inertia.patch(this.route("presence.edit", presence_id));
    },
    formattedDate(originalDate) {
      var day = moment(originalDate);
      return day.format("DD-MM-YYYY");
    },
  },
};
</script>
