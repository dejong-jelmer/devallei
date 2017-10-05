<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Studentdata;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    
    protected $fillable = [
        'coach_id',
        'status_id',
    ];
    // Relationships
    
    /**
     * Get the studentdata record from a student.
     */
    public function studentdata()
    {
        return $this->hasOne('App\models\Studentdata');    
    }

    /**
     * Get the coach that owns the student.
     */
    public function coach()
    {
        return $this->belongsTo('App\models\Coach');
    }

    /**
     * Get the attendance that of a the student.
     */
    public function attendance()
    {
        return $this->hasMany('App\models\Attendance');
    }

    /**
     * Get the status of a student (status is owner of student).
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    // Model methods
    public function createPresence()
    {
        return $this->attendance()->create([
            'aanwezig_van' => Carbon::now(),
            'afwezig_tot' => Carbon::now(),
        ]);
    }

    public function updateAbsence()
    {
        return $this->attendance()->update([
            'aanwezig_tot' => Carbon::now(),
            'afwezig_van' => Carbon::now(),
        ]);
    }

    
    // public function hasAbsenceStatus()
    // {
    //     return (bool) $this->status()->wherePivotIn('status_id', [2, 3, 4, 5, 6])->count(); 
    // }

    // public function hasOkStatus()
    // {
    //     return (bool) $this->status()->wherePivotIn('status_id', [1])->count(); 
    // }

    // public function createStatus()
    // {
    //     if(!$this->hasAbsenceStatus()) {
    //         return $this->status()->update('1');
    //     }
    // }
    
}