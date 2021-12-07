<template>
  <div>
    <teleport to="head">
      <title>{{ title('Welcome') }}</title>
    </teleport>
    <div class="min-w-screen min-h-screen bg-gray-50 flex items-center justify-center py-5">
      <div class="w-full bg-white border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
        <div class="w-full max-w-6xl mx-auto">
          <div class="text-center pt-20 md:pt-0 max-w-xl my-auto mx-auto">
            <h1 class="text-6xl md:text-7xl font-bold mb-5 text-gray-600">KeizerPHP</h1>
            <h3 class="hidden md:flex text-xl mb-5 font-light">Beheer jouw Keizercompetitie, speel mee met een Keizercompetitie</h3>
            <div class="text-center mb-10">
              <span class="inline-block w-1 h-1 rounded-full bg-orange-400 ml-1"></span>
              <span class="inline-block w-3 h-1 rounded-full bg-orange-400 ml-1"></span>
              <span class="inline-block w-40 h-1 rounded-full bg-orange-400"></span>
              <span class="inline-block w-3 h-1 rounded-full bg-orange-400 ml-1"></span>
              <span class="inline-block w-1 h-1 rounded-full bg-orange-400 ml-1"></span>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">

            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Wat is KeizerPHP?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Met KeizerPHP kun je als vereniging eenvoudig een Keizercompetitie organiseren via het internet. Je hebt geen speciaal softwareprogramma nodig. <br>Het is aanmelden en gaan! De layout is bovendien geheel mobielvriendelijk!</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">

                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Hoe werkt het?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">De competitieleider van je vereniging registreert zichzelf en verzorgt de eerste instellingen. Leden van je vereniging hoeven alleen maar in te loggen met de door de competitieleider aangemaakte accounts.</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Wat kost het?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Het kost helemaal niks! Probeer het nu uit via de Demo <i class="fas fa-desktop"></i> & Handleiding <i class="fab fa-wpexplorer"></i></p>
              </div>
            </div>
          </div>
        </div>
        <guestmenu></guestmenu>

      </div>
    </div>
  </div>
</template>

<script>
import Guestmenu from "@/Shared/Guestmenu";
export default {
  name: "Guest",
  components: {
    Guestmenu,
  },
};
</script>

<style scoped>
</style>
