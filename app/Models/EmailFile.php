<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_id',
        'file',
        'name'
    ];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
