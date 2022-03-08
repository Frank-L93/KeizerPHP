<?php

namespace App\Models\Swiss;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwissGame extends Model
{
    use HasFactory;

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
