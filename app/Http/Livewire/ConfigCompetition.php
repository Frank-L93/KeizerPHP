<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Config;

class ConfigCompetition extends Component
{
    public $configs;

    protected $rules = [
        'configs.*.RoundsBetween_Bye' => 'required',
        'configs.*.RoundsBetween' => 'required',
        'configs.*.Club' => 'required',
        'configs.*.Personal' => 'required',
        'configs.*.Bye' => 'required',
        'configs.*.Presence' => 'required',
        'configs.*.Other' => 'required',
        'configs.*.Start' => 'required',
        'configs.*.Step' => 'required',
        'configs.*.Name' => 'required',
        'configs.*.Season' => 'required',
        'configs.*.Admin' => 'required',
        'configs.*.EndSeason' => 'required',
        'configs.*.announcement' => 'required',
        'configs.*.AbsenceMax' => 'required',
        'configs.*.SeasonPart' => 'required',
    ];

    public function save()
    {
        foreach($this->configs as $config)
        {
            $config->save();
        }
        session()->flash('success', 'Configuratie opgeslagen');
    }

    public function render()
    {

        return view('livewire.config-competition');
    }
}
