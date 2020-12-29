<div>
    @foreach($configs as $index => $config)
        <div wire:key="config-field-{{$config->id}}">
            <div x-data="{ accordion: 0 }">
                <x-accordion accordionID="1" title="Rounds">
            <x-form>
                <x-form-input label="RoundsBetween_Bye" type="number" original="configs.{{$index}}.RoundsBetween_Bye">
                    Rounds between bye
                </x-form-input>
                <x-form-input label="RoundsBetween" type="number" original="configs.{{$index}}.RoundsBetween">
                    Rounds between same pairing
                </x-form-input>
                <x-form-input label="AbsenceMax" type="number" original="configs.{{$index}}.AbsenceMax">
                    Maximum amount of absence rounds that get a scoring
                </x-form-input>
            </x-form>
                </x-accordion>
                <x-accordion accordionID="2" title="Score">
            <x-form>
                <x-form-input label="Club" type="number" original="configs.{{$index}}.Club">
                    Score when playing for club
                </x-form-input>
                <x-form-input label="Bye" type="number" original="configs.{{$index}}.Bye">
                    Score when playing the Bye
                </x-form-input>
                <x-form-input label="Personal" type="number" original="configs.{{$index}}.Personal">
                    Score when absent due to personal reasons
                </x-form-input>
                <x-form-input label="Other" type="number" original="configs.{{$index}}.Other">
                    Score when absent due to other reasons
                </x-form-input>
                <x-form-input label="Presence" type="number" original="configs.{{$index}}.Presence">
                    Score for being present
                </x-form-input>
            </x-form>
                </x-accordion>
                <x-accordion accordionID="3" title="Ranking">
            <x-form>
                <x-form-input label="Start" type="number" original="configs.{{$index}}.Start">
                    Value for the highest ranked player
                </x-form-input>
                <x-form-input label="Step" type="number" original="configs.{{$index}}.Step">
                    Value between two players
                </x-form-input>
            </x-form>
                </x-accordion>
                <x-accordion accordionID="4" title="Season">
            <x-form>
                <x-form-input label="Season" type="text" original="configs.{{$index}}.Season">
                    Season
                </x-form-input>
                <x-form-input label="SeasonPart" type="number" original="configs.{{$index}}.SeasonPart">
                    Amount of rounds for one part of the season
                </x-form-input>
                <x-form-input label="EndSeason" type="number" original="configs.{{$index}}.EndSeason">
                    Is it the end of the season? 1 for yes, 0 for no
                </x-form-input>
            </x-form>
                </x-accordion>
                <x-accordion accordionID="5" title="General">
            <x-form>
                <x-form-input label="Name" type="text" original="configs.{{$index}}.Name">
                    Competition Name
                </x-form-input>
                <x-form-input label="announcement" type="text" original="configs.{{$index}}.announcement">
                    Announcement to show on dashboard
                </x-form-input>
                <x-form-input label="Admin" type="number" original="configs.{{$index}}.Admin">
                    User ID of Competition Leader, ONLY CHANGE WHEN YOU ARE NO LONGER COMPETITION LEADER
                </x-form-input>
            </x-form>
                </x-accordion>
            </div>
        </div>
    @endforeach

</div>
