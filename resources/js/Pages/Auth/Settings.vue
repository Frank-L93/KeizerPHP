<template>
  <div>
    <teleport to="head">
      <title>{{ title('Instellingen') }}</title>
    </teleport>
    <form @submit.prevent="submit">
      <div><label>Naam</label> {{$page.props.auth.user.name}} (momenteel alleen aanpasbaar door de competitieleider)
      </div>
      <div>Email: {{$page.props.auth.user.email}} (momenteel alleen aanpasbaar door de competitieleider)
      </div>
      <div>
        Beschikbaarheid: {{$page.props.auth.user.beschikbaar}} (momenteel alleen aanpasbaar door de competitie-leider)
      </div>
      <select-input
        label="Notificaties"
        v-model="form.notifications"
      >
        <option value="0">Geen notificaties</option>
        <option value="1">Notificaties via web</option>
        <option value="2">Notificaties via e-mail en web</option>
        <option value="3">Notificaties via e-mail en web en RSS-kanaal</option>
        <option value="4">Notificaties via e-mail en RSS-kanaal</option>

      </select-input>

      <select-input
        label="Partijen"
        v-model="form.games"
      >
        <option value="0">Toon alleen eigen partijen</option>
        <option value="1">Toon alle partijen</option>
      </select-input>

      <select-input
        label="Ranglijst"
        v-model="form.ranking"
      >
        <option value="0">Eenvoudig</option>
        <option value="1">Uitgebreid</option>
      </select-input>
      <div v-if="$page.props.auth.user.settings.rss == 1">
        <text-input
          label="Jouw RSS-link"
          type="text"
          disabled
        >https://keizerphp.test/rss/{{$page.props.auth.user.api_token}}</text-input>
      </div>
      <div v-else></div>
      <div>
        Layout: {{$page.props.auth.user.settings.layout}} (Een donkere modus komt later)
      </div>
      <div>
        Voor het resetten van je wachtwoord, log je uit en vraag je een reset-link aan.
      </div>
      <loading-button
        :loading="sending"
        class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
        type="submit"
      >Sla op</loading-button>
    </form>
  </div>

</template>

<script>
import TextInput from "@/Shared/TextInput";
import SelectInput from "@/Shared/SelectInput";
import LoadingButton from "@/Shared/LoadingButton";
import Layout from "@/Shared/Layout";

export default {
  layout: Layout,
  name: "Data",
  props: {},
  components: {
    TextInput,
    SelectInput,
    LoadingButton,
  },
  data() {
    return {
      sending: false,
      show: "general",
      form: {
        notifications: this.$page.props.auth.user.settings.notifications,
        games: this.$page.props.auth.user.settings.games,
        ranking: this.$page.props.auth.user.settings.ranking,
        id: this.$page.props.auth.user.settings.id,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("user.saveSettings"), this.form, {
        inline: "default",
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
