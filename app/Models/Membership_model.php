<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\groups_model; // import your group model correctly

class Membership_model extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'id';

    const CREATED_AT = 'cdate';
    const UPDATED_AT = 'updateddate';

    protected $fillable = [
        'mid',
        'fname',
        'lname',
        'tele',
        'email',
        'address',
        'gender',
        'gid',
    ];

    /**
     * Boot method to auto-generate unique MID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $member->mid = self::generateMemberId();
        });
    }

    /**
     * Generate a unique membership ID
     */
    public static function generateMemberId()
    {
        do {
            $mid = "MID" . rand(10000000, 99999999);
        } while (self::where('mid', $mid)->exists());

        return $mid;
    }

    /**
     * Relationship: Each member belongs to one group
     * gid (member table) → id (groups table)
     */
    public function group()
    {
        return $this->belongsTo(groups_model::class, 'gid','gname', 'id');
    }
}
