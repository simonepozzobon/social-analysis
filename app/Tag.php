<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public function tweets() {
        return $this->morphedByMany(Tweet::class, 'taggable');
    }
}
