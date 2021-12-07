<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin - Rounds') }}</title>
    </teleport>
    <modal close-url="/admin/rounds">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <div class="px-8 pt-6 pb-5 border-b font-bold leading-none">
          Maak een of meerdere rondes
        </div>
        <form @submit.prevent="submit">
          <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
            <text-input
              v-model="form.date"
              :error="errors.date"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Datum"
              type="date"
            />
            <text-input
              v-model="form.round_number"
              :error="errors.round_number"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Ronde nummer"
              type="number"
            />

            <div>
              <loading-button
                :loading="sending"
                class="mt-5 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-green-500"
                type="submit"
              >Maak ronde</loading-button>
            </div>
          </div>
        </form>
        <form @submit.prevent="submitFile">
          <div class="border-t p-8 -mr-6 -mb-8 flex flex-wrap">

            <file-input
              v-model="fileform.file"
              :error="errors.file"
              class="pr-6 pb-8 w-full lg:w-1/2"
              type="file"
              accept=".csv"
              label="Gebruik een CSV-bestand met kolommen Rondenummer, Datum (in formaat: dd-mm-jjjj)"
            />
            <div>
              <loading-button
                :loading="sending"
                class="mt-5 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-green-500"
                type="submit"
              >Maak rondes</loading-button>
            </div>
          </div>
        </form>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">

        </div>

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
  name: "Create",
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
    FileInput,
  },
  props: {
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        date: null,
        round_number: null,
      },
      fileform: {
        file: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.rounds.store"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
    submitFile() {},
  },
};
</script>

<style scoped>
</style>
