<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventForm extends Model
{
    protected $fillable = [
        'event_id',
        'status',
        'user_id',

    ];

    public function fields()
    {
        return $this->hasMany(EventFormField::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventFormSubmission::class, 'event_form_id');
    }
}
