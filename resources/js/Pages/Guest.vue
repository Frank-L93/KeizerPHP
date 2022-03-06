<template>
  <div>
    <teleport to="head">
      <title>{{ title('Welkom') }}</title>
    </teleport>
    <div class="min-w-screen min-h-screen bg-gray-50 flex items-center justify-center py-5">

      <div class="w-full bg-white border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
        <div class="w-full max-w-6xl mx-auto">
          <div class="text-center pt-20 md:pt-0 max-w-xl my-auto mx-auto">
            <MainLogo />
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">
            <flash-messages />
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Wat is SchaakManager?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Met SchaakManager kun je als vereniging eenvoudig een Keizercompetitie organiseren via het internet. Je hebt geen speciaal softwareprogramma nodig. <br>Het is aanmelden en gaan! De layout is bovendien geheel mobielvriendelijk!</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">

                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Hoe werkt het?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">De competitieleider van je vereniging registreert zichzelf en verzorgt de eerste instellingen. Leden van de vereniging hoeven alleen maar in te loggen met de door de competitieleider aangemaakte accounts.</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Wat kost het?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Het kost helemaal niks! Probeer het nu uit via de Demo (wordt aangewerkt) <i class="fas fa-desktop"></i></p>
              </div>
            </div>
          </div>
        </div>
        <guestmenu current="home"></guestmenu>

      </div>
    </div>
  </div>
</template>

<script>
import Guestmenu from "@/Shared/Guestmenu";
import FlashMessages from "@/Shared/FlashMessages";
import MainLogo from "@/Shared/MainLogo";

export default {
  name: "Guest",
  components: {
    Guestmenu,
    FlashMessages,
    MainLogo,
  },
};
</script>

<style scoped>
</style>
