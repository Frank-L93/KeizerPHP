<template>
  <div>
    <teleport to="head">
      <title>{{ title('Partijen') }}</title>
    </teleport>
    <div class="flex items-center justify-between">
      <div class="text-xl font-bold mx-2 inline-flex align-middle">Partijen</div>
      <div v-if="this.$page.props.flash.error">

      </div>
      <div v-else>
        <div class="text-xl font-bold mx-2 inline-flex align-middle">Rondes</div>
        <nav
          class="inline-flex rounded-md shadow-sm -space-x-px align-middle"
          aria-label="Pagination"
        >

          <inertia-link
            v-if="previousShow"
            :href="route('games')"
            :data="{round: previous}"
            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
          >
            <Icon name="chevron-left" />
            <span class="sr-only">Previous</span>

          </inertia-link>
          <div v-else-if="next == Rounds[1].uuid">
          </div>
          <inertia-link
            v-else
            :href="route('games')"
            :data="{round: next}"
            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
          >
            <Icon name="chevron-left" />
            <span class="sr-only">Previous</span>

          </inertia-link>

          <div
            v-for="round in RoundsToShow"
            :key="round.uuid"
          >
            <inertia-link
              :href="route('games')"
              :data="{round: round.uuid}"
              aria-current="page"
              class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
              :class="{'z-10 bg-orange-50 border-orange-500 text-orange-600': $page.props.route.query.round == round.uuid ?? 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 '}"
            >

              {{round.round}}
            </inertia-link>

          </div>
          <div v-if="previousShow == false"></div>
          <div v-else-if="next ==Rounds[1].uuid">
            <inertia-link
              :href="route('games')"
              :data="{round: next}"
              class="relative inline-flex items-center px-2 py-2 ml-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
            >
              <Icon name="chevron-right" />
              <span class="sr-only">Next</span>
            </inertia-link>
          </div>
          <inertia-link
            v-else
            :href="route('games')"
            :data="{round: next}"
            class="relative inline-flex items-center px-2 py-2 ml-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
          >
            <Icon name="chevron-right" />
            <span class="sr-only">Next</span>
          </inertia-link>
        </nav>

      </div>
    </div>

    <div class="w-full">
      <div v-if="Current.published == 0">Partijen nog niet gepubliceerd</div>

      <div v-else class="bg-white shadow-md rounded my-6">
        
        <table class="sticky top-0 min-w-max w-full table-auto">
          <thead class="">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-center">Ronde</th>
              <th class="py-3 px-6 text-center">Wit</th>
              <th class="py-3 px-6 text-center">Zwart</th>
              <th class="py-3 px-6 text-center">Resultaat</th>
              <th class="py-3 px-6 text-center">Jouw Score</th>
            </tr>
          </thead>
          <tbody
            v-for="(game, key) in Games"
            class="text-gray-600 text-sm font-light"
            v-bind:key="game.id"
          >
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              :class="{ 'bg-gray-50': checkOdd(key) }"
            >

              <td class="py-3 px-6 text-center">{{game.round.round}}</td>
              <td class="py-3 px-6 text-center">
                {{game.white_player.name}}
              </td>
              <td class="py-3 px-6 text-center">
                <span v-if="game.black_player === null">{{game.black}}</span>
                <span v-else>{{game.black_player.name}}</span>
              </td>
              <td class="py-3 px-6 text-center">
                {{game.result}}
              </td>
              <td class="py-3 px-6 text-center">{{score(game.id)}}</td>
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
import Icon from "@/Shared/Icon";

export default {
  name: "ShowGames",
  layout: Layout,
  data() {
    return {
      previousShow: true,
      nextShow: true,
    };
  },
  props: {
    Games: Array,
    Rounds: Array,
    Scores: Array,
    Navigation: Array,
    Current: Object,
  },
  components: {
    Icon,
  },
  computed: {
    previous() {
      // als meer dan 1, dan 0, als 1 dan check of huidig eerste ronde is als dat is dan niet laten zien en alleen next, anders
      if (this.Navigation.length > 1) {
        return this.Navigation[0].uuid;
      } else {
        this.previousShow = false;
        if (this.Navigation[0].uuid == this.Rounds[0].uuid) {
          return "First Not Showing";
        } else {
        }
        return "first";
      }
    },
    next() {
      if (this.Navigation.length > 1) {
        return this.Navigation[1].uuid;
      } else {
        return this.Navigation[0].uuid;
      }
    },
    RoundsToShow() {
      const showableRounds = [];

      for (let k = -3; k < 3; k++) {
        if (this.Rounds[this.Current.round + k] !== undefined) {
          showableRounds.push(this.Rounds[this.Current.round + k]);
        }
      }
      return showableRounds;
    },
  },
  methods: {
    checkOdd(key) {
      if (key % 2 === 0 || key === 0) {
        return true;
      }
      return false;
    },
    score(id) {
      for (let i = 0; i < this.Scores.length; i++) {
        if (this.Scores[i]["id"] == id) {
          return this.Scores[i]["score"];
        }
      }
    },
    formattedDate(originalDate) {
      var day = moment(originalDate);
      return day.format("DD-MM-YYYY");
    },
  },
};
</script>