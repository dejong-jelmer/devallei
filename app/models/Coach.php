<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Coach extends Model
{
    
    protected $fillable = [
        'coach',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'email',
        'telefoon',
        'mobiel',
        'straat',
        'huisnummer',
        'postcode',

    ];
}