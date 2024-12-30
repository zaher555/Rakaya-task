<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['title','authour','availability_status'];
    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }
}
