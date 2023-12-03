<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }

    public function getKeywordsSuggestionsAttribute()
    {
        $keywords = [];
        $suggestions = $this->suggestions;

        foreach ($suggestions as $suggestion) {
            foreach ($suggestion->keywords_related as $keyword) {
                if (!in_array($keyword, $keywords)) {
                    $keywords[] = $keyword;
                }
                // $keywords[] = $keyword;
            }
        }

        return $keywords;
    }

    public function emails()
    {
        return $this->hasMany(Email::class , 'to_user_id');
    }

    public function getUnreadMessagesAttribute()
    {
        $unread_messages = 0;
        $messages = $this->emails;

        foreach ($messages as $message) {
            if ($message->is_read == false && $message->to_user_id == $this->id) {
                $unread_messages++;
            }
        }

        return $unread_messages;
    }
}
