<template>
  <div>
    <teleport to="head">
      <title>{{ title('Over') }}</title>
    </teleport>
    <div class="text-center pt-20 md:pt-0 max-w-xl my-5 mx-auto">
      <MainLogo />

      <guestmenu current="about"></guestmenu>
    </div>
    <div class="w-full bg-gray-300 border-t border-b overflow-hidden relative border-gray-200 px-5 py-16 md:py-24 text-gray-800">
      <div class="w-full max-w-6xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-3 ml-2 mr-2 mb-4 md:flex items-start">

          <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
            <div class="w-full flex mb-4 items-center">
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">Maker</h6>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">SchaakManager is gemaakt door Frank Lambregts. Frank schaakt zelf ook en in zijn vrije tijd probeert hij deze applicatie te optimaliseren. Je kunt meer over Frank te weten komen op zijn eigen <a
                  href='https://franklambregts.com/'
                  target='_blank'
                  class='underline hover:no-underline hover:text-orange-400'
                >website</a>! Vragen of opmerkingen over deze applicatie, stuur gerust een mail naar info@schaakmanager.nl!</p>
            </div>
          </div>
          <div class="w-full rounded-lg bg-white border border-gray-200 p-5 mr-3 text-gray-800 font-light mb-6">
            <div class="w-full flex mb-4 items-center">

              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">Technische werking van SchaakManager</h6>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">Wellicht ben je benieuwd hoe het een en ander werkt op de achtergrond. Dat is gemakkelijk uit te zoeken, omdat de broncode van deze applicatie vrij toegankelijk is voor iedereen. Er wordt gebruik gemaakt van toffe technieken en frameworks zoals Laravel (backend), Vue (frontend), Inertia (de lijm tussen back- en frontend) en Tailwind (de opmaak). Op <a
                  href="https://github.com/frank-l93/KeizerPHP"
                  target='_blank'
                  class='underline hover:no-underline hover:text-orange-400'
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
                  href='https://ko-fi.com/KeizerPHP'
                  target='_blank'
                  class='underline hover:no-underline hover:text-orange-400'
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
              <p class="text-sm leading-tight">Helaas moeten ook wij voldoen aan wat juridische regels, onder meer omtrent cookies. Wij maken zo min mogelijk gebruik van tracking en cookies. Alleen enkele noodzakelijke cookies leggen wij vast: Een cookie met daarin opgeslagen of je cookies accepteert, en 2 cookies om jouw site beleving te optimaliseren (een unieke Sessie-ID en een zogenaamde token om formulieren veilig te verwerken). Meer niet, en we zijn niet van plan om dat te veranderen, want cookies en tracking zijn stom.</p>
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

