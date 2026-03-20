<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'agent_user_type');
    }
}
