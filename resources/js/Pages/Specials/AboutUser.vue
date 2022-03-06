<template>
  <div>
    <teleport to="head">
      <title>{{ title('Uitleg') }}</title>
    </teleport>
    <h1 class="mb-8 font-bold text-3xl">Uitleg</h1>
    <p class="mb-8 leading-normal">
      In principe spreekt het voor zich, maar omdat het kan voorkomen dat je toch wat vragen hebt, hierbij een kleine uitleg.
    </p>
    <p class="mb-2 font-bold">Aanwezigheden doorgeven</p>
    <p class="mb-2">Aan het begin van het seizoen kan de competitieleider ervoor kiezen om iedereen die heeft aangegeven standaard aanwezig te zijn, voor alle rondes in een keer aanwezig te zetten. <br />
      Als hij dat gedaan heeft, zul je zien dat je al een hele lijst aan aanwezigheden hebt. Die kun je aanpassen met het potloodje
    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 inline-flex">
      <Icon name="pencil" />
    </div>. Dat wijst voor zich, ben je aanwezig, kun je het aanpassen naar afwezig en vice versa. <br />
    Bij het afwezig melden kun je een reden opgeven. Per reden kan een andere score nog worden gekregen, afhankelijk van hoe de competitieleider dat heeft ingesteld.
    <br /> Het toevoegen van een nieuwe aanwezigheid, gaat gemakkelijk met de groene knop rechtsboven op de pagina van de aanwezigheden. Je selecteert de datum waarvoor je je aanwezigheid wilt opgeven en kiest vervolgens of je afwezig bent of aanwezig bent die datum.
    </p>
    <p class="mb-2 font-bold">Partijen bekijken</p>
    <p class="mb-2">Zodra er partijen zijn, kun je bij de pagina met partijen, alle partijen terugvinden per ronde. Rechtsboven kun je naar de rondes door klikken.<br /> Bovendien zie je bij je eigen partijen welke score je hebt gehaald.</p>
    <p class="mb-2 font-bold">Ranglijst bekijken</p>
    <p class="mb-2">Ook de ranglijst is heel eenvoudig. Gesorteerd op score zie je daar de stand en als je over een van de regels gaat met je muis of hand, zie je wat extra gegevens van die persoon in de ranglijst.
      Bovendien, als je op het icoontje
      <Icon
        name="lookup"
        class="inline-flex"
      /> drukt bij de score, zie je hoe de score is opgebouwd.
    </p>
    <p class="mb-2 font-bold"> Gebruikersmenu</p>
    <p>Helemaal bovenin zie je je naam, dat is het gebruikersmenu. Daar kun je uitloggen of je instellingen aanpassen. De meeste instellingen spreken voor zich.<br />
      Je kunt je naam aanpassen, wachtwoord wijzigen en bijvoorbeeld voor het volgend seizoen aangeven of je standaard aanwezig bent. Ook kun je je notificatie-instellingen regelen daar. Wil je bijvoorbeeld een mail krijgen als ingedeeld is, geef je dat daar op.
      Sommige instellingen hebben nog geen effect, maar wordt later wel gebruikt!</p>

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