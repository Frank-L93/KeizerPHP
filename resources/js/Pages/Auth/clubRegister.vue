<template>
  <div>
    <teleport to="head">
      <title>{{ title('Registreer Club') }}</title>
    </teleport>
    <div class="grid grid-cols-2 w-1/16">
      <div class="col-span-2 col-end-1 my-2">
        <inertia-link :href="route('home')">
          <div class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md">
            <h3 class="text-2xl mb-3 font-semibold inline-flex">
              Home
            </h3>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
        </inertia-link>
      </div>
      <div class="col-end-5 col-span-2 my-2">
        <inertia-link :href="route('login')">
          <div class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md text-right">
            <h3 class="text-2xl mb-3 font-semibold inline-flex ">
              Login

            </h3>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 flex"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
        </inertia-link>
      </div>
    </div>
    <div class="p-6 bg-white-800 min-h-screen flex justify-center items-center">
      <div class="w-full max-w-md">
        <logo
          class="block mx-auto w-full max-w-xs fill-white"
          height="50"
        />
        <flash-messages></flash-messages>
        <form
          class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden"
          @submit.prevent="submit"
        >
          <div class="px-10 py-12">
            <text-input
              v-model="form.name"
              :error="errors.name"
              class="mt-10"
              label="Verenigingsnaam"
              type="text"
              autofocus
              autocapitalize="off"
            />
            <text-input
              v-model="form.contact"
              :error="errors.contact"
              class="mt-6"
              label="Competitieleider"
              type="text"
              autocapitalize="off"
            />
            <text-input
              v-model="form.email"
              :error="errors.email"
              class="mt-6"
              label="Email"
              type="email"
              autocapitalize="off"
            />
            <text-input
              v-model="form.password"
              class="mt-6"
              label="Wachtwoord"
              type="password"
            />
            <text-input
              v-model="form.knsb"
              class="mt-6"
              label="KNSB-nummer"
              type="number"
            />
            <text-input
              v-model="form.rating"
              class="mt-6"
              label="Rating"
              type="number"
            />
          </div>
          <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="submit"
            >Registreer</loading-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";
import TextInput from "@/Shared/TextInput";
import Logo from "@/Shared/Logo";
import FlashMessages from "@/Shared/FlashMessages";

export default {
  name: "clubRegister",
  components: {
    FlashMessages,
    LoadingButton,
    TextInput,
    Logo,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      sending: false,
      form: {
        name: null,
        contact: null,
        email: null,
        password: null,
        knsb: null,
        rating: null,
      },
    };
  },
  methods: {
    submit() {
      const data = new FormData();
      data.append("name", this.form.name || "");
      data.append("contact", this.form.contact || "");
      data.append("email", this.form.email || "");
      data.append("password", this.form.password || "");
      data.append("knsb", this.form.knsb || "");
      data.append("rating", this.form.rating || "");

      this.$inertia.post(this.route("registerClub"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>

<style scoped>
</style>
