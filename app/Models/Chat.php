<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasUuids;
    protected $fillable = [
        'message',
        'user_uuid',
        'is_read'
    ];

    protected $table = 'chats';
    protected $primaryKey = 'uuid';
    protected $keyType = "string";
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
