<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'icon_class',
        'badge_class'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
