<template>
  <div>
    <teleport to="head">
      <title>{{ title('Instellingen') }}</title>
    </teleport>
    <div class="center border-2 shadow-xl rounded-xl px-4 py-2">
      <form @submit.prevent="submit">
        <div>
          <label class="relative flex justify-between items-center group p-2 text-xs">Naam
            <span>
              <text-input
                type="text"
                v-model="form.name"
              />
            </span>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">Email
            <span>{{$page.props.auth.user.email}} (momenteel alleen aanpasbaar door de competitieleider)
            </span></label>
          <label class="relative flex justify-between items-center group p-2 text-xs">Oud wachtwoord
            <span>
              <text-input
                type="password"
                v-model="form.oldPassword"
              />
            </span>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">Nieuw wachtwoord
            <span>
              <text-input
                type="password"
                v-model="form.newPassword"
              />
            </span>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">Standaard Beschikbaar
            <input
              type="checkbox"
              class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
              v-model="form.beschikbaar"
            />
            <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>

          </label>
        </div>
        <div>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            Notificaties
            <input
              type="checkbox"
              class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
              v-model="form.notifications"
            />
            <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
          </label>
        </div>
        <div v-if="form.notifications == true">
          <label class="relative flex justify-between items-center group p-2 text-xs">
            E-mail
            <input
              type="checkbox"
              class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
              v-model="form.NotifyByMail"
            />
            <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            Website
            <input
              type="checkbox"
              class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
              v-model="form.NotifyByDB"
            />
            <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            RSS
            <input
              type="checkbox"
              class="absolute left-1/2 -translate-x-1/2 peer appearance-none hidden rounded-md"
              v-model="form.NotifyByRSS"
            />
            <span class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"></span>
          </label>
          <div v-if="form.NotifyByRSS == true">
            <label class="relative flex justify-between items-center group p-2 text-xs">
              Jouw RSS Link

              <span>https://keizerphp.test/rss/{{$page.props.auth.user.api_token}}</span></label>
          </div>
          <div v-else></div>

        </div>
        <div>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            Partijen
            <select-input v-model="form.games">
              <option value="0">Toon alleen eigen partijen</option>
              <option value="1">Toon alle partijen</option>
            </select-input>
          </label>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            Ranglijst
            <select-input v-model="form.ranking">
              <option value="0">Eenvoudig</option>
              <option value="1">Uitgebreid</option>
            </select-input>
          </label>
        </div>

        <div>
          <label class="relative flex justify-between items-center group p-2 text-xs">
            Layout
            <span>{{$page.props.auth.user.settings.layout}} (Een donkere modus komt later)</span>
          </label>
        </div>

        <loading-button
          :loading="sending"
          class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
          type="submit"
        >Sla op</loading-button>
      </form>
    </div>
  </div>

</template>

<script>
import TextInput from "@/Shared/TextInput";
import SelectInput from "@/Shared/SelectInput";
import LoadingButton from "@/Shared/LoadingButton";
import Layout from "@/Shared/Layout";
import Toggle from "@/Shared/Toggle";

export default {
  layout: Layout,
  name: "Data",
  props: {},
  components: {
    TextInput,
    SelectInput,
    LoadingButton,
    Toggle,
  },
  data() {
    return {
      sending: false,
      show: "general",
      form: {
        name: this.$page.props.auth.user.name,
        beschikbaar: this.$page.props.auth.user.beschikbaar,
        notifications: this.$page.props.auth.user.settings.notifications,
        games: this.$page.props.auth.user.settings.games,
        ranking: this.$page.props.auth.user.settings.ranking,
        id: this.$page.props.auth.user.settings.id,
        NotifyByMail: this.$page.props.auth.user.settings.NotifyByMail,
        NotifyByDB: this.$page.props.auth.user.settings.NotifyByRSS,
        NotifyByRSS: this.$page.props.auth.user.settings.NotifyByDB,
        oldPassword: "",
        newPassword: "",
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
