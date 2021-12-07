<template>
  <div>
    <teleport to="head">
      <title>{{ title('Login') }}</title>
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
        <inertia-link :href="route('register')">
          <div class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md text-right">
            <h3 class="text-2xl mb-3 font-semibold inline-flex align-top">
              Registreer
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
              v-model="form.email"
              :error="errors.email"
              class="mt-10"
              label="Email"
              type="email"
              autofocus
              autocapitalize="off"
              autocomplete="current-email"
            />
            <text-input
              v-model="form.password"
              class="mt-6"
              label="Password"
              type="password"
              autocomplete="current-password"
            />
            <label
              class="mt-6 select-none flex items-center"
              for="remember"
            >
              <input
                id="remember"
                v-model="form.remember"
                class="mr-1"
                type="checkbox"
              >
              <span class="text-sm">Onthoud mij</span>
            </label>
          </div>
          <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
            <inertia-link
              class="hover:underline"
              tabindex="-1"
              :href="route('password.request')"
            >Wachtwoord vergeten?</inertia-link>
            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="submit"
            >Login</loading-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";
import Logo from "@/Shared/Logo";
import TextInput from "@/Shared/TextInput";
export default {
  name: "Login",
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  props: {
    errors: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      sending: false,
      form: {
        email: "",
        password: "",
        remember: null,
      },
    };
  },
  methods: {
    submit() {
      const data = {
        email: this.form.email,
        password: this.form.password,
        remember: this.form.remember,
      };
      this.$inertia.post(this.route("login.attempt"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
