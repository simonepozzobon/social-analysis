<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    protected $table = 'mentions';

    public function tweets() {
        return $this->morphedByMany(Tweet::class, 'mentionable');
    }
}
