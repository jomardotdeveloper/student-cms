<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Policy::class);
    }

    public function children()
    {
        return $this->hasMany(Policy::class);
    }
}
