<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin - Gebruikers') }}</title>
    </teleport>
    <modal close-url="/admin/users">
      <form @submit.prevent="submit">
        <div class="bg-white rounded shadow overflow-x-hidden overflow-y-visible max-w-3xl">
          <div class="px-8 pt-6 pb-5 border-b font-bold leading-none">
            Wijzig een gebruiker
          </div>

          <div class="p-8 -mr-6 -mb-8 grid grid-cols-2 ">

            <text-input
              v-model="form.name"
              :error="errors.name"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Naam"
              type="text"
            />
            <text-input
              v-model="form.email"
              :error="errors.email"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Email"
              type="email"
            />
            <text-input
              v-model="form.rating"
              :error="errors.rating"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="Rating"
              type="number"
              step="1"
            />
            <text-input
              v-model="form.knsb_id"
              :error="errors.knsb_id"
              class="pr-6 pb-8 w-full lg:w-1/2"
              label="KNSB ID"
              type="number"
              step="1"
            />
            <div class="block md:flex justify-between">
              <label class="relative flex justify-between items-center group p-2 text-xs">
                Standaard beschikbaar
                <input
                  type="checkbox"
                  class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
                  v-model="form.beschikbaar"
                />
                <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
              </label>
              <label class="relative flex justify-between items-center group p-2 text-xs">
                Uitleg aanzetten
                <input
                  type="checkbox"
                  class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
                  v-model="form.firsttimelogin"
                />
                <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
              </label>
              <label class="relative flex justify-between items-center group p-2 text-xs">
                Actief
                <input
                  type="checkbox"
                  class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
                  v-model="form.active"
                />
                <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
              </label>
              <label class="relative flex justify-between items-center group p-2 text-xs">
                Activatielink nodig
                <input
                  type="checkbox"
                  class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
                  v-model="form.activate"
                />
                <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
              </label>
            </div>

          </div>

          <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
            <div>
              <loading-button
                :loading="sending"
                class="mt-5 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-green-500"
                type="submit"
              >Wijzig</loading-button>
            </div>
            <div>
              <loading-button
                :loading="sending1"
                class="mt-5 py-2 px-2 bg-red-300 rounded-xl border-1 shadow-xl border-gray-200 inline-block justify-between items-center hover:bg-red-500"
                type="button"
                @click="resetPassword"
              >Reset wachtwoord</loading-button>
            </div>
          </div>

        </div>
      </form>
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
import Toggle from "@/Shared/Toggle";

export default {
  name: "Edit",
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
    FileInput,
    Toggle,
  },
  props: {
    user: Object,
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      sending1: false,
      form: {
        id: this.user.id,
        name: this.user.name,
        api_token: this.user.api_token,
        email: this.user.email,
        knsb_id: this.user.knsb_id,
        rechten: this.user.rechten,
        club_id: this.user.club_id,
        rating: this.user.rating,
        beschikbaar: this.user.beschikbaar,
        firsttimelogin: this.user.firsttimelogin,
        active: this.user.active,
        activate: this.user.activate,
      },
      form2: {
        id: this.user.id,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("admin.users.update"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
    resetPassword() {
      if (
        confirm(
          "Weet je zeker dat je het wachtwoord van deze gebruiker wilt resetten?"
        )
      ) {
        this.$inertia.post(
          this.route("admin.users.resetPassword"),
          this.form2,
          {
            inline: "default",
            onStart: () => (this.sending1 = true),
            onFinish: () => (this.sending1 = false),
          }
        );
      }
    },
  },
};
</script>

<style scoped>
</style>
