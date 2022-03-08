<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin') }}</title>
    </teleport>
    <div>
      <h1 class="mb-8 font-bold text-3xl">Uitleg</h1>
      <p class="mb-8 leading-normal">
        In principe spreekt het voor zich, maar omdat het kan voorkomen dat je toch wat vragen hebt, hierbij een kleine uitleg.
      </p>
      <div>
        <p class="mb-2 font-bold">Instellingen</p>
        <p class="mb-2">De eerste stap die je doorloopt, zijn de instellingen</p>
        <p class="mb-2 font-bold">Gebruikers</p>
        <p class="mb-2"></p>
        <p class="mb-2 font-bold">Ranglijst</p>
        <p class="mb-2"></p>
        <p class="mb-2 font-bold">Rondes</p>
        <p class="mb-2"></p>
        <p class="mb-2 font-bold">Aanwezigheden</p>
        <p class="mb-2"></p>
        <p class="mb-2 font-bold">Partijen</p>
        <p class="mb-2"></p>

      </div>
    </div>

  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import Icon from "@/Shared/Icon";

export default {
  name: "Index",
  layout: Layout,
  components: {
    Icon,
  },
};
</script>
