<template>
  <div>
    <teleport to="head">
      <title>{{ title('Verwerk partijen') }}</title>
    </teleport>
    <modal close-url="/admin/games/">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <form @submit.prevent="submit">
          <div class="px-8 pt-6 pb-5 border-b font-bold leading-none bg-gray-100">
            Verwerk partijen
          </div>

          <div class="p-8 -mr-6 -mb-8 grid grid-cols-1">

            Weet je zeker dat je ronde {{round.round}} wilt verwerken?
            <div>De volgende partijen worden nieuw verwerkt, de oude partijen worden opnieuw berekend:
              <div
                v-for="game in games"
                :key="game.id"
              >
                <div v-if="game.round_id == round.id">
                  <div>{{game.white_player.name}} - <span v-if="game.black_player === null">Reden: {{game.black}}</span>
                    <span v-else>{{game.black_player.name}}</span> : {{game.result}}
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">

            <div>
              <loading-button
                :loading="sending"
                class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
                type="submit"
              >Verwerk</loading-button>
            </div>
            <div>
              <loading-button
                :loading="sending"
                class="inline-block mt-2 py-2 px-2 bg-red-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-red-500"
                type="submit"
                @click="cancel = true"
              >Annuleer</loading-button>
            </div>
          </div>
        </form>
      </div>
    </modal>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import LoadingButton from "@/Shared/LoadingButton";
import Modal from "@/Shared/Modal";

export default {
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
  },
  props: {
    round: Object,
    games: Array,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      cancel: false,
      form: {
        round: this.round,
        games: this.games,
      },
    };
  },
  methods: {
    submit() {
      if (this.cancel === true) {
        this.$inertia.visit(this.route("admin.games"));
      } else {
        this.$inertia.post(
          this.route("admin.rankings.processGames"),
          this.form,
          {
            inline: "default",
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
          }
        );
      }
    },
  },
};
</script>