<template>
  <div>
    <teleport to="head">
      <title>{{ title('Reset wachtwoord') }}</title>
    </teleport>
    <div class="p-6 bg-white-800 flex place-content-center items-center">
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
              label="Wachtwoord"
              type="password"
              autocomplete="current-password"
            />
            <text-input
              v-model="form.password_confirmation"
              id="password_confirmation"
              class="block mt-1 w-full"
              type="password"
              label="Bevestig wachtwoord"
              name="password_confirmation"
              required
            />
          </div>
          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button
                :loading="sending"
                type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md hover:bg-orange-500 focus:outline-none focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-700 transition duration-150 ease-in-out"
              >
                Reset wachtwoord
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
import FlashMessages from "@/Shared/FlashMessages";

export default {
  name: "Reset wachtwoord",
  components: {
    LoadingButton,
    Logo,
    TextInput,
    FlashMessages,
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
        email: this.$page.props.route.query.email,
        password: "",
        password_confirmation: "",
        token: this.$page.props.route.params.token,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("password.update"), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>