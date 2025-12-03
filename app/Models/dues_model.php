<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dues_model extends Model
{
    use HasFactory;

    public $table='mdues';
    protected $primaryKey = 'id';
    const CREATED_AT='cdate';
    const UPDATED_AT='updateddate';
}
