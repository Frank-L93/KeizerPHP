<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    public $fillable = [
        'name', 'contact', 'club_owner', 'token',
    ];


    public function name()
    {
        return $this->name;
    }
}
