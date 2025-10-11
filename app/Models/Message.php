<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'content',
        'is_read'
    ];

    protected function casts() : array {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function sender(): belongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient(): belongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
