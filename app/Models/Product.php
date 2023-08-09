<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'quantity',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'product_uuid', 'uuid');
    }
}
