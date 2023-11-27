<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrievanceFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'grievance_id',
        'file'
    ];


    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }
}
