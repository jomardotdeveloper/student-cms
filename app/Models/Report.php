<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    protected $fillable = [
        'grievance_id',
        'body',
        'allowed_users'
    ];

    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }

    public function getAllowedUsersAttribute()
    {
        $users = [];

        foreach (json_decode($this->attributes['allowed_users']) as $user) {
            $users[] = User::find($user);
        }
        return $users;
    }
}
