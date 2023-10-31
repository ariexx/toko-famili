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
        'from_user_uuid',
        'to_user_uuid',
        'is_read'
    ];

    protected $table = 'chats';
    protected $primaryKey = 'uuid';
    protected $keyType = "string";
    public $incrementing = false;

    //create relationship with user
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_uuid', 'uuid');
    }

    //create relationship with user
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_uuid', 'uuid');
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
