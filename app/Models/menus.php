<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menus extends Model
{
    use HasFactory;

    public $table='menus';
    protected $primaryKey = 'id';
    public $incrementing = false;
    const CREATED_AT='cdate';
    const UPDATED_AT = "updateddate";
}
