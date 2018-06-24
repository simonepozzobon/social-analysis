<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwProfile extends Model
{
    protected $table = 'tw_profiles';

    public function competitor() {
        return $this->belongsTo(Competitor::class);
    }

    public function tweets() {
        return $this->hasMany(Tweet::class);
    }
}
