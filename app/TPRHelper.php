<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPRHelper extends Model
{
    // Table Name
    protected $table = 'TPRHelper';
   
    protected $fillable = ['p', 'dp'];
    // Timestamps
    public $timestamps = true;
}