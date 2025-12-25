<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_model extends Model
{
    use HasFactory;


    public $table = 'logerevents';
    protected $primaryKey = 'id';
    const CREATED_AT = 'createdate';
    const UPDATED_AT = 'updateddate';





    /**
     * Boot method to auto-generate unique 
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($eventid) {
            $eventid->eid = self::generateMemberId();
        });
    }

    /**
     * Generate a unique membership ID
     */
    public static function generateMemberId()
    {
        do {
            $eid = "EVT" . rand(10000000, 99999999);
        } while (self::where('eid', $eid)->exists());

        return $eid;
    }
}