<template>
  <div>
    <teleport to="head">
      <title>{{ title("Admin - Rounds") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Rondes</div>
      <div class="flex">
        <inertia-link
          :href="route('admin.rounds.create')"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
        >
          Voeg rondes toe
        </inertia-link>
      </div>
    </div>
    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">
        <table class="sticky top-0 min-w-max w-full table-auto">
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-center">Ronde</th>
              <th class="py-3 px-6 text-center">Datum</th>
              <th class="py-3 px-6 text-center">Acties</th>
            </tr>
          </thead>
          <tbody
            v-for="(round, key) in Rounds"
            class="text-gray-600 text-sm font-light"
            v-bind:key="round.id"
          >
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              :class="{ 'bg-gray-50': checkOdd(key) }"
            >
              <td class="py-3 px-6 text-center">
                {{ round.round }}
              </td>
              <td class="py-3 px-6 text-center">
                {{ round.date }}
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                  <button
                  v-if="round.published === 0"
                    type="button"
                    @click="publish(round.id)"
                  >
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                     <svg   xmlns="http://www.w3.org/2000/svg"
                        fill="none" class="svg-icon" viewBox="0 0 24 24" stroke="currentColor">
							<path    stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2" d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
						</svg>
                    </div>
                  </button>
                  <button
                    type="button"
                    @click="edit(round.id)"
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
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                        />
                      </svg>
                    </div>
                  </button>
                  <button
                    v-if="round.processed === null"
                    type="button"
                    @click="destroy(round.id)"
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
  name: "Index",
  props: {
    Rounds: Array,
  },

  methods: {
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    destroy(roundid) {
      this.$inertia.delete(this.route("admin.rounds.delete", roundid));
    },
    edit(roundid) {
      this.$inertia.patch(this.route("admin.rounds.patch", roundid));
    },
    publish(roundid) {
      this.$inertia.patch(this.route("admin.rounds.publish", roundid));
    },
  },
};
</script>

<style scoped>
</style>
