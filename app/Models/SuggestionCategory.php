<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag_ids',
    ];

    public function getTagsAttribute()
    {
        $tags = [];

        foreach (json_decode($this->attributes['tag_ids']) as $tag) {
            $tags[] = Tag::where('name',$tag)->first();
        }
        return $tags;
    }

    public function getTagNamesAttribute()
    {
        if (!$this->attributes['tag_ids']) {
            return [];
        }
        return json_decode($this->attributes['tag_ids']);
    }

    public function getTagNamesStringAttribute()
    {
        if (!$this->attributes['tag_ids']) {
            return [];
        }
        return implode(' ', json_decode($this->attributes['tag_ids']));
    }
}
