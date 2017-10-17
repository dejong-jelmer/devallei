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
     * Get the studentdata record belongs to a student.
     * @return object Studendata model
     */
    public function studentdata()
    {
        return $this->hasOne('App\Models\Studentdata');    
    }

    /**
     * Get the coach that owns the student.
     * @return object Coach model
     */
    public function coach()
    {
        return $this->belongsTo('App\Models\Coach');
    }

    /**
     * Get the attendance that of a the student.
     * @return object Attendance model
     */
    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * Get the status of a student (status is owner of student).
     * @return  object Status model
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    /**
     * Get the students reasons for their status
     * @return object Reason model
     */
    public function reason()
    {
        return $this->hasManyThrough('App\Models\Reason', 'App\Models\Student');
    }

    // Model methods
    
    /**
     * create time off presence in the database update time off absence
     * @return null
     */
    public function createPresence()
    {
        return $this->attendance()->create([
            'aanwezig_van' => Carbon::now(),
            'afwezig_tot' => Carbon::now(),
        ]);
    }

    /**
     * create time off absence in the database update time off presence
     * @return null
     */
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