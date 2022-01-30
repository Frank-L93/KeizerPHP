<template>
  <div>
    <teleport to="head">
      <title>{{ title('Uitleg') }}</title>
    </teleport>
    <h1 class="mb-8 font-bold text-3xl">Uitleg</h1>
    <p class="mb-8 leading-normal">Inhoudsopgave:
      1. Aanwezigheden doorgeven
      2. Partijen bekijken
      3. Ranglijst bekijken
      4. Gebruikersmenu
      4a. Instellingen
      4b. Notificaties
    </p>

  </div>
</template>

<script>
import Layout from "@/Shared/Layout";

export default {
  name: "Index",
  layout: Layout,
};
</script>