<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership_model extends Model
{
    use HasFactory;

    public $table='member';
    protected $primaryKey = 'id';
    const CREATED_AT='cdate';
    const UPDATED_AT='updateddate';
}
