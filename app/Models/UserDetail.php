<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'user_details';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'user_uuid',
        'street_detail',
    ];
}
