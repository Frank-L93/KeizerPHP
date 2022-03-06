<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin') }}</title>
    </teleport>
    <div>

      <div>
        Inhoudsopgave:
        1. Instellingen
        2. Gebruikers
        3. Ranglijst
        4. rondes
        5. Aanwezigheden
        6. Partijen
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";

export default {
  name: "Index",
  layout: Layout,
  props: {},
};
</script>

