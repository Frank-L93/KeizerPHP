<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Todo get this stuff from the database.
class Config extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RoundsBetween_Bye', 'RoundsBetween', 'Club','Personal','Bye','Other','Presence','Start','Step','Name','Season','Admin','AbsenceMax','announcement'
,    ];
    public static function RoundsBetween($bye){
        if($bye == 1)
        {
            $value = Config::select('RoundsBetween_Bye')->first();
            
            // Maybe you want to add more rounds between Bye-games.
            return $value->RoundsBetween_Bye;
        }
        else
        {
            $value = Config::select('RoundsBetween')->first();
           
            return $value->RoundsBetween;
        }
    }
    
    public static function Scoring($result)
    {
        if($result == "Club")
        {
            $value = Config::select('Club')->first();
           
            return $value->Club;
        }
        elseif($result == "Personal")
        {
            $value = Config::select('Personal')->first();
           
            return $value->Personal;
        }
        elseif($result == "Bye")
        {
            $value = Config::select("Bye")->first();
           
            return $value->Bye;
        }
        elseif($result == "Presence")
        {
            $value = Config::select('Presence')->first();
           
            return $value->Presence;
        }
        else{
            $value = Config::select('Other')->first();
           
            return $value->Other;
        }
    }
    public static function AbsenceMax()
    {
        $value = Config::select('AbsenceMax')->first();
           
            return $value->AbsenceMax;  
    }
    public static function InitRanking($key)
    {
        if($key == "start"){
            $value = Config::select('Start')->first();
           
            return $value->Start;
        }
        else{
            $value = Config::select('Step')->first();
           
            return $value->Step;
        }
    }
    public static function CompetitionName()
    {
        $value = Config::select('Name')->first();
        if($value == NULL)
        {
            return "Need Install";
        }
        return $value->Name;  
    }

    public static function CompetitionSeason()
    {
        $value = Config::select('Season')->first();
           
            return $value->Season;
    }
}
