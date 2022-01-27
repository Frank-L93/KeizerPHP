<template>
  <div>
    <teleport to="head">
      <title>{{ title('Login') }}</title>
    </teleport>
    <Guestmenu current="login" />
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
