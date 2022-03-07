<template>
  <div>
    <teleport to="head">
      <title>{{ title('Registreer Club') }}</title>
    </teleport>

    <div class="text-center pt-20 md:pt-0 max-w-xl my-5 mx-auto">
      <MainLogo />
    </div>

    <div class="w-full bg-white border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
      <div class="w-full max-w-md mx-auto">
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
              class="btn-orange"
              type="submit"
            >Registreer</loading-button>
          </div>
        </form>
      </div>
      <Guestmenu current="registerClub" />
    </div>
  </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";
import TextInput from "@/Shared/TextInput";
import MainLogo from "@/Shared/MainLogo";
import FlashMessages from "@/Shared/FlashMessages";
import Guestmenu from "@/Shared/Guestmenu";

export default {
  name: "clubRegister",
  components: {
    FlashMessages,
    LoadingButton,
    TextInput,
    MainLogo,
    Guestmenu,
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
