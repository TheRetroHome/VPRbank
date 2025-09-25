<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'is_active',
        'tag_id'
    ];

    protected function casts() : array {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
