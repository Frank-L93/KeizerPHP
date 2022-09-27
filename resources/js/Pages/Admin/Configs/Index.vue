<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin - Instellingen') }}</title>
    </teleport>
    <form
      class=""
      @submit.prevent="submit"
    >
      <div class="flex justify-between">
        <div
          class="px-2 mx-2 my-2 rounded border shadow-xl bg-red-300"
          :class="{'bg-green-300' : show =='general'}"
          @click="show = 'general'"
        >Algemeen</div>
        <div
          class="px-2 mx-2 my-2 rounded border shadow-xl bg-red-300"
          :class="{'bg-green-300' : show =='scores'}"
          @click="show = 'scores'"
        >Scores</div>
        <div
          class="px-2 mx-2 my-2 rounded border shadow-xl bg-red-300"
          :class="{'bg-green-300' : show =='ranking'}"
          @click="show = 'ranking'"
        >Ranglijst</div>
        <div
          class="px-2 mx-2 my-2 rounded border shadow-xl bg-red-300"
          :class="{'bg-green-300' : show =='rounds'}"
          @click="show = 'rounds'"
        >Rondes</div>
        <div
          id="save"
          class="px-2 mx-2 my-2 rounded border shadow-xl bg-green-400 hover:bg-green-500"
        >
          <loading-button
            :loading="sending"
            type="submit"
          >Opslaan</loading-button>
        </div>
      </div>
      <div class="-top-10 max-w-lg border border-gray-200 shadow-xs mx-auto rounded-lg p-10 bg-white text-center space-y-3 flex-grow">
        <div v-if="show == 'scores'">
          <div class="block uppercase tracking-wid text-gray-700 text-xl font-bold mb-2 underline">Scores</div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.club"
                class="appearance-none block mt-1 py-3 px-4"
                label="Score voor afwezigheid namens club"
                type="number"
                step="0.01"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.personal"
                class="appearance-none block mt-1 py-3 px-4"
                label="Score voor afwezigheid met persoonlijke reden"
                type="number"
                step="0.01"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.other"
                class="appearance-none block mt-1 py-3 px-4"
                label="Score voor overige afwezigheid"
                type="number"
                step="0.01"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.bye"
                class="appearance-none block mt-1 py-3 px-4"
                label="Score voor Bye"
                type="number"
                step="0.01"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.presence"
                class="appearance-none block mt-1 py-3 px-4"
                label="Score voor aanwezigheid"
                type="number"
                step="0.01"
              />
              <text-input
                v-model="form.presenceOrLoss"
                class="appearance-none block mt-1 py-3 px-4"
                label="Gebruik de aanwezigheidsscore alleen voor verliezers (0 voor nee, 1 voor ja)"
                type="number"
              />
            </div>
          </div>
        </div>
        <div v-if="show == 'ranking'">
          <div class="block uppercase tracking-wid text-gray-700 text-xl font-bold mb-2 underline">Ranglijst</div>

          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.start"
                class="appearance-none block mt-1 py-3 px-4"
                label="Startwaarde voor hoogste positie op ranglijst"
                type="number"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.step"
                class="appearance-none block mt-1 py-3 px-4"
                label="Waarde tussen iedere positie op ranglijst"
                type="number"
              />
            </div>
          </div>
        </div>
        <div v-if="show == 'rounds'">
          <div class="block uppercase tracking-wid text-gray-700 text-xl font-bold mb-2 underline">Rondes</div>

          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.roundsbetween"
                class="appearance-none block mt-1 py-3 px-4"
                label="Rondes tussen zelfde pairing"
                type="number"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.roundsbetweenbye"
                class="appearance-none block mt-1 py-3 px-4"
                label="Rondes tussen indeling tegen Bye"
                type="number"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.seasonpart"
                class="appearance-none block mt-1 py-3 px-4"
                label="Rondes per seizoenshelft"
                type="number"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.absencemax"
                class="appearance-none block mt-1 py-3 px-4"
                label="Maximaal aantal rondes met afwezigheid-score"
                type="number"
              />
            </div>
          </div>
        </div>
        <div v-if="show == 'general'">
          <div class="block uppercase tracking-wid text-gray-700 text-xl font-bold mb-2 underline">Algemeen</div>

          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.season"
                class="appearance-none block mt-1 py-3 px-4"
                label="Naamgeving voor seizoen"
                type="text"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.endseason"
                class="appearance-none block mt-1 py-3 px-4"
                label="Indicator voor einde seizoen, zet op 1 voor reset"
                type="number"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.announcement"
                class="appearance-none block mt-1 py-3 px-4"
                label="Mededeling voor spelers"
                type="text"
              />
            </div>
          </div>
          <div class=" -mx-3 mb-2">
            <div class="px-3">
              <text-input
                v-model="form.admin"
                class="appearance-none block mt-1 py-3 px-4"
                label="UserID van Competitieleider (niet veranderen tenzij)"
                type="number"
              />
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</template>

<script>
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import Layout from "@/Shared/Layout";

export default {
  layout: Layout,
  name: "Data",
  props: {
    Configs: Object,
  },
  components: {
    TextInput,
    LoadingButton,
  },
  data() {
    return {
      sending: false,
      show: "general",
      form: {
        season: this.Configs[0].Season,
        endseason: this.Configs[0].EndSeason,
        announcement: this.Configs[0].Announcement,
        admin: this.Configs[0].Admin,
        absencemax: this.Configs[0].AbsenceMax,
        seasonpart: this.Configs[0].SeasonPart,
        roundsbetweenbye: this.Configs[0].RoundsBetween_Bye,
        roundsbetween: this.Configs[0].RoundsBetween,
        step: this.Configs[0].Step,
        start: this.Configs[0].Start,
        presence: this.Configs[0].Presence,
        club: this.Configs[0].Club,
        personal: this.Configs[0].Personal,
        other: this.Configs[0].Other,
        bye: this.Configs[0].Bye,
        presenceOrLoss: this.Configs[0].presenceOrLoss
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.saveConfigs"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
