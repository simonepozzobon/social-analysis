<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';

    public function profile() {
        return $this->belongsTo(TwProfile::class);
    }

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function mentions() {
        return $this->morphToMany(Mention::class, 'mentionable');
    }
}
