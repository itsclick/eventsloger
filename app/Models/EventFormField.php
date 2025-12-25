<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_form_id',
        'label',
        'name',
        'type',
        'is_required',
        'options',
        'position'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
