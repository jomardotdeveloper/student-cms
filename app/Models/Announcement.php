<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'announcement_category_id',
        'user_id',
        'tag_ids',
    ];

    public function announcementCategory()
    {
        return $this->belongsTo(AnnouncementCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
}
