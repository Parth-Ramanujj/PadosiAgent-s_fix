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
        'phone_number',
        'have_insurance',
        'insurance_products',
        'insurance_planning',
        'mutual_fund',
        'mf_plan',
        'thank_my_padosi',
        'thank_my_padosi_for',
        'participant_shared',
        'shareable_id',
        'registration_completed_at'
    ];

    protected $casts = [
        'phone_number' => 'string',
        'insurance_products' => 'array',
        'registration_completed_at' => 'datetime'
        // Remove participant_shared from casts since it's ENUM now
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'participant_shared' => 'No' // Default for ENUM
    ];

    /**
     * Validation rules
     */
    public static function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone_number' => 'required|string|max:20',
            'have_insurance' => 'required|in:yes,no',
            'insurance_products' => 'sometimes|array',
            'insurance_products.*' => 'sometimes|string',
            'insurance_planning' => 'sometimes|string|nullable',
            'mutual_fund' => 'required|in:yes,no',
            'mf_plan' => 'sometimes|string|nullable',
            'thank_my_padosi' => 'sometimes|string|max:255|nullable',
            'thank_my_padosi_for' => 'sometimes|string|nullable',
            'participant_shared' => 'sometimes|in:Yes,No'
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
            'have_insurance.required' => 'Please indicate if you have insurance',
            'mutual_fund.required' => 'Please indicate if you invest in mutual funds',
        ];
    }

    /**
     * Mark participant as shared
     */
    public function markAsShared()
    {
        $this->update(['participant_shared' => 'Yes']);
    }

    /**
     * Check if participant is shared
     */
    public function isShared()
    {
        return $this->participant_shared === 'Yes';
    }
}
