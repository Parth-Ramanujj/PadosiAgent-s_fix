<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference_id',
        'name',
        'mobile',
        'email',
        'company',
        'subject',
        'message',
        'status'
    ];

    /**
     * Scope a query to only include pending submissions.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include replied submissions.
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Scope a query to only include closed submissions.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Generate a new reference ID.
     */
    public static function generateReferenceId(): string
    {
        return 'CONTACT_' . strtoupper(uniqid());
    }

    /**
     * Check if submission is recent (within 24 hours).
     */
    public function isRecent(): bool
    {
        return $this->created_at->gt(now()->subDay());
    }
}
