<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
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
    
    // Relationships

    public function students()
    {
       return $this->hasMany('App\models\Student');
    }

    public function getStudents()
    {
       return $this->students()->get();
    }
}