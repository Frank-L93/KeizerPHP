<template>
  <div>
    <div class="flex flex-wrap -mx-2 overflow-hidden lg:-mx-3 xl:-mx-3">

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        <Icon
          name="users"
          class="inline-flex"
        /> Aantal deelnemers: {{players[0]}}<br>
        Aantal standaard aanwezige deelnemers: {{players[1]}}
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        <div class="grid grid-cols-5 grid-flow-col">
          <div class="col-span-1">
            <Icon
              name="cake"
              class="inline-flex"
            />
          </div>
          <div class="col-span-4">
            <table>
              <th class="
            table-cell
            text-centerr">Plek</th>
              <th class="table-cell text-center">Naam</th>
              <th class="table-cell text-center">Score</th>
              <tr
                v-for="(user, key) in top"
                :key="user.id"
              >
                <td class="table-cell text-center">{{key + 1}}</td>
                <td class="table-cell text-center">{{user.user.name}}</td>
                <td class="table-cell text-center">{{user.score}}</td>
              </tr>
            </table>
          </div>

        </div>
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        <div v-if="currentGames == 'Er is geen komende ronde'">
          Er is geen komende ronde, dus geen partijen beschikbaar.
        </div>
        <div v-else>
          <div v-if="currentGames.length > 0">
            <table>
              <th class="
            table-cell
            text-center">Bord</th>
              <th class="
            table-cell
            text-center">Wit</th>
              <th class="table-cell text-center">Zwart</th>
              <th class="table-cell text-center">Resultaat</th>
              <tr
                v-for="(game,key) in currentGames"
                :key="game.id"
              >
                <td class="
            table-cell
            text-center">{{key + 1}}</td>
                <td class="
            table-cell
            text-center">{{game.white_player.name}}</td>
                <td
                  v-if="game.black_player == null && game.result == 'Afwezigheid'"
                  class="
            table-cell
            text-center"
                >
                  -</td>
                <td
                  v-else-if="game.black_player == null"
                  class="
            table-cell
            text-center"
                >bye</td>
                <td
                  v-else
                  class="table-cell text-center"
                >{{game.black_player.name}}</td>
                <td class="
            table-cell
            text-center">{{game.result}}</td>
              </tr>
            </table>
          </div>
          <div v-else>Er zijn nog geen partijen in de komende ronde</div>
        </div>
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        <div
          v-for="tpr in TPR"
          :key="tpr.id"
        >
          {{tpr.user.name}} heeft de hoogste TPR:<br>
          {{tpr.tpr}}</div>
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        Je beste overwinning is behaald tegen <span
          v-for="(value, name) in bestWin.opponnent"
          :key="name"
        >
          <span v-if="name === 'name'">{{value}}</span>
          <span v-else></span>
        </span> <span
          v-for="(value, name) in bestWin.opponnent"
          :key="name"
        >
          <span v-if="name === 'rating'"> (Rating: {{value}})</span>
          <span v-else></span>
        </span>
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        Resterend aantal rondes:<br>
        {{leftRounds}}
      </div>

    </div>
  </div>
</template>

<script>
import Icon from "@/Shared/Icon";

import axios from "axios";
export default {
  name: "Dashboard",
  components: {
    Icon,
  },
  data() {
    return {
      players: Array,
      top: Array,
      currentGames: Array,
      TPR: Array,
      bestWin: Object,
      leftRounds: null,
    };
  },
  methods: {
    getCurrentPlayers() {
      axios.get("/api/players").then((response) => {
        this.players = response.data;
      });
    },
    getCurrentTop3() {
      axios.get("/api/top").then((response) => {
        this.top = response.data;
      });
    },
    getCurrentGames() {
      axios.get("/api/games/current").then((response) => {
        this.currentGames = response.data;
      });
    },
    getBestTPR() {
      axios.get("/api/tpr").then((response) => {
        this.TPR = response.data;
      });
    },
    getBestWin() {
      axios.get("/api/bestWin").then((response) => {
        this.bestWin = response.data;
      });
    },
    getLeftRounds() {
      axios.get("/api/leftRounds").then((response) => {
        this.leftRounds = response.data;
      });
    },
  },
  mounted() {
    this.getCurrentPlayers();
    this.getCurrentTop3();
    this.getCurrentGames();
    this.getBestTPR();
    this.getBestWin();
    this.getLeftRounds();
  },
};
</script>