<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
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
    public function attendances()
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

    public function reason()
    {
        return $this->belongsTo('App\Models\Reason', 'reason_id');
    }

    
    // Model methods ----------------------------------------------------------
    
    /**
     * create time off presence in the database update time off absence
     * @return null
     */
    public function setAttendance($status, $reason=false)
    {
        return $this->attendances()->create([
            'tijd' => Carbon::now(),
            'status_id' => $status->id,
            'reason_id' => $reason ? $reason->id : 0,
        ]);
    }


    
}