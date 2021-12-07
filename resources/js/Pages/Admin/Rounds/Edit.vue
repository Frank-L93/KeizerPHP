<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin - Rondes') }}</title>
    </teleport>
    <modal close-url="/admin/rounds">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <div class="px-8 pt-6 pb-5 border-b font-bold leading-none">
          Wijzig een ronde
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
              >Update</loading-button>
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
  name: "Edit",
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
    FileInput,
  },
  props: {
    Round: Object,
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        date: this.Round.date,
        round_number: this.Round.round,
        id: this.Round.id,
      },
      fileform: {
        file: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.rounds.update"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>

<style scoped>
</style>
