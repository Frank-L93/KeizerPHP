<template>
  <div>
    <teleport to="head">
      <title>{{ title('Reset wachtwoord') }}</title>
    </teleport>
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

            <text-input
              v-model="form.password_confirmation"
              id="password_confirmation"
              class="block mt-1 w-full"
              type="password"
              label="Bevestig password"
              name="password_confirmation"
              required
            />

          </div>

          <div class="flex items-center justify-end mt-4">
            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="submit"
            >Reset wachtwoord</loading-button>
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
  name: "Reset wachtwoord",
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
        password_confirmation: "",
      },
    };
  },
  methods: {
    submit() {
      const data = {
        email: this.form.email,
        password: this.form.password,
        password_confirmation: this.form.password_confirmation,
        token: this.$page.props.route.params.token,
      };
      this.$inertia.post(this.route("password.update"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>