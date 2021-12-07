<template>
  <div>
    <teleport to="head">
      <title>{{ title('Pas aanwezigheid aan') }}</title>
    </teleport>
    <modal close-url="/presences/">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <form @submit.prevent="submit">
          <div class="px-8 pt-6 pb-5 border-b font-bold leading-none bg-gray-100">
            Pas een aanwezigheid aan
          </div>

          <div class="p-8 -mr-6 -mb-8 grid grid-cols-1">
            Je past je aanwezigheid aan voor ronde {{ Presence.round }}
            <input
              type="hidden"
              v-model="form.id"
            />
            <input
              type="hidden"
              v-model="form.round"
            />
            <div v-if="Presence.presence == 1">
              <select-input
                v-model="form.reason"
                :error="errors.reason"
                class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
                label="Afwezigheidsreden"
              >
                <option value="Empty"></option>
                <option value="Other">Afwezig met bericht</option>
                <option value="Club">Afwezig i.v.m. clubactiviteit</option>
                <option value="Personal">Afwezig door persoonlijke omstandigheid</option>
              </select-input>
            </div>
          </div>

          <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
            <div v-if="Presence.presence == 1">
              <loading-button
                v-model="form.availability"
                :loading="sending1"
                class="inline-block mt-2 py-2 px-2 bg-red-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-red-500"
                type="submit"
                v-on:click="form.availability = 0"
              >Afwezig</loading-button>
            </div>

            <div v-else>
              <div>
                <loading-button
                  v-model="form.availability"
                  :loading="sending2"
                  class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
                  type="submit"
                  v-on:click="form.availability = 1"
                >Aanwezig</loading-button>
              </div>
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
import TextInput from "@/Shared/TextInput";
import Modal from "@/Shared/Modal";
import SelectInput from "@/Shared/SelectInput";
import FileInput from "@/Shared/FileInput";

export default {
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
    FileInput,
  },
  props: {
    Presence: Object,
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending1: false,
      sending2: false,

      form: {
        id: this.Presence.id,
        reason: null,
        availability: null,
        change: 1,
        round: this.Presence.round,
      },
    };
  },
  methods: {
    submit() {
      if (this.form.availability == 0) {
        this.$inertia.post(this.route("presences.store"), this.form, {
          inline: "default",
          onStart: () => (this.sending1 = true),
          onFinish: () => (this.sending1 = false),
        });
      } else {
        this.$inertia.post(this.route("presences.store"), this.form, {
          inline: "default",
          onStart: () => (this.sending2 = true),
          onFinish: () => (this.sending2 = false),
        });
      }
    },
  },
};
</script>