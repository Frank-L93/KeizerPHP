<template>
  <div>
    <teleport to="head">
      <title>{{ title('Dashboard') }}</title>
    </teleport>
    <h1 class="mb-8 font-bold text-3xl">Dashboard</h1>
    <p class="mb-8 leading-normal">Welkom bij de competitie-omgeving van <b>{{this.$page.props.clubname[0]}}</b>! <br>
      <span v-if="this.$page.props.auth.user.firsttimelogin == true">Je logt voor de eerste keer in. Wil je eerst wat <inertia-link :href="route('aboutUser')">uitleg lezen over Schaakmanager</inertia-link>?<span v-if="this.$page.props.auth.user.roles[0] == 'competitionleader' "> Zo te zien ben jij de competitieleider, wil je ook <inertia-link :href="route('admin')">uitleg lezen over het beheren van de competitie</inertia-link>? Deze kun je altijd terug vinden in het verenigingsmenu.</span></span>
      <span v-else>Goed je weer te zien! Kijk hier onder direct naar de hoogtepunten uit de competitie</span>
    </p>
    <div class="mb-8 flex">
      <Dashboard />
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import Dashboard from "@/Pages/Dashboard/Index";
import axios from "axios";

export default {
  name: "Index",
  layout: Layout,
  components: {
    Dashboard,
  },
  methods: {
    setFirstTimeLoginToFalse() {
      axios.post("/api/firsttimelogin");
    },
  },
  mounted() {
    if (this.$page.props.auth.user.firsttimelogin == true) {
      this.setFirstTimeLoginToFalse();
    }
  },
};
</script>
