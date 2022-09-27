<template>
  <div>
    <teleport to="head">
      <title>{{ title("Admin - Games") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Partijen</div>
      <div class="flex">
        <inertia-link
          :href="route('admin.rankings.process')"
          class="py-2 px-2 bg-orange-400 hover:bg-orange-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
        >
          Verwerk partijen voor Ronde {{Round.round}}
        </inertia-link>
        <inertia-link
          :href="route('admin.games.generate')"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
        >
          Genereer nieuwe partijen
        </inertia-link>
        <inertia-link
          :href="route('admin.games.create')"
          class="py-2 px-2 bg-green-400 hover:bg-green-600 rounded-md border-gray-200 shadow-md text-white text-xs mx-2"
        >
          Voeg een nieuwe partij toe
        </inertia-link>
      </div>
    </div>
    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">
        <table class="sticky top-0 min-w-max w-full table-auto">
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-center">Wit</th>
              <th class="py-3 px-6 text-center">Zwart</th>
              <th class="py-3 px-6 text-center">
                Resultaat
              </th>
              <th class="py-3 px-6 text-center hidden md:table-cell">Ronde</th>
              <th class="py-3 px-6 text-center">Acties</th>
            </tr>
          </thead>
          <tbody
            v-for="(game, key) in Games"
            class="text-gray-600 text-sm font-light"
            :key="game.id"
          >
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              :class="{ 'bg-gray-50': checkOdd(key) }"
            >

              <td class="text-center">
                <div v-if="disabled === game.id">
                  <select-input v-model="game.white">
                    <option
                      v-for="user in Users"
                      :key="user.id"
                      :value="user.id"
                    >{{user.name}}</option>
                  </select-input>
                </div>
                <div v-else>
                  {{ game.white_player.name }}</div>
              </td>
              <td class="text-center">
                <div v-if="disabled === game.id">
                  <div v-if="game.black_player === null">
                    <select-input v-model="game.black">
                      <option
                        v-for="user in Users"
                        :key="user.id"
                        :value="user.id"
                      >{{user.name}}</option>
                      <option
                        value="Bye"
                        selected
                      >Bye</option>
                    </select-input>
                  </div>
                  <div v-else>
                    <select-input v-model="game.black">
                      <option
                        v-for="user in Users"
                        :key="user.id"
                        :value="user.id"
                      >{{user.name}}</option>
                      <option value="Bye">Bye</option>
                    </select-input>
                  </div>
                </div>
                <div v-else>
                  <div v-if="game.black_player === null">Reden: {{game.black}}</div>
                  <div v-else>{{ game.black_player.name }}</div>
                </div>
              </td>

              <td class="text-center">
                <div v-if="disabled === game.id">
                  <select-input v-model="game.result">
                    <option value="0-0">0-0</option>
                    <option value="1-0">1-0</option>
                    <option value="0.5-0.5">0.5-0.5</option>
                    <option value="0-1">0-1</option>
                    <option value="1-0R">1-0R</option>
                    <option value="0-1R">0-1R</option>
                  </select-input>
                </div>
                <div v-else>{{ game.result }}</div>

              </td>
              <td class="text-center hidden md:table-cell">
                {{ game.round.round }} | {{ formattedDate(game.round.date) }}
              </td>
              <td class="text-center">
                <div class="flex item-center justify-center">
                  <button
                    type="button"
                    @click="enable(game) "
                  >
                    <div
                      class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                      v-if="disabled === game.id"
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
                    v-if="game.result === '0-0' || game.black === 'Bye'"
                    type="
                    button"
                    @click="destroy(game.id)"
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
import SelectInput from "@/Shared/SelectInput";
import moment from "moment";
export default {
  name: "Index",
  layout: Layout,
  components: {
    SelectInput,
  },
  props: {
    Games: Array,
    Users: Array,
    Round: Object,
  },
  data() {
    return {
      disabled: null,
    };
  },
  methods: {
    enable(gameID) {
      if (this.disabled == gameID.id) {
        this.disabled = null;
        this.$inertia.patch(this.route("admin.games.patch", gameID), {
          preserveScroll: true,
        });
      } else {
        this.disabled = gameID.id;
      }
      return this.disabled;
    },
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    destroy(gameid) {
      this.$inertia.delete(this.route("admin.games.delete", gameid), {
        preserveScroll: true,
      });
    },
    formattedDate(originalDate) {
      var day = moment(originalDate);
      return day.format("DD-MM-YYYY");
    },
  },
};
</script>

<style scoped>
</style>
