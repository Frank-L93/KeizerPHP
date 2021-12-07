<template>
  <div>
    <teleport to="head">
      <title>{{ title("Ranglijst") }}</title>
    </teleport>

    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2">Ranglijst</div>

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
                {{ ranking.score }}
              </td>
              <td class="text-center hidden md:table-cell">
                {{ ranking.gamescore }}
              </td>
              <td class="text-center">
                {{ ranking.value }}
              </td>
              <td class="text-center hidden md:table-cell">{{ ranking.LastValue }}</td>
              <td class="text-center hidden md:table-cell">

                <div v-if="ranking.color == NULL">-</div>
                <div v-else>{{ ranking.color }}</div>

              </td>
              <td class="text-center hidden md:table-cell">

                {{ ranking.amount }}
              </td>
              <td class="text-center hidden md:table-cell">
                {{ ranking.TPR }}
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

export default {
  layout: Layout,
  name: "Index",

  props: {
    Rankings: Array,
  },
  methods: {
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
  },
};
</script>

<style scoped>
</style>
