<template>
  <div>
    <teleport to="head">
      <title>{{ title('Help') }}</title>
    </teleport>
    <div class="text-center pt-20 md:pt-0 max-w-xl my-5 mx-auto">
      <MainLogo />

      <guestmenu current="help"></guestmenu>
    </div>
    <div class="w-full bg-gray-300 border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
      <div class="w-full max-w-6xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">

          <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
            <div class="w-full flex mb-4 items-center">
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">Eerste stap</h6>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">De eerste stap die gedaan moet worden om gebruik te maken van SchaakManager is dat de contactpersoon van de vereniging, zich registreert en de competitie instelt. De eerste maal duurt het zo'n 5 tot 10 minuten om alles naar wens in te stellen en de leden aan te maken.</p>
            </div>
          </div>
          <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
            <div class="w-full flex mb-4 items-center">

              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">Heb je een account?</h6>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">Dan log je in met jouw e-mailadres dat bij de vereniging gebruikt wordt en met jouw ontvangen wachtwoord. Er wordt altijd aangeraden om eerst je wachtwoord te wijzigen. Daarna kun je op geven bij welke rondes je aanwezig of afwezig bent, je kunt een ranglijst bekijken en de partijen bekijken</p>
            </div>
          </div>
          <div class="w-full rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
            <div class="w-full flex mb-4 items-center">
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">Hoe ziet het er uit van binnen?</h6>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">Plaatjes zeggen veel meer dan woorden, dus bij deze ook een reeks van screenshots.
                <img src='/assets/dashboard.png' />
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
import Guestmenu from "@/Shared/Guestmenu";
import MainLogo from "@/Shared/MainLogo";
export default {
  name: "Guest",
  components: {
    Guestmenu,
    MainLogo,
  },
};
</script>

<style scoped>
</style>
