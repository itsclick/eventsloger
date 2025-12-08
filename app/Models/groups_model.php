<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groups_model extends Model
{
    use HasFactory;

    public $table='cgroups';
    protected $primaryKey = 'id';
    const CREATED_AT='cdate';
    const UPDATED_AT='updateddate';
    protected $fillable = [
        'gid',
        'gname',
        
    ];

    /**
     * Boot method to auto-generate unique MID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($groupid) {
            $groupid->gid = self::generateMemberId();
        });
    }

    /**
     * Generate a unique membership ID
     */
    public static function generateMemberId()
    {
        do {
            $gid = "GID" . rand(10000000, 99999999);
        } while (self::where('id', $gid)->exists());

        return $gid;
    }

  
}
