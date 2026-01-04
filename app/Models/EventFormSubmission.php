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
        'event_id',
        'full_name',       // new
        'phone_number',    // new
        'email_address',   // new
        'gender',
        'otp_code',
        'otp_expires_at',
        'verified',

    ];

    protected $casts = [
        'responses' => 'array',
    ];

    public $timestamps = false;
}
