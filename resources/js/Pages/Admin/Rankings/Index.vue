<template>
  <div>
    <teleport to="head">
      <title>{{ title("Admin - Rankings") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Ranglijst</div>
      <div class="flex">
        <inertia-link
          v-show="Rankings.length === 0"
          :href="route('admin.rankings.create')"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
          as="button"
          method="post"
          type="button"
        >
          Genereer de eerste ranglijst
        </inertia-link>

      </div>
    </div>
    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">
        <form @submit.prevent="submit">
          <table class="sticky top-0 min-w-max w-full table-auto">
            <thead class="">
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center">Speler</th>
                <th class="py-3 px-6 text-center">Score</th>
                <th class="py-3 px-6 text-center hidden md:table-cell">
                  Partijscore
                </th>
                <th class="py-3 px-6 text-center">Waarde</th>
                <th class="py-3 px-6 text-center hidden md:table-cell">
                  Vorige waarde
                </th>
                <th class="py-3 px-6 text-center hidden md:table-cell">
                  Kleurbalans
                </th>
                <th class="py-3 px-6 text-center hidden md:table-cell">
                  Aantal gespeelde partijen
                </th>
                <th class="py-3 px-6 text-center hidden md:table-cell">TPR</th>
                <th class="py-3 px-6 text-center">Acties</th>
              </tr>
            </thead>
            <tbody
              v-for="(ranking, key) in Rankings.sort((a, b) => b.score - a.score)"
              class="text-gray-600 text-sm font-light"
              v-bind:key="ranking.id"
            >
              <tr
                class="border-b border-gray-200 hover:bg-gray-100"
                :class="{ 'bg-gray-50': checkOdd(key) }"
              >
                <td class="text-center">{{ ranking.user.name }}</td>
                <td class="text-center">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      size="6"
                      width="10"
                      step="0.1"
                      name="score"
                      class="py-0 mx-0 text-xs !important"
                      v-model.lazy="ranking.score"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>{{ ranking.score }}</div>
                </td>
                <td class="text-center hidden md:table-cell">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      name="gamescore"
                      v-model="ranking.gamescore"
                      class="py-0 mx-0 text-xs !important"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>{{ ranking.gamescore }}</div>
                </td>
                <td class="text-center">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      name="value"
                      class="py-0 mx-0 text-xs !important"
                      v-model="ranking.value"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>{{ ranking.value }}</div>
                </td>
                <td class="text-center hidden md:table-cell">{{ ranking.LastValue }}</td>
                <td class="text-center hidden md:table-cell">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      name="color"
                      v-model="ranking.color"
                      class="py-0 mx-0 text-xs !important"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>
                    <div v-if="ranking.color == NULL">-</div>
                    <div v-else>{{ ranking.color }}</div>
                  </div>
                </td>
                <td class="text-center hidden md:table-cell">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      name="amount"
                      v-model="ranking.amount"
                      class="py-0 mx-0 text-xs !important"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>{{ ranking.amount }}</div>
                </td>
                <td class="text-center hidden md:table-cell">
                  <div v-if="disabled === ranking.id">
                    <input
                      type="number"
                      name="TPR"
                      v-model="ranking.TPR"
                      class="py-0 mx-0 text-xs !important"
                      v-on:keyup.enter="enable(ranking)"
                    />
                  </div>
                  <div v-else>{{ ranking.TPR }}</div>
                </td>

                <td class="text-center">
                  <div class="flex item-center justify-center">
                    <button
                      type="button"
                      @click="enable(ranking) "
                    >
                      <div
                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                        v-if="disabled === ranking.id"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path d="M17.064,4.656l-2.05-2.035C14.936,2.544,14.831,2.5,14.721,2.5H3.854c-0.229,0-0.417,0.188-0.417,0.417v14.167c0,0.229,0.188,0.417,0.417,0.417h12.917c0.229,0,0.416-0.188,0.416-0.417V4.952C17.188,4.84,17.144,4.733,17.064,4.656M6.354,3.333h7.917V10H6.354V3.333z M16.354,16.667H4.271V3.333h1.25v7.083c0,0.229,0.188,0.417,0.417,0.417h8.75c0.229,0,0.416-0.188,0.416-0.417V3.886l1.25,1.239V16.667z M13.402,4.688v3.958c0,0.229-0.186,0.417-0.417,0.417c-0.229,0-0.417-0.188-0.417-0.417V4.688c0-0.229,0.188-0.417,0.417-0.417C13.217,4.271,13.402,4.458,13.402,4.688"></path>
                        </svg>
                      </div>
                      <div
                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                        v-else
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                      </div>
                    </button>
                    <button
                      v-if="1 === 1"
                      type="button"
                      @click="destroy(ranking.id)"
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
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import TextInput from "@/Shared/TextInput";

export default {
  layout: Layout,
  name: "Index",
  components: {
    TextInput,
  },
  props: {
    Rankings: Array,
  },
  data() {
    return {
      disabled: null,
    };
  },
  methods: {
    enable(rankingID) {
      if (this.disabled == rankingID.id) {
        this.disabled = null;
        this.$inertia.patch(this.route("admin.rankings.patch", rankingID), {
          preserveScroll: true,
        });
      } else {
        this.disabled = rankingID.id;
      }
      return this.disabled;
    },
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    destroy(ranking_id) {
      this.$inertia.delete(this.route("admin.ranking.delete", ranking_id));
    },
  },
};
</script>

<style scoped>
</style>
