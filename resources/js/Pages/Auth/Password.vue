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
            <h3 class="text-2xl mb-3 font-semibold inline-flex ">
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

        <form @submit.prevent="resetPassword">
          <input
            v-model="form.token"
            type="hidden"
          >

          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 leading-5"
            >
              Email address
            </label>

            <div class="mt-1 rounded-md shadow-sm">
              <input
                v-model.lazy="form.email"
                id="email"
                type="email"
                required
                autofocus
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
              />
            </div>

          </div>

          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
              >
                Stuur een nieuw wachtwoord.
              </button>
            </span>
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
        token: this.rndStr(20),
      },
    };
  },
  methods: {
    resetPassword() {
      const data = {
        email: this.form.email,
        token: this.form.token,
      };
      this.$inertia.post(this.route("password.resetting"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
    rndStr(len) {
      let text = " ";
      let chars = "123456789abcdefghijklmnopqrstuvwxyz";

      for (let i = 0; i < len; i++) {
        text += chars.charAt(Math.floor(Math.random() * chars.length));
      }

      return text;
    },
  },
};
</script>