<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    /*
    * The competition that is played, needs configuration, which is this Config-model.
    * There a multiple configuration actions.
    * The model gives back the configged variables by using $config->functionname($input);
    * Therefore this can be called in Matching Principles and Calculation Principles
    */


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RoundsBetween_Bye', 'RoundsBetween', 'Club', 'Personal', 'Bye', 'Other', 'Presence', 'Start', 'Step', 'Name', 'Season', 'Admin', 'AbsenceMax', 'announcement', 'SeasonPart', 'club_id',
    ];
    public static function RoundsBetween($bye)
    {
        if ($bye == 1) {
            $value = Config::select('RoundsBetween_Bye')->first();

            // Maybe you want to add more rounds between Bye-games.
            return $value->RoundsBetween_Bye;
        } else {
            $value = Config::select('RoundsBetween')->first();

            return $value->RoundsBetween;
        }
    }

    public static function UsagePresenceScore()
    {
        $value = Config::select('presenceOrLoss')->first();

        if ($value->presenceOrLoss == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function Scoring($result)
    {
        // Absence club (afwezig club)
        if ($result == "Club") {
            $value = Config::select('Club')->first();

            return $value->Club;
        }
        // Absence due to personal reasons/sickness/force majeure (0.25)
        elseif ($result == "Personal") {
            $value = Config::select('Personal')->first();

            return $value->Personal;
        } elseif ($result == "Bye") {
            $value = Config::select("Bye")->first();

            return $value->Bye;
        } elseif ($result == "Presence") {
            $value = Config::select('Presence')->first();

            return $value->Presence;
        }
        // Absence with message (afwezig met bericht) (0.3333) --> max 5 times per season part
        else {
            $value = Config::select('Other')->first();

            return $value->Other;
        }
    }
    public static function SeasonPart()
    {
        $value = Config::select('SeasonPart')->first();

        return $value->SeasonPart;
    }
    public static function AbsenceMax()
    {
        $value = Config::select('AbsenceMax')->first();

        return $value->AbsenceMax;
    }
    public static function InitRanking($key)
    {
        if ($key == "start") {
            $value = Config::select('Start')->first();

            return $value->Start;
        } else {
            $value = Config::select('Step')->first();

            return $value->Step;
        }
    }
    public static function CompetitionName()
    {
        $value = Config::select('Name')->first();
        if ($value == NULL) {
            return "Need Install";
        }
        return $value->Name;
    }

    public static function CompetitionSeason()
    {
        $value = Config::select('Season')->first();

        return $value->Season;
    }
    public static function Admin()
    {
        $value = Config::select('Admin')->first();

        return $value->Admin;
    }

    protected static function booted()
    {
        static::addGlobalScope(new ClubScope);

        static::creating(function ($model) {
            if (session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
        });
    }
}
