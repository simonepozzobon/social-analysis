<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $table = 'competitors';

    public function pages() {
        return $this->hasMany(Page::class);
    }

    public function twitter_profiles() {
        return $this->hasMany(TwProfile::class);
    }
}
