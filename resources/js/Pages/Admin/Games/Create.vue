<template>
  <div>
    <teleport to="head">
      <title>{{ title('Nieuwe partij') }}</title>
    </teleport>
    <modal close-url="/admin/games/">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <form @submit.prevent="submit">
          <div class="px-8 pt-6 pb-5 border-b font-bold leading-none bg-gray-100">
            Voeg een nieuwe partij toe
          </div>

          <div class="p-8 -mr-6 -mb-8 grid grid-cols-2">

            <select-input
              v-model="form.white"
              :error="errors.white"
              class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
              label="Wit"
            >

              <option
                v-for="user in users"
                :key="user.id"
                :value="user.id"
              >{{user.name}}</option>

            </select-input>
            <select-input
              v-model="form.black"
              :error="errors.black"
              class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
              label="Zwart"
            >

              <option
                v-for="user in users"
                :key="user.id"
                :value="user.id"
              >{{user.name}}</option>
              <option value="Bye">Bye</option>
            </select-input>
            <select-input
              v-model="form.result"
              :error="errors.result"
              class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
              label="Resultaat"
            >
              <option value="0-0">0-0</option>
              <option value="1-0">1-0</option>
              <option value="0.5-0.5">0.5-0.5</option>
              <option value="0-1">0-1</option>
            </select-input>
            <select-input
              v-model="form.round_id"
              :error="errors.round_id"
              class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
              label="Ronde"
            >

              <option
                v-for="round in rounds"
                :key="round.id"
                :value="round.id"
              >{{round.round}} | {{round.date}}</option>
            </select-input>
          </div>

          <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">

            <div>
              <loading-button
                :loading="sending"
                class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
                type="submit"
              >Voeg toe</loading-button>
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

export default {
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
  },
  props: {
    rounds: Array,
    users: Array,
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,

      form: {
        result: "0-0",
        white: null,
        black: null,
        round_id: null,
        id: 0,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.games.store"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>