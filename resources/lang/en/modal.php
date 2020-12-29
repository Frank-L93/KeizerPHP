<?php

return [
    'notificationsTitle' => '
<div class="flex justify-between items-center pb-3">
    <p class="text-2xl font-bold">Wanneer en hoe krijg je notificaties?</p>
    <div class="cursor-pointer z-50" @@click="showModal = false">
        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
    </div>
</div>',
'notificationsContent' => '
<p>Afhankelijk van je instellingen, apparaat en browser kun je verschillende soorten notificaties krijgen. Wanneer je voor de eerste keer inlogt zul je geen notificaties krijgen, pas als je hier in de instellingen een van de opties selecteert zul je notificaties krijgen.
                                                                Notificaties zijn handige statusupdates: Wanneer de stand is bijgewerkt, een nieuwe ronde is ingedeeld of jouw partijen is bijgewerkt.</p>
                                                                <p>
                                                                <ul class="list-disc ml-2 mt-2 mb-2">
                                                                <li>Notificaties per e-mail: Je krijgt een email met de statusupdate.</li>
                                                                <li>Push Notificaties: Je krijgt een melding dat je browser push notificaties wilt tonen. Accepteer dit en je zult de statusupdates als melding vanuit je browser, ongeacht of deze open staat, krijgen. 
                                                                <br>Dit werkt niet altijd maar wel in de volgende gevallen:
                                                                <ol class="list-decimal ml-5 mt-2 mb-2">
                                                                <li>Chrome (niet iOS)</li>
                                                                <li>Edge (de nieuwste versie)</li>
                                                                <li>FireFox (niet iOS)</li>
                                                                <li>Safari (niet iOS)</li>
                                                                </ol>
                                                                </li>
                                                                <li>Notificaties per SMS: Je krijgt een SMS met de statusupdate. Bij het gebruik van deze optie wordt om een kleine donatie gevraagd gezien het versturen van SMSjes geld kost.</li>
                                                                <li>Notificaties op de website: Je krijgt de statusupdate alleen te zien op de website, boven in het scherm zul je een postvak zien waar je de meldingen in ontvangt. Hiervoor dien je ingelogd te zijn. Bij iedere soort notificatie, krijg je deze. Met deze optie krijg je alleen de notificatie op de website.</li>
                                                                </ul></p>
                                                                <small>Wil je pushnotificaties ontvangen op je iPhone? Maak dan gebruik van de optie om een RSS-feed te gebruiken. Met de meeste RSS Reader apps, krijg je een notificatie als er namelijk een nieuw item daar aan is toegevoegd. En dat gebeurd!
                                                                Jouw RSS-feed link is persoonlijk, dus je krijgt alleen je eigen berichten te zien. Werkt ook op andere apparaten;)</small>',

];
?>