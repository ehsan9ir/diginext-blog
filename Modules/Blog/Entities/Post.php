<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['comments'];
    protected $appends = ['username'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'sourceable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute()
    {
        if (isset($this->user) && $this->user) {
            $username = $this->user->username;
            unset($this->user);

            return $username;
        }

        return null;
    }
}
