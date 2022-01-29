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
        Partijen in huidige ronde
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        Beste TPR
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        Beste overwinning gebruiker
      </div>

      <div class="my-2 px-2 w-full overflow-hidden md:w-1/2 lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3 border rounded-xl shadow-xl bg-orange-500">
        Resterend aantal rondes
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
      currentGames: null,
      TPR: null,
      bestWin: null,
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