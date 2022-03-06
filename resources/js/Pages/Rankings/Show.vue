<template>
  <div>
    <teleport to="head">
      <title>{{ title("Ranglijst") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div
        v-if="$page.props.club.details.lastProcessed == NULL"
        class="text-xl font-bold mx-2"
      >Ranglijst</div>
      <div
        v-else
        class="text-xl font-bold mx-2"
      >Ranglijst na ronde {{$page.props.club.details.lastProcessed.round}}</div>

    </div>
    <div class="w-full">
      <div class="bg-white shadow-md rounded my-6">

        <table
          v-if="Rankings.length > 0"
          class="sticky top-0 min-w-max w-full table-auto"
        >
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-center">Speler</th>
              <th class="py-3 px-6 text-center">Score</th>
              <th class="py-3 px-6 text-center hidden md:table-cell">
                Partijscore
              </th>
              <th class="py-3 px-6 text-center">Waarde</th>

            </tr>
          </thead>
          <tbody
            v-for="(ranking, key) in Rankings.sort((a, b) => b.score - a.score)"
            class="text-gray-600 text-sm font-light"
            v-bind:key="ranking.id"
          >
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              :class="{ 'bg-gray-50': checkOdd(key)}"
              @mouseenter="toggle(key)"
              @mouseleave="toggle(key)"
            >
              <td class="text-center">{{ ranking.user.name }}</td>
              <td class="text-center">
                <Popper :arrow="true">

                  <div @click="fetchData(ranking.user.id)">{{ ranking.score }}
                    <Icon
                      name="lookup"
                      class="inline-flex"
                    />
                  </div>
                  <template #content>
                    <div v-if="data.length > 0">
                      Opbouw van de score:
                      <hr>
                      <table>
                        <th>Partij (incl. bye en afwezigheid)</th>
                        <th>Score</th>
                        <tr
                          v-for="(game, key) in data"
                          :key="game.id"
                        >
                          <td>{{key + 1}}</td>
                          <td>{{game.score}}</td>
                        </tr>
                      </table>
                      <div>Huidige waarde: {{ranking.value}}</div>
                    </div>
                  </template>

                </Popper>
              </td>
              <td class="text-center hidden md:table-cell">
                {{ ranking.gamescore }}
              </td>
              <td class="text-center">
                {{ ranking.value }}
              </td>

            </tr>
            <tr
              v-if="opened.includes(key)"
              class="bg-orange-100"
            >
              <td class="text-center table-cell md:hidden"><b>Partijscore</b><br>{{ ranking.gamescore }}</td>
              <td class="text-center hidden md:table-cell">
                <b>Vorige waarde</b><br>{{ ranking.LastValue }}
              </td>
              <td class="text-center hidden md:table-cell">
                <b>Kleurbalans</b><br>
                <div v-if="ranking.color == NULL">-</div>
                <div v-else>{{ ranking.color }}</div>

              </td>
              <td class="text-center">
                <b>Gespeelde Partijen</b><br>{{ ranking.amount }}
              </td>
              <td class="text-center">
                <b>TPR</b><br> {{ ranking.TPR }}
              </td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          Er is nog geen ranglijst aangemaakt
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import Popper from "vue3-popper";
import axios from "axios";
import Icon from "@/Shared/Icon";

export default {
  layout: Layout,
  name: "Index",
  components: {
    Popper,
    Icon,
  },
  props: {
    Rankings: Array,
  },
  data() {
    return {
      opened: [],
      data: Array,
    };
  },
  methods: {
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    toggle(id) {
      const index = this.opened.indexOf(id);
      if (index > -1) {
        this.opened.splice(index, 1);
      } else {
        this.opened.push(id);
      }
    },
    async fetchData(userID) {
      axios.get("/gamescore/" + userID).then((response) => {
        this.data = response.data;
      });
    },
  },
};
</script>

<style scoped>
:deep(.popper) {
  background: #ffffff;
  padding: 20px;
  box-shadow: 1;
  border-radius: 20px;
  border: 2px;
  border-color: rgb(3, 3, 3);
  color: rgb(3, 3, 3);
  font-weight: bold;
  text-transform: uppercase;
}

:deep(.popper #arrow::before) {
  background: #ffffff;
}

:deep(.popper:hover),
:deep(.popper:hover > #arrow::before) {
  background: #ffffff;
}
</style>
