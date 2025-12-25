<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFormSubmission extends Model
{
    use HasFactory;


    protected $fillable = [
        'event_form_id',
        'data',
        'user_id',
        'attended',

    ];

    protected $casts = [
        'responses' => 'array',
    ];

    public $timestamps = false;
}