<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin - Users') }}</title>
    </teleport>
    <modal close-url="/admin/users">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <div class="px-8 pt-6 pb-5 border-b font-bold leading-none">
          Maak een of meerdere gebruikers
        </div>
        <form @submit.prevent="submit">
          <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
            <text-input
              v-model="form.name"
              :error="errors.name"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Naam"
            />
            <text-input
              v-model="form.email"
              :error="errors.email"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Email"
            />
            <text-input
              v-model="form.rating"
              :error="errors.rating"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Rating"
              type="number"
            />
            <text-input
              v-model="form.knsb_id"
              :error="errors.knsb_id"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="KNSB"
              type="number"
            />
            <select-input
              v-model="form.beschikbaar"
              :error="errors.beschikbaar"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Beschikbaar"
            >
              <option :value="null" />
              <option value='0'>Nee</option>
              <option value='1'>Ja</option>
            </select-input>
            <div>
              <loading-button
                :loading="sending"
                class="mt-5 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-green-500"
                type="submit"
              >Maak gebruiker</loading-button>
            </div>
          </div>
        </form>
         <form @submit.prevent="submitFile">
          <label>Gebruik een CSV-bestand met kolommen Naam, Email, Rating, KNSB en Beschikbaar</label>
          <input
            type="file"
            @input="fileForm.usersFile = $event.target.files[0]"
          />
          <progress
            v-if="fileForm.progress"
            :value="fileForm.progress.percentage"
            max="100"
          >
            {{ fileForm.progress.percentage }}%
          </progress>
          <button
            class="mt-5 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-green-500"
            type="submit"
          >Maak gebruikers</button>
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

import { useForm } from "@inertiajs/inertia-vue3";

export default {
  name: "Create",
  layout: Layout,
  setup() {
    const fileForm = useForm({
      usersFile: null,
    });

    function submitFile() {
      console.log("test");
      fileForm.post("/admin/users/createUsers");
    }

    return { fileForm, submitFile };
  },
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
        name: null,
        email: null,
        rating: null,
        knsb_id: null,
        beschikbaar: null,
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.users.store"), this.form, {
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
