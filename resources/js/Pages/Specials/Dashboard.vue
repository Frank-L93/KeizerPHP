<template>
  <h2
    class="text-center text-lg font-bold underline"
    v-for="club in currentFavoriteClub"
    :key="club.id"
  > {{club.name}}</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">
    <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
      <div class="w-full flex mb-4 items-center">
        <div class="flex-grow pl-3">
          <h6 class="font-bold text-sm uppercase text-gray-600">Partijen</h6>
        </div>
      </div>
      <div class="w-full">
        <div class="text-sm leading-tight">
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
      </div>
    </div>
    <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
      <div class="w-full flex mb-4 items-center">
        <div class="flex-grow pl-3">
          <h6 class="font-bold text-sm uppercase text-gray-600">Huidige stand</h6>
        </div>
      </div>
      <div class="w-full">
        <div class="text-sm leading-tight">

          <div class="">
            <table>
              <th class="
            table-cell
            text-centerr">Plek</th>
              <th class="table-cell text-center">Naam</th>
              <th class="table-cell text-center">Score</th>
              <tr
                v-for="(user, key) in currentRanking"
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
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "Dashboard",
  components: {},

  data() {
    return {
      currentGames: Array,
      currentFavoriteClub: Array,
      currentRanking: Array,
      club: this.$cookies.get("club"),
    };
  },
  methods: {
    getCurrentGames(clubid) {
      axios
        .get("/api/clubs/club/" + clubid + "/games/current")
        .then((response) => {
          this.currentGames = response.data;
        });
    },
    getCurrentRanking(clubid) {
      axios
        .get("/api/clubs/club/" + clubid + "/ranking/current")
        .then((response) => {
          this.currentRanking = response.data;
        });
    },
    getCurrentFavoriteClub(clubid) {
      axios.get("/api/clubs/club/" + clubid + "/name").then((response) => {
        this.currentFavoriteClub = response.data;
      });
    },
  },
  created() {
    this.getCurrentGames(this.club);
    this.getCurrentRanking(this.club);
    this.getCurrentFavoriteClub(this.club);
  },
};
</script>