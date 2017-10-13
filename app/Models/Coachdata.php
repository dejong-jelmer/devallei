<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Coachdata extends Model
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
    public function coach()
    {
        return $this->belongsTo('App\Models\Coach');
    }
    

    // Model methods
   
    
}