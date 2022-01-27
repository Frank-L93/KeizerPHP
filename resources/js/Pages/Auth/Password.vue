<template>
  <div>
    <teleport to="head">
      <title>{{ title('Reset wachtwoord') }}</title>
    </teleport>
    <Guestmenu />
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
            <div class="mt-1 rounded-md shadow-sm">
              <text-input
                :error="errors.email"
                v-model.lazy="form.email"
                id="email"
                type="email"
                required
                autofocus
                class="mt-10"
                label="Email"
              />
            </div>
          </div>
          {{this.$page.props.flash.status}}
          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-orange active:bg-orange-700 transition duration-150 ease-in-out"
              >
                Stuur een nieuw wachtwoord
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
import Guestmenu from "@/Shared/Guestmenu";

export default {
  name: "Login",
  components: {
    LoadingButton,
    Logo,
    TextInput,
    Guestmenu,
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