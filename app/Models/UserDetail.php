<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes, HasFactory, HasUuids;

    protected $table = 'user_details';
    protected $primaryKey = 'uuid';
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'user_uuid',
        'street_detail',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
