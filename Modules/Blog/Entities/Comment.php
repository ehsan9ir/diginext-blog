<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['username'];
    protected $with = [];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\CommentFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sourceable()
    {
        return $this->morphTo();
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
