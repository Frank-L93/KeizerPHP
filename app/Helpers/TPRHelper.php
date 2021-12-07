<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

// Not really a Helper
class TPRHelper extends Model
{
    // Table Name
    protected $table = 'TPRHelper';

    protected $fillable = ['pn', 'dp'];
    // Timestamps
    public $timestamps = true;
}
