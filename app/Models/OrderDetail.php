<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasUuids;
    protected $table = 'order_details';
    protected $primaryKey = 'uuid';
    protected $keyType = 'uuid';
    protected $fillable = [
        'order_uuid',
        'product_uuid',
        'quantity',
        'total',
    ];

    public $incrementing  = false;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_uuid', 'uuid');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
