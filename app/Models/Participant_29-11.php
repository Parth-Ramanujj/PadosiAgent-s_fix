<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number'
    ];

    protected $casts = [
        'phone_number' => 'string'
    ];

    /**
     * Validation rules
     */
    public static function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone_number' => 'required|string|max:20'
        ];
    }

    /**
     * Custom validation messages
     */
    public static function messages()
    {
        return [
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'phone_number.required' => 'Phone number is required',
        ];
    }
}
