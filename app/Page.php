<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    public function competitor() {
        return $this->belongsTo(Competitor::class);    
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
