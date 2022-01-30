<template>
  <div>
    <teleport to="head">
      <title>{{ title('Over') }}</title>
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
                  <h6 class="font-bold text-sm uppercase text-gray-600">Maker</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">KeizerPHP is gemaakt door Frank Lambregts. Frank schaakt zelf ook en in zijn vrije tijd probeert hij deze applicatie te optimaliseren. Je kunt meer over Frank te weten komen op zijn eigen <a
                    href='https://franklambregts.com/'
                    target='_blank'
                  >website</a>! Vragen of opmerkingen over deze applicatie, stuur gerust een mail naar dev@keizerphp.nl!</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">

                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Technische werking van KeizerPHP</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Wellicht ben je benieuwd hoe het een en ander werkt op de achtergrond. Dat is gemakkelijk uit te zoeken, omdat de broncode van deze applicatie vrij toegankelijk is voor iedereen. Er wordt gebruik gemaakt van toffe technieken en frameworks zoals Laravel (backend), Vue (frontend), Inertia (de lijm tussen back- en frontend) en Tailwind (de opmaak). Op <a
                    href="https://github.com/frank-l93/keizerphp"
                    target='_blank'
                  >GitHub</a> kun je bijdragen of rondsnuffelen. Er zijn geen tests geschreven, dat is wel iets wat zou moeten, dus ben jij een tester, schroom niet!</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Wat kost het nou echt?</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Om gebruik te maken van de applicatie, betaal je echt helemaal niks. Je kunt eventuele aanvullende services aanvragen, zoals een private versie voor je vereniging. Om de applicatie (momenteel) in de lucht te houden, kost het Frank zo'n 25 bakjes koffie per maand. Die kun je, als je wilt, betalen via donatieplatform <a
                    href='https://ko-fi.com/keizerphp'
                    target='_blank'
                  >Ko-Fi</a></p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 ml-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Juridisch</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Helaas moeten ook wij voldoen aan wat juridische regels, onder meer omtrent cookies. Wij maken zo min mogelijk gebruik van tracking en cookies. Alleen enkele noodzakelijke cookies leggen wij vast: Een cookie met daarin opgeslagen of je cookies accepteert, en 2 cookies om jouw site beleving te optimaliseren (een unieke Sessie-ID en een zogenaamde token om formulieren veilig te verwerken). Meer niet, en we zijn niet van plan om dat te veranderen, want cookies en tracking is stom.</p>
              </div>
            </div>
            <div class="w-full rounded-lg bg-white border border-gray-200 p-5 ml-3 text-gray-800 font-light mb-6">
              <div class="w-full flex mb-4 items-center">
                <div class="flex-grow pl-3">
                  <h6 class="font-bold text-sm uppercase text-gray-600">Dank</h6>
                </div>
              </div>
              <div class="w-full">
                <p class="text-sm leading-tight">Deze applicatie kan niet bestaan zonder de controle die vaak is uitgevoerd met behulp van Sevilla (JBFSoftware) om te kijken of het indelingsmechanisme overeen kwam. Dank voor het beschikbaar stellen van Sevilla JB!</p>
              </div>
            </div>
          </div>
        </div>
        <guestmenu current="about"></guestmenu>

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
